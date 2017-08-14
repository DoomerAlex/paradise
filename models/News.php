<?php

require_once(ROOT."/models/FirstModel.php");

class Article{
	public $id;
	public $headline;
	public $picture;
	public $text;
	public $date;
	public $categorys = array();

	public function __construct($id, $head, $pic=null, $txt=null, $date=null, $cat=null){
		$this->id = $id;
		$this->headline = $head;
		$this->picture = $pic;
		$this->text = $txt;
		$this->date = $date;
		$this->categorys = $cat;
	}
}


class News extends FirstModel{

	public function getCutaway($num){ // get Cutaway for HomePage
		$pdo = DataBase::getConnectDb(); // connection whis DB
		$query = $pdo->prepare(
			" SELECT N.*, AN.date_time"
			." FROM news N, admin_news AN" 
			." WHERE N.id = AN.news" 
			." AND AN.date_time = ("
				."SELECT MIN(date_time)"
				." FROM admin_news AN2" 
				." WHERE AN2.news = N.id)" 
			." ORDER BY AN.date_time DESC" 
			." LIMIT ?, 6");
		$query->execute(array((int)$num));
		$array_return = array();
		$i = 0;
		while ($row = $query->fetch(PDO::FETCH_LAZY)){
			$text = mb_substr($row->text,0,280, "UTF-8");  // get a valid text from cutaway
			$date = FirstModel::getDate($row['date_time']);  // get a valid date from cutaway
			$categorys = self::getCategorysById($row['id']);
		 	$array_return[$i] = new Article($row->id, $row->headline, $row->picture, $text, $date, $categorys);
		 	$i++;
		}
		return $array_return;
	}

	public function getCutawayByCategory($cat, $num){ // get Cutaway for HomePage by Category
		$pdo = DataBase::getConnectDb(); // connection whis DB
		$query = $pdo->prepare(
			" SELECT N.*, AN.date_time"
			." FROM news N, news_category NC, admin_news AN"
			." WHERE N.id = NC.news"
			." AND N.id = AN.news"
			." AND AN.date_time = ("
				."SELECT MIN(date_time)"
				." FROM admin_news AN2"
				." WHERE AN2.news = N.id)"
			." AND NC.category = ?"
			." ORDER BY AN.date_time DESC"
			." LIMIT ?, 6");
		$query->execute([$cat ,(int)$num]);
		$array_return = array();
		$i = 0;
		while ($row = $query->fetch(PDO::FETCH_LAZY)){
			$text = mb_substr($row->text,0,280, "UTF-8");  // get a valid text from cutaway
			$date = FirstModel::getDate($row['date_time']);  // get a valid date from cutaway
			$categorys = self::getCategorysById($row['id']);
		 	$array_return[$i] = new Article($row->id, $row->headline, $row->picture, $text, $date, $categorys);
		 	$i++;
		}
		return $array_return;
	}

	public function getNewsById($id){ // get full one news 
		$pdo = DataBase::getConnectDb(); // connection whis DB
		$query = $pdo->prepare(
			"SELECT N.*, AN.date_time" 
			." FROM news N, admin_news AN" 
			." WHERE N.id = ?"
			." AND N.id = AN.news"
			." AND AN.date_time = ("
				." SELECT MIN(date_time)" 
				." FROM admin_news AN2" 
				." WHERE AN2.news = N.id)");
		$query->execute(array($id));
		$row = $query->fetch(PDO::FETCH_LAZY);
		$text = str_replace("\n","<br>",$row->text); // get a valid text from NewsPage
		$date = FirstModel::getDate($row['date_time']);  // get a valid date
		$categorys = self::getCategorysById($row['id']);
		$result = new Article($row->id, $row->headline, $row->picture, $text, $date, $categorys);
		return $result;
	}

	private function getCategorysById($id){ // get categorys of news
		$pdo = DataBase::getConnectDb(); // connection whis DB
		$query = $pdo->prepare(
			"SELECT C.name" 
			." FROM news_category NC, categorys C "
			." WHERE news = ? AND NC.category = C.id");
		$query->execute(array($id));
		$array_return = array();
		while ($row = $query->fetch(PDO::FETCH_LAZY)){
			array_unshift($array_return, $row['name']);
		}
		return $array_return;
	}

	public function getTagsById($id){ // get tags of news 
		$pdo = DataBase::getConnectDb(); // connection whis DB
		$query = $pdo->prepare(
			"SELECT T.name, T.id"
			." FROM tags T, news_tag NT"
			." WHERE NT.news = ?"
			." AND NT.tag = T.id");
		$query->execute([$id]);
		$result = $query->fetchAll(PDO::FETCH_COLUMN);
		return $result;
	}

