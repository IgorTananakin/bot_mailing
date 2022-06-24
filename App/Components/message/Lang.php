<?php

if ($message == $json['buttons']['lang'] && $cmd[0] == '') {
    $lang = $db->getLang($chatid);
    if ($lang == 'ru' || $lang == '') {
        $lang = 'uz';
        $db->setLang($chatid, 'uz');
    } else if ($lang == 'uz') {
        $lang = 'ru';
        $db->setLang($chatid, 'ru');
    }
    //полчение языкового выбора
    try {
        $local = new Lang($lang);
        $json = $local->getLang();
    } catch (Exception $e) { }

    require __DIR__ . '/../../../GlobalVars.php';

    $msg->replyHTML($json['text']['lang'], $btn_start);

    exit();
}
