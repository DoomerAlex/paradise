<?php require_once(ROOT."/vews/pages/components/aside.php"); ?>

	<div class="content">

<?php require_once(ROOT."/vews/pages/components/header.php"); ?>
	
		<div class="content-box">
			<h1><?php echo $row->headline; ?></h1>
			<?php echo "<img src=\"/vews/img/news_img/".$row->picture."\" alt=\"".$row->headline."\" class=\"news__img\">"; ?>
			<p class="news__text_news"><?php echo $row->text; ?></p>
			
			<?php if($_SESSION['user_role'] == 'admin'){  // кнопки для админа
					echo "<a href=\"/news/editnews/{$row->id}\" class=\"edit_news__button\">Редактировать</a>";
					echo "<div id=\"delete_news_form\">";
					echo "<button class=\"edit_news__button\" onclick=\"delete_news({$row->id})\">Удалить</button>";
					echo "</div>";
				}
			?>

			<hr class="news_hr">
			<h3>Комментарии:</h3>

			<div class="news__add_comment">
			<?php if (isset($_SESSION['user_id'])) { ?>
				<form action="javascript:void(null);" method="post" onsubmit="addComment(<?php echo $row->id?>)" id="add_comment">
					<textarea placeholder="Ваш комментарий" name="comment" class="add_comment__textarea" id="textarea_add_new_comment"></textarea>
					<input type="submit" value="Добавить" class="add_comment__input_submit green">
				</form>
			<?php } else echo "<div class=\"add_comment__errore_not_regist\">Авторизуйтесь, чтобы комментировать новость.</div>"; ?>
			</div> <!-- конец add_comment -->
			<div id="new_comments"></div>
			<?php require_once(ROOT."/vews/pages/components/Comments.php"); ?> 

		</div>

		<div class="news__more_informations"> <!-- доп информация -->
			<div class="news__other_news"> <!-- дополнительные новости -->
				<h3 class="other_news__head">Вам может быть интересно:</h3>
				<?php foreach ($other_news as $value) {
					echo "<hr class=\"news_hr\">";
					echo "<a href=\"/news/".$value->id."\" class=\"other_news__headline\">{$value->headline}</a>";
				} ?>
			</div> <!-- конец дополнительных новостей -->

			<div class="news__tags clearfix"> <!-- блок с тегами -->
				<h3 class="news__head_tags">Теги новсти:</h3>
				<?php foreach ($tags as $value) echo "<a href=\"/news/search/?tag={$value}\" class=\"news__tag_name\">#{$value}</a>"; ?>
			</div> <!-- конец тегов -->

		</div> <!-- конец доп информации -->


	</div>  <!--конец content-->
<?php require_once(ROOT."/vews/pages/components/footer.php"); ?>
<script type="text/javascript" src="/vews/js/news.js"></script>
</body>
</html>