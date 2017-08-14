<div class="aside-reg__name"><?php echo $_SESSION['user_name']; ?></div>

<?php 
	if ($_SESSION['user_role'] == 'admin'){ // панель для админа
		echo "<nav class=\"aside-nav\"><ul>";
		echo "<li class=\"aside-nav__li\"><a href=\"/news/addnews\" class=\"aside-nav__a\">Добавить новость<a></li>";
		echo "</ul></nav>";
	}
	else if ($_SESSION['user_role'] == 'moderator'){ // панель для модератора

	}
	else{ // панель обысного юзера

	}
?>

<form action="/news" method="post">  <!-- форма для выхода -->
	<input type="hidden" name="exit" value="yes">
	<input type="submit" value="Выйти" class="reg-buttons__input-exit">
</form>