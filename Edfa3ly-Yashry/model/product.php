<?php

namespace NsBll;

class Product extends Bll {

    public function __construct() {
        $this->_table = "tbl_product";
        $this->_data = array(
            'intID' => -1,
            'strName' => '',
            'strDescription' => '',
            'floatPrice' => -1,
            'strCode' => '',
            'intTaxID' => -1
        );
        parent::__construct();
    }

    public function __get($name) {
        switch ($name) {
            // late binding obj tax if you need it
            case 'objTax':
                if (!isset($this->_data['objTax'])) {
                    $obj = new \NsBll\Tax();
                    $rslt = $obj->LoadByID($this->_data['intTaxID']);
                    if ($rslt) {
                        $this->_data['objTaxType'] = $obj;
                    }
                }
                break;
        }
    }

    protected function delete() {
        return true;
    }

    protected function load($objRow) {
        // should load products from database , no we have not database then we upload from file
        $this->_data['intID'] = $objRow->pkID;
        $this->_data['strName'] = $objRow->fldName;
        $this->_data['strDescription'] = $objRow->fldDescription;
        $this->_data['floatPrice'] = $objRow->fldPrice;
        $this->_data['strCode'] = $objRow->fldCode;
        $this->_data['intTaxID'] = $objRow->fkTaxID;
    }

    public function LoadByID($intID) {
        $arr['pkID'] = $intID;
        $arrData = $this->retrive($arr);
        if (!empty($arrData)) {
            return ($arrData[0]);
        }
        return false;
    }

    public function LoadByName($strName) {
        $arr['fldName'] = "'" . $strName . "'";
        $arrData = $this->retrive($arr);
        if (!empty($arrData)) {
            return ($arrData[0]);
        }
        return false;
    }

    public function GetData() {
        return $this->retrive();
    }

    static public function GetAssociativeByNameWithCount($arrProductNameCount) {
        $arrProduct = array();
        foreach ($arrProductNameCount as $strName => $intCount) {
            $objProduct = new \NsBll\Product();
            $rslt = $objProduct->LoadByName($strName);
            if ($rslt) {
                $objProduct->_data['intCount'] = $intCount;
                $arrProduct[$objProduct->_data['intID']] = $objProduct;
            }
        }
        return $arrProduct;
    }

}
