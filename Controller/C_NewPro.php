<?phpinclude_once('C_Base.php');//// ����������� �������� ������ ����� �������.//class C_NewPro extends C_Base{	private $newPro = array();	// ������ ����� �������  		//	// �����������.	//	function __construct()	{    	parent::__construct();	}		//	// ����������� ���������� �������.	//	protected function OnInput()	{		parent::OnInput();		$this->title = '����� ������';		if (isset ($_GET['cat']))		{			$this->newPro = $this->product->GetByCat($_GET['cat']);			$cat = M_Category::Instance()->Get($_GET['cat']);					$this->title = $cat['cat_name'];		}		else 			$this->newPro = $this->product->All();			}		//	// ����������� ��������� HTML.	//		protected function OnOutput()	{		$vars = array('admin' => $_SESSION['admin'], 'title' => $this->title, 'newPro' => $this->newPro);			$this->content = $this->Template('View/V_NewPro.php', $vars);		parent::OnOutput();	}	}