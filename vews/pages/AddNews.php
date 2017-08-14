<?php require_once(ROOT."/vews/pages/components/aside.php"); ?>
	<div class="content">
<?php require_once(ROOT."/vews/pages/components/header.php"); ?>

	<h1>Добавить статью:</h1>
			<div class="add-news__form">
				<form enctype="multipart/form-data" method="post" action="/editnews/addnews">
					<h3>Заголовок:</h3>
					<input type="text" name="add_headline" class="wid100">
					<h3>Картинка:</h3>
					<input type="file" name="add_picture" accept="image/*,image/jpeg">
					<h3>Раздел:</h3>
					<ul>
						<li><label><input type="checkbox" name="cb1">Спорт</label></li>
						<li><label><input type="checkbox" name="cb2">Политика</label></li>
						<li><label><input type="checkbox" name="cb3">Экономика</label></li>
						<li><label><input type="checkbox" name="cb4">Искусство</label></li>
						<li><label><input type="checkbox" name="cb5">Общество</label></li>
						<li><label><input type="checkbox" name="cb6">Наука и техника</label></li>
					</ul>
					<h3>Текст статьи:</h3>
					<textarea name="add_text" class="wid100"></textarea>
					<h3>Теги:</h3>
					<input type="text" name="tags" class="wid100">
					<div id="add-news__button">
						<input type="submit" class="add-news__submit green border-green" value="Добавить">
					</div>
				</form>
			</div>

	</div>  <!--конец content-->
<?php require_once(ROOT."/vews/pages/components/footer.php"); ?>
<script type="text/javascript" src="/vews/js/news.js"></script>
</body>
</html>