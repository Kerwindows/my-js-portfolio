<?php

session_start();

if(isset($_SESSION['Userdata']['EmailAddress']))
{
unset($_SESSION);
session_destroy();
}


header("Location: login.php");
die;