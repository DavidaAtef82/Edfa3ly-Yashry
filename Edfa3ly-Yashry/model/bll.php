<?php

namespace NsBll;

class Bll {

    public $_data;
    protected $_table;
    protected $_conn;

    protected function __construct() {
        $instance = \ConnectDb::getInstance();
        $this->_conn = $instance->getConnection();
    }

    protected function retrive($arrParam = array()) {
        $strSQL = "SELECT * FROM ";
        $strSQL .= $this->_table;

        $strWhere = " WHERE 1=1";
        if (!empty($arrParam)) {
            foreach ($arrParam as $key => $val) {
                $strWhere .= " AND  $key = $val";
            }
        }
        $strSQL .= " $strWhere";

        $arrObject = $this->_conn->query($strSQL)->fetchAll();
        
        if(!$arrObject) { 
            return false;
        }
        
        $arrData = array();
        foreach ($arrObject as $obj) {
            $this->load((object) $obj);
            $arrData[] = (object) $this->_data;
        }
        return $arrData;
    }

}
