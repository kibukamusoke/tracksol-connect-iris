<?php
/**
 * IDE: PhpStorm.
 * Created by: Trevor
 * Date: 10/14/18
 * Time: 5:24 PM
 */

class Auth
{
    protected $__DB;
    protected $__GB;

    public function __construct($__DB, $__GB, $__Sec)
    {
        $this->__DB = $__DB;
        $this->__GB = $__GB;
    }

    public function getUser($id)
    {
        $id = $this->__GB->__DB->escape_string($id);
        $query = $this->__GB->__DB->select('auth', '*', "`id` = {$id}");
        if ($this->__GB->__DB->num_rows($query) != 0) {
            $fetch = $this->__GB->__DB->fetch_assoc($query);
            return $fetch;
        }
    }

    public function getAuthID($token)
    {
        $token = $this->__GB->__DB->escape_string($token);
        $query = $this->__GB->__DB->select('session', '*', "`token`= '{$token}'");
        if ($this->__GB->__DB->num_rows($query) != 0) {
            $fetch = $this->__GB->__DB->fetch_assoc($query);
            return $fetch['authId'];
        } else {
            return 0;
        }
    }

    public function adminLogin($array)
    {
        $error = '';
        foreach ($array as $key => $val) {
            $array[$key] = trim($this->__GB->__DB->escape_string($val));
        }
        $query = $this->__GB->__DB->select('auth', '*', "`username` = '" . $array['username'] . "' AND `password` = '" . md5($array['password']) . "'");
        if (empty($array['username']) || empty($array['password'])) {
            $error = 'All fields required';
        } else if ($this->__GB->__DB->num_rows($query) <= 0) {
            $error = 'Login failed please try again';
        } else {
            $fetch = $this->__GB->__DB->fetch_assoc($query);
            $this->__GB->SetSession('admin', $fetch['id']);
            $this->__GB->SetSession('adminusername', $fetch['fullname']);
            $this->__GB->SetSession('avatar', $fetch['profilepic']);
            header('Location: index.php');
        }
        $this->__GB->__DB->free_result($query);
        return $error;
    }

    public function AdminExists($username)
    {
        $query = $this->__GB->__DB->select('auth', '`id`', "`username` = '" . $username . "'");
        if ($this->__GB->__DB->num_rows($query) != 0) {
            return true;
        } else {
            return false;
        }
    }

    public function GetAdmins($limit)
    {
        $query = $this->__GB->__DB->select('auth', '*', '', '`id` DESC', $limit);
        $links = '';
        while ($fetch = $this->__GB->__DB->fetch_assoc($query)) {
            $links[] = $fetch;
        }
        return $links;
    }

    public function logout()
    {
        $this->__GB->UnsetSession('admin');
        $this->__GB->UnsetSession('adminusername');
        $this->__GB->UnsetSession('avatar');
        header('Location: login.php');

    }

}