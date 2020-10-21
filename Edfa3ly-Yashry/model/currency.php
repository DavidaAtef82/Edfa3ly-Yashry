<?php

namespace NsBll;

class Currency {

    private $strDefault;
    //I have base these rates on USD 
    private $arrCurrncy = [
        'USD' => 1.0,
        'EGP' => 15.74,
        'GBP' => 0.7,
        'EUR' => 0.800284,
        'YEN' => 109.67,
        'CAN' => 1.23,
    ];

    public function __construct($strCurrency = 'USD') {
        if (!key_exists($strCurrency, $this->arrCurrncy)) {
            $strCurrency = "USD";
        }
        $this->strDefault = $strCurrency;
    }

    public function NewValue($amount) {
        return round($this->arrCurrncy[$this->strDefault] * $amount, 2) . "$this->strDefault";
    }

    public function GetAll() {
        return $this->arrCurrncy;
    }

}
