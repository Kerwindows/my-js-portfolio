<?php
//Function to display session messages
function set_msg($msg) { //eg. 'Welcome to your account';
  if (empty($msg)) {
    $msg = '';
  }
  else {
    $_SESSION['setmsg']     = "<div class='alert alert-success alert-dismissible fade show' role='alert'>$msg</div>";

  }
}

//Function to display error message
function set_error_msg($msg) { //eg. 'Welcome to your account';
  if (empty($msg)) {
    $msg = '';
  }
  else {
    $_SESSION['setmsg']     = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>$msg</div>";
  }
}

function display_msg() {
  if (isset($_SESSION['setmsg'])) {
    echo $_SESSION['setmsg'];
    unset($_SESSION['setmsg']);
  }

}