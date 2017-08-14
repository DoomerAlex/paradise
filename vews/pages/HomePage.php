<?php require_once(ROOT."/vews/pages/components/aside.php"); ?>


	<div class="content">

<?php require_once(ROOT."/vews/pages/components/header.php"); ?>

<?php if (isset($slider)) require_once(ROOT."/vews/pages/components/slider.php"); ?>

		<div class="news-box__box">
			<h2 class="h2_last_news"> Последние новости<?php echo $name_search; ?>:</h2>
			
			<?php require_once(ROOT."/vews/pages/components/Cutaway.php"); ?>
		
		</div>
	</div>  <!--конец content-->

<?php require_once(ROOT."/vews/pages/components/footer.php"); ?>

<script type="text/javascript">
	$(document).ready(function(){ // для слайдера
		$('.bxslider').bxSlider({
			auto: true,
			captions: true,
			speed: 1000,
		});
	});
</script>
<script type="text/javascript" src="/vews/js/jquery.bxslider.min.js"></script>
<script async src="https://www.gismeteo.ru/api/informer/getinformer/?hash=Y1R0j6U74C6Ri7" type="text/javascript"></script>
</body>
</html>