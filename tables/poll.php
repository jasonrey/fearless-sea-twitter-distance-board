<?php
!defined('SERVER_EXEC') && define('SERVER_EXEC', 1);

require_once(dirname(__FILE__) . '/../lib/base.php');

class PollTable extends Table
{
	public $count;
	public $date;

	public function store()
	{
		if (empty($this->date)) {
			$this->date = date('Y-m-d H:i:s');
		}

		return parent::store();
	}
}