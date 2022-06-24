<?php
// //установить webhook
// //https://api.telegram.org/bot5506706465:AAFdlPcvGu4EpF1RyoXQ52OF1ZaMP3Teqw0/setWebhook?url=https://itsportigor.ddns.net/testbot/bot.php



// // //$data = file_get_contents('php://input');
// // //$data = json_decode($data, true);
// // //ob_start();
// // //print_r($data);
// // //$out = ob_get_clean();
// // //file_put_contents(__DIR__ . '/message.txt', $out, 8);


// // require_once (__DIR__ . '/init.php');
// // require_once (__DIR__ . '/App/DBManager/DBManager.php');
// // require_once (__DIR__ . '/App/Crypto/Crypto.php');
// // require_once (__DIR__ . '/App/Lang/Lang.php');
// // require_once (__DIR__ . '/App/Security/Security.php');
// // require_once (__DIR__ . '/App/Modules/Webhook/Webhook.php');
// // require_once (__DIR__ . '/App/Modules/Formatter/Formatter.php');
// // require_once (__DIR__ . '/App/Modules/Buttons/Buttons.php');
// // require_once (__DIR__ . '/App/Modules/Notifications/Notifications.php');
// // require_once (__DIR__ . '/App/Modules/Messages/Messages.php');
// // require_once (__DIR__ . '/App/Modules/Referrals/Referrals.php');

// // //телега
// // $tg = new Telegram($token);
// // //var_dump($tg);
// // //модуль отправки сообщений
// // $msg = new Messages($tg);
// // //var_dump($msg);
// // //MySQL
// // //$db = new PDO('mysql:host=localhost;dbname=testigor;charset=utf8', 'igorr', 'tX1nT4gX5z');
// // //$test = $db->query("SELECT * FROM users")->fetchAll(PDO::FETCH_ASSOC);

// // //var_dump($test);
// // $db = new MysqliDb(DB_HOST, DB_LOGIN, DB_PSWD, DB_NAME, 3306, 'utf8mb4');

// // $db = new DBManager($db);

// // //модуль одноразовой установки вебхука
// // $wb = new Webhook($tg);

// // $formatter = new Formatter();
// // //шифорвание данных по ключу
// // $chatid = $tg->ChatID();
// // $data = $tg->Callback_Data();
// // $callback_id = $tg->Callback_ID();
// // var_dump($object);
// // $photo_id = $object['message']['photo'];
// // $photo_id = array_pop($photo_id);
// // $photo_id = $photo_id['file_id'];
// // /*--- PHOTO ID ---*/
// // /*--- VOICE ID ---*/

// // /*--- DOCUMENT ID ---*/
// // $document_id = $object['message']['document']['file_id'];
// // /*--- DOCUMENT ID ---*/

// // $caption = $tg->Caption();
// // $chat_id_response = $object['callback_query']['from']['id'];

// // //if ($chatid != ADMIN_ID) exit();

// // if (empty($entities)) {
// //     $entities = $object['message']['caption_entities'];
// // }

// // if (empty($username)) $username = 'NaN';


// // //полчение языкового выбора
// // try {
// //     $local = new Lang($db->getLang($chatid));
// //     $json = $local->getLang();
// // } catch (Exception $e) { }

// // //if ($chatid != ADMIN_ID) exit();

// // $new_user = false;
// // if (!$db->isUser($chatid) && stripos($chatid, '-') === false ) {
// //     $new_user = true;
// //     $db->addUser($chatid, $name);
// //     $db->setLang($chatid, 'ru');
// // }

// // $db->setUsername($chatid, $username);

// // $cmd = $db->getCmd($chatid);
// // if (isset($cmd)) $cmd = explode('/', $cmd);
// // if (isset($message)) $message_arr = explode(' ', $message);

// // if (empty($data)) $data = $object['callback_query']['data'];
// // if (!empty($data)) $data = explode('/', $data);

// // if ($chatid == null && empty($object['callback_query']['data'])) exit();

// // //includes Global Vars
// // require_once (__DIR__ . '/GlobalVars.php');
// // //подключаение компонентов

// // //START SYS
// // require_once (__DIR__ . '/App/Components/message/start.php');
// // require_once (__DIR__ . '/App/Components/message/Cancel.php');
// // require_once (__DIR__ . '/App/Components/message/Site.php');
// // require_once (__DIR__ . '/App/Components/message/Invited.php');
// // require_once (__DIR__ . '/App/Components/message/Bonus.php');
// // require_once (__DIR__ . '/App/Components/message/Lang.php');

// // //ADMIN
// // require_once (__DIR__ . '/App/Components/message/Admin/mailing.php');
// ?>
// <?php
// /**
// *   Very simple chat bot @verysimple_bot by Novelsite.ru
// *   05.07.2021
// */
// header('Content-Type: text/html; charset=utf-8'); // на всякий случай досообщим PHP, что все в кодировке UTF-8

