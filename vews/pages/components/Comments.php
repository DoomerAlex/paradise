<?php
	if (isset($_POST['num'])) 	$num = $_POST['num'];
	else 						$num = 0;
	$next = $num + 1;
	if (isset($row->id)) $id_news = $row->id;
	else if (isset($_POST['id_news'])) $id_news = $_POST['id_news'];
?>

<?php foreach ($comments as $com) { ?>
			<div class="news__comments" id="comment_box_<?php echo $com->id; ?>">
				<div class="clearfix news__header_comments">
					<span class="news__comments_nickname"><?php echo $com->author; ?></span>
					<span class="news__comment_time"><?php echo $com->date; ?></span>
				</div>
				<div class="news__comment_text" <?php echo "id=\"comment_{$com->id}\">".$com->text; ?></div>

				<?php
					if ($_SESSION['user_role'] == 'admin' || $_SESSION['user_role'] == 'moderator'){
						echo <<<_END
						<div class="clearfix">
							<button class="news__comments_admin_button" onclick="delete_comment({$com->id})">Удалить</button>
							<div id="comment_edit_button_{$com->id}">
								<button class="news__comments_admin_button" onclick="edit_comment({$row->id},{$com->id})">Редактировать</button>
							</div>
						</div>
_END;
					}
				?>

			</div>
			<?php } ?>

			<?php if (count($comments) == 5){ // если много комментариев
				echo "<div id=\"comments_{$num}\">";
				echo "<button class=\"index_news__more_news\" onclick=\"more_comments({$next},{$id_news})\">Далее...</button>";
				echo "</div>";
			}	?>