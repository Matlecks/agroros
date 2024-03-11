<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Калькулятор дозировок");
?>

<?
$APPLICATION->IncludeComponent("bitrix:main.include", "",
	array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => SITE_DIR."include/calc/calculator_korma.php",
		
	),
	false);
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>