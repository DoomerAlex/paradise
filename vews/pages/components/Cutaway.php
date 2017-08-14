<?php 
	if (isset($_POST['num'])) 	$num = $_POST['num'];
	else 						$num = 0;
	$next = $num + 1;
?>

<?php foreach ($cutaways as $row) { ?>
					<div class="news-box">
				<?php echo "<a href=\"/news/".$row->id."\">" ?>
	 				<div class="news-box__text">
	 					<div class="news-box__data-time"><?php echo $row->date; ?></div>
	 					<div class="news-box__category">
	 						<ul>
	 							<?php foreach ($row->categorys as $cat) echo "<li>".$cat."</li>"; ?>
	 						</ul>
	 					</div>
	 					<div class="news-box__headline"> <?php echo $row->headline; ?> </div>
	 					<div class="news-box__short-text"> <? echo $row->text; ?> </div>
	 				</div>
	 				<?php echo "<img src=\"/vews/img/news_img/".$row->picture."\" alt=\"".$row->headline."\">"; ?>
	 			</a>
	 		</div>
		<?php } ?>
		<?php if (count($cutaways) == 6){ //если новостей больше 6
			echo "<div id=\"block_{$num}\">";
			echo "<button class=\"index_news__more_news\" onclick=\"more_news({$next})\">Далее...</button>";
			echo "</div>";
		} ?>