<?php
	function get_date($bad_date){
		$time = mb_substr($bad_date,-8,5,"UTF-8");
		$date = mb_substr($bad_date,8,2,"UTF-8").'.'.mb_substr($bad_date,5,2,"UTF-8").'.'.mb_substr($bad_date,2,2,"UTF-8");
		return $time.' '.$date;
	}
	session_start();
	require_once '../login.php'; // подключает файл с данными о подключении к БД
	$conn = new mysqli($hn, $un, $pw, $db); // подключает БД
	$num = $_POST['num'] * 5;
	$num_2 = $_POST['num'];
	$id_news = $_POST['id_news'];
	//echo "<div id=\"comments_{$num_2}\">";
	$query = "SELECT id, user, datetime, text FROM comments WHERE news = ".$id_news." ORDER BY datetime DESC LIMIT {$num},5";
	$result = $conn->query($query); // выполняет запрос
	$rows = $result->num_rows; // записывает количество записей в таблице
	for ($i=0; $i<$rows; $i++){
		$result->data_seek($i); // процедура, указывает на строчку определенного номера 
		$row = $result->fetch_array(MYSQLI_ASSOC); // метод, который запихивает все в массив
		$query = "SELECT name FROM users WHERE id =".$row['user'];
		$result_name = $conn->query($query); // выполняет запрос
		$row_name = $result_name->fetch_array(MYSQLI_ASSOC); // метод, который запихивает все в массив
		$normal_date = get_date($row['datetime']);
		echo <<<_END
		<div class="news__comments">
			<div class="clearfix news__header_comments">
				<span class="news__comments_nickname">{$row_name['name']}</span>
				<span class="news__comment_time">{$normal_date}</span>
			</div>
			<div class="news__comment_text" id="comment_{$i}">{$row['text']}</div>
_END;
		if ($_SESSION['role'] == 2 || $_SESSION['role'] == 1){
			echo <<<_END
			<div class="clearfix">
				<form action="news.php?id_news={$id_news}" method="post">
					<input type="hidden" name="id_comment_delete" value="{$row['id']}">
					<input type="submit" value="Удалить" class="news__comments_admin_button">
				</form>
				<div id="comment_edit_button_{$i}">
					<button class="news__comments_admin_button" onclick="edit_comment({$i},{$id_news},{$row['id']})">Редактировать</button>
				</div>
			</div>
_END;
		}
		echo "</div>";
	}
	if ($rows == 5){ //если комментариев больше 5
		$num_3 = $num_2 + 1;
		echo "<div id=\"comments_{$num_2}\">";
		echo "<button class=\"index_news__more_news\" onclick=\"more_comments({$num_3},{$id_news})\">Далее...</button>";
		echo "</div>";
	}
?>