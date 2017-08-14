<?php

require_once(ROOT."/models/FirstModel.php");

class EditNews extends FirstModel{

	public function addNews(){
		$pdo = DataBase::getConnectDb(); // connection whis DB
		$path = 'vews/img/news_img/'; // путь копирования картинок
		$max_size_image = 5242880; // максимальный размер картинки в байтах (5мб)
		if ($_FILES['add_picture']['size'] < $max_size_image){
			if (!@copy($_FILES['add_picture']['tmp_name'], $path.$_FILES['add_picture']['name'])){ // копирует картинку в папку сайта
				echo 'что-то пошло не так';
			}
			if (isset($_POST['add_headline']) && isset($_POST['add_text'])){ // добавляет результаты в БД
				try{
					$pdo->beginTransaction();
					$query = $pdo->prepare("INSERT INTO news VALUES(NULL, ?, ?, ?)");
					$query->execute([$_POST['add_headline'], $_FILES['add_picture']['name'], $_POST['add_text']]);
					$query = $pdo->prepare("SELECT id FROM news WHERE text = ? LIMIT 1");
					$query->execute([$_POST['add_text']]);
					$id_news = $query->fetchColumn();
	 				for ($i = 1; $i < 7; $i++) {
	 					$name_cb = 'cb'.$i; 
		 				if (FirstModel::checkbox_verify($name_cb) == 1){
		 					$query = $pdo->prepare("INSERT INTO news_category VALUES(?,?)");
		 					$query->execute([$id_news, $i]);
		 				}
	 				}
	 				$query = $pdo->prepare("INSERT INTO admin_news VALUES"."(?, CURRENT_TIMESTAMP, ?)");
	 				$query->execute([$_SESSION['user_id'], $id_news]);
	 				self::addTags($_POST['tags'], $id_news);
	 				$pdo->commit();
				}
				catch (Exception $e){
					$pdo->rollBack();
					echo "Ошибка: " . $e->getMessage();
				}
			}
		}
		else echo "Ошибка! Файл с картинкой весит более 5 МБ!";
		return $id_news;
	}
	// добавить транзакции!!!


	public function editNewsById($id){
		$pdo = DataBase::getConnectDb(); // connection whis DB
		try{
			$pdo->beginTransaction();
			$query = $pdo->prepare("UPDATE news SET headline = ?, text = ? WHERE id = ?");
			$query->execute([$_POST['add_headline'], $_POST['add_text'], $id]);
			$query = $pdo->prepare("DELETE FROM news_category WHERE news = ?");
			$query->execute([$id]);
			for ($i = 1; $i < 7; $i++) { // записывает новые категории
			 	$name_cb = 'cb'.$i; 
				if (FirstModel::checkbox_verify($name_cb) == 1){
					$query = $pdo->prepare("INSERT INTO news_category VALUES(?, ?)");
					$query->execute([$id, $i]);
				}
			}
			$query = $pdo->prepare("INSERT INTO admin_news VALUES(?, CURRENT_TIMESTAMP, ?)");
			$query->execute([$_SESSION['user_id'], $id]);
			$query = $pdo->prepare("DELETE FROM news_tag WHERE news = ?");
			$query->execute([$id]);
			self::addTags($_POST['tags'], $id);

			if ($_FILES['add_picture']['size'] > 0){ // загружает новую картинку
				$path = 'vews/img/news_img/'; // путь копирования картинок
				$max_size_image = 5242880; // максимальный размер картинки в байтах (5мб)
				if ($_FILES['add_picture']['size'] < $max_size_image){
					if (!@copy($_FILES['add_picture']['tmp_name'], $path . $_FILES['add_picture']['name'])){ // копирует картинку в папку сайта
						echo 'что-то пошло не так';
					}
					else{
						$query = $pdo->prepare("UPDATE news SET picture = ? WHERE id = ?");
						$query->execute([$_FILES['add_picture']['name'], $id]);
					}
				}
				else echo "Ошибка! Файл с картинкой весит более 5 МБ!";
			}
			$pdo->commit();
		}
		catch (Exception $e){
			$pdo->rollBack();
			echo "Ошибка: " . $e->getMessage();
		}

	}

	public function deleteNews($id){
		$pdo = DataBase::getConnectDb(); // connection whis DB
		try{
			$pdo->beginTransaction();
			$query = $pdo->prepare("DELETE FROM news WHERE id = ?");
			$query->execute([$id]);
			$query = $pdo->prepare("DELETE FROM news_category WHERE news = ?");
			$query->execute([$id]);
			$query = $pdo->prepare("DELETE FROM comments WHERE news = ?");
			$query->execute([$id]);
			$query = $pdo->prepare("DELETE FROM news_tag WHERE news =  ?");
			$query->execute([$id]);
			$pdo->commit();
		}
		catch (Exception $e){
			$pdo->rollBack();
			echo "Ошибка: " . $e->getMessage();
		}

	}

	public function addTags($tagline, $id_news){
		$pdo = DataBase::getConnectDb(); // connection whis DB
		$tags = explode(' ', $tagline); // преобразует теги в массив
 		foreach ($tags as $value) { // добавляет теги
 			if ($value != '' && $value != ' '){
				$query = $pdo->prepare("SELECT COUNT(id) AS num FROM tags WHERE name = ?");
				$query->execute([$value]);
				$rows = $query->fetchColumn();
				if ($rows == 0){
					$query = $pdo->prepare("INSERT INTO tags VALUES(NULL, ?)");
					$query->execute([$value]);
				}
				$query = $pdo->prepare("SELECT id FROM tags WHERE name = ?");
				$query->execute([$value]);
				$id_tag = $query->fetchColumn();
				$query = $pdo->prepare("INSERT INTO news_tag VALUES(?, ?)");
				$query->execute([$id_news, $id_tag]);
			}
		}
	}



}
