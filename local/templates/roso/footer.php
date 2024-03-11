<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
CJSCore::Init(array("fx","jquery"));
?>

					</div>
					<?if ($needSidebar):?>
					<div class="sidebar col-lg-5 col-md-4 col-sm-10 col-xs-12">
					<?$APPLICATION->IncludeComponent(
					   "bitrix:main.include",
					   "",
					   Array(
						  "AREA_FILE_SHOW" => "sect", 
						  "AREA_FILE_SUFFIX" => "inc", 
						  "AREA_FILE_RECURSIVE" => "Y", 
						  "EDIT_MODE" => "html", 
					   ),
					   false,
					   Array('HIDE_ICONS' => 'N')
					);?> 
					</div><!--// sidebar -->
					<?endif?>
				</div><!--//row-->	
				<div class="footer_push"></div>
			</div><!--//container bx-content-seection-->
		</div><!--//workarea-->
	</div> 
</div><!-- //bx-wrapper-->
	
	<footer class="footer<?=($top_banner ? ' page_banner_footer' : '')?>">

		<div class="container section_footer">
			<div class="row footer_links">
				<div class="hidden-lg hidden-md col-sm-12">
				<?$APPLICATION->IncludeComponent("bitrix:menu", "footer_menu", Array(
						"COMPONENT_TEMPLATE" => "footer_menu",
						"ROOT_MENU_TYPE" => "bottom",	// Тип меню для первого уровня
						"MENU_CACHE_TYPE" => "N",	// Тип кеширования
						"MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
						"MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
						"MENU_CACHE_GET_VARS" => "",	// Значимые переменные запроса
						"MAX_LEVEL" => "1",	// Уровень вложенности меню
						"CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
						"USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
						"DELAY" => "N",	// Откладывать выполнение шаблона меню
						"ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
					),
					false
				);?>
				</div>
			</div>
		
			<div class="row">
					
				<div class="col-lg-12 col-md-12">
				
					<?php
					$copy_year = 2017;
					if (date('Y') > $copy_year){$copy_year = $copy_year.'-'.date('Y');}
					?>
				
					<div class="copyright">© Агророс<span class="comma">,</span> <span class="years"><?=$copy_year?></span></div>
					
					<div class="phones_wrap">
						<div class="phone ekb"><?php $APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/footer_phone_ekb.php"), false);?></div>
						<div class="phone msk"><?php $APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/footer_phone_msk.php"), false);?></div>
					</div>
					
					<div class="footer_form back_call">
						<?$APPLICATION->IncludeComponent("bitrix:form.result.new", "back_call_bottom", Array(
							"WEB_FORM_ID" => "6",	// ID веб-формы
								"IGNORE_CUSTOM_TEMPLATE" => "N",	// Игнорировать свой шаблон
								"USE_EXTENDED_ERRORS" => "Y",	// Использовать расширенный вывод сообщений об ошибках
								"SEF_MODE" => "N",	// Включить поддержку ЧПУ
								"VARIABLE_ALIASES" => array(
									"WEB_FORM_ID" => "WEB_FORM_ID",
									"RESULT_ID" => "RESULT_ID",
								),
								"CACHE_TYPE" => "A",	// Тип кеширования
								"CACHE_TIME" => "3600",	// Время кеширования (сек.)
								"LIST_URL" => "",	// Страница со списком результатов
								"EDIT_URL" => "",	// Страница редактирования результата
								"SUCCESS_URL" => "",	// Страница с сообщением об успешной отправке
								"CHAIN_ITEM_TEXT" => "",	// Название дополнительного пункта в навигационной цепочке
								"CHAIN_ITEM_LINK" => "",	// Ссылка на дополнительном пункте в навигационной цепочке
								"AJAX_MODE" => "Y",
								"AJAX_OPTION_SHADOW" => "N",
								"AJAX_OPTION_JUMP" => "N",
								"AJAX_OPTION_STYLE" => "Y",
								"AJAX_OPTION_HISTORY" => "N"
							),
							false
						);?>
					</div>
					
					<div class="email"><?php $APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/footer_email.php"), false);?></div>
					
					<div class="privacy"><?php $APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/footer_privacy.php"), false);?></div>
					
					<div class="roso_backlink">
						<a href="https://www.rosogroup.ru/"><span>Росо Груп</span></a>
					</div>
					
				</div>
				
			</div>
			
		</div>
	</footer>
	
<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(52177156, "init", {
        id:52177156,
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/52177156" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

</body>
</html>