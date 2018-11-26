<?php
require_once '../common/common_header.php';
$yb_uid = $_SESSION['yb_uid'];

$teachers = new teachers($yb_uid);

$result = array(
	"classes" => $teachers->classes,
	"name" => $teachers->name,
	"my_form_text" => $teachers->check_all_my_forms(),
);

echo json_encode($result);
