<?php

namespace NsBll;

class Tax extends Bll {

    const ENUM_TYPE_FIXED = "FIXED";
    const ENUM_TYPE_PERCENT = "PERCENT";

    public function __construct() {
        $this->_table = "tbl_tax";
        $this->_data = array(
            'intID' => -1,
            'strName' => '',
            'strType' => '',
            'intValue' => -1,
        );
        parent::__construct();
    }

    protected function load($objRow) {
        // should load products from database , no we have not database then we upload from file
        $this->_data['intID'] = $objRow->pkID;
        $this->_data['strName'] = $objRow->fldName;
        $this->_data['strType'] = $objRow->fldType;
        $this->_data['intValue'] = $objRow->fldValue;
    }

    static public function GetPercentValue($floatNet, $floatTaxVal) {
        return (($floatTaxVal * $floatNet) / 100);
    }

    public function LoadByID($intID) {
        if (empty($intID))
            return false;

        $arr['pkID'] = $intID;
        $arrData = $this->retrive($arr);
        if (!empty($arrData)) {
            return ($arrData[0]);
        }
        return false;
    }

    public function GetDefaultTax() {
        $arr['fldOnBill'] = 1;
        $arrData = $this->retrive($arr);
        if (!empty($arrData)) {
            return ($arrData);
        }
        return false;
    }

    public function GetData() {
        return $this->retrive();
    }

    static public function Calculate($decNet) {
        // then we will add the default tax for any bill or invoice 
        $objTax = new \NsBll\Tax();
        $arrTax = $objTax->GetDefaultTax();
        $intTotalTax = 0;
        foreach ($arrTax as $obj) {
            switch ($obj->strType) {
                case \NsBll\Tax::ENUM_TYPE_PERCENT:
                    $intTotalTax += (\NsBll\Tax::GetPercentValue($decNet, $obj->intValue));
                    break;
                default :
                    $intTotalTax += $obj->intValue;
                    break;
            }
            return  round($intTotalTax, 2);
        }
    }

}
