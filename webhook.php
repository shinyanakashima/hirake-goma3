<?php

/*
（厳密にはpayloadというパラメータに対して下記パラメータ郡をjson形式で送信します。）

パラメータ名    概要
text    メッセージ（必須）
username        投稿者（サービス）名
icon_url        投稿者名のアイコン画像のURL
icon_emoji      投稿者名のアイコン
channel 「#」または「@」から始まるChannel名
*/

function getQiita() {
        $ret = "";
        $url = 'https://qiita.com/api/v1/items';
        $resp = file_get_contents($url);
        $data = json_decode($resp);
        foreach($data as $obj) {
                $ret .= $obj->url . "\n";
        }
        return $ret;
}

header('Content-Type: application/json');

$ret = getQiita();
echo json_encode(array(
	"text" => $ret
));


