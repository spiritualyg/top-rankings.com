<?php

ini_set('display_errors', 'On');
$host = "mysql305.ixwebhosting.com"; //database location
$user = "saqib78_admin"; //database username
$pass = "ABC123"; //database password
$db_name = "saqib78_user_locations_online"; //database name

$link = mysql_connect($host, $user, $pass);
mysql_select_db($db_name);

if (!$link)
{
  echo "Please try later.";
}
else
{
mysql_select_db($db_name);
}

function buildBaseString($baseURI, $method, $params) {
	$r = array();
	ksort($params);
	foreach($params as $key=>$value){
		$r[] = "$key=" . rawurlencode($value);
	}
	return $method."&" . rawurlencode($baseURI) . '&' . rawurlencode(implode('&', $r));
}

function buildAuthorizationHeader($oauth) {
	$r = 'Authorization: OAuth ';
	$values = array();
	foreach($oauth as $key=>$value)
		$values[] = "$key=\"" . rawurlencode($value) . "\"";
	$r .= implode(', ', $values);
	return $r;
}

function json_decode_nice($json, $assoc = FALSE){ 
    $json = str_replace(array("\n","\r"),"",$json); 
    $json = preg_replace('/([{,]+)(\s*)([^"]+?)\s*:/','$1"$3":',$json);
    $json = preg_replace('/(,)\s*}$/','}',$json);
    return json_decode($json,$assoc); 
}

function update_by_api(){
	$url = "https://api.twitter.com/1.1/trends/place.json";
	$oauth_access_token ="380000894-3RFFWXO37ZVgLxRtqD53zxI5wD6oA6rL6u5ZYY5L";
	$oauth_access_token_secret = "2thlTlkAXKUzC898dlFkJDXSdlylO9AHjldzhNft0";
	$consumer_key = "uhtHgO0xcmmRMclI039g";
	$consumer_secret = "WlvS0wez73u1jqNu5CsHl8HOqNZQoqoh0IiRX9hxXs";
	$oauth = array( 'oauth_consumer_key' => $consumer_key,
		'id' => 1,
		'oauth_nonce' => time(),
		'oauth_signature_method' => 'HMAC-SHA1',
		'oauth_token' => $oauth_access_token,
		'oauth_timestamp' => time(),
		'oauth_version' => '1.0');

	$base_info = buildBaseString($url, 'GET', $oauth);
	$composite_key = rawurlencode($consumer_secret) . '&' . rawurlencode(								$oauth_access_token_secret);
	$oauth_signature = base64_encode(hash_hmac('sha1', $base_info, 		$composite_key, true));
	$oauth['oauth_signature'] = $oauth_signature;

	// Make Requests
	$header = array(buildAuthorizationHeader($oauth), 'Expect:');
	$options = array( CURLOPT_HTTPHEADER => $header,
		//CURLOPT_POSTFIELDS => $postfields,
		CURLOPT_HEADER => false,
		CURLOPT_URL => $url . '?id=1',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_SSL_VERIFYPEER => false);

	$feed = curl_init();
	curl_setopt_array($feed, $options);
	$json = curl_exec($feed);
	$json_decoded =json_decode($json,true);

	$data = $json_decoded[0]['trends']; 
	$res = "";
	foreach ($data as $item) { 
   		$res = $res . "<br /> <a href=\"".$item['url'].
		"\"target=\"_blank\">".$item['name'].
		"</a>\r\n<br /> \r\n";
	}
	curl_close($feed);
	$res = base64_encode($res);
	$query = "UPDATE  `cache` SET  
	`htmlContent` =  '".$res."', `updateTime` =  '".time()."'
	WHERE name = 'twitter'";
	$resultOfQuery = mysql_query($query);
	if($resultOfQuery)
		return base64_decode($res);
	else
		return "update error:" . $query;
}

function update_by_cache(){
	$resultOfQuery = mysql_query("SELECT * FROM cache WHERE name='twitter‘");
	$rowItemsInDB = mysql_fetch_array($resultOfQuery);
	return	base64_decode($rowItemsInDB[1]);
}

function getContent(){
	$resultOfQuery = mysql_query("SELECT * FROM cache WHERE name='twitter'");
	$rowItemsInDB = mysql_fetch_array($resultOfQuery);

	if (time()-$rowItemsInDB[2]> 60)
		return update_by_api();
	else
		return base64_decode($rowItemsInDB[1]);
}

echo getContent();

?>
