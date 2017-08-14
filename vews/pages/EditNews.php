<?php require_once(ROOT."/vews/pages/components/aside.php"); ?>
	<div class="content">
<?php require_once(ROOT."/vews/pages/components/header.php"); ?>

		<h1>Редактировать статью:</h1>
		<div class="add-news__form">
			<form enctype="multipart/form-data" method="post" action="/editnews/editnews/<?php echo $news->id; ?>">
				<h3>Заголовок:</h3>
				<input type="text" name="add_headline" class="wid100" value="<?php echo $news->headline; ?>">
				<h3>Картинка:</h3>
				<input type="file" name="add_picture" accept="image/*,image/jpeg">
				<h3>Раздел:</h3>
				<ul>
				<?php
				for ($i=0; $i<COUNT($news->categorys); $i++){
					if ($news->categorys[$i] == 'спорт') $cb1 = true;
				 	if ($news->categorys[$i] == 'политика') $cb2 = true;
				 	if ($news->categorys[$i] == 'экономика') $cb3 = true;
				 	if ($news->categorys[$i] == 'искусство') $cb4 = true;
				 	if ($news->categorys[$i] == 'общество') $cb5 = true;
				 	if ($news->categorys[$i] == 'наука и техника') $cb6 = true;
				}
				if (isset($cb1)) 	echo "<li><label><input type=\"checkbox\" name=\"cb1\" checked=\"checked\">Спорт</label></li>";
				else 				echo "<li><label><input type=\"checkbox\" name=\"cb1\">Спорт</label></li>";
				if (isset($cb2)) 	echo "<li><label><input type=\"checkbox\" name=\"cb2\" checked=\"checked\">Политика</label></li>";
				else 				echo "<li><label><input type=\"checkbox\" name=\"cb2\">Политика</label></li>";
				if (isset($cb3)) 	echo "<li><label><input type=\"checkbox\" name=\"cb3\" checked=\"checked\">Экономика</label></li>";
				else 				echo "<li><label><input type=\"checkbox\" name=\"cb3\">Экономика</label></li>";
				if (isset($cb4)) 	echo "<li><label><input type=\"checkbox\" name=\"cb4\" checked=\"checked\">Искусство</label></li>";
				else 				echo "<li><label><input type=\"checkbox\" name=\"cb4\">Искусство</label></li>";
				if (isset($cb5)) 	echo "<li><label><input type=\"checkbox\" name=\"cb5\" checked=\"checked\">Общество</label></li>";
				else 				echo "<li><label><input type=\"checkbox\" name=\"cb5\">Общество</label></li>";
				if (isset($cb6)) 	echo "<li><label><input type=\"checkbox\" name=\"cb6\" checked=\"checked\">Наука и техника</label></li>";
				else 				echo "<li><label><input type=\"checkbox\" name=\"cb6\">Наука и техника</label></li>";
				?>
				</ul>
				<h3>Текст статьи:</h3>
				<textarea name="add_text" class="wid100"><?php echo $news->text; ?></textarea>
				<h3>Теги:</h3>
				<input type="text" name="tags" class="wid100" value="<?php echo $tags; ?>">
				<div id="add-news__button">
					<input type="submit" class="add-news__submit green border-green" value="Сохранить">
				</div>
			</form>
		</div>

	</div>  <!--конец content-->
<?php require_once(ROOT."/vews/pages/components/footer.php"); ?>
<script type="text/javascript" src="/vews/js/news.js"></script>
</body>
</html>