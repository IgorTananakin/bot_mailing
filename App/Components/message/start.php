<?php

if ($message == '/start') {
    $db->setCmd($chatid, '');
    $resp = $local->getResponse('start.txt');
    $msg->replyHTML($resp, $btn_start);
    exit();
}

if ($message_arr[0] == '/start') {
    if ( $new_user && !empty($message_arr[1]) ) {
        $db->setRefer($chatid, $message_arr[1]);
        $msg->sendHTML($message_arr[1], $json['text']['реферал']);
        $referrals = $db->getReferrals($message_arr[1]);
        $referrals++;
        $db->setReferrals($message_arr[1], $referrals);
    }
    $db->setCmd($chatid, '');
    $resp = $local->getResponse('start.txt');
    $msg->replyHTML($resp, $btn_start);
    exit();
}