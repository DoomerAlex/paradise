<?php

require_once(ROOT."/models/Comments.php");
require_once(ROOT."/controllers/FirstController.php"); // Parents controller

class CommentsController extends FirstController{

	public function actionAdd($news){
		Comments::AddComment($news);
		$comments = Comments::VewNewComment($news);
		//print_r($comments);
		require_once(ROOT."/vews/pages/components/Comments.php");
		return true;
	}

	public function actionDelete($news){
		Comments::DeleteComment($news);
		return true;
	}

	public function actionEdit($news){
		Comments::EditComment($news);
		return true;
	}
}