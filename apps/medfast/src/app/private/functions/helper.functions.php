<?php
/**
 * Function List:
 * 1. force_https - Redirects to HTTPS if not already using HTTPS.
 * 2. base_url_dir - Returns the base URL directory of the application.
 * 3. base_url - Returns the base URL of the application.
 * 4. redirect - Redirects the user to a specified URL.
 * 5. check_Input - Sanitizes input to prevent XSS attacks.
 * 6. check_Names - Sanitizes and formats names.
 * 7. check_Email - Validates an email address.
 * 8. check_uploads - Sanitizes uploaded file names.
 * 9. clean - Trims whitespace from a string.
 * 10. sanitize - Sanitizes a string by removing special characters.
 * 11. val_email - Validates an email address.
 * 12. val_int - Validates an integer.
 * 13. sanitize_upload_file - Sanitizes and formats uploaded file names.
 * 14. sanitize_upload_filename - Sanitizes and adds a random number to filenames.
 * 15. getExtension - Retrieves the file extension from a filename.
 * 16. hash_pwd - Hashes a password using MD5 (not recommended for new projects).
 * 17. generateUniqueUserID - Generates a unique user ID.
 * 18. getSlug - Extracts the slug from a URL.
 * 19. getTitle - Sets the page and tab title in a web application.
 * 20. daysBetween - Calculates the number of days between two dates.
 * 21. addMonths - Adds a number of months to a date.
 * 22. addDays - Adds a number of days to a date.
 * 23. generateUniqueID - Generates a unique identifier.
 * 24. generateInvoiceNumber - Generates a sequential invoice number.
 * 25. generateOrderId - Generates a random order ID.
 * 26. c_encrypt - Encrypts a string with a custom method.
 * 27. c_decrypt - Decrypts a string with a custom method.
 * 28. analyzeReferralPayments - Analyzes referral payments and calculates totals.
 * 29. date_time - Gets the current date and time in a specified timezone.
 * 30. convert_date_time - Converts a date and time to a different timezone.
 * 31. set_date_time - Sets the date and time format and timezone.
 * 32. ensureLoggedIn - Redirects if a user is not logged in.
 * 33. authenticationCheck - Checks if a user has the required role to access a page.
 * 34. generateScriptTags - Generates HTML script tags for an array of JavaScript file paths.
 * 35. javascript - Outputs script tags for an array of JavaScript file paths.
 * 36. generateStyleTags - Generates HTML link tags for an array of CSS file paths.
 * 37. cssLoader - Outputs link tags for an array of CSS file paths.
 * 38. calculateBMICategory - Calculates the BMI category based on weight and height.
 * 39. calculateAge - Calculates age based on date of birth.
 * 40. highlightBMICategory - Highlights the BMI category in a list.
 * 41. cmToInches - Converts centimeters to inches.
 * 42. calculateHealthPercentage - Calculates a health percentage based on various vitals.
 * 43. calculateBMI - Calculates the Body Mass Index (BMI).
 */

if (!defined('PROJECT_PATH')) {
	header("Location: /");
	exit();
}

// Require https

function base_url_dir()
{
	$url = "https://" . $_SERVER["HTTP_HOST"] . dirname($_SERVER["PHP_SELF"]) . "";
	return htmlspecialchars($url);
}
function base_url()
{
	$url = "https://" . $_SERVER["HTTP_HOST"] . "/apps/medfast";
	return htmlspecialchars($url);
}

//function to redirect
function redirect($url)
{
	return header("Location: {$url}");
	exit();
}

function check_Input($data)
{
	$data = str_replace(array(
		'\'',
		"\"",
		"<"
	), array(
		"&#39;",
		"&quot;",
		""
	), $data);
	$data = trim($data);
	$data = stripslashes($data);
	//$data = htmlspecialchars($data);
	return $data;
}

function check_Names($data)
{

	$data = str_replace(array(
		'\'',
		"\"",
		"<"
	), array(
		"&#39;",
		"&quot;",
		""
	), $data);
	$data = trim($data); //remove the white spaces and other predefined characters
	$data = stripslashes($data);
	$data = ucfirst(strtolower($data));

	return $data;
}

