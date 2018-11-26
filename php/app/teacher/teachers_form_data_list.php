<?php

// 根据oid 返回order表的id

require_once '../common/common_header.php';

$teacher = new teachers($_SESSION['yb_uid']);
if (!isset($_GET['id'])) {
	die("未传入参数");
}

$result = $teacher->get_form_data_list($_GET['id']);

echo json_encode($result);
