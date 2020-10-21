<?php

namespace NsBll;

class Offer_Depend extends Bll {

    public function __construct() {
        $this->_table = "tbl_offer_depend";
        $this->_data = array (
            'intOfferID' => -1,
            'intProductID ' => -1,
            'intNum' => -1,
        );
        parent::__construct();
    }

    protected function load($objRow) {
        // should load products from database , no we have not database then we upload from file
        $this->_data['intOfferID'] = $objRow->fkOfferID;
        $this->_data['intProductID'] = $objRow->fkProductID;
        $this->_data['intNum'] = $objRow->fldNum;
    }

    public function GetByProductID($intID) {
        $arr['fkProductID'] = $intID;
        $arrData = $this->retrive($arr);
        if (!empty($arrData)) {
            return ($arrData);
        }
        return false;
    }

    public function getByOfferID($intID) {
        $arr['fkOfferID'] = $intID;
        $arrData = $this->retrive($arr);
        if (!empty($arrData)) {
            return ($arrData);
        }
        return false;
    }

    public function AcceptOffer($intOfferID, $arrProduct, $intTime = 0) {
        if (empty($intOfferID) || empty($arrProduct)) {
            return false;
        }
        // count number of times to applay this offer
        $arrOfferDepend = $this->getByOfferID($intOfferID);
        foreach ($arrOfferDepend as $obj) {
            // key of arrProduct is the product id, if exist check number if not return false
            if (empty($arrProduct[$obj->intProductID])) {
                return false;
            }
            // get num of product based on the how many offer access
            $intNumProductTime = $arrProduct[$obj->intProductID ]->_data['intCount'] - ($obj->intNum * $intTime);
            if($intNumProductTime < $obj->intNum ) {
               return false;
            }
        }
       return true;
    }

    public function GetData() {
        return $this->retrive();
    }

}
