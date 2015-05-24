<?php
!defined('SERVER_EXEC') && die('No access.');

require_once(dirname(__FILE__) . '/../lib/base.php');

class PollModel extends Model
{
	public $tablename = 'poll';

	public function getLastPollDate()
	{
		$query = 'SELECT MAX(`date`) FROM `poll`';

		$lastdate = $this->getCell($query);

		return $lastdate;
	}
}