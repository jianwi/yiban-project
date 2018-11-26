<?php
// 传入订单id。查看详细数据
require_once '../common/common_header.php';

if (!isset($_GET['id'])) {
	die("未传入参数");
}

$teacher = new teachers($_SESSION['yb_uid']);

$result = $teacher->get_form_data($_GET['id']);

ksort($result[0], SORT_NUMERIC);
$b = array_slice($result[0], 0, 6);
unset($b[0]);
$b["data"] = stripcslashes($b["data"]);
echo json_encode($b);