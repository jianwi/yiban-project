<?php
/**
 * 轻应用授权
 * 访问入口。用户授权，保存用户YB_uid到cookie中。然后跳转到前端首页。
 *
 */
if (!isset($_GET['yb_uid'])) {

	echo (' <meta http-equiv="refresh" content="1;url=http://f.yiban.cn/iapp332886">');
	echo "未登录，1s后跳转授权";
}
require "classes/yb-globals.inc.php";

//配置文件
require_once 'config/yb_token.php';
//初始化

$api = YBOpenApi::getInstance()->init($config['AppID'], $config['AppSecret'], $config['CallBack']);

$iapp = $api->getIApp();

try {
//轻应用获取access_token，未授权则跳转至授权页面
	$info = $iapp->perform();
} catch (YBException $ex) {
	echo $ex->getMessage();
}

// 获取yb_uid，保存cookie
$token = $info['visit_oauth']['access_token']; //轻应用获取的token
$api->bind($token);

$userAll = $api->request("user/me"); //读取api
$yb_uid = $userAll["info"]["yb_userid"]; //id

setcookie('yb_uid')=$yb_uid;


?>