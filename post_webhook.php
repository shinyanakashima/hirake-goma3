<?php
$incomingUrl =  'https://hooks.slack.com/services/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';
$payload = array(
        'text' => '投稿テスト<http://siva/project/nss/pukiwiki/index.php?%E5%8B%A4%E6%80%A0%E3%81%AB%E3%81%A4%E3%81%84%E3%81%A6|勤怠について>',
        'username' => 's_nakashima',
        'icon_url' => 'https://slack-assets2.s3-us-west-2.amazonaws.com/5504/img/emoji/1f40b.png',
//      'icon_emoji' => ':beginner:',
        'channel' => '#random',
);


function slackIncomingWebhook($url, $payload) {
        $params = array('payload' => json_encode($payload));
        return postRequest($url, $params);
}

function postRequest($url, $params) {
        $headers = array();
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);

// slackは自己証明書ではないのでコメントアウトしておく。
//    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
//    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        $ret = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);
        if ($error) {
                throw new Exception("API呼出に失敗しました。" . $error);
        }

        return $ret;
}

$ret = slackIncomingWebhook($incomingUrl, $payload);

