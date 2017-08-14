<?php

require_once(ROOT."/models/FirstModel.php");

class UserControl extends FirstModel{

	public function CheckName($name){
		$pdo = DataBase::getConnectDb(); // connection whis DB
		$query = $pdo->prepare("SELECT COUNT(name) FROM users WHERE name = ?");
		$query->execute([$name]);
		$rows = $query->fetchColumn();
		if ($rows == 0) echo "<div class=\"green reg_success\"><i class=\"fa fa-check\" aria-hidden=\"true\"></div>";
		else echo "<div class=\"red reg_success\">Данный логин занят</div>";
	}

	public function CheckEmail($email){
		$pdo = DataBase::getConnectDb(); // connection whis DB
		$query = $pdo->prepare("SELECT COUNT(email) FROM users WHERE email = ?");
		$query->execute([$email]);
		$rows = $query->fetchColumn();
		if ($rows == 0) echo "<div class=\"green reg_success\"><i class=\"fa fa-check\" aria-hidden=\"true\"></div>";
		else echo "<div class=\"red reg_success\">Почта занята</div>";
	}

	public function AddNewUser(){
		$pdo = DataBase::getConnectDb(); // connection whis DB
		try{
			$pdo->beginTransaction();
			$query = $pdo->prepare("INSERT INTO users VALUES(NULL, ?, ?, CURRENT_TIMESTAMP, ?, '1' )");
			$query->execute([$_POST['name_reg'], $_POST['pasw_reg'], $_POST['email_reg']]);
			$query = $pdo->prepare("SELECT id FROM users WHERE name = ?"); //запрос на id
			$query->execute([$_POST['name_reg']]);
			$id = $query->fetchColumn();
			session_start();
			$_SESSION['user_id'] = $id;
			$_SESSION['user_name'] = $_POST['name_reg'];
			$_SESSION['user_role'] = 'user';
			$query = $pdo->prepare("INSERT INTO users_user VALUES(?)");
			$query->execute([$id]);
			$pdo->commit();
		}
		catch (Exception $e){
			$pdo->rollBack();
			echo "Ошибка: " . $e->getMessage();
		}
	}
}