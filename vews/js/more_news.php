<?php
	function get_date($bad_date){
		$time = mb_substr($bad_date,-8,5,"UTF-8");
		$date = mb_substr($bad_date,8,2,"UTF-8").'.'.mb_substr($bad_date,5,2,"UTF-8").'.'.mb_substr($bad_date,2,2,"UTF-8");
		return $time.' '.$date;
	}
	require_once '../login.php'; // подключает файл с данными о подключении к БД
	$conn = new mysqli($hn, $un, $pw, $db); // подключает БД
	$num = $_POST['num'] * 6;
	$num_2 = $_POST['num'] + 1;
	if (isset($_GET['category'])){ // если выбрана категория
		$query = "SELECT N.*, AN.date_time FROM news N, news_category NC, admin_news AN WHERE N.id = NC.news AND N.id = AN.news AND AN.date_time = (SELECT MIN(date_time) FROM admin_news AN2 WHERE AN2.news = N.id) AND NC.category = ".$_GET['category']." ORDER BY AN.date_time DESC LIMIT {$num},6";
		$result = $conn->query($query); // выполняет запрос 
		$rows = $result->num_rows; // записывает количество записей в таблице
		for ($i=0; $i<$rows; $i++){
			$result->data_seek($i); // процедура, указывает на строчку определенного номера 
	 		$row = $result->fetch_array(MYSQLI_ASSOC);    // метод, который запихивает все в массив 
	 		echo "<div class=\"news-box\"><a href=\"news.php?id_news=".$row['id']."\">";
	 		echo 	"<div class=\"news-box__text\">";
	 		echo 		"<div class=\"news-box__data-time\">".get_date($row['date_time'])."</div>";
	 		echo 		"<div class=\"news-box__category\">";
	 		echo 		"<ul>";
	 		$query = "SELECT category FROM news_category WHERE news = ".$row['id'];
	 		$result_category = $conn->query($query); // выполняет запрос
	 		$rows_category = $result_category->num_rows; // записывает количество записей в таблице
	 		for ($j=0; $j<$rows_category; $j++){
	 			$result_category->data_seek($j);
	 			$row_category = $result_category->fetch_array(MYSQLI_ASSOC);
	 			$query = "SELECT name FROM categorys WHERE id =".$row_category['category'];
	 			$result_cat = $conn->query($query); // выполняет запрос
	 			$rows_cat = $result_cat->num_rows; // записывает количество записей в таблице
	 			$result_cat->data_seek($rows_cat);
	 			$row_cat = $result_cat->fetch_array(MYSQLI_ASSOC);
	 			echo "<li>".$row_cat['name']."</li>";
	 		}
	 		echo 		"</ul>";
	 		echo 		"</div>";
	 		echo 		"<div class=\"news-box__headline\">".$row['headline']."</div>";
	 		$text = mb_substr($row['text'],0,280, "UTF-8");
	 		echo "<div class=\"news-box__short-text\">".$text."...</div>";
	 		echo "</div><img src=\"img/news_img/".$row['picture']."\" alt=\"".$row['picture']."\"></a></div>"; // конец news-box
	 	}
	}
	else {
		$query = "SELECT N.*, AN.date_time FROM news N, admin_news AN WHERE N.id = AN.news AND AN.date_time = (SELECT MIN(date_time) FROM admin_news AN2 WHERE AN2.news = N.id) ORDER BY AN.date_time DESC LIMIT {$num},6";
		$result = $conn->query($query); // выполняет запрос
		$rows = $result->num_rows; // записывает количество записей в таблице
		for ($i=0; $i<$rows; $i++){
			$result->data_seek($i); // процедура, указывает на строчку определенного номера 
	 		$row = $result->fetch_array(MYSQLI_ASSOC);    // метод, который запихивает все в массив 
	 		echo "<div class=\"news-box\"><a href=\"news.php?id_news=".$row['id']."\">";
	 		echo 	"<div class=\"news-box__text\">";
	 		echo 		"<div class=\"news-box__data-time\">".get_date($row['date_time'])."</div>";
	 		echo 		"<div class=\"news-box__category\">";
	 		echo 		"<ul>";
	 		$query = "SELECT category FROM news_category WHERE news = ".$row['id'];
	 		$result_category = $conn->query($query); // выполняет запрос
	 		$rows_category = $result_category->num_rows; // записывает количество записей в таблице
	 		for ($j=0; $j<$rows_category; $j++){
	 			$result_category->data_seek($j);
	 			$row_category = $result_category->fetch_array(MYSQLI_ASSOC);
	 			$query = "SELECT name FROM categorys WHERE id =".$row_category['category'];
	 			$result_cat = $conn->query($query); // выполняет запрос
	 			$rows_cat = $result_cat->num_rows; // записывает количество записей в таблице
	 			$result_cat->data_seek($rows_cat);
	 			$row_cat = $result_cat->fetch_array(MYSQLI_ASSOC);
	 			echo "<li>".$row_cat['name']."</li>";
	 		}
	 		echo 		"</ul>";
	 		echo 		"</div>";
	 		echo 		"<div class=\"news-box__headline\">".$row['headline']."</div>";
	 		$text = mb_substr($row['text'],0,280, "UTF-8");
	 		echo "<div class=\"news-box__short-text\">".$text."...</div>";
	 		echo "</div><img src=\"img/news_img/".$row['picture']."\" alt=\"".$row['picture']."\"></a></div>"; // конец news-box
	 	}
	}
	if ($rows == 6){ //если новостей больше 8
		echo "<div id=\"block_{$_POST['num']}\">";
		echo "<button class=\"index_news__more_news\" onclick=\"more_news({$num_2})\">Далее...</button>";
		echo "</div>";
	}
?>