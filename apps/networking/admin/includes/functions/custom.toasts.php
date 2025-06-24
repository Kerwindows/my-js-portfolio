<?php
//Function to display session messages
function set_msg($msg) { //eg. 'Welcome to your account';
  if (empty($msg)) {
    $msg = '';
  }
  else {


    $_SESSION['setmsg']     = "<div id='toast-container' class='toast-top-right'><div class='fadeout toast toast-success' aria-live='polite' style=''><div class='toast-message'>$msg</div></div></div>";

  }
}

//Function to display error message
function set_error_msg($msg) { //eg. 'Welcome to your account';
  if (empty($msg)) {
    $msg = '';
  }
  else {


    $_SESSION['setmsg']     = "<div id='toast-container' class='fadeout toast-top-right'><div class='toast toast-error' aria-live='assertive' style=''><div class='toast-message'>$msg</div></div></div>";
  }
}

function display_msg() {
  if (isset($_SESSION['setmsg'])) {
    echo $_SESSION['setmsg'];
    unset($_SESSION['setmsg']);
  }

}