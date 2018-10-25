<?php
/**
 * IDE: PhpStorm.
 * Created by: Trevor
 * Date: 10/18/18
 * Time: 12:11 PM
 */

class TerminalOnline
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

    public function terminalUpdate($tmn_hw_id, $action_id)
    {
        return $this->callDBAPI($tmn_hw_id, $action_id, array());
    }

    public function checkCustomerPoints($data)
    {
        $data = $this->sanitizeInput($data);
        $tmn_hw_id = isset($data['tmn_hw_id']) ? $data['tmn_hw_id'] : hexdec($data['tid']);
        $act = isset($data['actionId']) ? $data['actionId'] : $data['act'];
        return $this->callDBAPI($tmn_hw_id, $act, $data);
    }

    public function sanitizeInput($data) {
        $data = json_encode($data);
        $data = str_ireplace('\n', '|', $data);
        return json_decode($data, true);
    }

}
