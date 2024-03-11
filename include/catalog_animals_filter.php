<?php
$curPage = $APPLICATION->GetCurPage();
$calcPage = '/kalkulyator-dozirovok/';
$mainPage = '/korma-i-dobavki/';

if ($curPage == $mainPage && !isset($_GET['filter'])) {
	$_SESSION['animal_filter'] = 'all';
}

if ($curPage == $mainPage && isset($_GET['filter']) && $_GET['filter']=='all'){
	$_SESSION['animal_filter'] = 'all';
}

if (stristr($curPage,$calcPage)){$_SESSION['animal_filter'] = 'calc';}
else if (isset($_GET['filter']) && !empty($_GET['filter'])){
	if ($_GET['filter'] == 'all'){$_SESSION['animal_filter'] = 'all';}
	if ($_GET['filter'] == 'cattle'){$_SESSION['animal_filter'] = 'cattle';}
	if ($_GET['filter'] == 'pigs'){$_SESSION['animal_filter'] = 'pigs';}
	if ($_GET['filter'] == 'birds'){$_SESSION['animal_filter'] = 'birds';}
}

$active_buttons = array(
	'all' => '',
	'birds' => '',
	'pigs' => '',
	'cattle' => '',
	'calc' => '',
);

if ($_SESSION['animal_filter'] == 'calc'){$active_buttons['calc'] = ' active';}
else if(isset($_SESSION['animal_filter']) && !empty($_SESSION['animal_filter'])){
	if ($_SESSION['animal_filter'] == 'all'){$active_buttons['all'] = ' active';}
	if ($_SESSION['animal_filter'] == 'birds'){$active_buttons['birds'] = ' active';}
	if ($_SESSION['animal_filter'] == 'pigs'){$active_buttons['pigs'] = ' active';}
	if ($_SESSION['animal_filter'] == 'cattle'){$active_buttons['cattle'] = ' active';}

} else {
	$active_buttons['all'] = ' active';
}

$animals_filter = array(
	array(
		'title' => 'Все кормовые добавки',
		'href' => '/korma-i-dobavki/?filter=all',
		'class' => 'no_image'.$active_buttons['all']
	),
	array(
		'title' => 'Птица',
		'href' => '/korma-i-dobavki/?filter=birds',
		'class' => 'birds'.$active_buttons['birds']
	),
	array(
		'title' => 'Свиньи',
		'href' => '/korma-i-dobavki/?filter=pigs',
		'class' => 'pigs'.$active_buttons['pigs']
	),
	array(
		'title' => 'Крупный рогатый скот',
		'href' => '/korma-i-dobavki/?filter=cattle',
		'class' => 'cattle'.$active_buttons['cattle']
	),
	// array(
	// 	'title' => 'Калькулятор дозировок',
	// 	'href' => '/korma-i-dobavki/kalkulyator-dozirovok/',
	// 	'class' => 'calculator'.$active_buttons['calc']
	// ),
);

$add_class = '';
if ($top){$add_class = ' top';}
?>


<?if ($top):?>
<div class="animals_filter_pseudo_selector hidden-lg hidden-md hidden-sm">Все кормовые добавки</div>
<?endif;?>

<div class="animals_filter<?=$add_class?>">

	<?foreach($animals_filter as $item):?>
		<a href="<?= $item['href'] ?>" data-class="<?=$item['class']?>" class="button <?=$item['class']?>"><?=$item['title']?></a>
	<?endforeach;?>

	<div class="clear"></div>

</div>