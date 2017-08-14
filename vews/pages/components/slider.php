<div class="index__block_info clearfix">  <!-- блок с гланвой инфой -->
			<div class="block_info__news">  <!-- блок с главной новостью дня -->
				<div class="block_info__slider">
					<link rel="stylesheet" type="text/css" href="/vews/js/jquery.bxslider.css">
					<ul class="bxslider">
						<?php foreach ($slider as $row) echo "<li><a href=\"/news/{$row->id}\"> <img src=\"/vews/img/news_img/{$row->picture}\" title=\"{$row->headline}\" class=\"slider_img\"></a></li>"; ?>
					</ul>
				</div>
			</div>  <!-- конец блока с глановной новостью дня -->
			<div class="block_info__vidjet clearfix">  <!-- блок с виждетами -->
				<div class="vidjet__weather"> <!-- блок с погодой -->
					<!-- Gismeteo informer START -->
					<h3 class="vidjet__weather_name">Погода:</h3>
					<div id="gsInformerID-Y1R0j6U74C6Ri7" class="gsInformer">
					    <div class="gsIContent">
					        <div id="cityLink">
					            <a href="https://www.gismeteo.ru/weather-nizhny-novgorod-4355/" target="_blank">Погода в Нижнем Новгороде</a>
					        </div>
					        <div class="gsLinks">
					            <table>
					            <tr>
					                <td>
					                    <div class="leftCol">
					                        <a href="https://www.gismeteo.ru/" target="_blank">
					                            <img alt="Gismeteo" title="Gismeteo" src="https://nst1.gismeteo.ru/assets/flat-ui/img/logo-mini2.png" align="middle" border="0" />
					                            <span>Gismeteo</span>
					                        </a>
					                    </div>
					                    <div class="rightCol">
					                        <a href="https://www.gismeteo.ru/weather-nizhny-novgorod-4355/2-weeks/" target="_blank">Прогноз на 2 недели</a>
					                    </div>
					                </td>
					            </tr>
					            </table>
					        </div>
					    </div>
					</div>
					<!-- Gismeteo informer END -->
				</div>  <!-- конец блока с погодой -->
				<div class="vidjet__currency">  <!-- блок с валютами -->
				
				<?php if ($_COOKIE['color_theme'] == 'black'){
		echo <<<_END
			<iframe style="width:100%;border:0;overflow:hidden;background-color:transparent;height:172px" scrolling="no" src="https://fortrader.org/informers/getInformer?st=14&cat=7&mult=0.7&showGetBtn=0&w=0&codes=0&colors=titleTextColor%3Dffffff%2CtitleBackgroundColor%3D36393e%2CthTextColor%3Dffffff%2CthBackgroundColor%3D36393e%2CsymbolTextColor%3Dffffff%2CtableTextColor%3Dffffff%2CborderTdColor%3D36393e%2CtableBorderColor%3D36393e%2CprofitTextColor%3D89bb50%2CprofitBackgroundColor%3Dtransparent%2ClossTextColor%3Dff1616%2ClossBackgroundColor%3Dtransparent%2CoddBackgroundTrColor%3D36393e%2CevenBackgroundTrColor%3D36393e%2CinformerLinkTextColor%3D454242%2CinformerLinkBackgroundColor%3Dtransparent%2CitemImgBg%3Dffffff%2CitemImgTextColor%3D000000&items=2%2C21&columns=todayCourse&toCur=11111"></iframe>
_END;
		}
		else { 
		echo <<<_END
			<iframe style="width:100%;border:0;overflow:hidden;background-color:transparent;height:172px" scrolling="no" src="https://fortrader.org/informers/getInformer?st=14&cat=7&mult=0.7&showGetBtn=0&w=0&codes=0&colors=titleTextColor%3D000000%2CtitleBackgroundColor%3Dffffff%2CthTextColor%3D000000%2CthBackgroundColor%3Dffffff%2CsymbolTextColor%3D000000%2CtableTextColor%3D000000%2CborderTdColor%3Dffffff%2CtableBorderColor%3Dffffff%2CprofitTextColor%3D89bb50%2CprofitBackgroundColor%3Dtransparent%2ClossTextColor%3Dff1616%2ClossBackgroundColor%3Dtransparent%2CoddBackgroundTrColor%3Dffffff%2CevenBackgroundTrColor%3Dffffff%2CinformerLinkTextColor%3D454242%2CinformerLinkBackgroundColor%3Dtransparent%2CitemImgBg%3Dffffff%2CitemImgTextColor%3D000000&items=2%2C21&columns=todayCourse&toCur=11111"></iframe>
_END;
		}?>

				</div>  <!-- конец блока с валютами -->
			</div>  <!-- конец блока с виждетами -->
		</div>  <!-- конец блока с гланой инфой -->