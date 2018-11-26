<?php
/**
 * 教师类
查：
我管理的班级
我设计的表单
我的表单填写情况
导出表单
写：
设计表单


 */

class teachers extends students {
	public $yb_uid; //易班uid
	public $classes; //班级信息,数组
	public $name; //教师名字
	public $school; //学校

// 构造函数，查询并保存用户的姓名,学号，班级等信息

	function __construct($yb_uid) {

		$this->yb_uid = $yb_uid;
		$db = $this->pdos();
		$db->exec("set names utf8");
		$sql = "select classybname from yb_classlist left join yb_adminlist on yb_classlist.classteacher=yb_adminlist.teacherid WHERE yb_adminlist.teacherid='{$yb_uid}'";
		$a = $db->query($sql);
		$b = array_column($a->fetchAll(), "classybname");
		$this->classes = $b;

	}

//保存,发布一个表单，表单源码，班级（数组），时间,起始时间，结束时间

	function save_form($form_model, $classes, $date1, $date2) {
		$date = $this->get_time_now();
		$yb_uid = $this->yb_uid;
		$form_model = addslashes($form_model);
		$classes = addslashes($classes);
		$db = $this->pdos();
		$db->exec("set names utf8");
		$sql = "INSERT INTO `forms`(`yb_uid`, `data`, `date`,`date_b`, `date_e`, `classes`) VALUES ('{$yb_uid}','{$form_model}','{$date}','{$date1}','{$date2}','{$classes}')";
		return $db->exec($sql);
	}

//获取我设计的表单列表
	function check_all_my_forms() {
		$db = $this->pdos();
		$db->exec("set names utf8");
		$sql = "select * from forms where yb_uid='{$this->yb_uid}'";
		$a = $db->query($sql)->fetchAll();

		function unset_some(&$value, $key) {
			unset($value[0], $value[1], $value['2'], $value['3'], $value['4'], $value['5'], $value['6'], $value['data'], $value['yb_uid']);
			$value["classes"] = stripcslashes($value['classes']);
		}
		array_walk($a, "unset_some");
		$db = null;
		return $a;
	}

//我的表单数据列表

	function get_form_data_list($form_model_id) {
		$db = $this->pdos();
		$db->exec("set names utf8");
		$sql = "SELECT * FROM `form_orders` WHERE `oid`= '{$form_model_id}'";
		$a = $db->query($sql)->fetchAll();
		$db = null;
		return array_column($a, "id");

// 获取表单的数据
		function get_form_data($id) {
			$db = $this->pdos();
			$db->exec("set names utf8");
			$sql = "SELECT `data`,`date` FROM `form_orders` WHERE `id`= '{$id}'";
			$a = $db->query($sql)->fetchAll();
			return $a;
		}

	}
}