<?php

require_once(ROOT."/models/UserControl.php");
require_once(ROOT."/controllers/FirstController.php"); // Parents controller

class UserControlController extends FirstController{

	public function actionRegistrationPage(){
		require_once(ROOT."/vews/pages/RegistrationPage.php");
		return true;
	}

	public function actionAjax_CheckNameForRegistration(){
		UserControl::CheckName($_POST['login']);
		return true;
	}

	public function actionAjax_CheckEmailForRegistration(){
		UserControl::CheckEmail($_POST['email']);
		return true;
	}

	public function actionAddNewUser(){
		UserControl::AddNewUser();
		echo '<script>location.replace("/news");</script>';
		exit;
		return true;
	}

}