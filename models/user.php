<?php
!defined('SERVER_EXEC') && die('No access.');

require_once(dirname(__FILE__) . '/../lib/base.php');

class UserModel extends Model
{
	public $tablename = 'user';

	public function getTopUsers($options = array())
	{
		/*
		$options = array(
			'limit' => 10,
			'start' => 0
		);
		*/

		/*
		select b.*, count(a.userid) as count, sum(if(a.unit = 'mi', a.distance * 1.60934, a.distance)) as distancekm, sum(if(a.unit = 'km', a.distance * 0.621371, a.distance)) as distancemi from tweet as a
		left join user as b
		on a.userid = b.userid
		where a.distance > 0
		group by a.userid
		order by distancekm desc;
		*/

		$query = 'SELECT `b`.*, COUNT(`a`.`userid`) AS `count`, ROUND(SUM(IF(`a`.`unit` = \'mi\', `a`.`distance` * 1.60934, `a`.`distance`)), 2) AS `distancekm`, ROUND(SUM(IF(`a`.`unit` = \'km\', `a`.`distance` * 0.621371, `a`.`distance`)), 2) AS `distancemi` FROM `tweet` AS `a`';
		$query .= ' LEFT JOIN `user` AS `b` ON `a`.`userid` = `b`.`userid`';
		$query .= ' WHERE `a`.`distance` > 0';
		$query .= ' GROUP BY `a`.`userid`';
		$query .= ' ORDER BY `distancekm` DESC';

		$query .= $this->buildLimit($options);

		return $this->getResult($query);
	}
}