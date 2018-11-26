<?php

/*
输入id,返回表单数据。
如果班级不被包含与。返回不支持填表。

 */

require_once '../../config/db.php';
require_once '../../class/tools.php';
require_once '../../class/students.php';
require_once '../../class/teachers.php';

header('charset: utf-8;');

session_start();

if (!isset($_SESSION["yb_uid"])) {
	die("用户未登录");
}

if (!isset($_GET['id'])) {
	die("未传入id参数");
}

$id = $_GET['id'];
$student = new students($_SESSION["yb_uid"]);
$a = $student->get_form_text($id);
$class = $_SESSION['class'];
$classes = $a[0]['classes'];
if (!strpos($classes, $class)) {
	die("你不符合填写表单的条件");
}

echo $a[0]['data'];
