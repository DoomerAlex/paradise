<div class="red reg-buttons__wrong">Логин или пароль введены не верно</div>
<form action="/news" method="post" class="aside-form">
	<input type="text" placeholder="Логин" name="login" class="aside-buttons__input-text"  required="required">
	<input type="password" placeholder="Пароль" name="password" class="aside-buttons__input-text" required="required">
	<div class="clearfix">
		<input type="submit" value="Войти" class="reg-buttons__input-button">
		<button class="reg-buttons__input-button" onclick="back_login()">Назад</button>
	</div>
</form>