<?
CModule::IncludeModule("iblock");
// Получаем список разделов по-умолчанию (КРС)
$allowed_sections = array();
$arSelect = array("IBLOCK_ID", "ID", "DETAIL_PAGE_URL", "IBLOCK_SECTION_ID");
//$arFilter = array("IBLOCK_ID" => 2, "ACTIVE" => "Y", "PROPERTY_PRD_IS_CATTLE_VALUE" => 'Да');
$arFilter = array("IBLOCK_ID" => IBLOCK_ID_KORMA, "ACTIVE" => "Y", "PROPERTY_KRS_VALUE" => 'Да');
$res = CIBlockElement::GetList(array(), $arFilter, false, array("nTopCount" => 10000), $arSelect);
while ($ob = $res->GetNextElement()){
    $arFields = $ob->GetFields();
    if (!empty($arFields['IBLOCK_SECTION_ID']) && !in_array($arFields['IBLOCK_SECTION_ID'], $allowed_sections)) {
        $allowed_sections[] = $arFields['IBLOCK_SECTION_ID'];
    }
}
?>

<div class="calculator_wrap">
    <div class="top_control">
        <div class="ttl"><span>Вид животного</span></div>
        <div class="buttons_wrap">
            <div class="button birds" data-filter="PTITSA" data-class="birds">
                <div class="image"></div>
                <span>Птица</span>
                
            </div>
            <div class="button pigs" data-filter="SVINI" data-class="pigs">
                <div class="image"></div>
                <span>Свиньи</span>           
                
            </div>
            <div class="button cattle active" data-filter="KRS" data-class="cattle">
                <div class="image"></div>
                <span class="hidden-sm hidden-xs">Крупный<br />рогатый скот</span>
                <span class="hidden-lg hidden-md">КРС</span>
            </div>
        </div>
        <div class="clear"></div>
    </div>

    <div class="calc_content">
		<? // Список разделов
		$APPLICATION->IncludeComponent(
			"bitrix:catalog.section.list",
			"calc_sections",
			array(
				"ALLOWED_SECTIONS" => $allowed_sections,
				"IBLOCK_TYPE" => 'catalog',
                // "IBLOCK_ID" => '2',
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
		);?>
    </div>

    <div class="calculator">
        <?
        $dose = 0;
        $measure = 'мл';
        ?>
        <div class="calc_block left">

            <div class="head hidden-lg hidden-md hidden-sm">
                <div class="first">рекомендуемая</div>
                <div class="second">Дозировка</div>
            </div>

            <div class="calc_row dose">
                <div class="calc_label dose"><span>Дозировка на одно животное</span></div>
                <div class="calc_input_wrap">
                    <div class="control_button minus" data-target="dose">−</div>
                    <input type="text" id="dose" value="<?=$dose?>">
                    <div class="control_button plus" data-target="dose">+</div>
                </div>
                <div class="calc_label right"><span><span class="calc_measure"><?=$measure?></span> в день</span></div>
                <div class="clear"></div>
            </div>

            <div class="calc_row days">
                <div class="calc_label days"><span>Длительность лечения</span></div>
                <div class="calc_input_wrap">
                    <div class="control_button minus" data-target="days">−</div>
                    <input type="text" id="days" value="1">
                    <div class="control_button plus" data-target="days">+</div>
                </div>
                <div class="calc_label right"><span>дней</span></div>
                <div class="clear"></div>
            </div>

            <div class="calc_row heads">
                <div class="calc_label heads"><span>Животных</span></div>
                <div class="calc_input_wrap">
                    <div class="control_button minus" data-target="heads">−</div>
                    <input type="text" id="heads" value="1">
                    <div class="control_button plus" data-target="heads">+</div>
                </div>
                <div class="calc_label right"><span>голов</span></div>
                <div class="clear"></div>
            </div>
        </div>

        <div class="calc_block image">
            <img src="<?=SITE_TEMPLATE_PATH?>/images/product_placeholder_big.png"></a>
        </div>

        <div class="calc_block right">
            <div class="calc_footer">
                <div class="result">
                    <span class="ttl">Для лечения необходимо</span>
                    <div class="res"><span class="digits">0</span> <span class="calc_measure"><?=$measure?></span></div>
                </div>

                <div class="get_price">
                    <span class="text">
                        <a href="#">Заголовок продукта</a>
                    </span>
                    <div class="get_price_button">Запросить цену</div>
                </div>

            </div>
        </div>

        <div class="clear"></div>
    </div>

    <div class="product_form_wrap"></div>

</div>

<div class="loading">Загрузка&#8230;</div>