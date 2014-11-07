<?php

/*
[ param ]
text
username
icon_url 
icon_emoji 
channel 
*/

class Qiita {

	public static function getNews() {
		$ret = '';
		$url = 'https://qiita.com/api/v1/items';
		$resp = file_get_contents($url);
		$data = json_decode($resp);
		foreach($data as $obj) {
			$ret .= $obj->url . "\n";
		}

		return $ret;
	}
}


$resp_text = Qiita::getNews();
// check
// if (strlen($resp_text) < 1) {
if (!isset($resp_text{1})) {
	$resp_text = 'none!';	
}

// outputする
header('Content-Type: application/json');
echo json_encode(array(
	"text" => $resp_text,
));


