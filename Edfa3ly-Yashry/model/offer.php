<?php

namespace NsBll;

class Offer extends Bll {

    public function __construct() {
        $this->_table = "tbl_offer";
        $this->_data = array(
            'intID' => -1,
            'intProductID ' => '',
            'intValue' => -1,
        );
        parent::__construct();
    }

    protected function load($objRow) {
        // should load products from database , no we have not database then we upload from file
        $this->_data['intID'] = $objRow->pkID;
        $this->_data['intProductID '] = $objRow->fkProductID;
        $this->_data['intValue'] = $objRow->fldValue;
    }

    public function LoadByProductID($intID) {
        $arr['fkProductID'] = $intID;
        $arrData = $this->retrive($arr);
        if (!empty($arrData)) {
            return ($arrData[0]);
        }
        return 0;
    }

    public function LoadByID($intID) {
        $arr['pkID'] = $intID;
        $arrData = $this->retrive($arr);
        if (!empty($arrData)) {
            return ($arrData[0]);
        }
        return 0;
    }

    public function GetByProductID($intID) {
        $arr['fkProductID'] = $intID;
        $arrData = $this->retrive($arr);
        if (!empty($arrData)) {
            return ($arrData);
        }
        return array();
    }

    public function GetData() {
        return $this->retrive();
    }

    // this function to count the number of times can offer support for example : if there are offer on single t-shirt 
    // customer buy 4 t-shirt that mean offer times 4 
    // i handle cases of product offer based on others 

    static public function CountOfferAcceptance($intOfferID, $arrProduct, $intCount) {
        $intCountTimes = 0;
        for ($intAcc = 0; $intAcc < $intCount; $intAcc++) {
            $obj = new \NsBll\Offer_Depend();
            $rslt = $obj->AcceptOffer($intOfferID, $arrProduct, $intAcc);
            if ($rslt) {
                $intCountTimes++;
            } else {
                break;
            }
        }
        return $intCountTimes;
    }

    static public function Calculate($arrProduct, &$arrOffer) {
        $arrOffer = array();
        $decTotalDiscount = 0;
        foreach ($arrProduct as $intID => $objProduct) {
            // get possible offers for this item
            $objOfferTemp = new \NsBll\Offer();
            $arrProductOffers = $objOfferTemp->GetByProductID($intID);
            // loop on the product offers in case the product has many offers in diffrent cases
            foreach ($arrProductOffers as $objProductOffer) {
                $intCountTimes = self::CountOfferAcceptance($objProductOffer->intID, $arrProduct, $objProduct->_data['intCount']);
                if (!empty($intCountTimes)) {
                    // get value of discount based on the product and its name rather than the total object
                    $objProductOffer->intDiscountValue = ($objProduct->_data['floatPrice'] * $objProductOffer->intValue) / 100;
                    $objProductOffer->strProductName = $objProduct->_data['strName'];
                    $arrOffer [] = array(
                        'Value' => $objProductOffer->intValue."%",
                        'ProductName' => $objProduct->_data['strName'],
                        'Count' => $intCountTimes,
                        'DiscountValue' => round(($objProduct->_data['floatPrice'] * $objProductOffer->intValue) / 100, 2),
                    );
                    $decTotalDiscount += $intCountTimes * $objProductOffer->intDiscountValue;
                }
            }
        }
        return round($decTotalDiscount, 2);
    }

}
