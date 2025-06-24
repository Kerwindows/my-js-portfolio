<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
require('../../../../../includes/linkwi.php');
$db = new dbase;
// Iterate over the array and update or insert each social link
foreach ($_POST as $key => $value) {
    if (substr($key, -3) === "-id" || substr($key, -5) === "-name" || substr($key, -5) === "-icon" || $key === 'userid') {
        continue; // Skip the id, name, icon, and userid fields
    }

    // Get the corresponding id, name, and icon values
    $id_key = $key . "-id";
    $name_key = $key . "-name";
    $icon_key = $key . "-icon";
    $id_value = $_POST[$id_key];
    $name_value = $_POST[$name_key];
    $icon_value = $_POST[$icon_key];
$userid = custom_decrypt($_POST['userid'],SECRET_KEY,SECRET_IV);

// Sanitize and clean the URL
$sanitizedValue = clean(sanitize(filter_var($value, FILTER_SANITIZE_URL)));

// Prepare the SQL query with INSERT INTO ... ON DUPLICATE KEY UPDATE syntax
$db->query('INSERT INTO `socials` (id, social_name, social_link, UniqueID, fa_icon) VALUES (:id, :name, :link, :userid, :icon) ON DUPLICATE KEY UPDATE social_link = :link, fa_icon = :icon');

// Bind the parameters
$db->bind(':id', $id_value, PDO::PARAM_STR);
$db->bind(':name', $name_value, PDO::PARAM_STR);
$db->bind(':link', $sanitizedValue, PDO::PARAM_STR);
$db->bind(':userid', $userid, PDO::PARAM_STR);
$db->bind(':icon', $icon_value, PDO::PARAM_STR);

// Execute the query
$db->execute();

}
$db->closeConnection();
// At this point, all social links should be updated or inserted in the database
}
?>