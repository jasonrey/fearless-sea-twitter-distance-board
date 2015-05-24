<?php
!defined('SERVER_EXEC') && define('SERVER_EXEC', 1);

require_once(dirname(__FILE__) . '/../lib/base.php');

class TweetTable extends Table
{
	public $tweetid;
	public $userid;
	public $text;
	public $date;
	public $distance;
	public $unit;
}