<?php
$curPage = $APPLICATION->GetCurPage();

$active = '';
$active_front = '';
if ($curPage == '/semena/kalkulyator-normy-vyseva/'){
	$active = ' active';
}

if ($curPage == '/semena/') {
	$active_front = ' active';
}
?>

<!-- <div class="animals_filter semena">
	<a href="/semena/" class="semena_front button<?=$active_front?>">Все семена</a>
	<a href="/semena/kalkulyator-normy-vyseva/" class="calc_semena button<?=$active?>">Калькулятор нормы высева</a>
	<div class="clear"></div>
</div> -->