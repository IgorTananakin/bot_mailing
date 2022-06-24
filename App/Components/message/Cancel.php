<?php

if ($message == $json['buttons']['отмена']) {
    $db->setCmd($chatid, '');
    $msg->replyHTML($json['text']['отменено'], $btn_start);
    exit();
}
