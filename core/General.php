<?php
/**
 * IDE: PhpStorm.
 * Created by: Trevor
 * Date: 10/14/18
 * Time: 5:41 PM
 */

class General
{
    public $__DB, $__SEC;
    private $constants;

    function __construct($__DB, $__SEC, $CONSTANTS)
    {
        $this->__DB = $__DB;
        $this->__SEC = $__SEC;
        $this->constants = $CONSTANTS;
    }

    public function prepareMessage($array)
    {
        ob_clean();
        header('Content-Type: application/json; charset=utf-8');
        if (is_array($array)) {
            echo json_encode($array);
        } else {
            echo $array;
        }
    }

    public function CountRows($table, $where = '')
    {
        if ($where != '') {
            $query = $this->__DB->select($table, '*', $where);
        } else {
            $query = $this->__DB->select($table, '`id`');
        }
        return $this->__DB->num_rows($query);
    }

    public function b64encode($string)
    {
        return urlencode(base64_encode($string));
    }

    public function b64decode($string)
    {
        return urldecode(base64_decode($string));
    }

    public function GetConfig($name, $for)
    {
        $query = $this->__DB->select('config', '`value`', "`name` = '{$name}' AND `for` = '{$for}'");
        $fetch = $this->__DB->fetch_assoc($query);
        return $fetch['value'];
    }

    public function TimeAgo($ptime, $chat = false)
    {
        if ($chat) {
            $t = time() - $ptime;
            $day = 24 * 60 * 60;
            if ($t > $day) {
                return date("H:i d/m/y", $ptime);
            } else {
                return date("H:i", $ptime);
            }
        }
        $etime = time() - $ptime;
        if ($etime < 1) {
            return '0 seconds';
        }
        $a = array(12 * 30 * 24 * 60 * 60 => 'year',
            30 * 24 * 60 * 60 => 'month',
            24 * 60 * 60 => 'day',
            60 * 60 => 'hour',
            60 => 'minute',
            1 => 'second'
        );
        foreach ($a as $secs => $str) {
            $d = $etime / $secs;
            if ($d >= 1) {
                $r = round($d);
                return $r . ' ' . $str . ($r > 1 ? 's' : '') . ' ago';
            }
        }
    }

    public function SetSession($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function GetSession($key)
    {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        } else {
            return false;
        }
    }

    public function UnsetSession($key)
    {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        } else {
            return false;
        }
    }

    public function randomNumber($length)
    {
        $result = '';
        for ($i = 0; $i < $length; $i++) {
            $result .= mt_rand(0, 9);
        }
        return $result;
    }

    public function DisplayError($error, $error_type = 'green')
    {
        /* toastr :
            1 - GREEN
            2 - YELLOW
            3 - RED
            4 - BLUE
        */
        $error_type = strtolower($error_type);
        switch ($error_type) {
            case 'green':
                $error_type = 2;
                break;
            case 'yellow':
                $error_type = 3;
                break;
            case 'red':
                $error_type = 4;
                break;
            case 'blue':
                $error_type = 1;
                break;
        }
        $msg = '<script type="text/javascript">';
        $msg .= 'window.onload = function( ) {';
        $msg .= "DisplayError(" . $error_type . ",'" . $error . "');";
        $msg .= '}</script>';
        return $msg;
    }

    function slack($message)
    {
        $message = array('payload' => json_encode(array('text' => $message)));
        $c = curl_init($this->constants['slack_url']);
        curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($c, CURLOPT_POST, true);
        curl_setopt($c, CURLOPT_POSTFIELDS, $message);
        $result = curl_exec($c);
        curl_close($c);
        return $result;
    }

    function terminalFormulateOutputString($buzzer, $lcd_line1, $lcd_line2, $lcd_line3, $lcd_line4, $printer)
    {
        $ret = '';
        switch ($buzzer) {
            case '3':
                $buzzer = 'A';
                $B = 'B`';
                break;
            case '1':
                $buzzer = 'A';
                $B = '';
                break;
            default:
                $buzzer = 'E';
                $B = '`B`';
                break;
        }
        $ret .= '{' . $B . $buzzer . '`}';
        if (strlen(trim($lcd_line1 . $lcd_line2 . $lcd_line3 . $lcd_line4)) > 0) {
            $ret .= '{L`' . strlen(trim($lcd_line1)) > 0 ? '[1`' . $lcd_line1 . '`]' : '';
            $ret .= strlen(trim($lcd_line2)) > 0 ? '[2`' . $lcd_line2 . '`]' : '';
            $ret .= strlen(trim($lcd_line3)) > 0 ? '[3`' . $lcd_line3 . '`]' : '';
            $ret .= (strlen(trim($lcd_line4)) > 0 ? '[4`' . $lcd_line4 . '`]' : '') . '`}';
        }
        if (strlen(trim($printer)) > 0)
            $ret .= '{P`' . '[T`' . $printer . '`]`}';
        return $ret;
    }
}