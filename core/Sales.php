<?php
/**
 * IDE: PhpStorm.
 * Created by: Trevor
 * Date: 10/11/18
 * Time: 9:35 PM
 */

class Sales
{

    private $__DB, $__GB, $__Sec;

    public function __construct($__DB, $__GB, $__Sec)
    {
        $this->__DB = $__DB;
        $this->__GB = $__GB;
        $this->__Sec = $__Sec;
    }


    public function addPaymentMode($data) {
        $data['created_by'] = $_SESSION['adminusername'];
        $query = $this->__GB->__DB->select('payment_mode', '*', "mode_code = '{$data['mode_code']}' AND status = 1");
        if ($this->__GB->__DB->num_rows($query) > 0) {
            // duplicate card_no not allowed::
            return array('success' => false, 'message' => 'Mode Code exists.');
        }
        $insert = $this->__DB->insert('payment_mode', $data);
        if ($insert) {
            return array('success' => true, 'message' => 'Mode Added');
        } else {
            return array('success' => false, 'message' => $insert);
        }
    }

    public function updatePaymentMode($data) {
        $mode_id = $data['mode_id'];
        unset($data['mode_id']);
        $data['updated_by'] = $_SESSION['adminusername'];
        $data['updated_dt'] = date('Y-m-d h:i:s');
        $update = $this->__GB->__DB->update('payment_mode', $data, "mode_id = {$mode_id}");
        if ($update) {
            return array('success' => true, 'message' => 'Update successful');
        } else {
            return array('success' => false, 'message' => $update);
        }
    }

}