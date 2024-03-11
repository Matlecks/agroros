<?

use Bitrix\Highloadblock as HL;

use Bitrix\Main\Entity;

// if (in_array($_SERVER['REMOTE_ADDR'], ['178.72.68.220', '46.163.154.227','95.82.251.125','87.21.189.91','92.248.189.41','178.72.91.96','92.248.188.9'])){
// 	$_GET['debug_roso'] = 1;
// }



AddEventHandler("iblock", "OnAfterIBlockElementUpdate", "OnAfterIBlockElementHandler");

AddEventHandler("iblock", "OnAfterIBlockElementAdd", "OnAfterIBlockElementHandler");

AddEventHandler("iblock", "OnBeforeIBlockElementUpdate", "OnBeforeIBlockElementUpdateHandler");

AddEventHandler("iblock", "OnBeforeIBlockElementDelete", "OnBeforeIBlockElementDeleteHandler");



// Синхронизируем ответы формы "Вакансии" с элементами одноимённого инфоблока



$old_name = '';

$QUESTION_ID = 10; // ID вопроса, в который мы будем добавлять ответы



function OnBeforeIBlockElementUpdateHandler(&$arFields)

{

	global $old_name;

	$arr = CIblockElement::GetByID($arFields["ID"]);

	if ($ar = $arr->Fetch()){

		$old_name = trim($ar["NAME"]);

	}

}



function OnBeforeIBlockElementDeleteHandler($ID)

{

	global $QUESTION_ID;

	$arr = CIblockElement::GetByID($ID);

	if ($ar = $arr->Fetch()){

		

		CModule::IncludeModule("form");

		$rsAnswersDel = CFormAnswer::GetList($QUESTION_ID, $by="s_id", $order="desc", Array("MESSAGE" => $ar["NAME"]), $is_filtered);

		while ($arAnswerDel = $rsAnswersDel->Fetch()){

			CFormAnswer::Delete($arAnswerDel["ID"]);

		}

	}

}



function OnAfterIBlockElementHandler(&$arFields){

	

	/*

	if ($arFields["IBLOCK_ID"] == 7 && intval($arFields["RESULT"]) >= 0){

	

		global $old_name, $QUESTION_ID;

		CModule::IncludeModule("form");

		

		// Удаляем старое значение ответа при возможном Update.

		

		if (strlen($old_name)>0)

		{

			$rsAnswersDel = CFormAnswer::GetList($QUESTION_ID, $by="s_id", $order="desc", Array("MESSAGE" => $old_name), $is_filtered);

			while ($arAnswerDel = $rsAnswersDel->Fetch()){

				CFormAnswer::Delete($arAnswerDel["ID"]);

			}

		}

		

		// Добавляем новое значение

		

		$rsAnswers = CFormAnswer::GetList($QUESTION_ID, $by="s_id", $order="desc", Array(), $is_filtered);

		$arAnswer = $rsAnswers->Fetch();

		if (!$arAnswer){

			

			$arAdd = Array("QUESTION_ID"=> $QUESTION_ID, "MESSAGE"=> $arFields["NAME"], "VALUE"=>$arFields["NAME"], "FIELD_TYPE"=> "dropdown");

			CFormAnswer::Set($arAdd, false, $QUESTION_ID);

			

		} else {

					

			$bnew = true;

			do {

				if ($arAnswer["MESSAGE"] == $arFields["NAME"]){

					$bnew = false; break;

				}

			} while ($arAnswer = $rsAnswers->Fetch());

			

			if ($bnew){

				$arAdd = Array("QUESTION_ID"=> $QUESTION_ID, "MESSAGE"=> $arFields["NAME"], "VALUE"=>$arFields["NAME"], "FIELD_TYPE"=> "dropdown");

				CFormAnswer::Set($arAdd, false, $QUESTION_ID);

			}

		}

	}

	*/

}



function get_company($id_1c){



	static $data;



	if (!empty($data)){



		$result = false;

		if ($data[$id_1c]){

			$result = $data[$id_1c];

		}



	} else {



		// Составляем массив вида array(ID_компании_в_1С => ID_компании_на_сайте) 

		$data = array();



		if (CModule::IncludeModule("iblock")) {

			$arFilter = array(

				"ACTIVE" => 'Y',

				"IBLOCK_ID" => 4, // Инфоблок "Производители"

			);

			$arSelect = array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_*");

			$res = CIBlockElement::GetList(array(), $arFilter, false, array(), $arSelect);

			while ($ob = $res->GetNextElement()) {

				$company = $ob->GetFields(); // Получаем поля элемента   

				$company['PROPERTIES'] = $ob->GetProperties(); // Получаем свойства элемента



				if (!empty($company['PROPERTIES']['CPM_1C_CONNECTOR']['VALUE'])) {

					foreach ($company['PROPERTIES']['CPM_1C_CONNECTOR']['VALUE'] as $id) {



						if (!$data[$id]) {

							$data[$id] = $company['ID'];

						}



					}

				}

			}

		}



		$result = false;

		if ($data[$id_1c]) {

			$result = $data[$id_1c];

		}

	}

	return $result;

}



