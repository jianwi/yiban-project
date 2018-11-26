<meta charset="utf-8">

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

//工具类
require_once 'config/db.php';
require_once 'class/tools.php';
$api = YBOpenApi::getInstance()->init($config['AppID'], $config['AppSecret'], $config['CallBack']);

$iapp = $api->getIApp();

try {
//轻应用获取access_token，未授权则跳转至授权页面
	$info = $iapp->perform();
} catch (YBException $ex) {
	echo $ex->getMessage();
}

// 获取toekn，保存cookie
$token = $info['visit_oauth']['access_token']; //轻应用获取的token
$api->bind($token);

$type = $api->request("user/real_me")["info"]["yb_identity"]; //用户身份
$sex = $api->request("user/real_me")["info"]["yb_sex"]; //用户性别
$userAll = $api->request("user/verify_me");
// 解析数组
$yb_username = $userAll["info"]["yb_realname"]; //用户名
$yb_school = $userAll["info"]["yb_schoolname"]; //学校名

$yb_uid = $userAll["info"]["yb_userid"]; //id

$b = array_values($userAll["info"]);

$tools = new tools($yb_uid);
list($yb_uid, $realname, $schoolid, $school, $college_name, $class, $enteryear, $studentid) = $b;
$c = $tools->write_details($yb_uid, $realname, $school, $college_name, $class, $studentid, $type);

session_start();
$_SESSION['yb_uid'] = $yb_uid;
$_SESSION['token'] = $token;
$_SESSION['realname'] = $realname;
$_SESSION['yb_school'] = $yb_school;
$_SESSION['college_name'] = $college_name;
$_SESSION['class'] = $class;
$_SESSION['studentid'] = $studentid;
$_SESSION['type'] = $type;
$_SESSION['sex'] = $sex;

if ($c) {
	echo "数据写入成功";
} else {
	echo "数据写入失败，用户信息可能已存在";
}

?>