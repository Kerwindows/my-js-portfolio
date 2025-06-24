<?php
if (!defined('PROJECT_PATH')) {
    redirect(base_url().'/404');
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect POST data with sanitization
    $sanitizationRules = [

        'fname' => FILTER_SANITIZE_STRING,
        'mname' => FILTER_SANITIZE_STRING,
        'lname' => FILTER_SANITIZE_STRING,
        'alias' => FILTER_SANITIZE_STRING,
        'dob' => function ($value) {
            return date('Y-m-d', strtotime($value));
        }, // Custom sanitization for DOB
        'sex' => FILTER_SANITIZE_STRING, // Assuming 'sex' is submitted as 'Male' or 'Female'
        'ethnicity' => FILTER_SANITIZE_STRING,
        'phone' => FILTER_SANITIZE_STRING,
        'email' => FILTER_SANITIZE_EMAIL,
        'address' => FILTER_SANITIZE_STRING,
        'town' => FILTER_SANITIZE_STRING, // Assuming 'town' is a simple text input
        'city' => FILTER_SANITIZE_STRING,
        'country' => FILTER_SANITIZE_STRING,
        'postal_code' => FILTER_SANITIZE_STRING,
        'religion' => FILTER_SANITIZE_STRING,
        'union_status' => FILTER_SANITIZE_STRING,
        'occupation' => FILTER_SANITIZE_STRING,
        'about' => FILTER_SANITIZE_STRING,
        'status' => FILTER_SANITIZE_STRING, // Assuming 'status' is submitted as 'active' or 'inactive'
        'next_of_kin_fname' => FILTER_SANITIZE_STRING,
        'next_of_kin_lname' => FILTER_SANITIZE_STRING,
        'next_of_kin_relationship' => FILTER_SANITIZE_STRING,
        'next_of_kin_phone' => FILTER_SANITIZE_STRING,
        'mother_maiden_name' => FILTER_SANITIZE_STRING,
        'emergency_contact_fname' => FILTER_SANITIZE_STRING,
        'emergency_contact_lname' => FILTER_SANITIZE_STRING,
        'emergency_contact_relationship' => FILTER_SANITIZE_STRING,
        'emergency_contact_phone' => FILTER_SANITIZE_STRING,

    ];


    // Initialize an array to hold sanitized inputs
    $sanitizedInputs = [];

    // Iterate over each sanitization rule
    foreach ($sanitizationRules as $field => $rule) {
        if (is_callable($rule)) {
            // If the rule is a custom function, call it
            $sanitizedInputs[$field] = call_user_func($rule, $_POST[$field] ?? '');
        } else {
            // Otherwise, use filter_input
            $sanitizedInputs[$field] = filter_input(INPUT_POST, $field, $rule);
        }
    }
    
    
   if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $imageSize = $_FILES['image']['size'];
    $imageType = $_FILES['image']['type'];

    // Check if the file size is less than 5 MB and the type is JPEG or PNG
    if ($imageSize > 5 * 1024 * 1024 || !in_array($imageType, ['image/jpeg', 'image/png'])) {
        echo "Invalid file size or type.";
        exit;
    }

    $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
    $filename = uniqid().'-'.uniqid() . '.' . $extension;
    // Correcting the target path assuming your script is at the root directory of your project
    $targetPath = $_SERVER['DOCUMENT_ROOT'] . base_url()."/assets/img/patients/" . $filename;

    // Ensure directory exists or attempt to create it
    if (!file_exists($_SERVER['DOCUMENT_ROOT'] . '/assets/img/patients/')) {
        mkdir($_SERVER['DOCUMENT_ROOT'] . '/assets/img/patients/', 0755, true);
    }

    // Resize and move the uploaded file
    list($originalWidth, $originalHeight) = getimagesize($_FILES['image']['tmp_name']);
    $targetWidth = 200;
    $targetHeight = 200;

    $targetImage = imagecreatetruecolor($targetWidth, $targetHeight);

    switch ($imageType) {
        case 'image/jpeg':
            $sourceImage = imagecreatefromjpeg($_FILES['image']['tmp_name']);
            imagecopyresampled($targetImage, $sourceImage, 0, 0, 0, 0, $targetWidth, $targetHeight, $originalWidth, $originalHeight);
            imagejpeg($targetImage, $targetPath);
            break;
        case 'image/png':
            $sourceImage = imagecreatefrompng($_FILES['image']['tmp_name']);
            imagecopyresampled($targetImage, $sourceImage, 0, 0, 0, 0, $targetWidth, $targetHeight, $originalWidth, $originalHeight);
            imagepng($targetImage, $targetPath);
            break;
    }

    imagedestroy($sourceImage);
    imagedestroy($targetImage);


    $sqlUsers = "UPDATE users SET 
            fname = :fname,
            mname = :mname,
            lname = :lname,
            alias = :alias,
            dob = :dob,
            sex = :sex,
            ethnicity = :ethnicity,
            phone = :phone,
            email = :email,
            address = :address,
            town = :town,
            city = :city,
            country = :country,
            postal_code = :postal_code,
            religion = :religion,
            union_status = :union_status,
            occupation = :occupation,
            about = :about,
            status = :status,
            image = :image
        WHERE uid = :uid";


    // SQL statement for updating the next_of_kins table
    $sqlNextOfKins = "UPDATE next_of_kins SET 
            fname = :next_of_kin_fname,
            lname = :next_of_kin_lname,
            relationship = :next_of_kin_relationship,
            phone = :next_of_kin_phone
        WHERE uid = :uid";


    // SQL statement for updating the emergency_contacts table
    $sqlEmergencyContacts = "UPDATE emergency_contacts SET 
            fname = :emergency_contact_fname,
            lname = :emergency_contact_lname,
            relationship = :emergency_contact_relationship,
            phone = :emergency_contact_phone
        WHERE uid = :uid";


    $db = new dbase();

    // Start transaction
    $db->beginTransaction();

    try {
        // Execute Update for Users
        $db->query($sqlUsers);
        // Bind common parameters for users table
        $commonFields = ['fname', 'mname', 'lname', 'alias', 'dob', 'sex', 'ethnicity', 'phone', 'email', 'address', 'town', 'city', 'country', 'postal_code', 'religion', 'union_status', 'occupation', 'about', 'status'];
        foreach ($commonFields as $field) {
            $db->bind(":$field", $sanitizedInputs[$field], is_int($sanitizedInputs[$field]) ? PDO::PARAM_INT : PDO::PARAM_STR);
        }
        $db->bind(':image', base_url()."/assets/img/patients/" . $filename, PDO::PARAM_STR);
        $db->bind(':uid', $uid, PDO::PARAM_STR);
        $db->execute();

        // Execute Update for Next of Kins
        $db->query($sqlNextOfKins);
        $db->bind(':next_of_kin_fname', $sanitizedInputs['next_of_kin_fname'], PDO::PARAM_STR);
        $db->bind(':next_of_kin_lname', $sanitizedInputs['next_of_kin_lname'], PDO::PARAM_STR);
        $db->bind(':next_of_kin_relationship', $sanitizedInputs['next_of_kin_relationship'], PDO::PARAM_STR);
        $db->bind(':next_of_kin_phone', $sanitizedInputs['next_of_kin_phone'], PDO::PARAM_STR);
        $db->bind(':uid', $uid, PDO::PARAM_STR);
        $db->execute();

        // Execute Update for Emergency Contacts
        $db->query($sqlEmergencyContacts);
        $db->bind(':emergency_contact_fname', $sanitizedInputs['emergency_contact_fname'], PDO::PARAM_STR);
        $db->bind(':emergency_contact_lname', $sanitizedInputs['emergency_contact_lname'], PDO::PARAM_STR);
        $db->bind(':emergency_contact_relationship', $sanitizedInputs['emergency_contact_relationship'], PDO::PARAM_STR);
        $db->bind(':emergency_contact_phone', $sanitizedInputs['emergency_contact_phone'], PDO::PARAM_STR);
        $db->bind(':uid', $uid, PDO::PARAM_STR);
        $db->execute();

        // If all operations were successful, commit the transaction
        $db->commit();
        echo "success";
        // Assuming redirect() is a function you've defined to redirect the user
        redirect(base_url()."/patient/edit/{$uid}");
    } catch (PDOException $e) {
    $db->rollBack();
    error_log('PDOException caught during transaction: ' . $e->getMessage());
    echo "An error occurred. Transaction rolled back. Error: " . $e->getMessage();
    exit;
}
} else {
    // Handle the case when no image is uploaded
    // SQL statement for updating the users table
    $sqlUsers = "UPDATE users SET 
            fname = :fname,
            mname = :mname,
            lname = :lname,
             alias = :alias,
            dob = :dob,
            sex = :sex,
            ethnicity = :ethnicity,
            phone = :phone,
            email = :email,
             address = :address,
            town = :town, 
            city = :city,           
            country = :country,
            postal_code = :postal_code,
            religion = :religion,
            union_status = :union_status,
            occupation = :occupation,
            about = :about,
            status = :status
        WHERE uid = :uid";


    // SQL statement for updating the next_of_kins table
    $sqlNextOfKins = "UPDATE next_of_kins SET 
            fname = :next_of_kin_fname,
            lname = :next_of_kin_lname,
            relationship = :next_of_kin_relationship,
            phone = :next_of_kin_phone
        WHERE uid = :uid";


    // SQL statement for updating the emergency_contacts table
    $sqlEmergencyContacts = "UPDATE emergency_contacts SET 
            fname = :emergency_contact_fname,
            lname = :emergency_contact_lname,
            relationship = :emergency_contact_relationship,
            phone = :emergency_contact_phone
        WHERE uid = :uid";


    $db = new dbase();

    // Start transaction
    $db->beginTransaction();

    try {
        // Execute Update for Users
        $db->query($sqlUsers);
        // Bind common parameters for users table
        $commonFields = ['fname', 'mname', 'lname', 'alias', 'dob', 'sex', 'ethnicity', 'phone', 'email', 'address', 'town', 'city', 'country', 'postal_code', 'religion', 'union_status', 'occupation', 'about', 'status'];
        foreach ($commonFields as $field) {
            $db->bind(":$field", $sanitizedInputs[$field], is_int($sanitizedInputs[$field]) ? PDO::PARAM_INT : PDO::PARAM_STR);
        }
        $db->bind(':uid', $uid, PDO::PARAM_STR);
        $db->execute();

        // Execute Update for Next of Kins
        $db->query($sqlNextOfKins);
        $db->bind(':next_of_kin_fname', $sanitizedInputs['next_of_kin_fname'], PDO::PARAM_STR);
        $db->bind(':next_of_kin_lname', $sanitizedInputs['next_of_kin_lname'], PDO::PARAM_STR);
        $db->bind(':next_of_kin_relationship', $sanitizedInputs['next_of_kin_relationship'], PDO::PARAM_STR);
        $db->bind(':next_of_kin_phone', $sanitizedInputs['next_of_kin_phone'], PDO::PARAM_STR);
        $db->bind(':uid', $uid, PDO::PARAM_STR);
        $db->execute();

        // Execute Update for Emergency Contacts
        $db->query($sqlEmergencyContacts);
        $db->bind(':emergency_contact_fname', $sanitizedInputs['emergency_contact_fname'], PDO::PARAM_STR);
        $db->bind(':emergency_contact_lname', $sanitizedInputs['emergency_contact_lname'], PDO::PARAM_STR);
        $db->bind(':emergency_contact_relationship', $sanitizedInputs['emergency_contact_relationship'], PDO::PARAM_STR);
        $db->bind(':emergency_contact_phone', $sanitizedInputs['emergency_contact_phone'], PDO::PARAM_STR);
        $db->bind(':uid', $uid, PDO::PARAM_STR);
        $db->execute();

        // If all operations were successful, commit the transaction
        $db->commit();
        //success
        redirect(base_url()."/patient/edit/{$uid}");
    } catch (PDOException $e) {
    $db->rollBack();
    error_log('PDOException caught during transaction: ' . $e->getMessage());
    echo "An error occurred. Transaction rolled back. Error: " . $e->getMessage();
    //redirect(base_url()."/patient/edit/{$uid}");
    exit;
	}
}

}else{
 redirect(base_url().'/404');
}