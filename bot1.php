<?php
// file_get_contents('Location: https://api.telegram.org/bot5449570464:AAE_8ED2xuDOFQl82MeLvgJ9bWhOy4i5DTw/setWebhook?url=https://itsportigor.ddns.net/testbot/bot1.php');
//file_get_contents('php://input');
$request = file_get_contents( 'https://api.telegram.org/bot5449570464:AAE_8ED2xuDOFQl82MeLvgJ9bWhOy4i5DTw/setWebhook?url=https://itsportigor.ddns.net/testbot/bot1.php' );

$request = json_decode( $request, TRUE );

if( $request )
{

// header ('Location: https://itsportigor.ddns.net/testbot/bot1.php');
//установить webhook
//https://api.telegram.org/bot5506706465:AAFdlPcvGu4EpF1RyoXQ52OF1ZaMP3Teqw0/setWebhook?url=https://itsportigor.ddns.net/testbot/bot.php

//include("https://api.telegram.org/bot5449570464:AAE_8ED2xuDOFQl82MeLvgJ9bWhOy4i5DTw/setWebhook?url=https://itsportigor.ddns.net/testbot/bot1.php");

//$data = file_get_contents('php://input');
//$data = json_decode($data, true);
//ob_start();
//print_r($data);
//$out = ob_get_clean();
//file_put_contents(__DIR__ . '/message.txt', $out, 8);


require_once (__DIR__ . '/init.php');
require_once (__DIR__ . '/App/DBManager/DBManager.php');
require_once (__DIR__ . '/App/Crypto/Crypto.php');
require_once (__DIR__ . '/App/Lang/Lang.php');
require_once (__DIR__ . '/App/Security/Security.php');
require_once (__DIR__ . '/App/Modules/Webhook/Webhook.php');
require_once (__DIR__ . '/App/Modules/Formatter/Formatter.php');
require_once (__DIR__ . '/App/Modules/Buttons/Buttons.php');
require_once (__DIR__ . '/App/Modules/Notifications/Notifications.php');
require_once (__DIR__ . '/App/Modules/Messages/Messages.php');
require_once (__DIR__ . '/App/Modules/Referrals/Referrals.php');

//телега
$tg = new Telegram($token);
//var_dump($tg);
//модуль отправки сообщений
$msg = new Messages($tg);
//var_dump($msg);
//MySQL
//$db = new PDO('mysql:host=localhost;dbname=testigor;charset=utf8', 'igorr', 'tX1nT4gX5z');
//$test = $db->query("SELECT * FROM users")->fetchAll(PDO::FETCH_ASSOC);

//var_dump($test);
$db = new MysqliDb(DB_HOST, DB_LOGIN, DB_PSWD, DB_NAME, 3306, 'utf8mb4');

$db = new DBManager($db);

//модуль одноразовой установки вебхука
$wb = new Webhook($tg);

$wb->setWebhookDynamic(__LINE__, $url);
//модуль создания кнопок
$bt = new Buttons($tg);
// var_dump($bt);
//модуль увндомлений
$notification = new Notifications($tg);

//формирование entity в html разметку
$formatter = new Formatter();
//шифорвание данных по ключу
$crypto = new Crypto();

$object = $tg->getData();
var_dump($object);
$chatid = $tg->ChatID();
$message = $tg->Text();
$name = $tg->FirstName();
$username = $tg->Username();
$message_id = $tg->MessageID();
$data = $tg->Callback_Data();
$callback_id = $tg->Callback_ID();

/*--- PHOTO ID ---*/
var_dump($object);
$photo_id = $object['message']['photo'];
$photo_id = array_pop($photo_id);
$photo_id = $photo_id['file_id'];
/*--- PHOTO ID ---*/

/*--- VIDEO ID ---*/
$video_id = $object['message']['video']['file_id'];
/*--- VIDEO ID ---*/

/*--- VIDEO NOTE ID ---*/
$video_note_id = $object['message']['video_note']['file_id'];
/*--- VIDEO NOTE ID ---*/

/*--- ANIMATION ID ---*/
$animation_id = $object['message']['animation']['file_id'];
/*--- ANIMATION ID ---*/

/*--- AUDIO ID ---*/
$audio_id = $object['message']['audio']['file_id'];
/*--- AUDIO ID ---*/

/*--- VOICE ID ---*/
$voice_id = $object['message']['voice']['file_id'];
/*--- VOICE ID ---*/

/*--- DOCUMENT ID ---*/
$document_id = $object['message']['document']['file_id'];
/*--- DOCUMENT ID ---*/

$caption = $tg->Caption();
$chat_id_response = $object['callback_query']['from']['id'];

//if ($chatid != ADMIN_ID) exit();

if (empty($entities)) {
    $entities = $object['message']['caption_entities'];
}

if (empty($username)) $username = 'NaN';


//полчение языкового выбора
try {
    $local = new Lang($db->getLang($chatid));
    $json = $local->getLang();
} catch (Exception $e) { }

//if ($chatid != ADMIN_ID) exit();

$new_user = false;
if (!$db->isUser($chatid) && stripos($chatid, '-') === false ) {
    $new_user = true;
    $db->addUser($chatid, $name);
    $db->setLang($chatid, 'ru');
}

$db->setUsername($chatid, $username);

$cmd = $db->getCmd($chatid);
if (isset($cmd)) $cmd = explode('/', $cmd);
if (isset($message)) $message_arr = explode(' ', $message);

if (empty($data)) $data = $object['callback_query']['data'];
if (!empty($data)) $data = explode('/', $data);

if ($chatid == null && empty($object['callback_query']['data'])) exit();

//includes Global Vars
require_once (__DIR__ . '/GlobalVars.php');
//подключаение компонентов

//START SYS
require_once (__DIR__ . '/App/Components/message/start.php');
require_once (__DIR__ . '/App/Components/message/Cancel.php');
require_once (__DIR__ . '/App/Components/message/Site.php');
require_once (__DIR__ . '/App/Components/message/Invited.php');
require_once (__DIR__ . '/App/Components/message/Bonus.php');
require_once (__DIR__ . '/App/Components/message/Lang.php');

//ADMIN
require_once (__DIR__ . '/App/Components/message/Admin/mailing.php');
 //file_get_contents('Location: https://api.telegram.org/bot5449570464:AAE_8ED2xuDOFQl82MeLvgJ9bWhOy4i5DTw/setWebhook?url=https://itsportigor.ddns.net/testbot/bot1.php');
}
?>