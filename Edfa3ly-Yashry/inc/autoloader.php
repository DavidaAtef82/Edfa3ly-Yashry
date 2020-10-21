<?php 

function __autoload($class) {
    // get class with namespace 
    $arrPart = explode('\\', $class);
    $strClassName = strtolower(end($arrPart));
    require  'model/'. $strClassName. '.php';
}