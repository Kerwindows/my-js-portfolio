<?php
if(isset($_SESSION['Userdata']['email']))
{
unset($_SESSION);
	session_destroy();
}
header("Location:/login");
die;