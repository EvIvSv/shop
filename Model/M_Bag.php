<?phpinclude_once('M_Users.php');//// �������� �������//class M_Bag{	private static $instance; 	// ������ �� ��������� ������	private $msql; 				// ������� ��	private $id_user;			// ��� �������� ������������	private $pro = array();			//	// ��������� ������������� ���������� (��������)	//	public static function Instance()	{		if (self::$instance == null)			self::$instance = new M_Bag();				return self::$instance;	} 	//	// �����������	//		public function __construct()	{		$this->msql = MSQL::Instance();		$this->id_user = M_Users::Instance()->GetIdUser();	}	    public function SetIdUserBug($id_user)	{        $this->id_user = $id_user;        return true;	}	//	// ���������� ������� �� ��	//	public function GetBag()	{		//$this->pro = $_SESSION['pro'];		// ������.		if ($_SESSION['id_user'] != null)			{			$t = "SELECT * 				  FROM bag 				  WHERE id_user = '%d'";			$query = sprintf($t, $_SESSION['id_user']);			$result = $this->msql->Select($query);			$_SESSION['pro'] = null;			foreach ($result as $val)			{				$_SESSION['pro'][] = array($val['id_pro'], $val['col']);			}		}		return $_SESSION['pro'];	}		//	// ���������� ������ � �������	// $id_pro - ������������� ������	//	public function Add($id_pro)	{		if ($_SESSION['id_user'] == null)		{			$_SESSION['pro'][] = array($id_pro, 1);		}		else		{			$obj['id_user'] = $_SESSION['id_user'];			$obj['id_pro'] = $id_pro;			$obj['col'] = 1;			$this->msql->Insert('bag', $obj);			$this->GetBag();		}		return true;	}	//	// ������� �������	// $id_pro - ������������� ������	//	public function Del($id_pro)	{		//$this->pro = array();		//$_SESSION['pro'] = array();		// ������.		if ($_SESSION['id_user'] == null)		{			for ($i=0; $i<count($_SESSION['pro']); $i++)					if ($_SESSION['pro'][$i][0] == $id_pro)						unset($_SESSION['pro'][$i]);		}		else		{					$t = "id_user = '%d' and id_pro = '%d'";					$where = sprintf($t, $_SESSION['id_user'], $id_pro);					$this->msql->Delete('bag', $where);		}		$this->GetBag();		return true;		}			//	// ������� ���� �������	//	public function DelAll()	{		//$this->GetBag();		//$this->pro = array();		$_SESSION['pro'] = null;		// ������.		$t = "id_user = '%d'";				$where = sprintf($t, $_SESSION['id_user']);				$this->msql->Delete('bag', $where);		return true;		}		//	// ��������� ���������� ������ � �������	// $id_pro - ������������� ������	// $col    - ���������� ������ � ��������� $id_pro	//	public function SetCol($id_pro, $col)	{		if ($_SESSION['id_user'] == null)		{			for ($i=0; $i<count($_SESSION['pro']); $i++)				if ($_SESSION['pro'][$i][0] == $id_pro)					$_SESSION['pro'][$i][1] = $col;		}		else		{			$obj['col'] = $col;			$t = "id_user = '%d' and id_pro = '%d'";					$where = sprintf($t, $_SESSION['id_user'], $id_pro);					$this->msql->Update('bag', $obj, $where);		}		$this->GetBag();		return true;	}	//	// ���������� ������� �������	//	public function SumPro()	{		$this->GetBag();		//echo $_SESSION['pro']		$sum = 0;		if ($_SESSION['pro'] != null)		{			foreach ($_SESSION['pro'] as $val)			{				$sum += $val[1];			}		}				return $sum;	}}