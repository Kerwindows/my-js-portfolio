<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

require('../../../../../includes/linkwi.php');
$db = new dbase;
$db->query("SELECT Bio FROM Users WHERE UniqueID='".custom_decrypt($_POST['userid'],SECRET_KEY,SECRET_IV)."'");
$bio = $db->fetchSingle();
$db->closeConnection();
echo clean(sanitize($bio['Bio']));
}