<?php

require_once('inc/autoloader.php');

$param = array_merge($_POST, $_GET);

if (!empty($param['products'])) {
    $strProductsName = $param['products'];
    $arrProductName = explode(',', $strProductsName);
    $arrProductNameCount = array_count_values($arrProductName);

    // get products by count 
    $arrProduct = \NsBll\Product::GetAssociativeByNameWithCount($arrProductNameCount);
    // create bill or cart of products
    $objResult = \NsBll\Bill::Create($arrProduct);

    // get currency 
    $strCurrency = empty($param['currency']) ? 'USD' : $param['currency'];
    // print result 
    $objResult->PrintResult($strCurrency);
} else {
    http_response_code(404);
}
