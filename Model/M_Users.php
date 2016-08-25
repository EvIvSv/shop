<?php
include_once('MSQL.php');
include_once('Model/M_Bag.php');
//
// Менеджер пользователей
//
class M_Users
{	
	private static $instance;	// экземпляр класса
	private $msql;				// драйвер БД
	private $id_user;			// идентификатор текущего пользователя
	private $us_name;			// имя текущего пользователя
	private $fam;				// фамилия текущего пользователя
	private $phone;				// телефон текущего пользователя
    private $islogin;           // true, если пользователь авторизован
    private $admin;			// true, если пользователь администратор	
	//
	// Получение экземпляра класса
	// результат	- экземпляр класса MSQL
	//
	public static function Instance()
	{
		if (self::$instance == null)
			self::$instance = new M_Users();
			
		return self::$instance;
	}

	//
	// Конструктор
	//
	public function __construct()
	{
	    $this->islogin = false;
		$this->msql = MSQL::Instance();
		//$this->id_user = null;
		$this->us_name = null;
		$this->fam = null;
		$this->phone = null;
	}
	
	public function GetIdUser()
	{
		return $this->id_user;
	}
    public function GetNameUser()
	{
		return $this->us_name;
	}
    public function GetIslogin()
	{
		return $this->islogin;
	}
	//
	//  Регистрирует нового пользователя и заносит его в базу данных
	//
	public function Add($us_name, $fam, $login, $pass, $phone)
	{	
		// Запрос.
		$obj = array();
		$obj['us_name'] = $us_name;
		$obj['fam'] = $fam;
		$obj['login'] = $login;
		$obj['pass'] = md5($pass);
		$obj['phone'] = $phone;

		$this->msql->Insert('user', $obj);
		return true;
	}

	//
	// Получает пользователя по логину
	//
	public function GetByLogin($login)
	{	
		$t = "SELECT * FROM user WHERE login = '%s'";
		$query = sprintf($t, mysql_real_escape_string($login));
		$result = $this->msql->Select($query);
		return $result[0];
	}
	
	//
	// Авторизация
	// $login 		- логин
	// $pass	 	- пароль
	// $remember 	- нужно ли запомнить в куках
	// результат	- true или false
	//
	public function Login($login, $pass, $remember)
	{
		$_SESSION['pro']=null;
		// вытаскиваем пользователя из БД 
		$user = $this->GetByLogin($login);
		if ($user == null)
        {
            $_SESSION['islogin']=false;
        	return false;
        }
		$this->id_user = $user['id_user'];
		$this->us_name = $user['us_name'];
		$this->fam = $user['fam'];
		$this->phone = $user['phone'];
				
		// проверяем пароль
		if ($user['pass'] != md5($pass) and $user['pass'] != $pass)
		{
            $_SESSION['islogin']=false;
        	return false;
        }
		if ($login == 'admin')
        {
            $_SESSION['admin']=true;
        }
        $_SESSION['islogin']=true;  
		
		$_SESSION['User']=$login;      
   		$_SESSION['id_user']=$this->id_user;      
		// запоминаем имя и md5(пароль)
		if ($remember)
		{
			$expire = time() + 3600 * 24 * 100;
			setcookie('login', $login, $expire);
			setcookie('admin', $admin, $expire);
			setcookie('pass', md5($pass), $expire);
		}
		
		// Применяем имя пользователя в классу Bag() и получаем его корзину 
		M_Bag::Instance()->SetIdUserBug($this->id_user);
		M_Bag::Instance()->GetBag();
		
		return true;
	}

	//
	// Выход
	//
	public function Logout()
	{
		$_SESSION['islogin']=null;
		setcookie('login', '', time() - 1);
		setcookie('password', '', time() - 1);
		unset($_COOKIE['login']);
		unset($_COOKIE['password']);
		unset($_COOKIE['admin']);
		$_SESSION['id_user']=null;
		$_SESSION['pro']=null;
        $_SESSION['islogin']=false;
		$_SESSION['admin']=false;
		$this->id_user = null;
		$this->us_name = null;
		$this->fam = null;
		$this->phone = null;
        $this->islogin = false;
	}
}
