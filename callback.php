<?php

use function PHPSTORM_META\type;

$accessToken = 'FyIepKRW8Fk4NMIyb/uSrzHqEoRI9E9/SB/Rzq/v2L8Ipex6AgUNGJHY6IGB0ikH7tMnXv+3MfaW7GgHxXQn9vFn0w1i9+2HZJlgN3bblAjBhFs10sGlJLRRzs1kheXn60kgEzJyoPU5PySX0TOf3AdB04t89/1O/w1cDnyilFU='; 
$jsonString = file_get_contents('php://input'); error_log($jsonString); 
$jsonObj = json_decode($jsonString); 
$message = $jsonObj->{"events"}[0]->{"message"};
$userid = $jsonObj->{"events"}[0]->{"source"}->{"userId"};
$replyToken = $jsonObj->{"events"}[0]->{"replyToken"};
$event_type = $jsonObj->{"events"}[0]->{"type"};

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
} elseif ($message->{"text"} == 'アンケート回答' || $event_type = "follow") {
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
                'label' => '1~3カ月',
                'text' => '妊娠月齢1カ月です',
              ),
            ),
            1 => 
            array (
              'type' => 'action',
              'action' => 
              array (
                'type' => 'message',
                'label' => '4~6カ月',
                'text' => '妊娠月齢1カ月です',
              ),
            ),
            2 => 
            array (
              'type' => 'action',
              'action' => 
              array (
                'type' => 'message',
                'label' => '6~9カ月',
                'text' => '妊娠月齢1カ月です',
              ),
            ),
            3 => 
            array (
              'type' => 'action',
              'action' => 
              array (
                'type' => 'message',
                'label' => '10~12カ月',
                'text' => '妊娠月齢1カ月です',
              ),
            ),
            4 => 
            array (
              'type' => 'action',
              'action' => 
              array (
                'type' => 'message',
                'label' => '13~15カ月',
                'text' => '妊娠月齢1カ月です',
              ),
            ),
          ),
        ),
    );

     // カルーセルタイプ 
    // $messageData = [ 'type' => 'text', 'text' => "https://volare.slack.com/archives/DKJJ24Q22/p1611902930000600"."ユーザーIDのトークンをパラメタにつけてURLを作成→  ".$userid ];
 } elseif ($message->{"text"} == '妊娠月齢1カ月です') {
    $messageData = array (
        'type' => 'text',
        'text' => '目の特徴を以下からお選びください',
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
                'label' => 'ぱっちり二重',
                'text' => 'ぱっちり二重を選択',
              ),
            ),
            1 => 
            array (
              'type' => 'action',
              'action' => 
              array (
                'type' => 'message',
                'label' => 'キレなが一重',
                'text' => 'ぱっちり二重を選択',
              ),
            ),
            2 => 
            array (
              'type' => 'action',
              'action' => 
              array (
                'type' => 'message',
                'label' => 'つぶら瞳',
                'text' => 'ぱっちり二重を選択',
              ),
            ),
          ),
        ),
    );

 } elseif ($message->{"text"} == 'ぱっちり二重を選択') {
    $messageData = array (
        'type' => 'text',
        'text' => '鼻の特徴を以下からお選びください',
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
                'label' => '小鼻が大きめの鼻',
                'text' => '小鼻が大きめの鼻',
              ),
            ),
            1 => 
            array (
              'type' => 'action',
              'action' => 
              array (
                'type' => 'message',
                'label' => '小鼻が小さめの鼻',
                'text' => '小鼻が大きめの鼻',
              ),
            ),
            2 => 
            array (
              'type' => 'action',
              'action' => 
              array (
                'type' => 'message',
                'label' => '低くて可愛い鼻',
                'text' => '小鼻が大きめの鼻',
              ),
            ),
          ),
        ),
    );

 } elseif ($message->{"text"} == '小鼻が大きめの鼻') {
    $messageData = array (
        'type' => 'text',
        'text' => 'その他当てはまるものを以下から一つお選びください',
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
                'label' => 'クリクリ天然パーマ（髪型）',
                'text' => 'クリクリ天然パーマ（髪型）',
              ),
            ),
            1 => 
            array (
              'type' => 'action',
              'action' => 
              array (
                'type' => 'message',
                'label' => 'ふわふわ毛量多め（髪型）',
                'text' => 'クリクリ天然パーマ（髪型）',
              ),
            ),
            2 => 
            array (
              'type' => 'action',
              'action' => 
              array (
                'type' => 'message',
                'label' => 'しっかり太眉（眉）',
                'text' => 'クリクリ天然パーマ（髪型）',
              ),
            ),
            3 => 
            array (
              'type' => 'action',
              'action' => 
              array (
                'type' => 'message',
                'label' => '上がり眉（眉）',
                'text' => 'クリクリ天然パーマ（髪型）',
              ),
            ),
          ),
        ),
    );

 } elseif ($message->{"text"} == 'クリクリ天然パーマ（髪型）') {
    $messageData = array (
        'type' => 'text',
        'text' => '洋服のカラーを以下からお選びください',
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
                'label' => 'ブルー系',
                'text' => 'ブルー系',
              ),
            ),
            1 => 
            array (
              'type' => 'action',
              'action' => 
              array (
                'type' => 'message',
                'label' => 'ピンク系',
                'text' => 'ブルー系',
              ),
            ),
            2 => 
            array (
              'type' => 'action',
              'action' => 
              array (
                'type' => 'message',
                'label' => 'グリーン系',
                'text' => 'ブルー系',
              ),
            ),
            3 => 
            array (
              'type' => 'action',
              'action' => 
              array (
                'type' => 'message',
                'label' => 'オレンジ系',
                'text' => 'ブルー系',
              ),
            ),
            4 => 
            array (
              'type' => 'action',
              'action' => 
              array (
                'type' => 'message',
                'label' => 'ホワイト系',
                'text' => 'ブルー系',
              ),
            ),

          ),
        ),
    );

 } elseif ($message->{"text"} == 'ブルー系'){
    $messageData = [ 'type' => 'text', 'text' => "これで質問は以上だよ！君だけの赤ちゃんが送られてくるよ" ]; 
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