// $site_dir = dirname(dirname(__FILE__)).'/'; // корень сайта
// $bot_token = '5506706465:AAFdlPcvGu4EpF1RyoXQ52OF1ZaMP3Teqw0'; // токен вашего бота
// $data = file_get_contents('php://input'); // весь ввод перенаправляем в $data
// $data = json_decode($data, true); // декодируем json-закодированные-текстовые данные в PHP-массив

// $order_chat_id = '123456789';  //chat_id менеджера компании для заявок
// $bot_state = ''; // состояние бота, по-умолчанию пустое

// // Для отладки, добавим запись полученных декодированных данных в файл message.txt, 
// // который можно смотреть и понимать, что происходит при запросе к боту
// // Позже, когда все будет работать закомментируйте эту строку:
// file_put_contents(__DIR__ . '/message.txt', print_r($data, true));

// // Основной код: получаем сообщение, что юзер отправил боту и 
// // заполняем переменные для дальнейшего использования
// if (!empty($data['message']['text'])) {
//     $chat_id = $data['message']['from']['id'];
//     $user_name = $data['message']['from']['username'];
//     $first_name = $data['message']['from']['first_name'];
//     $last_name = $data['message']['from']['last_name'];
//     $text = trim($data['message']['text']);
//     $text_array = explode(" ", $text);

// 	// получим текущее состояние бота, если оно есть
// 	$bot_state = get_bot_state ($chat_id);

//     // если текущее состояние бота отправка заявки, то отправим заявку менеджеру компании на $order_chat_id
//     if (substr($bot_state, 0, 6) == '/order') {
//         $text_return = "
// Заявка от @$user_name:
// Имя: $first_name $last_name 
// $text
// ";
//         message_to_telegram($bot_token, $order_chat_id, $text_return);
//         set_bot_state ($chat_id, ''); // не забудем почистить состояние на пустоту, после отправки заявки
//     }
//     // если состояние бота пустое -- то обычные запросы
//     else {
    
//     	// вывод информации Помощь
//         if ($text == '/help') {
//             $text_return = "Привет, $first_name $last_name, вот команды, что я понимаю: 
//     /help - список команд
//     /about - о нас
//     /order - оставить заявку
//     ";
//             message_to_telegram($bot_token, $chat_id, $text_return);
//             set_bot_state ($chat_id, '/help');
//         }
        
//         // вывод информации о нас
//         elseif ($text == '/about') {
//             $text_return = "verysimple_bot:
//     Я пример самого простого бота для телеграм, написанного на простом PHP.
//     Мой код можно скачивать, дополнять, исправлять. Код доступен в этой статье:
//     https://www.novelsite.ru/kak-sozdat-prostogo-bota-dlya-telegram-na-php.html
//     ";
//             message_to_telegram($bot_token, $chat_id, $text_return);
//             set_bot_state ($chat_id, '/about');
//         }
        
//         // переход в режим Заявки
//         elseif ($text == '/order') {
//             $text_return = "$first_name $last_name, для подтверждения Заявки введите текст вашей заявки и нажмите отправить. 
// Наши специалисты свяжутся с вами в ближайшее время!
// ";
//             message_to_telegram($bot_token, $chat_id, $text_return);
//             set_bot_state ($chat_id, '/order');
//         }
// 	}
// }

// // функция отправки сообщения от бота в диалог с юзером
// function message_to_telegram($bot_token, $chat_id, $text, $reply_markup = '')
// {
//     $ch = curl_init();
//     $ch_post = [
//         CURLOPT_URL => 'https://api.telegram.org/bot' . $bot_token . '/sendMessage',
//         CURLOPT_POST => TRUE,
//         CURLOPT_RETURNTRANSFER => TRUE,
//         CURLOPT_TIMEOUT => 10,
//         CURLOPT_POSTFIELDS => [
//             'chat_id' => $chat_id,
//             'parse_mode' => 'HTML',
//             'text' => $text,
//             'reply_markup' => $reply_markup,
//         ]
//     ];

//     curl_setopt_array($ch, $ch_post);
//     curl_exec($ch);
// }

// // сохранить состояние бота для пользователя
// function set_bot_state ($chat_id, $data)
// {
//     file_put_contents(__DIR__ . '/users/'.$chat_id.'.txt', $data);
// }

// // получить текущее состояние бота для пользователя
// function get_bot_state ($chat_id)
// {
//     if (file_exists(__DIR__ . '/users/'.$chat_id.'.txt')) {
//         $data = file_get_contents(__DIR__ . '/users/'.$chat_id.'.txt');
//         return $data;
//     }
//     else {
//         return '';
//     }
// }
?>