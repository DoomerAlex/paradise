<?php

require_once(ROOT."/models/EditNews.php");
require_once(ROOT."/controllers/FirstController.php"); // Parents controller

class EditNewsController extends FirstController{

	public function actionAddNews(){
		$id_news = EditNews::addNews();
		echo '<script>location.replace("/news/'.$id_news.'");</script>'; exit;
		return true;
	}

	public function actionEditNews($id){
		EditNews::editNewsById($id);
		echo '<script>location.replace("/news/'.$id.'");</script>';
		exit;
		return true;
	}

	public function actionDelete(){
		EditNews::deleteNews($_POST['delete_news']);
		echo '<script>location.replace("/news");</script>';
		exit;
		return true;
	}
}