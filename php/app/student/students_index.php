<?php
// 判断是否登陆，没登录直接显示。
// 返回所有表单链接的id号。form_text_list
// 返回所有已填写表单的数据的id号。form_data_list

require_once '../common/common_header.php';

$students = new students($_SESSION['yb_uid']);

$text = $students->get_my_form_text_list();
$data = $students->get_my_form_data_list();
$result = array('form_text_list' => $text,
	'form_data_list' => $data);

echo json_encode($result);