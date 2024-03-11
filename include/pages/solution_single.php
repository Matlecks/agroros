<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
CModule::IncludeModule("iblock");

if (isset($_GET['solution_code']) && !empty($_GET['solution_code'])){

	$_REQUEST["ELEMENT_CODE"] = trim($_GET['solution_code']);

	// Проверяем к какому каталогу относится выбранное решение
	$arFilter = array("ACTIVE" => 'Y', "IBLOCK_ID" => 12, "CODE" => trim($_GET['solution_code']));
	$arSelect = array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_*");
	$res = CIBlockElement::GetList(array(), $arFilter, false, array(), $arSelect);
	
	$element = false;
	while ($ob = $res->GetNextElement()) {
		$arFields = $ob->GetFields(); // Получаем поля элемента   
		$arFields['PROPERTIES'] = $ob->GetProperties(); // Получаем свойства элемент
		$element = $arFields;
	}

	// Подключаем компоненты в зависимости от типа решения
	if ($element['PROPERTIES']['SOL_CATEGORY']['VALUE']){
		if (in_array('seeds', $element['PROPERTIES']['SOL_CATEGORY']['VALUE_XML_ID'])){
			include_once('sol_semena.php');
		} else {
			include_once('sol_korma.php');
		}
	}
}
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>