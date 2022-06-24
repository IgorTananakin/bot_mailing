<?php

$inline_lang = $bt->inlineButtons([
    [
        '🇷🇺 Русский' => 'lang/ru'
    ],
    [
        '🇺🇸 English' => 'lang/enUS'
    ],
    [
        '🇺🇿 O\'zbek' => 'lang/uz'
    ]
]);

$btn_start = $bt->keyButtons([
    [
        $json['buttons']['пригласить'] => '',
        $json['buttons']['бонус'] => '',
        $json['buttons']['lang'] => ''
    ],
    [
        $json['buttons']['сайт'] => ''
    ]
]);

$keyboard_cancel = $bt->keyButtons([
    [
        $json['buttons']['отмена'] => ''
    ]
]);