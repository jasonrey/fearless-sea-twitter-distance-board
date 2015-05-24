<?php

!defined('SERVER_EXEC') && define('SERVER_EXEC', 1);

require_once('../lib/base.php');

$ajax = Lib::ajax();

$start = isset($_POST['start']) ? $_POST['start'] : 0;
$limit = isset($_POST['limit']) ? $_POST['limit'] : 10;

$userModel = Lib::model('user');

$users = $userModel->getTopUsers(array('start' => $start, 'limit' => $limit));

$ajax->success($users);