function check_Email($email)
{
	filter_var($email, FILTER_VALIDATE_EMAIL);
	return $email;
}

function check_uploads($uploads)
{
	$uploads = str_replace(' ', '', $uploads);
	return $uploads;
}

//function to trim values
function clean($value)
{

	return trim($value);
}

//function to sanitize strings
function sanitize($raw_value)
{

	return filter_var($raw_value, FILTER_SANITIZE_STRING);
}

//function to validate email
function val_email($raw_email)
{

	return filter_var($raw_email, FILTER_VALIDATE_EMAIL);
}
//function to validate int
function val_int($raw_int)
{

	return filter_var($raw_int, FILTER_VALIDATE_INT);
}
//sanitize uploads
function sanitize_upload_file($data)
{
	$imgName = $data;
	$indexOFF = strrpos($imgName, '.');
	$nameFile = substr($imgName, 0, $indexOFF);
	$extension = substr($imgName, $indexOFF);
	$clean = preg_replace("([^\w\s\d\-_~,;\[\]\(\)])", "", $nameFile);
	$NAMEFILE = str_replace(' ', '', $clean) . $extension;
	return $NAMEFILE;
}
function sanitize_upload_filename($data)
{
	
	$imgName = $data;
	$indexOFF = strrpos($imgName, '.');
	$nameFile = substr($imgName, 0, $indexOFF);
	$extension = substr($imgName, $indexOFF);
	$clean = preg_replace("([^\w\s\d\-_~,;\[\]\(\)])", "", $nameFile);
	$NAMEFILE = str_replace(' ', '', $clean) . "-" . rand(100, 9999) . $extension;
	return $NAMEFILE;
}
function getExtension($str) {

         $i = strrpos($str,".");
         if (!$i) { return ""; } 
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
 }
//function to hash passwords
function hash_pwd($raw_password)
{

	return md5($raw_password);
}

