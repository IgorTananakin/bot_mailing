<?php

if ($data[0] == 'cancel') {
    $db->setCmd($chatid, '');
    $msg->delete();
    $response = $local->getResponse('start.txt');
    $msg->delete();
    $msg->replyHTML($response, $btn_start);
    exit();
}