<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>

<?
//$APPLICATION->IncludeComponent(
// 	"bitrix:news.list", 
// 	"front_slider", 
// 	array(
// 		"COMPONENT_TEMPLATE" => "front_slider",
// 		"IBLOCK_TYPE" => "-",
// 		"IBLOCK_ID" => "3",
// 		"NEWS_COUNT" => "100",
// 		"SORT_BY1" => "ACTIVE_FROM",
// 		"SORT_ORDER1" => "DESC",
// 		"SORT_BY2" => "SORT",
// 		"SORT_ORDER2" => "ASC",
// 		"FILTER_NAME" => "",
// 		"FIELD_CODE" => array(
// 			0 => "ID",
// 			1 => "NAME",
// 			2 => "DETAIL_TEXT",
// 			3 => "DETAIL_PICTURE",
// 			4 => "",
// 		),
// 		"PROPERTY_CODE" => array(
// 			0 => "SLIDE_TITLE",
// 			1 => "",
// 		),
// 		"CHECK_DATES" => "Y",
// 		"DETAIL_URL" => "",
// 		"AJAX_MODE" => "N",
// 		"AJAX_OPTION_JUMP" => "N",
// 		"AJAX_OPTION_STYLE" => "Y",
// 		"AJAX_OPTION_HISTORY" => "N",
// 		"AJAX_OPTION_ADDITIONAL" => "",
// 		"CACHE_TYPE" => "A",
// 		"CACHE_TIME" => "36000000",
// 		"CACHE_FILTER" => "N",
// 		"CACHE_GROUPS" => "Y",
// 		"PREVIEW_TRUNCATE_LEN" => "",
// 		"ACTIVE_DATE_FORMAT" => "d.m.Y",
// 		"SET_TITLE" => "N",
// 		"SET_BROWSER_TITLE" => "N",
// 		"SET_META_KEYWORDS" => "N",
// 		"SET_META_DESCRIPTION" => "N",
// 		"SET_LAST_MODIFIED" => "N",
// 		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
// 		"ADD_SECTIONS_CHAIN" => "N",
// 		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
// 		"PARENT_SECTION" => "",
// 		"PARENT_SECTION_CODE" => "",
// 		"INCLUDE_SUBSECTIONS" => "N",
// 		"STRICT_SECTION_CHECK" => "N",
// 		"DISPLAY_DATE" => "N",
// 		"DISPLAY_NAME" => "N",
// 		"DISPLAY_PICTURE" => "N",
// 		"DISPLAY_PREVIEW_TEXT" => "N",
// 		"PAGER_TEMPLATE" => ".default",
// 		"DISPLAY_TOP_PAGER" => "N",
// 		"DISPLAY_BOTTOM_PAGER" => "Y",
// 		"PAGER_TITLE" => "Новости",
// 		"PAGER_SHOW_ALWAYS" => "N",
// 		"PAGER_DESC_NUMBERING" => "N",
// 		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
// 		"PAGER_SHOW_ALL" => "N",
// 		"PAGER_BASE_LINK_ENABLE" => "N",
// 		"SET_STATUS_404" => "N",
// 		"SHOW_404" => "N",
// 		"MESSAGE_404" => ""
// 	),
// 	false
//);
?>

<?
$APPLICATION->IncludeComponent("bitrix:menu", "front_slider", Array(
		"COMPONENT_TEMPLATE" => "front_slider",
		"ROOT_MENU_TYPE" => "front_slider",	// Тип меню для первого уровня
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
);
?>

<div class="front_delivery_form webform">
<?
$APPLICATION->IncludeComponent("bitrix:form.result.new", "front_delivery", Array(
	"WEB_FORM_ID" => "2",	// ID веб-формы
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
);
?>
</div>



<?php $APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/front_text_block.php"), false);?>

<div class="front_companies_prefix">
	<?php $APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/front_companies.php"), false);?>
</div>

<?
$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"companies_front", 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "N",
		"DISPLAY_PICTURE" => "N",
		"DISPLAY_PREVIEW_TEXT" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "CODE",
			1 => "XML_ID",
			2 => "NAME",
			3 => "DETAIL_PICTURE",
			4 => "",
		),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "4",
		"IBLOCK_TYPE" => "-",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "N",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "99",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(
			0 => "CPM_TILE_BIG",
			1 => "",
		),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N",
		"COMPONENT_TEMPLATE" => "companies_front",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости"
	),
	false
);
?>

<div class="detail_news_bottom">
	<div class="header_wrap">
		<a class="header" href="/press-centr">Пресс-центр</a>
	</div>

<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"press_center_detail_front", 
	array(
		"COMPONENT_TEMPLATE" => ".default",
		"IBLOCK_TYPE" => "-",
		"IBLOCK_ID" => "5",
		"NEWS_COUNT" => "3",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "PRESS_EVENT_END",
			2 => "PRESS_EVENT_START",
			3 => "",
		),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"PREVIEW_TRUNCATE_LEN" => "",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"SET_TITLE" => "N",
		"SET_BROWSER_TITLE" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_LAST_MODIFIED" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"INCLUDE_SUBSECTIONS" => "N",
		"STRICT_SECTION_CHECK" => "N",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Новости",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SET_STATUS_404" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => ""
	),
	false
);?>

</div>

<?
$APPLICATION->SetTitle("Группа компаний «Агророс»");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>