define('IBLOCK_ID_SEMENA', 13); // Каталог "Семена"

define('IBLOCK_ID_KORMA', 14); // Каталог "Корма и добавки"



// Работа с выгрузкой

class RosoUtils

{

	function OnBeforeIBlockElementUpdateHandler(&$arFields)

	{

		$catalog_blocks = array(IBLOCK_ID_SEMENA, IBLOCK_ID_KORMA);



		/*

		Свойства, которые необходимо транслировать:

	

		Корма и добавки:

			- Изготовитель 181 в 201

			- Норма ввода 165 в 202

			- Норма ввода для калькулятора 185 в 203

			- Базовая единица - Единица измерения 145 в 204

			- Преимущества - из 184 в 205

			- Биологическое действие из 182 в 206

			- Показания к применению из 183 в 207



		Семена:

			- Изготовитель 110 в 130

			- Норма ввода 93 в 131

			- Норма ввода для калькулятора 114 в 132

			- Базовая единица - Единица измерения 73 в 133

			- Преимущества - из 113 в 135

			- Назначение 117 в 140

			- Состав 118 в 137

			- вегетационный период 116 - 136

		 */



		if ($_SESSION["BX_CML2_IMPORT"]["NS"]['STEP']) {



			if (in_array($arFields["IBLOCK_ID"], $catalog_blocks)){



				// Производитель

				$company_from = false;

				if ($arFields["IBLOCK_ID"] == IBLOCK_ID_SEMENA){

					$company_from = 110;

					$company_to = 130;

				}



				if ($arFields["IBLOCK_ID"] == IBLOCK_ID_KORMA) {

					$company_from = 181;

					$company_to = 201;

				}



				if ($company_from && !empty($arFields["PROPERTY_VALUES"][$company_from]["n0"]["VALUE"])){



					$company_id = get_company($arFields["PROPERTY_VALUES"][$company_from]["n0"]["VALUE"]);



					if ($company_id){

						$arFields["PROPERTY_VALUES"][$company_to]["n0"]["VALUE"] = $company_id;

					}

				}



				// Норма высева/ввода

				$norma_from = false;

				if ($arFields["IBLOCK_ID"] == IBLOCK_ID_SEMENA) {

					$norma_from = 93;

					$norma_to = 131;

				}

				if ($arFields["IBLOCK_ID"] == IBLOCK_ID_KORMA) {

					$norma_from = 165;

					$norma_to = 202;

				}



				if ($norma_from && !empty($arFields["PROPERTY_VALUES"][$norma_from]["n0"]["VALUE"])){

					$norma_value = trim($arFields["PROPERTY_VALUES"][$norma_from]["n0"]["VALUE"]);

					$arFields["PROPERTY_VALUES"][$norma_to]["n0"]["VALUE"] = $norma_value;

				}



				// Норма высева/ввода для калькулятора

				$norma_calc_from = false;

				if ($arFields["IBLOCK_ID"] == IBLOCK_ID_SEMENA) {

					$norma_calc_from = 114;

					$norma_calc_to = 132;

				}

				if ($arFields["IBLOCK_ID"] == IBLOCK_ID_KORMA) {

					$norma_calc_from = 185;

					$norma_calc_to = 203;

				}



				if ($norma_calc_from && !empty($arFields["PROPERTY_VALUES"][$norma_calc_from]["n0"]["VALUE"])){

					$norma_calc_value = trim($arFields["PROPERTY_VALUES"][$norma_calc_from]["n0"]["VALUE"]);

					$arFields["PROPERTY_VALUES"][$norma_calc_to]["n0"]["VALUE"] = $norma_calc_value;

				}



				// Единица измерения

				$measure_from = false;

				if ($arFields["IBLOCK_ID"] == IBLOCK_ID_SEMENA) {

					$measure_from = 73;

					$measure_to = 133;

				}

				if ($arFields["IBLOCK_ID"] == IBLOCK_ID_KORMA) {

					$measure_from = 145;

					$measure_to = 204;

				}



				if ($measure_from && !empty($arFields["PROPERTY_VALUES"][$measure_from]["n0"]["VALUE"])) {

					$measure_value = trim($arFields["PROPERTY_VALUES"][$measure_from]["n0"]["VALUE"]);

					$arFields["PROPERTY_VALUES"][$measure_to]["n0"]["VALUE"] = $measure_value;

				}



				// Назначение (только для семян)

				$purpose_from = false;

				if ($arFields["IBLOCK_ID"] == IBLOCK_ID_SEMENA) {

					$purpose_from = 117;

					$purpose_to = 140;

				}



				if ($purpose_from && !empty($arFields["PROPERTY_VALUES"][$purpose_from]["n0"]["VALUE"])) {

					$purpose_value = trim($arFields["PROPERTY_VALUES"][$purpose_from]["n0"]["VALUE"]);

					$arFields["PROPERTY_VALUES"][$purpose_to]["n0"]["VALUE"] = $purpose_value;

				}



				// Состав

				$sostav_from = false;

				if ($arFields["IBLOCK_ID"] == IBLOCK_ID_SEMENA) {

					$sostav_from = 118;

					$sostav_to = 137;

				}



				if ($sostav_from && !empty($arFields["PROPERTY_VALUES"][$sostav_from]["n0"]["VALUE"])) {

					$sostav_value = trim($arFields["PROPERTY_VALUES"][$sostav_from]["n0"]["VALUE"]);

					$arFields["PROPERTY_VALUES"][$sostav_to]["n0"]["VALUE"] = $sostav_value;

				}



				// Вегетационный период

				$vegetation_from = false;

				if ($arFields["IBLOCK_ID"] == IBLOCK_ID_SEMENA) {

					$vegetation_from = 116;

					$vegetation_to = 136;

				}



				if ($vegetation_from && !empty($arFields["PROPERTY_VALUES"][$vegetation_from]["n0"]["VALUE"])) {

					$vegetation_value = trim($arFields["PROPERTY_VALUES"][$vegetation_from]["n0"]["VALUE"]);

					$arFields["PROPERTY_VALUES"][$vegetation_to]["n0"]["VALUE"] = $vegetation_value;

				}



				// Преимущества

				$adv_from = false;

				if ($arFields["IBLOCK_ID"] == IBLOCK_ID_KORMA) {

					$adv_from = 184;

					$adv_to = 205;

				}

				if ($arFields["IBLOCK_ID"] == IBLOCK_ID_SEMENA) {

					$adv_from = 113;

					$adv_to = 135;

				}



				if ($adv_from && !empty($arFields["PROPERTY_VALUES"][$adv_from]["n0"]["VALUE"])) {

					$adv_value = trim($arFields["PROPERTY_VALUES"][$adv_from]["n0"]["VALUE"]);

					$arFields["PROPERTY_VALUES"][$adv_to]["n0"]["VALUE"] = $adv_value;

				}



				// Биологическое действие

				$bio_from = false;

				if ($arFields["IBLOCK_ID"] == IBLOCK_ID_KORMA) {

					$bio_from = 182;

					$bio_to = 206;

				}



				if ($bio_from && !empty($arFields["PROPERTY_VALUES"][$bio_from]["n0"]["VALUE"])) {

					$bio_value = trim($arFields["PROPERTY_VALUES"][$bio_from]["n0"]["VALUE"]);

					$arFields["PROPERTY_VALUES"][$bio_to]["n0"]["VALUE"] = $bio_value;

				}



				// Показания к применению

				$usage_from = false;

				if ($arFields["IBLOCK_ID"] == IBLOCK_ID_KORMA) {

					$usage_from = 183;

					$usage_to = 207;

				}



				if ($usage_from && !empty($arFields["PROPERTY_VALUES"][$usage_from]["n0"]["VALUE"])) {

					$usage_value = trim($arFields["PROPERTY_VALUES"][$usage_from]["n0"]["VALUE"]);

					$arFields["PROPERTY_VALUES"][$usage_to]["n0"]["VALUE"] = $usage_value;

				}

	

			

			}



			// if (CModule::IncludeModule("iblock")) {

			// 	$data = '--------------------------------------

			// 	' . date("d.m.Y H:i:s") . ' - ' . $_SERVER["REMOTE_ADDR"] . ':

			// 	<pre>' . print_r($arFields, 1) . '</pre>';

			// 	file_put_contents($_SERVER["DOCUMENT_ROOT"] . '/logimport.txt', $data, FILE_APPEND);

			// }



		}

		return true;

	}

}



AddEventHandler("iblock", "OnBeforeIBlockElementUpdate", array("RosoUtils", "OnBeforeIBlockElementUpdateHandler"));

AddEventHandler("iblock", "OnBeforeIBlockElementAdd", array("RosoUtils", "OnBeforeIBlockElementUpdateHandler"));



// Получаем список изготовителей из хайлоад блока

function get_izgotovitel(){

	CModule::IncludeModule('iblock');

	CModule::IncludeModule('highloadblock');



	$data = array();



	$hlblock = HL\HighloadBlockTable::getById(3)->fetch(); // id highload блока

	$entity = HL\HighloadBlockTable::compileEntity($hlblock);

	$entityClass = $entity->getDataClass();



	$res = $entityClass::getList(array(

		'select' => array('*'),

		// 'filter' => array('UF_XML_ID' => заданный ID)

	));



	while($row = $res->fetch()){

		if (!empty($row['UF_NAME']) && !empty($row['UF_XML_ID'])){

			$data[$row['UF_XML_ID']] = $row['UF_NAME'];

		}

	}



	return $data;

}

$izgotov = get_izgotovitel();

define('IZGOTOVITEL', $izgotov); // Хайлоад блок "Изготовители"



?>