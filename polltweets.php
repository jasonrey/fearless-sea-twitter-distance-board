<?php

!defined('SERVER_EXEC') && define('SERVER_EXEC', 1);

require_once('lib/base.php');

$ch = curl_init();

$apikey = API_KEY;
$apisecret = API_SECRET;
$api = base64_encode($apikey . ':' . $apisecret);

$headers = array(
	'Content-Type: application/x-www-form-urlencoded;charset=UTF-8',
	'Authorization: Basic ' . $api,
	'Content-Length: 29'
);

$postdata = 'grant_type=client_credentials';

curl_setopt($ch, CURLOPT_URL, 'https://api.twitter.com/oauth2/token');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);

$output = curl_exec($ch);
curl_close($ch);

if ($output === false) {
	echo 'CURL error: ' . curl_error($ch);
	exit;
}

$response = json_decode($output);

if (isset($response->errors)) {
	var_dump($response->errors);
	exit;
}

if (!isset($response->token_type) || $response->token_type !== 'bearer') {
	echo 'Unknown error: Unexpected response.';
	exit;
}

$accesstoken = $response->access_token;

$ch = curl_init();

$headers = array(
	'Content-Type: application/x-www-form-urlencoded;charset=UTF-8',
	'Authorization: Bearer ' . $accesstoken
);

$apiurl = 'https://api.twitter.com/1.1/search/tweets.json';

$options = array();
$options['q'] = TWEET_HASHTAG;
$options['result_type'] = TWEET_MODE;
$options['count'] = TWEET_COUNT;

$tweetModel = Lib::model('tweet');
$latestId = $tweetModel->getLatestId();

if (!empty($latestId)){
	$options['since_id'] = $latestId;
}

curl_setopt($ch, CURLOPT_URL, $apiurl . '?' . http_build_query($options));
curl_setopt($ch, CURLOPT_HTTPGET, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$output = curl_exec($ch);
curl_close($ch);

if ($output === false) {
	echo 'CURL error: ' . curl_error($ch);
	exit;
}

$response = json_decode($output);

if (!isset($response->statuses)) {
	echo 'Unknown error: Unexpected response.';
	exit;
}

$processedUser = array();

$tweets = array();

foreach (array_reverse($response->statuses) as $s) {

	// We don't want retweeeted tweets
	if (isset($s->retweeted_status)) {
		continue;
	}

	$tweet = Lib::table('tweet');

	$state = $tweet->load(array('tweetid' => $s->id));

	if ($state) {
		continue;
	}

	$tweets[] = $s->id;

	$pattern = '(\\d+[\\.,].*?)(km|mi)';
	$matched = preg_match('/' . $pattern . '/ui', $s->text, $matches);

	$distance = 0;
	$unit = null;

	if ($matched > 0) {
		$distance = str_replace(',', '.', $matches[1]);
		$unit = $matches[2];
	}

	$tweet->bind(array(
		'tweetid' => $s->id,
		'userid' => $s->user->id,
		'text' => $s->text,
		'date' => date_create($s->created_at)->format('Y-m-d H:i:s'),
		'distance' => $distance,
		'unit' => $unit
	));

	$state = $tweet->store();

	if (!isset($processedUser[$s->user->id])) {
		$processedUser[$s->user->id] = true;

		$user = Lib::table('user');
		$user->load(array('userid' => $s->user->id));

		$user->bind(array(
			'userid' => $s->user->id,
			'name' => $s->user->name,
			'screenname' => $s->user->screen_name,
			'avatar' => $s->user->profile_image_url,
			'cover' => $s->user->profile_background_image_url
		));

		$user->store();
	}
}

$poll = Lib::table('poll');
$poll->count = count($tweets);

$poll->store();

echo '<p>Success!</p>';
echo '<p>Polled tweets: ' . count($tweets) .'</p>';