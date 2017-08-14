<?php

class Comment{
	public $id;
	public $author;
	public $text;
	public $date;

	public function __construct($id, $author, $text, $date){
		$this->id = $id;
		$this->author = $author;
		$this->text = $text;
		$this->date = $date;
	}
}


class FirstModel{

	public static function getDate($bad_date){ // get a valid date
		$time = mb_substr($bad_date,-8,5,"UTF-8");
		$date = mb_substr($bad_date,8,2,"UTF-8").'.'.mb_substr($bad_date,5,2,"UTF-8").'.'.mb_substr($bad_date,2,2,"UTF-8");
		return $time.' '.$date;
	}

	public static function Authorization(){ // аворизация
		if (isset($_POST['exit'])){
			$_SESSION = array();
			session_destroy();
			return "/vews/pages/components/form_login.php";
		}
		else if (isset($_SESSION['user_id'])){ 
			return "/vews/pages/components/successful_login.php";
		}
		else if (isset($_POST['login']) && isset($_POST['password'])){
			$pdo = DataBase::getConnectDb(); // connection whis DB
			$query = $pdo->prepare(
			" SELECT id, name"
			." FROM users"
			." WHERE name = ?"
			." AND password = ?");
			$query->execute(array($_POST['login'], $_POST['password']));
			while ($row = $query->fetch(PDO::FETCH_LAZY)){
				$_SESSION['user_id'] = $row->id;
				$_SESSION['user_name'] = $row->name;
				$query2 = $pdo->prepare(
					"SELECT COUNT(id) AS admin"
					." FROM users_admin"
					." WHERE id = ?");
				$query2->execute([$row->id]);
				$row2 = $query2->fetchColumn();
				if ($row2 == 1) $_SESSION['user_role'] = 'admin';
				else{
					$query3 = $pdo->prepare(
						"SELECT COUNT(id) AS moderator"
						." FROM users_moderator"
						." WHERE id = ?");
					$query3->execute([$row->id]);
					$row3 = $query3->fetchColumn();
					if ($row3 == 1) $_SESSION['user_role'] = 'moderator';
					else $_SESSION['user_role'] = 'user';
				}
				$ok = true;
			}
			if (!isset($ok)) {
				return "/vews/pages/components/failed_login.php";
				session_destroy();
			}
			else return "/vews/pages/components/successful_login.php";
		}
		else {
			return "/vews/pages/components/form_login.php";
			session_destroy();
		}
	}

	public static function getColorTheme(){
		if (!isset($_COOKIE['color_theme'])) setcookie('color_theme', 'black', time()+60*60*24, '/');
		//setcookie('color_theme', '', time()-60*60*24);
		if (isset($_POST['theme_change'])){
			if ($_COOKIE['color_theme'] == 'black'){
				setcookie('color_theme', 'white', time()+60*60*24, '/');
			}
			else {
				setcookie('color_theme', 'black', time()+60*60*24, '/');
			}
			header("Location: ".$_SERVER["REQUEST_URI"]); // редирект
	    	exit;
		}
	}

	public static function checkbox_verify($_name) { // проверяет чекбоксы
		$result=0;
		if (isset($_REQUEST[$_name])) {
			if ($_REQUEST[$_name]=='on') $result=1;
		}
		return $result;
	}
}