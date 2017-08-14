<?php

require_once(ROOT."/models/News.php");
require_once(ROOT."/controllers/FirstController.php"); // Parents controller

class NewsController extends FirstController{

	public function actionAll_news(){
		$name_page ='';
		$cutaways = News::getCutaway(0);
		$slider = News::getNewsForSlider();
		require_once(ROOT."/vews/pages/HomePage.php");
		return true;
	}

	public function actionArticle($id){
		$name_page ='';
		$row = News::getNewsById($id);
		$comments = News::getCommentsForNews($id, 0);
		$tags = News::getTagsById($id);
		$other_news = News::getOtherNewsById($id);
		require_once(ROOT."/vews/pages/NewsPage.php");
		return true;
	}

	public function actionCategory($category){
		$name_page ='';
		$cutaways = News::getCutawayByCategory($category, 0);
		$name_search = News::getCategoryName($category);
		require_once(ROOT."/vews/pages/HomePage.php");
		return true;
	}

	public function actionSearch(){
		$name_page = '';
		$name_search = ' '.$_GET['tag'];
		$cutaways = News::getCutawayByTag($_GET['tag']);
		require_once(ROOT."/vews/pages/HomePage.php");
		return true;
	}

	public function actionAdd(){
		$name_page = '';
		require_once(ROOT."/vews/pages/AddNews.php");
		return true;
	}

	public function actionEdit($id){
		$name_page = '';
		$news=News::getDataNews($id);
		$tag=News::getTagsById($id);
		$tags = '';
		foreach ($tag as $value) $tags .= $value.' ';
		require_once(ROOT."/vews/pages/EditNews.php");
		return true;
	}

	public function actionDelete($id){
		$name_page = '';
		return true;
	}

	public function actionAjaxMoreNews(){
		$cutaways = News::getCutaway($_POST['num']*6);
		require_once(ROOT."/vews/pages/components/Cutaway.php");
		return true;
	}

	public function actionAjaxMoreComments($id){
		$comments = News::getCommentsForNews($id, $_POST['num']*5);
		require_once(ROOT."/vews/pages/components/Comments.php");
		return true;
	}
}