<?php
/**
 * IDE: PhpStorm.
 * Created by: Trevor
 * Date: 10/19/18
 * Time: 9:30 PM
 */

class Staff
{
    private $__DB, $__GB, $__Sec, $__CONNECT;

    public function __construct($__DB, $__GB, $__Sec, $__CONNECT)
    {
        $this->__DB = $__DB;
        $this->__GB = $__GB;
        $this->__Sec = $__Sec;
        $this->__CONNECT = $__CONNECT;
    }

    public function addStaff($data)
    {
        $data['created_by'] = $_SESSION['adminusername'];
        $query = $this->__GB->__DB->select('staff', '*', "card_no = '{$data['card_no']}' AND status = 1");
        if ($this->__GB->__DB->num_rows($query) > 0) {
            // duplicate card_no not allowed::
            return array('success' => false, 'message' => 'Card Number exists.');
        }
        $insert = $this->__DB->insert('staff', $data);
        $this->__CONNECT->upsertConnectCard($data);
        if ($insert) {
            return array('success' => true, 'message' => 'Staff Added');
        } else {
            return array('success' => false, 'message' => $insert);
        }

    }

    public function updateStaff($data)
    {
        $staff_id = $data['staff_id'];
        unset($data['staff_id']);
        $data['updated_by'] = $_SESSION['adminusername'];
        $data['updated_dt'] = date('Y-m-d h:i:s');
        $update = $this->__GB->__DB->update('staff', $data, "staff_id = {$staff_id}");
        $this->__CONNECT->upsertConnectCard($data);
        if ($update) {
            return array('success' => true, 'message' => 'Update successful');
        } else {
            return array('success' => false, 'message' => $update);
        }
    }

}