function generateUniqueUserID($prefix = 'UID') {
    // Use microtime to get both the current Unix timestamp and microsecond value as a float
    $time = microtime(true);
    
    // Generate a random number between 1000 and 9999
    $random = mt_rand(1000, 9999);

    // Generate a unique ID using the uniqid() function
    $unique = uniqid();

    // Combine all to create a unique user ID
    $userID = $prefix . '-' . base_convert($time, 10, 36) . '-' . $unique;

    // Convert to uppercase
    return strtoupper($userID);
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



function getTitle($page_title = 'Information', $tab_title = 'AI Content')
{
	echo "<script>
		$('title').text('$tab_title');
		$('#page-title').html(`$page_title <span class='h-20px border-gray-400 border-start mx-3'></span>
                <small class='text-gray-500 fs-7 fw-semibold my-1'>#XRS-45670</small>`);
	</script>";
}

function daysBetween($startDate, $endDate) {
    // Create DateTime objects for the start and end dates
    $start = new DateTime($startDate);
    $end = new DateTime($endDate);

    // Check if start date is after the end date and return 0 if true
    if ($start > $end) {
        return 0;
    }

    // Calculate the difference in days
    $interval = $start->diff($end);

    // Return the number of days
    return $interval->days;
}

function addMonths($datestamp, $duration) {
    // Attempt to parse the date with the ISO 8601 format, allowing for missing seconds
    $date = DateTime::createFromFormat('Y-m-d\TH:i', $datestamp);
    if (!$date) {
        // Fallback for the complete ISO 8601 format including seconds
        $date = DateTime::createFromFormat('Y-m-d\TH:i:s', $datestamp);
    }
    if (!$date) {
        // Attempt with a more generic format if needed
        $date = new DateTime($datestamp);
    }

    // Check if the date was parsed correctly
    if (!$date) {
        throw new Exception("Invalid date format provided: " . $datestamp);
    }

    // Add the specified number of months
    $date->modify("+$duration month");

    // Return the modified date in the standard format
    return $date->format('Y-m-d H:i:s');
}

function addDays($datestamp, $duration) {
    // Parse the input datestamp without the comma
    $date = DateTime::createFromFormat('Y-m-d H:i:s', $datestamp);
    
    // Check if the date was parsed correctly
    if (!$date) {
        throw new Exception("Invalid date format provided: " . $datestamp);
    }

    // Add no. of days to it
    $date->modify('+' . $duration . ' day');

    // Format and return the modified date
    return $date->format('Y-m-d H:i:s');
}
function generateUniqueID($length = 32) {
    // Combine the current time (in microseconds), a random number, and a constant string
    $data = microtime() . rand(1000, 9999) . "YourConstantStringHere";
    
    // Generate a hash of the data
    $hash = hash('sha256', $data);
    
    // Return a substring of the hash, based on the desired length
    return substr($hash, 0, $length);
}

function generateInvoiceNumber($previousInvoice = null) {
    $date = new DateTime(); // Current date
    $prefix = 'INV';
    $datePart = $date->format('Ymd');

    if ($previousInvoice && strpos($previousInvoice, $datePart) === 3) {
        // Extract the counter from the previous invoice number
        $previousCounter = (int) substr($previousInvoice, -3);
        $counter = str_pad($previousCounter + 1, 3, '0', STR_PAD_LEFT);
    } else {
        $counter = '001';  // Start from 001 if no previous invoice or it's from a different day
    }

    return "{$prefix}{$datePart}-{$counter}";
}
function generateOrderId() {
    // Generate a random number between 100 and 999 (inclusive)
    $randomNumber = rand(100, 999);

    // Generate a random 3-character string
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charLength = strlen($characters);
    $randomChars = '';
    for ($i = 0; $i < 3; $i++) {
        $randomChars .= $characters[rand(0, $charLength - 1)];
    }

    // Combine to create the order ID
    return "loom_{$randomNumber}-{$randomChars}";
}

function c_encrypt($string, $secret_key)
{
    $output = '';
    for ($i = 0; $i < strlen($string); $i++) {
        $output .= chr(ord($string[$i]) + ord($secret_key[$i % strlen($secret_key)]));
    }
    return base64_encode($output);
}

function c_decrypt($string, $secret_key)
{
    $string = base64_decode($string);
    $output = '';
    for ($i = 0; $i < strlen($string); $i++) {
        $output .= chr(ord($string[$i]) - ord($secret_key[$i % strlen($secret_key)]));
    }
    return $output;
}
function analyzeReferralPayments($user,$creditsWorthPayments) {
    if (!isset($user['payments']) || !is_array($user['payments'])) {
        return "Payments data is not available.";
    }

    $totalRidCredits = 0;
    $totalPayments = 0;
    $lastReceivedRidCredits = 0;
    $uniqueRids = [];

    foreach ($user['payments'] as $payment) {
        if (isset($payment['ridCredits']) && is_numeric($payment['ridCredits'])) {
            $totalRidCredits += $payment['ridCredits'];
            $lastReceivedRidCredits = $payment['ridCredits'];
        }

        if (isset($payment['rid'])) {
            $uniqueRids[$payment['rid']] = true;
        }
    }

    $totalPayments = floor($totalRidCredits / $creditsWorthPayments);
    $totalUniqueRids = count($uniqueRids);

    return [
        'total_credits' => $totalRidCredits,
        'total_payments' => $totalPayments,
        'last_received_credits' => $lastReceivedRidCredits,
        'total_unique_rids' => $totalUniqueRids,
    ];
}

//set time zone stamp

function date_time($string = 'H:i:s', $toTz = 'America/Port_of_Spain', $fromTz = 'America/New_York')
{
	// timezone by php friendly values
	$date = new DateTime("now", new DateTimeZone($fromTz));
	$date->setTimezone(new DateTimeZone($toTz));
	$time = $date->format($string);
	return $time;
}

function convert_date_time($time = '', $string = 'H:i:s', $toTz = 'America/Port_of_Spain', $fromTz = 'America/New_York')
{
	// timezone by php friendly values
	$date = new DateTime($time, new DateTimeZone($fromTz));
	$date->setTimezone(new DateTimeZone($toTz));
	$time = $date->format($string);
	return $time;
}
function set_date_time($string = 'H:i:s', $time = '', $toTz = 'America/Port_of_Spain', $fromTz = 'America/New_York')
{
	// timezone by php friendly values
	$date = new DateTime($time, new DateTimeZone($fromTz));
	$date->setTimezone(new DateTimeZone($toTz));
	$time = $date->format($string);
	return $time;
}
function ensureLoggedIn($login_check) {
    if (!isset($login_check['session_email']) || empty($login_check['session_email']) ) {
        redirect($login_check['redirectTo']);
        exit();
    }
}
function authenticationCheck($role_check) {
    // Check if session role is not set or empty
    if (!isset($role_check['session_role']) || empty($role_check['session_role'])) {
        redirect($role_check['redirectTo']); // Redirect to login page
        exit();
    } elseif (!in_array($role_check['session_role'], $role_check['allowed_roles'])) {
        redirect($role_check['redirectTo']); // Redirect if session role is not in allowed roles
        exit();
    }
}
// JS scripts generator function for flat lists of script paths
function generateScriptTags($js_arrays = []) {
    // Initialize an empty string to accumulate the script tags
    $scripts = '';

    // Iterate over each script path in the flat list
    foreach ($js_arrays as $path) {
        // Append a script tag for the current path to the accumulator string
        $scripts .= '<script nonce="'.htmlspecialchars($_SESSION['nonce']).'" src="'. $path . '"></script>' . "\n";
    }

    // Return the concatenated string of script tags
    return $scripts;
}

function javascript($array_var = []) { 
    // Call generateScriptTags with the flat array of script paths and output the result
    echo generateScriptTags($array_var);
}
// CSS scripts generator function for flat lists of script paths
function generateStyleTags($cssArrays = []) {
    // Initialize an empty string to accumulate the link tags
    $styles = '';

    // Iterate over each style sheet path in the array
    foreach ($cssArrays as $path) {
        // Append a link tag for the current path to the accumulator string
        // Assume all styles are CSS, hence type="text/css" and rel="stylesheet" are used
        $styles .= '<link rel="stylesheet" type="text/css" href="'. $path . '">' . "\n";
    }

    // Return the concatenated string of link tags
    return $styles;
}

function cssLoader($array_var = []) {
    // Call generateStyleTags with the array of style sheet paths and output the result
    echo generateStyleTags($array_var);
}


function calculateBMICategory($weightInPounds, $heightInCm) {
    // Convert height to inches (1 foot = 12 inches)
    $totalHeightInInches = cmToInches($heightInCm);
    
    // Convert height to meters (1 inch = 0.0254 meters)
    $heightInMeters = $totalHeightInInches * 0.0254;
    
    // Convert weight to kilograms (1 pound = 0.45359237 kilograms)
    $weightInKilograms = $weightInPounds * 0.45359237;
    
    // Calculate the BMI
    $bmi = $weightInKilograms / ($heightInMeters ** 2);

    // Determine BMI category based on the calculated BMI
    if ($bmi < 16.5) {
        return ['Severely Underweight', $bmi];
    } elseif ($bmi < 18.5) {
        return ['Underweight', $bmi];
    } elseif ($bmi < 25) {
        return ['Normal', $bmi];
    } elseif ($bmi < 30) {
        return ['Overweight', $bmi];
    } elseif ($bmi < 40) {
        return ['Obese', $bmi];
    } else {
        return ['Severely Obese', $bmi];
    }
}
//calculate age
function calculateAge($dob) {
    // Create a DateTime object for the date of birth
    $dateOfBirth = new DateTime($dob);
    
    // Get the current date
    $today = new DateTime();
    
    // Calculate the interval between the two dates
    $interval = $dateOfBirth->diff($today);
    
    // Extract the years from the interval
    $age = $interval->y;
    
    // Return the calculated age
    return $age;
}
// Function to highlight the BMI category in an unordered list
function highlightBMICategory($weightInPounds, $heightInCm) {
    list($category, $bmi) = calculateBMICategory($weightInPounds,$heightInCm);
    
    // Calculate width percentage for BMI progress bar
    $widthPercentage = min(($bmi / 45) * 100, 100);

    // Output the progress bar
    echo "<div class='progress weight-bar'>
            <div class='progress-bar progress-bar-success' role='progressbar' style='width: {$widthPercentage}%;'></div>
          </div>";

    // Continue with highlighting categories as before
    $categories = ['Severely Underweight', 'Underweight', 'Normal', 'Overweight', 'Obese', 'Severely Obese'];
    
    echo '<ul class="weight-checkit">';
    foreach ($categories as $cat) {
        $highlightStyle = ($cat === $category) ? " style='margin-bottom: 0;background: rgba(46, 55, 164, 0.05);border-radius: 8px;padding: 6px 10px;'" : "";
        $displayBMI = ($cat === $category) ? " (" . round($bmi, 1) . ")" : "";
        echo "<li{$highlightStyle}>{$cat}{$displayBMI}</li>";
    }
    echo '</ul>';
}

//convert cm to inches
function cmToInches($cm) {
    $inches = $cm / 2.54;
    return $inches;
}

function calculateHealthPercentage($vitals) {

if(empty($vitals['cholesterol']) AND empty($vitals['blood_pressure']) AND empty($vitals['sleep']) AND empty($vitals['glucose']) AND empty($vitals['heart_rate']) AND empty($vitals['temperature']) AND empty($vitals['weight']) AND empty($vitals['height'])){
return '';
exit;
}else{

    // Define the "ideal" normal values
    $normals = [
        'cholesterol' => 200, // in mg/dL, assuming total cholesterol
        'blood_pressure_systolic' => 120, // Systolic BP (mmHg)
        'blood_pressure_diastolic' => 80, // Diastolic BP (mmHg)
        'glucose' => 99, // in mg/dL
        'heart_rate' => 80, // in bpm
        'sleep' => 450, // 7 hours 30 minutes, in minutes
        'temperature' => 37, // in degrees Celsius
        'bmi' => 21.75 // Midpoint of normal BMI range
    ];
    
    

    // Convert the vitals to the right units and calculate the BMI
    $bloodPressureValues = explode('/', $vitals['blood_pressure']);
    $sleepValues = explode(':', $vitals['sleep']);
    
    $totalCholesterol = $vitals['cholesterol']; // Just take the total cholesterol
    $systolicBP = (float)$bloodPressureValues[0];
    $diastolicBP = (float)$bloodPressureValues[1];
    $glucose = (float)$vitals['glucose'];
    $heartRate = (float)$vitals['heart_rate'];
    $sleepInMinutes = ((int)$sleepValues[0] * 60) + (int)$sleepValues[1]; // Convert hours and minutes to total minutes
    $temperature = (float)$vitals['temperature'];
    $weightInPounds = (float)$vitals['weight']; // Assuming weight is in pounds
    $heightInCm = (float)$vitals['height']; // Assuming height is in cm
    $bmi = calculateBMI($weightInPounds, $heightInCm);

    // Initialize the health score
    $healthScore = 0;

    // Add up the percentage of the normal value for each vital, capped between 0 and 100
    $healthScore += ($totalCholesterol <= $normals['cholesterol']) ? ($totalCholesterol / $normals['cholesterol']) * 100 : 0;
    $healthScore += ($systolicBP <= $normals['blood_pressure_systolic']) ? ($systolicBP / $normals['blood_pressure_systolic']) * 100 : 0;
    $healthScore += ($diastolicBP <= $normals['blood_pressure_diastolic']) ? ($diastolicBP / $normals['blood_pressure_diastolic']) * 100 : 0;
    $healthScore += ($glucose <= $normals['glucose']) ? ($glucose / $normals['glucose']) * 100 : 0;
    $healthScore += ($heartRate >= $normals['heart_rate'] - 20 && $heartRate <= $normals['heart_rate'] + 20) ? 100 : ($heartRate / $normals['heart_rate']) * 100;
    $healthScore += ($sleepInMinutes >= $normals['sleep'] - 60 && $sleepInMinutes <= $normals['sleep'] + 60) ? 100 : ($sleepInMinutes / $normals['sleep']) * 100;
    $healthScore += ($temperature >= $normals['temperature'] - 0.5 && $temperature <= $normals['temperature'] + 0.5) ? 100 : ($temperature / $normals['temperature']) * 100;
    $healthScore += ($bmi >= 18.5 && $bmi <= 24.9) ? 100 : ($bmi / $normals['bmi']) * 100;

    // Calculate the average health score
    $healthScore = $healthScore / count($normals);

    return round($healthScore, 2);
    }
}

// Function to calculate BMI
function calculateBMI($weightInPounds, $heightInCm) {
    $heightInMeters = $heightInCm / 100; // Convert height to meters
    $weightInKilograms = $weightInPounds * 0.45359237; // Convert pounds to kilograms
    $bmi = $weightInKilograms / ($heightInMeters ** 2); // Calculate BMI
    return $bmi;
}

function uploadAndResizeImage($params) {
    $defaults = [
        'fileInput' => null,
        'targetDir' => '',
        'maxFileSize' => 5 * 1024 * 1024, // 5 MB
        'targetWidth' => 200,
        'targetHeight' => 200,
    ];

    // Merge defaults with user-provided params
    $params = array_merge($defaults, $params);

    $result = [
        'status' => false,
        'message' => '',
        'filePath' => '',
    ];

    $imageSize = $params['fileInput']['size'];
    $imageType = $params['fileInput']['type'];

    // Validate file size and type
    if ($imageSize > $params['maxFileSize'] || !in_array($imageType, ['image/jpeg', 'image/png'])) {
        $result['message'] = "Invalid file size or type.";
        return $result;
    }

    $extension = pathinfo($params['fileInput']['name'], PATHINFO_EXTENSION);
    $filename = uniqid() . '-' . uniqid() . '.' . $extension;
    $targetPath = $_SERVER['DOCUMENT_ROOT'] . $params['targetDir'] . $filename;

    // Ensure the target directory exists
    if (!file_exists($_SERVER['DOCUMENT_ROOT'] . $params['targetDir']) && !mkdir($_SERVER['DOCUMENT_ROOT'] . $params['targetDir'], 0755, true)) {
        $result['message'] = "Failed to create directory.";
        return $result;
    }

    // Process image resizing
    list($originalWidth, $originalHeight) = getimagesize($params['fileInput']['tmp_name']);
    $targetImage = imagecreatetruecolor($params['targetWidth'], $params['targetHeight']);

    switch ($imageType) {
        case 'image/jpeg':
            $sourceImage = imagecreatefromjpeg($params['fileInput']['tmp_name']);
            break;
        case 'image/png':
            $sourceImage = imagecreatefrompng($params['fileInput']['tmp_name']);
            break;
        default:
            imagedestroy($targetImage);
            $result['message'] = "Unsupported image format.";
            return $result;
    }

    imagecopyresampled($targetImage, $sourceImage, 0, 0, 0, 0, $params['targetWidth'], $params['targetHeight'], $originalWidth, $originalHeight);

    // Save the resized image
    $saveSuccess = false;
    if ($imageType === 'image/jpeg') {
        $saveSuccess = imagejpeg($targetImage, $targetPath);
    } elseif ($imageType === 'image/png') {
        $saveSuccess = imagepng($targetImage, $targetPath);
    }

    imagedestroy($sourceImage);
    imagedestroy($targetImage);

    if (!$saveSuccess) {
        $result['message'] = "Failed to save the image.";
        return $result;
    }

    $result['status'] = true;
    $result['message'] = "Image uploaded and resized successfully.";
    $result['filePath'] = $params['targetDir'] . $filename;

    return $result;
}

function getImagePath($data) {
    // Check if 'image' key exists and its value is not null and not empty
    if (!empty($data) || !is_null($data) || $data != '') {
        return $data;
    } else {
        // Return default image path if 'image' key is empty or null
        return base_url().'/assets/img/patients/default.jpg';
    }
}