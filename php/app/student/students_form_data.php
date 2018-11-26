<?php
require_once '../common/common_header.php';

if (!isset($_GET['id'])) {
	die("未传入id");
}

$student = new students($_SESSION['yb_uid']);
$result = $student->get_form_data($_GET['id']);

ksort($result[0], SORT_NUMERIC);
$b = array_slice($result[0], 0, 6);
unset($b[0]);
$b["data"] = stripcslashes($b["data"]);
$my_data = json_encode($b);
echo "$my_data";
