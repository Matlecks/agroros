<div class=" hidden-sm hidden-xs vacancy_sidebar">
	<div class="general_terms">
		<?php $APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/vacancy_general_terms.php"), false);?>
	</div>
	<div class="contacts">
		<?php $APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/vacancy_contacts.php"), false);?>
	</div>
	<div class="button_green">Отправить резюме</div>
</div>