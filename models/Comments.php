<?php

require_once(ROOT."/models/FirstModel.php");

class Comments extends FirstModel{

	public function addComment($news){
		$pdo = DataBase::getConnectDb(); // connection whis DB
		try{
			$pdo->beginTransaction();
			$query = $pdo->prepare(
				"INSERT INTO comments"
				." VALUES(NULL, ?, ?, CURRENT_TIMESTAMP, ? )");
			$query->execute([$news, $_SESSION['user_id'], $_POST['comment']]);
			$pdo->commit();
		}
		catch (Exception $e){
			$pdo->rollBack();
			echo "Ошибка: " . $e->getMessage();
		}
	}

	public function EditComment($news){
		$pdo = DataBase::getConnectDb(); // connection whis DB
		try{
			$pdo->beginTransaction();
			$query = $pdo->prepare("UPDATE comments SET text = ? WHERE id = ?");
			$query->execute([$_POST['edit_comment_text'], $_POST['id_comment_edit']]);
			$pdo->commit();
			echo $_POST['edit_comment_text'];
		}
		catch (Exception $e){
			$pdo->rollBack();
			echo "Ошибка: " . $e->getMessage();
		}
		
	}

	public function DeleteComment($news){
		$pdo = DataBase::getConnectDb(); // connection whis DB
		try{
			$pdo->beginTransaction();
			$query = $pdo->prepare("DELETE FROM comments WHERE id =?");
			$query->execute([$_POST['id_comment_delete']]);
			$pdo->commit();
		}
		catch (Exception $e){
			$pdo->rollBack();
			echo "Ошибка: " . $e->getMessage();
		}
	}

	public function VewNewComment($news){
		$pdo = DataBase::getConnectDb(); // connection whis DB
		$query = $pdo->prepare("SELECT C.id, U.name, C.datetime, C.text"
			." FROM comments C, users U"
			." WHERE C.news = ?"
			." AND C.user = ?"
			." AND C.user = U.id"
			." ORDER BY C.datetime DESC"
			." LIMIT 1");
		$query->execute([$news, $_SESSION['user_id']]);
		$result = array();
		while ($row = $query->fetch(PDO::FETCH_LAZY)){
			$date = FirstModel::getDate($row->datetime);  // get a valid date from cutaway
			$res = new Comment($row->id, $row->name, $row->text, $date);
			$result[0] = $res;
		}
		return $result;
	}
}