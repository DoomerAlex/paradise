<?php require_once(ROOT."/vews/pages/components/aside.php"); ?>

	<div class="content">

<?php require_once(ROOT."/vews/pages/components/header.php"); ?>
	<h1>Регистрация нового пользователя</h1>
	<div class="regist-div__form">
		<form action="/registration/addAkk" method="post">
			<div class="regist-div__table clearfix">
					
							<div class="reg__col25">Введите имя:</div>
							<div class="reg__col50">
								<input type="text" name="name_reg" placeholder="логин" id="name_reg" required="required">
							</div>
							<div class="reg__col25" id="name_reg_res">
							
							</div>
						
						
							<div class="reg__col25">Введите email:</div>
							<div class="reg__col50">
								<input type="text" name="email_reg" placeholder="Email" id="email_reg" required="required">
							</div>
							<div class="reg__col25" id="email_reg_res">
							
							</div>
						
						
							<div class="reg__col25">Введите пароль:</div>
							<div class="reg__col50">
								<input type="text" name="pasw_reg" placeholder="пароль" id="pasw_reg" required="required">
							</div>
							<div class="reg__col25" id="pasw1_reg_res">
							
							</div>
						
						
							<div class="reg__col25">Повторите пароль:</div>
							<div class="reg__col50">
								<input type="password" name="pasw2_reg" placeholder="пароль" id="pasw2_reg" required="required">
							</div>
							<div class="reg__col25" id="pasw2_reg_res">
							
							</div>
						
					</div>
					<div id="regist-button__registration">
						<input type="button" class="regist-button__reg red border-red" value="Зарегистрироваться">
					</div>
				</form>
			</div>
			

	</div>  <!--конец content-->
<?php require_once(ROOT."/vews/pages/components/footer.php"); ?>
<script type="text/javascript" src="/vews/js/news.js"></script>
<script type="text/javascript" src="/vews/js/registration.js"></script>
</body>
</html>