<?php
/**
 * IDE: PhpStorm.
 * Created by: Trevor
 * Date: 10/11/18
 * Time: 9:35 PM
 */

class Customer
{
    private $__DB, $__GB, $__Sec;

    public function __construct($__DB, $__GB, $__Sec)
    {
        $this->__DB = $__DB;
        $this->__GB = $__GB;
        $this->__Sec = $__Sec;
    }


    public function addCustomer($data)
    {
        $data['created_by'] = $_SESSION['adminusername'];
        $query = $this->__GB->__DB->select('customer', '*', "card_no = '{$data['card_no']}' AND status = 1");
        if ($this->__GB->__DB->num_rows($query) > 0) {
            // duplicate customer_code not allowed::
            return array('success' => false, 'message' => 'Customer Card exists.');
        }
        $insert = $this->__DB->insert('customer', $data);
        if ($insert) {
            return array('success' => true, 'message' => 'Customer Added');
        } else {
            return array('success' => false, 'message' => $insert);
        }

    }

    public function updateCustomer($data)
    {
        $id = $data['customer_id'];
        $data['updated_by'] = $_SESSION['adminusername'];
        unset($data['customer_id']);
        $data['updated_dt'] = date('Y-m-d h:i:s');
        $update = $this->__GB->__DB->update('customer', $data, "customer_id = {$id}");
        if ($update) {
            return array('success' => true, 'message' => 'Update successful');
        } else {
            return array('success' => false, 'message' => $update);
        }
    }


}