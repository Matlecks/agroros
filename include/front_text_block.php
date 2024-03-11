<div class="front_text_block">

	<div class="text_block left">
	<?php $APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/front_text_left.php"), false);?>
	</div>

	<div class="text_block right">
		<div class="loc_blocker hidden-lg"></div>
	<?php $APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/front_text_right.php"), false);?>
	</div>
	
	<div class="clear"></div>
	
</div>

