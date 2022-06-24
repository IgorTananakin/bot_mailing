<?php

set_time_limit(0);

if ($message == '/mailing' && $chatid == ADMIN_ID) {
    $btn_geo = $bt->inlineButtons([
        [
            'RU' => 'mailing_lang/ru',
            'UZ' => 'mailing_lang/uz'
        ],
        [
            'Всем' => 'mailing_lang/all'
        ]
    ]);
    $msg->replyHTML('По какоме гео рассылать', $btn_geo);
    $msg->replyHTML('Для отмены жми отмена', $keyboard_cancel);
    $db->setCmd($chatid, 'mailing_lang');
    exit();
}

if ($cmd[0] == 'mailing_lang') {
    $db->setCmd($chatid, 'mailing_text/' . $data[1]);
    $btn_geo = $bt->inlineButtons([
        [
            'RU' => 'mailing_lang/ru',
            'UZ' => 'mailing_lang/uz'
        ],
        [
            'Всем' => 'mailing_lang/all'
        ]
    ]);
    $msg->delete();
    $msg->replyHTML('Введите текст рассылки');
    exit();
}

if ($cmd[0] == 'mailing_text') {

    $msg->delete();
    $msg->replyHTML('Рассылка началась!', $btn_start);
    $db->setCmd($chatid, '');

    if ($cmd[1] == 'all') {
        $users = $db->getAllUsers();
    } else if ($cmd[1] == 'ru') {
        $users = $db->getAllUsersByLang('ru');
    } else if ($cmd[1] == 'uz') {
        $users = $db->getAllUsersByLang('uz');
    }

    if (empty($message)) {
        $message = $caption;
    }

    $message = $formatter::formatHTMLText($entities, $message);

    $counter = 0;

    $text = $message;

    //Определяем тип и получаем файл id
    if ( !empty($photo_id) ) {
        $attach = 'image::' . $photo_id;
    } else if ( !empty($video_id) ) {
        $attach = 'video::' . $video_id;
    } else if ( !empty($animation_id) ) {
        $attach = 'animation::' . $animation_id;
    } else if ( !empty($video_note_id) ) {
        $attach = 'video_note::' . $video_note_id;
    } else if ( !empty($audio_id) ) {
        $attach = 'audio::' . $audio_id;
    } else if ( !empty($voice_id) ) {
        $attach = 'voice::' . $voice_id;
    } else if ( !empty($document_id) ) {
        $attach = 'document::' . $document_id;
    } else {
        $attach = 'text';
    }

    $attach = explode('::', $attach);

//    $msg->sendHTML(ADMIN_ID, "{$attach[0]} - {$attach[1]}");

    foreach ($users as $user) {
        $chatid = $user['user_id'];
        //определяем какой тип рассылать
        if ($attach[0] == 'image') {
            $content = array('chat_id' => $chatid, 'caption' => $text, 'photo' => $attach[1], 'parse_mode' => 'HTML');
            $id = $tg->sendPhoto($content)['result']['message_id'];

        } else if ($attach[0] == 'video') {
            $content = array('chat_id' => $chatid, 'caption' => $text, 'video' => $attach[1], 'parse_mode' => 'HTML');
            $id = $tg->sendVideo($content)['result']['message_id'];

        } else if ($attach[0] == 'animation') {
            $content = array('chat_id' => $chatid, 'caption' => $text, 'animation' => $attach[1], 'parse_mode' => 'HTML');
            $id = $tg->sendAnimation($content)['result']['message_id'];

        } else if ($attach[0] == 'video_note') {
            $content = array('chat_id' => $chatid, 'video_note' => $attach[1], 'parse_mode' => 'HTML');
            $id = $tg->sendVideoNote($content)['result']['message_id'];

        } else if ($attach[0] == 'audio') {
            $content = array('chat_id' => $chatid, 'caption' => $text, 'audio' => $attach[1], 'parse_mode' => 'HTML');
            $id = $tg->sendAudio($content)['result']['message_id'];

        } else if ($attach[0] == 'voice') {
            $content = array('chat_id' => $chatid, 'voice' => $attach[1], 'parse_mode' => 'HTML');
            $id = $tg->sendVoice($content)['result']['message_id'];

        } else if ($attach[0] == 'document') {
            $content = array('chat_id' => $chatid, 'caption' => $text, 'document' => $attach[1], 'parse_mode' => 'HTML');
            $id = $tg->sendDocument($content)['result']['message_id'];
        } else if ($attach[0] == 'text') {
            $content = array('chat_id' => $chatid, 'text' => $text, 'parse_mode' => 'HTML');
            $id = $tg->sendMessage($content)['result']['message_id'];
        }

        if ($counter == 30) {
            sleep(1);
            $counter = 0;
        }
        $counter++;
    }

    exit();
}