	public function getOtherNewsById($id){
		$pdo = DataBase::getConnectDb(); // connection whis DB
		$query = $pdo->prepare(
			" SELECT DISTINCT N.headline, NT.news, AN.date_time "
			." FROM news N, news_tag NT, admin_news AN"
			." WHERE N.id = NT.news "
			." AND NT.news != ?"
			." AND N.id = AN.news"
			." AND NT.tag IN ("
				." SELECT tag "
				." FROM news_tag"
				." WHERE news = ?)"
			." AND AN.date_time = ("
				." SELECT MIN(date_time)"
				." FROM admin_news AN2"
				." WHERE AN2.news = N.id)"
			." ORDER BY AN.date_time DESC" 
			." LIMIT 5");
		$query->execute(array($id, $id));
		$array_other_news = array();
		$num = 0;
		while ($row = $query->fetch(PDO::FETCH_LAZY)){
			$array_other_news[$num] = new Article($row->news, $row->headline);
			$num++;
		}
		if ($num < 5){
			$query = $pdo->prepare(
				"SELECT DISTINCT N.headline, N.id, AN.date_time"
				." FROM news N, news_category NC, admin_news AN"
				." WHERE N.id = NC.news"
				." AND N.id = AN.news"
				." AND NC.category IN ("
					." SELECT category"
					." FROM news_category"
					." WHERE news = ?)"
				." AND AN.date_time = ("
					."SELECT MIN(date_time)"
					." FROM admin_news AN2"
					." WHERE AN2.news = N.id)"
				." ORDER BY AN.date_time DESC");
			$query->execute(array($id));
			while ($row = $query->fetch(PDO::FETCH_LAZY)){
				$fail = false;
				for($i = 0; $i < 5; $i++){
					if ($array_other_news[$i]->id == $row['id'] || $row['id'] == $id){
						$fail = true;
						break;
					}
				}
				if ($fail == false && $num != 5 ){
					$array_other_news[$num] = new Article($row->id, $row->headline);
					$num++;
				}
				else if ($num == 5) break;
			}
		}
		return $array_other_news;
	}

	public function getNewsForSlider(){ // get information for slider
		$pdo = DataBase::getConnectDb(); // connection whis DB
		$query = $pdo->prepare(
			"SELECT N.headline, N.picture, N.id"
			." FROM news N, news_category NC, admin_news AN"
			." WHERE N.id = NC.news"
			." AND N.id = AN.news"
			." AND AN.date_time = ("
				."SELECT MIN(date_time)"
				." FROM admin_news AN2"
				." WHERE AN2.news = N.id)"
			." AND NC.category = ?"
			." ORDER BY AN.date_time DESC"
			." LIMIT 1");
		$result = array();
		for ($i=0; $i<6; $i++){
			$j = $i+1;
			$query->execute([$j]);
			$value = $query->fetch(PDO::FETCH_LAZY);
			$result[$i] = new Article($value->id, $value->headline, $value->picture);
		}
		return $result;
	}

	public function getCommentsForNews($id, $num){
		$pdo = DataBase::getConnectDb(); // connection whis DB
		$query = $pdo->prepare("SELECT C.id, U.name, C.datetime, C.text"
			." FROM comments C, users U"
			." WHERE C.news = ?"
			." AND C.user = U.id"
			." ORDER BY C.datetime DESC"
			." LIMIT ? ,5");
		$query->execute([$id, $num]);
		$result = array();
		while ($row = $query->fetch(PDO::FETCH_LAZY)){
			$date = FirstModel::getDate($row->datetime);  // get a valid date from cutaway
			$value = new Comment($row->id, $row->name, $row->text, $date);
			array_push($result, $value);
		}
		return $result;
	}

	public function getCategoryName($id){
		if 		($id == 1) return " спорта";
		else if ($id == 2) return " политики";
		else if ($id == 3) return " экономики";
		else if ($id == 4) return " искусства";
		else if ($id == 5) return " общества";
		else if ($id == 6) return " науки и техники";
		else return "ERROR";
	}

	public function getCutawayByTag($tag){
		$pdo = DataBase::getConnectDb(); // connection whis DB
		$tags = explode(' ', $tag); // разбивает запрос на составляющие
		$news_array = array();
		$news_array_num = 0;
		$result = array();
		foreach ($tags as $value) {
			if ($value != '' && $value != ' '){
				$like = "%$value%";
				$query = $pdo->prepare(
					"SELECT DISTINCT N.*, AN.date_time"
					." FROM news N, admin_news AN, tags T, news_tag NT"
					." WHERE N.id = AN.news AND T.name like ?"
					." AND T.id = NT.tag"
					." AND NT.news = N.id"
					." AND AN.date_time = ("
						."SELECT MIN(date_time)"
						." FROM admin_news AN2"
						." WHERE AN2.news = N.id)"
					." ORDER BY AN.date_time DESC"
					." LIMIT 24");
				$query->execute([$like]);
				while ($row = $query->fetch(PDO::FETCH_LAZY)){
					$error = false;

					foreach ($news_array as $id_news) { // проверяет была ли уже эта сатья
					 	if ($row->id == $id_news) $error = true;
					}
					if ($error == false){
						$text = mb_substr($row->text,0,280, "UTF-8");  // get a valid text from cutaway
						$date = FirstModel::getDate($row->date_time);  // get a valid date from cutaway
						$categorys = self::getCategorysById($row->id);
						$res = new Article($row->id, $row->headline, $row->picture, $text, $date, $categorys);
						array_push($result, $res);
						$news_array[$news_array_num] = $row->id; //запись в массив id статьи
					 	$news_array_num++;
					}
				}
			}
		}			
		return $result;
	}

	public function getDataNews($id){
		$pdo = DataBase::getConnectDb(); // connection whis DB
		$query = $pdo->prepare("SELECT * FROM news WHERE id = ?");
		$query->execute([$id]);
		while ($row = $query->fetch(PDO::FETCH_LAZY)){
			$result = new Article($row->id, $row->headline, $row->picture, $row->text);
		}
		$categorys = self::getCategorysById($id);
		$result->categorys = $categorys;
		return $result;
	}
}