<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("Такой страницы на сайте нет");?>

<div class="page_404_content">
	<div class="prefix">404</div>
	<h1>Такой страницы<br />на сайте нет</h1>
	<p class="text">Перейдите <a href="/">на главную</a> или<br />выберите раздел в меню.</p>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
