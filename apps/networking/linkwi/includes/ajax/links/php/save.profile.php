<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require ('../../../../../includes/linkwi.php');

    $userid       = clean(sanitize(custom_decrypt($_POST['userid'], SECRET_KEY, SECRET_IV)));
    $FirstName    = ucfirst(strtolower(clean(sanitize($_POST['firstname']))));
    $LastName     = ucfirst(strtolower(clean(sanitize($_POST['lastname']))));
    $Job          = clean(sanitize($_POST['title']));
    $Organization = clean(sanitize($_POST['organization']));
    $IndustryType = clean(sanitize($_POST['industrytype']));

    $folderPath = LINKWI_IMG_PATH . '/profile-images/';

    // Check if an image file is uploaded
    if (isset($_FILES['profile_img']) && !empty($_FILES['profile_img']['name'])) {
        $raw_img = $_FILES['profile_img']['name'];
        $img_ext = pathinfo($raw_img, PATHINFO_EXTENSION);

        // Validate file size (1MB limit)
        if ($_FILES['profile_img']['size'] > 1000000) {
            echo json_encode(["newImage" => '', "error" => "The image attached is too large"]);
            exit();
        }

        // Check for allowed image formats
        $allowed_img = array('png', 'jpg', 'jpeg');
        if (!in_array(strtolower($img_ext), $allowed_img)) {
            echo json_encode(["newImage" => '', "error" => "The image format is not allowed"]);
            exit();
        }

        // Generate new image name
        $new_img = preg_replace('/[^A-Za-z0-9_\-]/', '', $FirstName . '-' . $LastName) . '-' . rand(999, 9999) . '.' . $img_ext;
        $new_img = str_replace(' ', '-', strtolower($new_img));

        // Save the image to the folder
        $temp_folder = $_FILES['profile_img']['tmp_name'];
        if (move_uploaded_file($temp_folder, $folderPath . $new_img)) {
            echo json_encode(["newImage" => $new_img, "error" => ""]);
        } else {
            echo json_encode(["error" => "Failed to save image"]);
            exit();
        }

        // Update database with the new profile image
        $db = new dbase;
        $db->query('UPDATE `Users` SET 
            FirstName = :FirstName, 
            LastName = :LastName,
            ProfileImage = :ProfileImage,
            Job = :Job,
            Organization = :Organization,
            IndustryType = :IndustryType 
            WHERE UniqueID = :userid');

        $db->bind(':userid', $userid, PDO::PARAM_STR);
        $db->bind(':FirstName', $FirstName, PDO::PARAM_STR);
        $db->bind(':LastName', $LastName, PDO::PARAM_STR);
        $db->bind(':ProfileImage', $new_img, PDO::PARAM_STR);
        $db->bind(':Job', $Job, PDO::PARAM_STR);
        $db->bind(':Organization', $Organization, PDO::PARAM_STR);
        $db->bind(':IndustryType', $IndustryType, PDO::PARAM_STR);
        $db->execute();
        $db->closeConnection();
    } else {
        // No image uploaded, only update other fields
        $db = new dbase; 
        $db->query('UPDATE `Users` SET 
            FirstName = :FirstName, 
            LastName = :LastName,
            Job = :Job,
            Organization = :Organization,
            IndustryType = :IndustryType 
            WHERE UniqueID = :userid');

        $db->bind(':userid', $userid, PDO::PARAM_STR);
        $db->bind(':FirstName', $FirstName, PDO::PARAM_STR);
        $db->bind(':LastName', $LastName, PDO::PARAM_STR);
        $db->bind(':Job', $Job, PDO::PARAM_STR);
        $db->bind(':Organization', $Organization, PDO::PARAM_STR);
        $db->bind(':IndustryType', $IndustryType, PDO::PARAM_STR);
        $db->execute();
        $db->closeConnection();

        echo json_encode(["newImage" => '', "error" => ""]);
    }
}