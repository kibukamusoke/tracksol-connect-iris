<?php
/**
 * IDE: PhpStorm.
 * Created by: Trevor
 * Date: 10/11/18
 * Time: 9:35 PM
 */

class Store
{

    private $__DB, $__GB, $__Sec;

    public function __construct($__DB, $__GB, $__Sec)
    {
        $this->__DB = $__DB;
        $this->__GB = $__GB;
        $this->__Sec = $__Sec;
    }

    public function addStockItem($data)
    {
        $query = $this->__GB->__DB->select('stock', '*', "stock_code = '{$data['stock_code']}' AND status = 1");
        if ($this->__GB->__DB->num_rows($query) > 0) {
            // duplicate stock_code not allowed::
            return array('success' => false, 'message' => 'Stock Code exists.');
        }
        $insert = $this->__DB->insert('stock', $data);
        if ($insert) {
            return array('success' => true, 'message' => 'Stock Item Added');
        } else {
            return array('success' => false, 'message' => $insert);
        }

    }

    public function updateStockItem($data)
    {
        $stock_id = $data['stock_id'];
        unset($data['stock_id']);
        $data['updated_by'] = $_SESSION['adminusername'];
        $data['updated_dt'] = date('Y-m-d h:i:s');
        $update = $this->__GB->__DB->update('stock', $data, "stock_id = {$stock_id}");
        if ($update) {
            return array('success' => true, 'message' => 'Update successful');
        } else {
            return array('success' => false, 'message' => $update);
        }
    }



    public function addStore($data)
    {
        $data['created_by'] = $_SESSION['adminusername'];
        $query = $this->__GB->__DB->select('store', '*', "store_code = '{$data['store_code']}' AND status = 1");
        if ($this->__GB->__DB->num_rows($query) > 0) {
            // duplicate store_code not allowed::
            return array('success' => false, 'message' => 'Store Code exists.');
        }
        $insert = $this->__DB->insert('store', $data);
        $this->__GB->__DB->query('CALL updateStoreHierarchy()'); // always rebuild nodes
        if ($insert) {
            return array('success' => true, 'message' => 'Store Added');
        } else {
            return array('success' => false, 'message' => $insert);
        }

    }

    public function updateStore($data)
    {
        $store_id = $data['store_id'];
        $data['updated_by'] = $_SESSION['adminusername'];
        unset($data['store_id']);
        $data['updated_dt'] = date('Y-m-d h:i:s');
        $update = $this->__GB->__DB->update('store', $data, "store_id = {$store_id}");
        $this->__GB->__DB->query('CALL updateStoreHierarchy()'); // always rebuild nodes
        if ($update) {
            return array('success' => true, 'message' => 'Update successful');
        } else {
            return array('success' => false, 'message' => $update);
        }
    }


    public function addCategory($data)
    {
        $data['created_by'] = $_SESSION['adminusername'];
        $query = $this->__GB->__DB->select('category', '*', "category_name = '{$data['category_name']}' AND status = 1");
        if ($this->__GB->__DB->num_rows($query) > 0) {
            // duplicate store_code not allowed::
            return array('success' => false, 'message' => 'Category Name exists.');
        }
        $insert = $this->__DB->insert('category', $data);
        $this->__GB->__DB->query('CALL fn_updateCategoryHierarchy()'); // always rebuild nodes
        if ($insert) {
            return array('success' => true, 'message' => 'Category Added');
        } else {
            return array('success' => false, 'message' => $insert);
        }

    }

    public function updateCategory($data)
    {
        $id = $data['cat_id'];
        $data['updated_by'] = $_SESSION['adminusername'];
        unset($data['cat_id']);
        $data['updated_dt'] = date('Y-m-d h:i:s');
        $update = $this->__GB->__DB->update('category', $data, "cat_id = {$id}");
        $this->__GB->__DB->query('CALL fn_updateCategoryHierarchy()'); // always rebuild nodes
        if ($update) {
            return array('success' => true, 'message' => 'Update successful');
        } else {
            return array('success' => false, 'message' => $update);
        }
    }


}