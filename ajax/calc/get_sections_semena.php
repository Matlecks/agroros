<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>

<?
// Список разделов
$APPLICATION->IncludeComponent(
    "bitrix:catalog.section.list",
    "calc_sections",
    array(
        "SEMENA" => "Y",
        "IBLOCK_TYPE" => 'catalog',
        //"IBLOCK_ID" => '10',
        "IBLOCK_ID" => IBLOCK_ID_SEMENA,
        "COUNT_ELEMENTS" => 'N',
        "TOP_DEPTH" => '1',
        "SECTION_URL" => '/semena/#SECTION_CODE#/',
        "VIEW_MODE" => 'LINE',
        "SHOW_PARENT_NAME" => 'Y',
        "HIDE_SECTION_NAME" => "N",
        "ADD_SECTIONS_CHAIN" => 'Y',
    ),
    $component,
    array("HIDE_ICONS" => "Y")
);
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>