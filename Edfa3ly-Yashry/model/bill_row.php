<?php

namespace NsBll;

class Bill_Row extends Bll {

    const ENUM_TYPE_PRODUCT = "PRODUCT";
    const ENUM_TYPE_TAX = "TAX";
    const ENUM_TYPE_OFFER = "OFFER";
    
    public function __construct() {
        $this->_table = "tbl_bill_row";
        $this->_data = array(
            'intID' => -1,
            'intBillID' => -1,
            'intProductID' => -1,
            'intTaxID' => -1,
            'intOfferID ' => -1,
            'strRowType' => '',
            'decPrice' => -1,
            'intQuantity' => -1,
        );
        parent::__construct();
    }

    protected function load($objRow) {
        // should load products from database , no we have not database then we upload from file
        $this->_data['intID'] = $objRow->pkID;
        $this->_data['intBillID'] = $objRow->fkBillID ;
        $this->_data['intProductID'] = $objRow->fkProductID;
        $this->_data['intTaxID'] = $objRow->fkTaxID ;
        $this->_data['intOfferID'] = $objRow->fkOfferID ;
        $this->_data['strRowType'] = $objRow->fldRowType;
        $this->_data['decPrice'] = $objRow->fldPrice;
        $this->_data['intQuantity'] = $objRow->fldQuantity;
    }

    public function LoadByID($intID) {
        $arr['pkID'] = $intID;
        $arrData = $this->retrive($arr);
        if (!empty($arrData)) {
            return ($arrData[0]);
        }
        return 0;
    }

    public function GetData() {
        return $this->retrive();
    }
}
