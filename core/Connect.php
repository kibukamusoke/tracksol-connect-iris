<?php
/**
 * IDE: PhpStorm.
 * Created by: Trevor
 * Date: 10/21/18
 * Time: 1:33 PM
 */

use Parse\ParseObject;
use Parse\ParseQuery;
use Parse\ParseACL;
use Parse\ParsePush;
use Parse\ParseUser;
use Parse\ParseInstallation;
use Parse\ParseException;
use Parse\ParseAnalytics;
use Parse\ParseFile;
use Parse\ParseCloud;
use Parse\ParseClient;
use Parse\ParsePushStatus;
use Parse\ParseServerInfo;
use Parse\ParseLogs;
use Parse\ParseAudience;

class Connect
{
    private $__DB, $__GB, $__Sec;
    private $cards_class;

    public function __construct($__DB, $__GB, $__Sec)
    {
        $this->__DB = $__DB;
        $this->__GB = $__GB;
        $this->__Sec = $__Sec;

        $this->cards_class = 'TerminalCard';
    }

    public function upsertConnectCard($data)
    {
        if(!isset($data['card_no']) || empty($data['card_no'])){
            return array('success' => false, 'message' => 'No Card Number');
        }
        // check the connect system and upsert if necessary
        $connectQuery = new ParseQuery($this->cards_class);
        $connectQuery->equalTo("cardNo", $data['card_no']);
        $connectQuery->limit(1);
        $cardObject = $connectQuery->first();

        if (!$cardObject) { // new card
            $cardObject = new ParseObject($this->cards_class);
        }

        if (isset($data['card_no']))
            $cardObject->set("cardNo", $data['card_no']);
        if (isset($data['staff_name']))
            $cardObject->set('name', $data['staff_name']);
        if (isset($data['role']))
            $cardObject->set('type', (int)($data['role'] == 2 ? 0 : 1));
        $cardObject->set('status', (int)(isset($data['status']) ? $data['status'] : 0));
        try {
            $cardObject->save();
            return array('success' => true, 'message' => 'Card Stored Successfully.');
        } catch (ParseException $ex) {
            return array('success' => false, 'message' => $ex);
        }
    }


}