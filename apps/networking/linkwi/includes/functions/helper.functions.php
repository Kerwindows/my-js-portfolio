<?php
/**
* Class and Function List:
* Function list:
* - force_https()
* - base_url_dir()
* - base_url()
* - redirect()
* - check_Input()
* - check_Names()
* - check_Email()
* - check_uploads()
* - clean()
* - sanitize()
* - val_email()
* - val_int()
* - sanitize_upload_file()
* - sanitize_upload_filename()
* - hash_pwd()
* - getSlug()
* - date_time()
* - set_date_time()
* Classes list:
*/
if (!defined('PROJECT_PATH')) {
	header("Location: ../../../../we-see-you.php");
	exit();
}

// Require https
function force_https() {
	if (($_SERVER['HTTPS'] != 'on')) {
		$url = "https://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
		header("Location: $url");
		exit;
	}
}
force_https();

function base_url_dir() {
	$url = "https://" . $_SERVER["HTTP_HOST"] . dirname($_SERVER["PHP_SELF"]) . "";
	return $url;
}
function base_url() {
	$url = "https://" . $_SERVER["HTTP_HOST"] . "/apps/networking";
	return $url;
}

//function to redirect
function redirect($url) {
	return header("Location: {$url}");
	exit();
}

function check_Input($data) {
	$data = str_replace(array(
		'\'',
		"\"",
		"<"
	) , array(
		"&#39;",
		"&quot;",
		""
	) , $data);
	$data = trim($data);
	$data = stripslashes($data);
	//$data = htmlspecialchars($data);
	return $data;
}

function check_Names($data) {

	$data = str_replace(array(
		'\'',
		"\"",
		"<"
	) , array(
		"&#39;",
		"&quot;",
		""
	) , $data);
	$data = trim($data); //remove the white spaces and other predefined characters
	$data = stripslashes($data);
	$data = ucfirst(strtolower($data));

	return $data;
}

function check_Email($email) {
	filter_var($email, FILTER_VALIDATE_EMAIL);
	return $email;
}

function check_uploads($uploads) {
	$uploads = str_replace(' ', '', $uploads);
	return $uploads;
}

//function to trim values
function clean($value) {

	return trim($value);
}

//function to sanitize strings
function sanitize($raw_value) {

	return filter_var($raw_value, FILTER_SANITIZE_SPECIAL_CHARS);
}

//function to validate email
function val_email($raw_email) {

	return filter_var($raw_email, FILTER_VALIDATE_EMAIL);
}
//function to validate int
function val_int() {

	return filter_var($raw_int, FILTER_VALIDATE_INT);
}
//sanitize uploads
function sanitize_upload_file($data) {
	$imgName = $data;
	$indexOFF = strrpos($imgName, '.');
	$nameFile = substr($imgName, 0, $indexOFF);
	$extension = substr($imgName, $indexOFF);
	$clean = preg_replace("([^\w\s\d\-_~,;\[\]\(\)])", "", $nameFile);
	$NAMEFILE = str_replace(' ', '', $clean) . $extension;
	return $NAMEFILE;
}
function sanitize_upload_filename($data) {
	$uploadOk = 1;
	$imgName = $data;
	$indexOFF = strrpos($imgName, '.');
	$nameFile = substr($imgName, 0, $indexOFF);
	$extension = substr($imgName, $indexOFF);
	$clean = preg_replace("([^\w\s\d\-_~,;\[\]\(\)])", "", $nameFile);
	$NAMEFILE = str_replace(' ', '', $clean) . "-" . rand(100, 9999) . $extension;
	return $NAMEFILE;
}

//function to hash passwords
function hash_pwd($raw_password) {

	return md5($raw_password);
}

function getSlug()
{
	$url = $_SERVER["REQUEST_URI"];

	// Extract the query part of the URL
	$query = parse_url($url, PHP_URL_QUERY);

	// If no query part, return empty string
	if (!$query) {
		return '';
	}

	// Parse the query string into an associative array
	parse_str($query, $params);

	// Return the first key from the associative array, which is our slug
	return key($params);
	// Example usage
	// If URL is: /page.php?slug=value&other=value2
	// Output: slug
}

function getTitle($page_title = 'Information',$tab_title = 'CUC Database') {
	echo "<script>
		$('title').text('$tab_title');
		$('#page-title').text('$page_title');
	</script>";
}



function custom_encrypt($string, $secret_key, $secret_iv)
{
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
    $output = base64_encode($output);
    return $output;
}
function custom_decrypt($string, $secret_key, $secret_iv)
{
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    return $output;
}



	
//set time zone stamp

function date_time($string='H:i:s',$toTz='America/Port_of_Spain',$fromTz='America/New_York')
    {   
        // timezone by php friendly values
        $date = new DateTime("now", new DateTimeZone($fromTz));
        $date->setTimezone(new DateTimeZone($toTz));
        $time= $date->format($string);
        return $time;
    }

function convert_date_time($time='',$string='H:i:s',$toTz='America/Port_of_Spain',$fromTz='America/New_York')
    {   
        // timezone by php friendly values
        $date = new DateTime($time, new DateTimeZone($fromTz));
        $date->setTimezone(new DateTimeZone($toTz));
        $time= $date->format($string);
        return $time;
    }
function set_date_time($string='H:i:s',$time = '',$toTz='America/Port_of_Spain',$fromTz='America/New_York')
    {   
        // timezone by php friendly values
        $date = new DateTime($time, new DateTimeZone($fromTz));
        $date->setTimezone(new DateTimeZone($toTz));
        $time= $date->format($string);
        return $time;
    }
        
    
//set time zone stamp
$tz = 'America/Port_of_Spain';
$timestamp = time();
$dt = new DateTime("now", new DateTimeZone($tz)); //first argument "must" be a string //
$dt->setTimestamp($timestamp); //adjust the object to correct timestamp
$Dateandtime = $dt->format('Y-m-d, H:i:s');
$Date = $dt->format('Y-m-d');
$Time = $dt->format('g:i:s A');