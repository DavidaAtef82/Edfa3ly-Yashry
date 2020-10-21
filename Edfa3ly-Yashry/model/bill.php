<?php

namespace NsBll;

class Bill extends Bll {

    public function __construct() {
        $this->_table = "tbl_bill";
        $this->_data = array(
            'intID' => -1,
            'tsCreatedOn' => '',
            'floatSubTotal' => 0,
            'floatTax' => 0,
            'arrOffer' => array(),
            'floatTotaldiscount' => 0,
            'floatTotal' => 0,
        );
        parent::__construct();
    }

    protected function load($objRow) {
        // should load products from database , no we have not database then we upload from file
        $this->_data['intID'] = $objRow->pkID;
        $this->_data['tsCreatedOn'] = $objRow->tsCreatedOn;
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

    public function PrintResult($strCurrency = '') {

        if (empty($strCurrency)) {
            $strCurrency = 'USD';
        }
        $objCurrency = new \NsBll\Currency($strCurrency);
        $objResult = array(
            "Subtotal" => $objCurrency->NewValue($this->_data['floatSubTotal']),
            "Taxes" => $objCurrency->NewValue($this->_data['floatTax']),
            "Discounts" => $this->_data['arrOffer'],
            "Total Discounts" => $objCurrency->NewValue($this->_data['floatTotaldiscount']),
            "Total" => $objCurrency->NewValue($this->_data['floatTotal']),
        );
        http_response_code(200);

        $arrReturn = array();
        $arrReturn['result'] = true;
        $arrReturn['title'] = "Success";
        $arrReturn['object'] = $objResult;
        print json_encode($arrReturn);
    }

    static public function Create($arrProduct) {
        /*
         * this function to create invoice or bill ,
         * the bill contains set of rows like products , tax , discount
         *  in new steps it should save in database with user that buy product
         */
        if (empty($arrProduct)) {
            return false;
        }

        $objBill = new \NsBll\Bill();

        foreach ($arrProduct as $intID => $objProduct) {
            // in the future if you need to save transactions in database use the class bill row to save this row 
            $objBillRow = new \NsBll\Bill_Row();
            $objBillRow->decPrice = $objProduct->_data['floatPrice'];
            $objBillRow->intQuantity = $objProduct->_data['intCount'];
            $objBill->_data['floatSubTotal'] += $objBillRow->decPrice * $objBillRow->intQuantity;
        }
        
        /*
         * tax has table in database that exist any tax you need to add there are default field 
         * that explain which the tax on the total bill or not
         */
        // get total tax for net or sub total 
        $objBill->_data['floatTax'] = \NsBll\Tax::Calculate($objBill->_data['floatSubTotal']);

        /*
         * to get offers for product 
         * there is a table called tbl_offer --> refere the offers on any product
         * and allow to add multiple offers to single product
         * and there is additional table called tbl_offer_depend  --> 
         * refere to no offer can occur without the condiotions is done 
         * it is possible to exist multiple dependance to single offer
         */
        // get total discount and  the offers for this item
        $objBill->_data['floatTotaldiscount'] = \NsBll\Offer::Calculate($arrProduct, $objBill->_data['arrOffer']);

        // get total 
        $floatTotalResult = $objBill->_data['floatSubTotal'] + $objBill->_data['floatTax'] - $objBill->_data['floatTotaldiscount'];

        $objBill->_data['floatTotal'] = round($floatTotalResult, 3);

        return $objBill;
    }

}
