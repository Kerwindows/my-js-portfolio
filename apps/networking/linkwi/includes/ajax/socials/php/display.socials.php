<?php


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    require('../../../../../includes/linkwi.php');

    if (custom_decrypt($_POST['chk'], SECRET_KEY, SECRET_IV)  == 1) {
        $check = true;
    } else {
        $check = false;
    }

    $db         = new dbase;
    $db->query("SELECT * FROM `socials` WHERE `UniqueID` = :uid ");
    $db->bind(':uid', custom_decrypt($_POST['userid'], SECRET_KEY, SECRET_IV), PDO::PARAM_STR);
    $getSocials = $db->fetchMultiple();

    if (empty($getSocials)) {
    } else {

        foreach ($getSocials as $social) {
            $id = $social['id'];
            $link = $social['social_link'];
            $name = $social['social_name'];
            $name_slug = strtolower($social['social_name']);
            $icon = $social['fa_icon'];

            echo '<a data-id="' . $name_slug . '" class="cookieclick social__' . $name_slug . '" href="' . $link . '" title="' . $name . '" target="_blank"><i class="' . $icon . '"></i> <span class="sr-only"></span></a>';
        }
    }
}