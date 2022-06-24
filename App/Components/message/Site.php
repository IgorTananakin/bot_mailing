<?php

if ($message == $json['buttons']['сайт'] && $cmd[0] == '') {
    $resp = $local->getResponse('site.txt');
    $btns = $bt->inlineButtons([
        [
            $json['inline']['сайт'] => SITE
        ]
    ]);
    $msg->replyHTML($resp, $btns);
    exit();
}
