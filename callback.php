<?php

use function PHPSTORM_META\type;

$accessToken = 'FyIepKRW8Fk4NMIyb/uSrzHqEoRI9E9/SB/Rzq/v2L8Ipex6AgUNGJHY6IGB0ikH7tMnXv+3MfaW7GgHxXQn9vFn0w1i9+2HZJlgN3bblAjBhFs10sGlJLRRzs1kheXn60kgEzJyoPU5PySX0TOf3AdB04t89/1O/w1cDnyilFU='; 
$jsonString = file_get_contents('php://input'); error_log($jsonString); 
$jsonObj = json_decode($jsonString); 
$message = $jsonObj->{"events"}[0]->{"message"};
$userid = $jsonObj->{"events"}[0]->{"source"}->{"userId"};
$replyToken = $jsonObj->{"events"}[0]->{"replyToken"};

error_log($userid);
 // 送られてきたメッセージの中身からレスポンスのタイプを選択 
if ($message->{"text"} == '確認') {
     // 確認ダイアログタイプ 
    $messageData = [ 
        'type' => 'template', 
        'altText' => '確認ダイアログ', 
        'template' => [ 'type' => 'confirm', 'text' => '元気ですかー？', 
            'actions' => [
                [ 'type' => 'message', 'label' => '元気です', 'text' => '元気です' ],
                [ 'type' => 'message', 'label' => 'まあまあです', 'text' => 'まあまあです' ], 
            ] 
        ]
 ]; 
} elseif ($message->{"text"} == 'ボタン') { 
    // ボタンタイプ 
    $messageData = [ 
        'type' => 'template',
         'altText' => 'ボタン', 
        'template' => [
             'type' => 'buttons',
             'title' => 'タイトルです',
             'text' => '選択してね', 
            'actions' => [
                 [ 
                    'type' => 'postback', 
                    'label' => 'webhookにpost送信', 
                    'data' => 'value' 
                ],
                 [
                     'type' => 'uri',
                     'label' => 'googleへ移動', 
                     'uri' => 'https://google.com' 
                 ]
              ]
          ] 
     ]; 
} elseif ($message->{"text"} == 'アンケート回答') {
    $messageData = array (
        'type' => 'text',
        'text' => '現在の妊娠月齢を教えてください',
        'quickReply' => 
        array (
          'items' => 
          array (
            0 => 
            array (
              'type' => 'action',
              'action' => 
              array (
                'type' => 'message',
                'label' => '1ヶ月',
                'text' => '妊娠月齢1カ月です',
              ),
            ),
            1 => 
            array (
              'type' => 'action',
              'action' => 
              array (
                'type' => 'message',
                'label' => '2カ月',
                'text' => '妊娠月齢2カ月です',
              ),
            ),
            2 => 
            array (
              'type' => 'action',
              'action' => 
              array (
                'type' => 'message',
                'label' => '3カ月',
                'text' => '妊娠月齢3カ月です',
              ),
            ),
            3 => 
            array (
              'type' => 'action',
              'action' => 
              array (
                'type' => 'message',
                'label' => '4カ月',
                'text' => '妊娠月齢4カ月です',
              ),
            ),
          ),
        ),
    );

     // カルーセルタイプ 
    // $messageData = [ 'type' => 'text', 'text' => "https://volare.slack.com/archives/DKJJ24Q22/p1611902930000600"."ユーザーIDのトークンをパラメタにつけてURLを作成→  ".$userid ];
 } else {
     // それ以外は送られてきたテキストをオウム返し
     $messageData = [ 'type' => 'text', 'text' => $message->{"text"} ]; 
} 
$response = [ 'replyToken' => $replyToken, 'messages' => [$messageData] ]; 
error_log(json_encode($response)); 
$ch = curl_init('https://api.line.me/v2/bot/message/reply'); 
curl_setopt($ch, CURLOPT_POST, true); 
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST'); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($response)); 
curl_setopt($ch, CURLOPT_HTTPHEADER, array( 'Content-Type: application/json; charser=UTF-8', 'Authorization: Bearer ' . $accessToken )); 
$result = curl_exec($ch); error_log($result); 
curl_close($ch);