<div class="calculator_wrap semena">

    <div class="calc_content">

		<? // Список разделов
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
        );?>
        
    </div>

    <div class="calculator semena">
        <?
        $dose = 0;
        $measure = 'мл';
        ?>
        <div class="calc_block left">

            <div class="head hidden-lg hidden-md hidden-sm">
                <div class="second">Посев</div>
            </div>

            <div class="calc_row dose">
                <div class="calc_label dose"><span>Норма высева</span></div>
                <div class="calc_input_wrap">
                    <div class="control_button minus" data-target="dose">−</div>
                    <input type="text" id="dose" value="<?= $dose ?>">
                    <div class="control_button plus" data-target="dose">+</div>
                </div>
                <div class="calc_label right"><span class="calc_measure"><?= $measure ?></span></div>
                <div class="clear"></div>
            </div>

            <div class="calc_row heads">
                <div class="calc_label heads"><span>Посевная площадь</span></div>
                <div class="calc_input_wrap">
                    <div class="control_button minus" data-target="heads">−</div>
                    <input type="text" id="heads" value="1">
                    <div class="control_button plus" data-target="heads">+</div>
                </div>
                <div class="calc_label right"><span>Га</span></div>
                <div class="clear"></div>
            </div>
        </div>

        <div class="calc_block image">
            <img src="<?= SITE_TEMPLATE_PATH ?>/images/placeholder_semena.jpg"></a>
        </div>

        <div class="calc_block right">
            <div class="calc_footer">
                <div class="result">
                    <span class="ttl">Для посева необходимо</span>
                    <div class="res"><span class="digits">0</span> <span class="calc_measure"><?= $measure ?></span></div>
                </div>

                <div class="get_price">
                    <div class="get_price_button">Запросить цену</div>
                    <span class="text">
                        <a href="#">Заголовок продукта</a>
                    </span>
                </div>

            </div>
        </div>

        <div class="calc_block potencial_results">
            <div class="res_header">Потенциальные результаты</div>
            <div class="res_content">
                <b>Заголовок</b><br>
                подпись<br>
                <br>
                <b>Заголовок</b><br>
                подпись в две<br>
                строчки<br>
            </div>
        </div>

        <div class="clear"></div>
    </div>

    <div class="product_form_wrap"></div>

</div>

<div class="loading"></div>