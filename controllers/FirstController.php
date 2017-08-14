<?php

class FirstController{

	public static $login;

	public function __construct(){
		self::$login = FirstModel::Authorization();
		FirstModel::getColorTheme();
	}
}