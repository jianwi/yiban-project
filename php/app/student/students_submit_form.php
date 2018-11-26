<?php
require_once '../common/common_header.php';

if (!isset($_POST['id'])) {
	die("未传入数据");
}
$id = $_POST['id'];
unset($_POST['id']);

$data = json_encode($_POST);

$student = new students($_SESSION['yb_uid']);

if ($student->submit_form($data, $id)) {
	die("success");
}

die("错误");