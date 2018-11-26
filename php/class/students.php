<?php
/**
 * 学生类
 *	查看学生信息
 * 	从所有form中查看适合我填的表
 *	从order中查我填过的表
 *	提交一个我填的表的信息，json
 */

class students extends tools {
	public $yb_uid; //易班uid
	public $class_name; //班级信息
	public $students_name; //学生名字
	public $student_id; //学号
	public $school_name; //学校
	public $college_name; //学院
	public $type;
// 构造函数，查询并保存用户的姓名,学号，班级等信息

	function __construct($yb_uid) {

		$this->yb_uid = $yb_uid;

		$db = $this->pdos();
		$db->exec("set names utf8");
		$sql = "select * from users where yb_uid='{$yb_uid}'";
		$a = $db->query($sql)->fetchAll();

		$this->students_name = $a[0]['name'];
		$this->school_name = $a[0]['school'];
		$this->college_name = $a[0]['college_name'];
		$this->class_name = $a[0]['class'];
		$this->student_id = $a[0]['studentid'];
		$this->type = $a[0]["type"];

	}

//获取我要填写的表单列表,。

	function get_my_form_text_list() {
		$class_name = $this->class_name;
		$db = $this->pdos();
		$db->exec("set names utf8");
		$sql = "SELECT * FROM `forms` WHERE `classes` LIKE '%{$class_name}%'";
		$a = $db->query($sql);
		return array_column($a->fetchAll(), "id"); //返回符合条件的表单id值
	}

// 表单的所有信息,通过表单id查待填表单信息

	function get_form_text($id) {
		$db = $this->pdos();
		$db->exec("set names utf8");
		$sql = "select * from forms where id= '{$id}'";
		$a = $db->query($sql);
		$db = null;
		return $a->fetchAll();
	}

// 获取我已填写的表单列表
	function get_my_form_data_list() {
		$yb_uid = $this->yb_uid;
		$db = $this->pdos();
		$db->exec("set names utf8");
		$sql = "SELECT * FROM `form_orders` WHERE yb_uid='{$yb_uid}'";
		$a = $db->query($sql)->fetchAll();
		$db = null;
		return array_column($a, "id"); //返回符合条件的表单id值
	}

//获取已填表单的数据

	function get_form_data($oid) {
		$yb_uid = $this->yb_uid;
		$db = $this->pdos();
		$db->exec("set names utf8");
		$sql = "SELECT * FROM `form_orders` WHERE `id`='{$oid}' AND `yb_uid`='{$yb_uid}'";
		$a = $db->query($sql);
		$db = null;
		return $a->fetchAll();
	}

//提交表单

	function submit_form($data, $oid) {
		$yb_uid = $this->yb_uid;
		$date = $this->get_time_now();
		$db = $this->pdos();
		$db->exec("set names utf8");
		$data = addslashes($data);
		$sql = "INSERT INTO `form_orders` (`oid`,`yb_uid`,`data`,`date`) VALUES ('{$oid}','{$yb_uid}','{$data}','{$date}')";
		$a = $db->exec($sql);
		$db = null;
		return $a;
	}

}