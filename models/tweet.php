<?php
!defined('SERVER_EXEC') && die('No access.');

require_once(dirname(__FILE__) . '/../lib/base.php');

class TweetModel extends Model
{
	public $tablename = 'tweet';

	public function getLatestId()
	{
		$query = 'SELECT MAX(`tweetid`) FROM `tweet`';

		$max = $this->getCell($query);

		return $max;
	}

	public function getUnprocessedTweets()
	{
		$query = 'SELECT * FROM `tweet` WHERE `distance` IS NULL';

		return $this->getResult($query);
	}
}