<?php
/**
 * 学生类
 *
 */

class students extends tools {
	public $yb_uid; //易班uid
	public $class; //班级信息
	public $students_name; //学生名字
	public $students_number; //学号

// 构造函数，查询并保存用户的姓名,学号，班级等信息

	function __construct($yb_uid) {

		$this->yb_uid = $yb_uid;

		$db = $this->pdos();
		$db->exec("set names utf8");
		$sql = "select * from students where yb_uid='{$yb_uid}'";
		$db->query($sql);
		$this->class = $a->fetchColumn(3);
		$this->students_name = $a->fetchColumn(2);
		$this->students_number = $a->fetchColumn(4);

	}

//获取表单列表,。

	function get_my_form_list() {
		$class = $this->class;
		$db = $this->pdos();
		$db->exec("set names utf8");
		$sql = "select * from forms where class like '%{$class}%'";
		$a = $db->query($sql);
		return array_column($a->fetchAll(), "id"); //返回符合条件的表单id值
	}

// 表单的所有信息,通过表单id查表单信息

	function get_form_text($id) {
		$db = $this->pdos();
		$db->exec("set names utf8");
		$sql = "select * from forms where id= '{$id}'";
		$a = $db->query($sql);
		return $a->fetchAll(); //返回符合条件的表单id值
	}
}