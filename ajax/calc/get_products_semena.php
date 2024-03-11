<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>

<?
if (isset($_REQUEST['section_name']) && isset($_REQUEST['section_id'])){

    $section_name = $_REQUEST['section_name'];
    $section_id = intval($_REQUEST['section_id']);
    global $product_filter;
    $product_filter = array(
        'IBLOCK_SECTION_ID' => $section_id,
        '!PROPERTY_PRD_MEASURE_UNIT' => false,
        '!PROPERTY_PRD_CALC_INPUT_RATE' => false,
    );

    $section_link = '<span id="animal_click" data-section-id="'.$section_id.'">'.$section_name.'</span>';
    $APPLICATION->IncludeComponent(
        "bitrix:news.list",
        "calc_products",
        array(
            "SECTION_LINK" => $section_link,
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
            "DISPLAY_NAME" => "Y",
            "DISPLAY_PICTURE" => "Y",
            "DISPLAY_PREVIEW_TEXT" => "Y",
            "DISPLAY_TOP_PAGER" => "N",
            "FIELD_CODE" => array(
                0 => "NAME",
                1 => "DETAIL_PICTURE",
            ),
            "FILTER_NAME" => "product_filter",
            "HIDE_LINK_WHEN_NO_DETAIL" => "N",
            //"IBLOCK_ID" => "10",
            "IBLOCK_ID" => IBLOCK_ID_SEMENA,
            "IBLOCK_TYPE" => "catalog",
            "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
            "INCLUDE_SUBSECTIONS" => "N",
            "MESSAGE_404" => "",
            "NEWS_COUNT" => "999",
            "PAGER_BASE_LINK_ENABLE" => "N",
            "PAGER_DESC_NUMBERING" => "N",
            "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
            "PAGER_SHOW_ALL" => "N",
            "PAGER_SHOW_ALWAYS" => "N",
            "PAGER_TEMPLATE" => ".default",
            "PAGER_TITLE" => "Новости",
            "PARENT_SECTION" => "",
            "PARENT_SECTION_CODE" => "",
            "PREVIEW_TRUNCATE_LEN" => "",
            "PROPERTY_CODE" => array(
                0 => "",
                1 => "SOL_CATEGORY",
                2 => "PRD_CALC_INPUT_RATE",
                3 => "PRD_MEASURE_UNIT",
                4 => "PRD_IMAGES",
                5 => "PRD_CALC_RESULT",
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
            "COMPONENT_TEMPLATE" => "calc_products"
        ),
        false
    );
}
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>