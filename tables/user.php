<?php
!defined('SERVER_EXEC') && define('SERVER_EXEC', 1);

require_once(dirname(__FILE__) . '/../lib/base.php');

class UserTable extends Table
{
	public $userid;
	public $name;
	public $screenname;
	public $avatar;
	public $cover;

	public function load($keys)
	{
		$state = parent::load($keys);

		if (!$state) {
			return $state;
		}

		$this->link = '';

		if (!empty($this->screenname)) {
			$this->link = 'https://twitter.com/' . $this->screenname;
		}
	}

	public function bind($keys)
	{
		$state = parent::bind($keys);

		if (!$state) {
			return $state;
		}

		$this->link = '';

		if (!empty($this->screenname)) {
			$this->link = 'https://twitter.com/' . $this->screenname;
		}
	}
}