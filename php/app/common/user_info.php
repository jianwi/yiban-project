<?php

// 返回用户信息
header('Content-type:text/json');
header('charset: utf-8;');
session_start();
$a = $_SESSION;
unset($a['token']);
echo json_encode($a);
