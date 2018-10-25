<?php
/**
 * IDE: PhpStorm.
 * Created by: Trevor
 * Date: 10/11/18
 * Time: 9:35 PM
 */

class Supplier
{
    private $__DB, $__GB, $__Sec;

    public function __construct($__DB, $__GB, $__Sec)
    {
        $this->__DB = $__DB;
        $this->__GB = $__GB;
        $this->__Sec = $__Sec;
    }


    public function addSupplier($data)
    {
        $data['created_by'] = $_SESSION['adminusername'];
        $query = $this->__GB->__DB->select('supplier', '*', "supplier_code = '{$data['supplier_code']}' AND status = 1");
        if ($this->__GB->__DB->num_rows($query) > 0) {
            // duplicate supplier code not allowed::
            return array('success' => false, 'message' => 'Supplier Code exists.');
        }
        $insert = $this->__DB->insert('supplier', $data);
        if ($insert) {
            return array('success' => true, 'message' => 'Supplier Added');
        } else {
            return array('success' => false, 'message' => $insert);
        }

    }

    public function updateSupplier($data)
    {
        $id = $data['supplier_id'];
        $data['updated_by'] = $_SESSION['adminusername'];
        unset($data['supplier_id']);
        $data['updated_dt'] = date('Y-m-d h:i:s');
        $update = $this->__GB->__DB->update('supplier', $data, "supplier_id = {$id}");
        if ($update) {
            return array('success' => true, 'message' => 'Update successful');
        } else {
            return array('success' => false, 'message' => $update);
        }
    }


}