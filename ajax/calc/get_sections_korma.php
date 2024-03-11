<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>

<?
if (isset($_REQUEST['filter'])){

    CModule::IncludeModule("iblock");
    $allowed_sections = array();
    $arSelect = array("IBLOCK_ID", "ID", "DETAIL_PAGE_URL", "IBLOCK_SECTION_ID");
    // $arFilter = array("IBLOCK_ID" => 2, "ACTIVE" => "Y", "PROPERTY_".$_REQUEST['filter']."_VALUE" => 'Да');
    $arFilter = array("IBLOCK_ID" => IBLOCK_ID_KORMA, "ACTIVE" => "Y", "PROPERTY_" . $_REQUEST['filter'] . "_VALUE" => 'Да');
    $res = CIBlockElement::GetList(array(), $arFilter, false, array("nTopCount" => 10000), $arSelect);
    while ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();
        if (!empty($arFields['IBLOCK_SECTION_ID']) && !in_array($arFields['IBLOCK_SECTION_ID'], $allowed_sections)) {
            $allowed_sections[] = $arFields['IBLOCK_SECTION_ID'];
        }
    }

    // Список разделов
    $APPLICATION->IncludeComponent(
        "bitrix:catalog.section.list",
        "calc_sections",
        array(
            "ALLOWED_SECTIONS" => $allowed_sections,
            "IBLOCK_TYPE" => 'catalog',
            //"IBLOCK_ID" => '2',
            "IBLOCK_ID" => IBLOCK_ID_KORMA,
            "COUNT_ELEMENTS" => 'N',
            "TOP_DEPTH" => '1',
            "SECTION_URL" => '/korma-i-dobavki/#SECTION_CODE#/',
            "VIEW_MODE" => 'LINE',
            "SHOW_PARENT_NAME" => 'Y',
            "HIDE_SECTION_NAME" => "N",
            "ADD_SECTIONS_CHAIN" => 'Y',
        ),
        $component,
        array("HIDE_ICONS" => "Y")
    );
}
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>