<?php
/**
 * IDE: PhpStorm.
 * Created by: Trevor
 * Date: 10/18/18
 * Time: 12:10 PM
 */

class TerminalOffline
{
    private $__DB, $__GB, $__Sec;

    public function __construct($__DB, $__GB, $__Sec)
    {
        $this->__DB = $__DB;
        $this->__GB = $__GB;
        $this->__Sec = $__Sec;
    }

    public function callDBAPI($tmn_hw_id, $action_id, $data)
    {
        $data = json_encode($data);
        $this->__GB->__DB->query("CALL sp_tms_api($tmn_hw_id,$action_id,'$data', @output);");
        $query = $this->__GB->__DB->query('SELECT @output');
        $result = $this->__GB->__DB->fetch_array($query);
        return $result[0];
    }

    public function registerFingerPrint($data)
    {
        return $this->callDBAPI($data['tmn_hw_id'], $data['actionId'], $data);
    }

    public function fingerPrintLog($data)
    {
        return $this->callDBAPI($data['tmn_hw_id'], $data['actionId'], $data);
    }

    public function processCashSale($data)
    {
        return $this->callDBAPI($data['tmn_hw_id'], $data['actionId'], $data);
    }

    public function processCustomerSale($data) // integrate with points clearing house.
    {
        return $this->callDBAPI($data['tmn_hw_id'], $data['actionId'], $data);
    }

    
}