<?php
require_once '../../config/db.php';
require_once '../../class/tools.php';
require_once '../../class/students.php';
require_once '../../class/teachers.php';

header('Content-type:text/json');
header('charset: utf-8;');

session_start();

if (!isset($_SESSION["yb_uid"])) {
	die("用户未登录");
}
