<?php
$arUrlRewrite=array (
  0 => 
  array (
    'CONDITION' => '#^/o-kompanii/((?!vakansii)[a-zA-Z0-9\\.\\-_\\/]+)/(.*)#',
    'RULE' => 'company_code=$1',
    'ID' => '',
    'PATH' => '/o-kompanii/company_single.php',
    'SORT' => 100,
  ),
  1 => 
  array (
    'CONDITION' => '#^/reshenie_zadach/([a-zA-Z0-9\\.\\-_\\/]+)/(.*)#',
    'RULE' => 'solution_code=$1',
    'ID' => '',
    'PATH' => '/include/pages/solution_single.php',
    'SORT' => 100,
  ),
  2 => 
  array (
    'CONDITION' => '#^/bitrix/services/ymarket/#',
    'RULE' => '',
    'ID' => '',
    'PATH' => '/bitrix/services/ymarket/index.php',
    'SORT' => 100,
  ),
  3 => 
  array (
    'CONDITION' => '#^/korma-i-dobavki/#',
    'RULE' => '',
    'ID' => 'bitrix:catalog',
    'PATH' => '/korma-i-dobavki/index.php',
    'SORT' => 100,
  ),
  4 => 
  array (
    'CONDITION' => '#^/personal/order/#',
    'RULE' => '',
    'ID' => 'bitrix:sale.personal.order',
    'PATH' => '/personal/order/index.php',
    'SORT' => 100,
  ),
  13 => 
  array (
    'CONDITION' => '#^/yevrazgreyn/#',
    'RULE' => '',
    'ID' => 'bitrix:catalog',
    'PATH' => '/yevrazgreyn/index.php',
    'SORT' => 100,
  ),
  5 => 
  array (
    'CONDITION' => '#^/press-centr/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/press-centr/index.php',
    'SORT' => 100,
  ),
  6 => 
  array (
    'CONDITION' => '#^/personal/#',
    'RULE' => '',
    'ID' => 'bitrix:sale.personal.section',
    'PATH' => '/personal/index.php',
    'SORT' => 100,
  ),
  12 => 
  array (
    'CONDITION' => '#^/agrovet/#',
    'RULE' => '',
    'ID' => 'bitrix:catalog',
    'PATH' => '/agrovet/index.php',
    'SORT' => 100,
  ),
  7 => 
  array (
    'CONDITION' => '#^/catalog/#',
    'RULE' => '',
    'ID' => 'bitrix:catalog',
    'PATH' => '/catalog/index.php',
    'SORT' => 100,
  ),
  8 => 
  array (
    'CONDITION' => '#^/semena/#',
    'RULE' => '',
    'ID' => 'bitrix:catalog',
    'PATH' => '/semena/index.php',
    'SORT' => 100,
  ),
  9 => 
  array (
    'CONDITION' => '#^/store/#',
    'RULE' => '',
    'ID' => 'bitrix:catalog.store',
    'PATH' => '/store/index.php',
    'SORT' => 100,
  ),
  10 => 
  array (
    'CONDITION' => '#^/news/#',
    'RULE' => '',
    'ID' => 'bitrix:news',
    'PATH' => '/news/index.php',
    'SORT' => 100,
  ),
  11 => 
  array (
    'CONDITION' => '#^/rest/#',
    'RULE' => '',
    'ID' => NULL,
    'PATH' => '/bitrix/services/rest/index.php',
    'SORT' => 100,
  ),
);
