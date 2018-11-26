<?php
require_once '../common/common_header.php';

if (!isset($_POST['form_model'])) {
	die("未传入数据");
}

$yb_uid = $_SESSION['yb_uid'];

$teachers = new teachers($yb_uid);

$form_model = $_POST['form_model'];
$classes = $_POST['classes'];

if ($teachers->save_form($form_model, $classes, 1, 1)) {
	die("success");
}
die("fail");