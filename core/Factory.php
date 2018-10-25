<?php
/**
 * IDE: PhpStorm.
 * Created by: Trevor
 * Date: 10/11/18
 * Time: 9:32 PM
 */

include_once('Sales.php');
include_once('Store.php');
include_once('Staff.php');
include_once('Customer.php');
include_once('Supplier.php');
include_once('Connect.php');
include_once('Auth.php');
include_once('TerminalOffline.php');
include_once('TerminalOnline.php');

class Factory
{
    public static function Connect($__DB, $__GB, $__Sec)
    {
        return new Connect($__DB, $__GB, $__Sec);
    }

    public static function Staff($__DB, $__GB, $__Sec, $__CONNECT)
    {
        return new Staff($__DB, $__GB, $__Sec, $__CONNECT);
    }

    public static function Sales($__DB, $__GB, $__Sec)
    {
        return new Sales($__DB, $__GB, $__Sec);
    }

    public static function Store($__DB, $__GB, $__Sec)
    {
        return new Store($__DB, $__GB, $__Sec);
    }

    public static function Customer($__DB, $__GB, $__Sec)
    {
        return new Customer($__DB, $__GB, $__Sec);
    }

    public static function Supplier($__DB, $__GB, $__Sec)
    {
        return new Supplier($__DB, $__GB, $__Sec);
    }

    public static function Auth($__DB, $__GB, $__Sec)
    {
        return new Auth($__DB, $__GB, $__Sec);
    }

    public static function TerminalOffline($__DB, $__GB, $__Sec)
    {
        return new TerminalOffline($__DB, $__GB, $__Sec);
    }

    public static function TerminalOnline($__DB, $__GB, $__Sec)
    {
        return new TerminalOnline($__DB, $__GB, $__Sec);
    }
}
