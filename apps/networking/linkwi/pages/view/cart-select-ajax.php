<?php

require('../../../includes/linkwi.php');
$db = new dbase;
$db->query(" DELETE FROM cart WHERE id = '".clean(sanitize($_POST["id"]))."'");
$db->execute();