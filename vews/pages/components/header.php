<header class="header-page">
	<div class="header-page__box clearfix">
		<div class="header_top_menu">
			<a href="#" id="add_bars"><i class="fa fa-bars icon_bars"></i></a>
			<a href="/news" class="header-page__site-name">Paradise lost news</a>
			<div class="header_options_div">
				<ul class="header_options clearfix">
					<li>
						<i class="fa fa-cog header_options__icon_cog"></i>
						<div class="header_options__menu clearfix">
							<br>
							<ul class="header_options__menu_items">
								<li>
									<?php echo "<form action=\"{$_SERVER['REQUEST_URI']}\" method=\"post\">"; ?>
									<input type="hidden" name="theme_change" value="true">
									<input type="submit" class="theme_change_button" <?php if ($_COOKIE['color_theme'] == 'white') echo "value=\"Темная тема\">";	else echo "value=\"Светлая тема\">"; ?>
									</form>
								</li>
								<li><a href="#" onclick="">Поддержка</a></li>
							</ul>
						</div>
					</li>
				</ul>
			</div>
		</div>
		<form action="/news/search/" method="GET" class="search__form clearfix"> <!-- форма поиска -->
			<input type="text" name="tag" placeholder="Поиск..." class="search__form_text">
		</form>
	</div>
</header>