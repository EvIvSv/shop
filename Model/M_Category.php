<?php//// �������� ���������//class M_Category{	private static $instance; 	// ������ �� ��������� ������	private $msql; 				// ������� ��		//	// ��������� ������������� ���������� (��������)	//	public static function Instance()	{		if (self::$instance == null)			self::$instance = new M_Category();				return self::$instance;	}	//	// �����������	//	public function __construct()	{		$this->msql = MSQL::Instance();	}		//	// ������ ���� ���������	//	public function All()	{		$query = "SELECT * 				  FROM category 				  ORDER BY id_cat DESC";				  		return $this->msql->Select($query);	}	//	// ���������� ���������	//	public function Get($id_cat)	{		// ������.		$t = "SELECT * 			  FROM  category			  WHERE id_cat = '%d'";			  		$query = sprintf($t, $id_cat);		$result = $this->msql->Select($query);		return $result[0];	}	//	// �������� ���������	//	public function Add($id_cat, $cat_name, $har1, $har2, $har3, $har4, $har5)	{		// ����������.		$pro_name = trim($cat_name);		$har1 = trim($har1);		$har2 = trim($har2);		$har3 = trim($har3);		$har4 = trim($har4);		$har5 = trim($har5);		// ��������.		if ($cat_name == '')			return false;		if ($id_cat == '')			return false;				// ������.		$obj = array();		$obj['cat_name'] = $cat_name;		$obj['har1'] = $har1;		$obj['har2'] = $har2;		$obj['har3'] = $har3;		$obj['har4'] = $har4;		$obj['har5'] = $har5;				$this->msql->Insert('category', $obj);		return true;	}	//	// �������� ���������	//	public function Edit($id_cat, $cat_name, $har1, $har2, $har3, $har4, $har5)	{		// ����������.		$cat_name = trim($cat_name);		$har1 = trim($har1);		$har2 = trim($har2);		$har3 = trim($har3);		$har4 = trim($har4);		$har5 = trim($har5);		// ��������.		if ($cat_name == '')			return false;				$obj = array();		$obj['cat_name'] = $cat_name;		$obj['har1'] = $har1;		$obj['har2'] = $har2;		$obj['har3'] = $har3;		$obj['har4'] = $har4;		$obj['har5'] = $har5;				$t = "id_cat = '%d'";				$where = sprintf($t, $id_cat);				$this->msql->Update('category', $obj, $where);		return true;	}	//	// ������� ���������.	//	public function Delete($id_cat)	{		// ������.		$t = "id_cat = '%d'";				$where = sprintf($t, $id_cat);				$this->msql->Delete('category', $where);		return true;	}}