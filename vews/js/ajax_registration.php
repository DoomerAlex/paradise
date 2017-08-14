<?php
	require_once '../login.php'; // подключает файл с данными о подключении к БД
	$conn = new mysqli($hn, $un, $pw, $db); // подключает БД
	if (isset($_POST['login'])){ // для имени
		$query = "SELECT name FROM users WHERE name = '".$_POST['login']."'";
		$result = $conn->query($query); // выполняет запрос, изменяет
		$rows = $result->num_rows; // записывает количество
		if ($rows == 0) echo "<div class=\"green reg_success\"><i class=\"fa fa-check\" aria-hidden=\"true\"></div>";
		else echo "<div class=\"red reg_success\">Данный логин занят</div>";
	}
	if (isset($_POST['email'])){ // для почты
		$query = "SELECT email FROM users WHERE email = '".$_POST['email']."'";
		$result = $conn->query($query); // выполняет запрос, изменяет
		$rows = $result->num_rows; // записывает количество
		if ($rows == 0) echo "<div class=\"green reg_success\"><i class=\"fa fa-check\" aria-hidden=\"true\"></div>";
		else echo "<div class=\"red reg_success\">Почта занята</div>";
	}
?>