<?php

if ($message == $json['buttons']['пригласить'] && $cmd[0] == '') {
    $resp = $local->getResponse('invite.txt');

    $refer = $db->getRefer($chatid);
    $name = $db->getName($refer);

    if (empty($refer)) {
        $invited = $json['text']['пришли сами'];
    } else {
        $invited = $json['text']['пригласил'] . "<a href='tg://user?id=$refer'>$name</a>";
    }

    $referral_url = "https://t.me/" . BOT_URL . '?start=';
    $resp = str_replace('{ref_link}', $referral_url . $chatid, $resp);
    $resp = str_replace('{referrals}', $db->getReferrals($chatid), $resp);
    $resp = str_replace('{invited}', $invited, $resp);

    $btns = $bt->inlineButtons([
        [
            $json['inline']['пригласить'] => 'https://t.me/share/url?url=' . $referral_url . $chatid . '&text=Зацени'
        ]
    ]);
    $msg->replyHTML($resp, $btns);
    exit();
}

