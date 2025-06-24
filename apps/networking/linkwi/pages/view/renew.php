<?php
$db = new dbase;
$db->query("SELECT * FROM Users WHERE UniqueID = '$UniqueID'");
$thisUserInfo = $db->fetchSingle();
$db->closeConnection();

$order_id = "LW" . strtoupper(bin2hex(random_bytes(5)));
$invoice_no = date("Ymd") . rand(111111, 999999);

$curl =
	curl_init('https://tt.wipayfinancial.com/plugins/payments/request');
curl_setopt_array($curl, [
	CURLOPT_FOLLOWLOCATION => false,
	CURLOPT_HEADER => false,
	CURLOPT_HTTPHEADER => [
		'Accept: application/json',
		'Content-Type: application/x-www-form-urlencoded'
	],
	CURLOPT_POST => true,
	CURLOPT_POSTFIELDS => http_build_query([
		'account_number' => '5845179505',
		'avs' => '0',
		'country_code' => 'TT',
		'currency' => 'TTD',
		'data' => '{"b_firstname":"' . $thisUserInfo['FirstName'] . '","b_lastname":"' . $thisUserInfo['FirstName'] . '","b_street":"' . $thisUserInfo['Address'] . '","b_town":"' . $thisUserInfo['City'] . '","b_country":"Trinidad & Tobago","b_contact":"' . $thisUserInfo['Contact'] . '","b_email":"' . $thisUserInfo['Email'] . '"}',
		'environment' => 'live',
		'fee_structure' => 'merchant_absorb',
		'method' => 'credit_card',
		'order_id' => $order_id,
		'origin' => 'LinkWi_App',
		'response_url' => 'https://linkwi.co/wipay-renew/go/',
		'total' => '100.00'
	]),
	CURLOPT_RETURNTRANSFER => true
]);
$result = curl_exec($curl);
curl_close($curl);
# result in JSON format (header)
$result = json_decode($result);
# perform redirect
header("Location: {$result->url}");
die();