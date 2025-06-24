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



function set_successful_payment_msg($msg,$msg2)
{ //eg. 'Welcome to your account';
    if (empty($msg)) {
        $msg = '';
    } else {
        $_SESSION['setPaymentMsg']     = "<div class='notice d-flex bg-light-success rounded border-success border border-dashed mb-12 p-6'>
                                          <!--begin::Icon-->
                                          <i class='ki-duotone ki-information fs-2tx text-success me-4'>
                                              <span class='path1'></span>
                                              <span class='path2'></span>
                                              <span class='path3'></span>
                                          </i>
                                          <!--end::Icon-->
                                          <!--begin::Wrapper-->
                                          <div class='d-flex flex-stack flex-grow-1'>
                                              <!--begin::Content-->
                                              <div class='fw-semibold'>
                                                  <h4 class='text-gray-900 fw-bold'>$msg</h4>
                                                  <div class='fs-6 text-gray-700'>$msg2</div>
                                              </div>
                                              <!--end::Content-->
                                          </div>
                                          <!--end::Wrapper-->
                                      </div>";
    }
}

function set_error_payment_msg($msg,$msg2)
{ //eg. 'Welcome to your account';
    if (empty($msg)) {
        $msg = '';
    } else {
        $_SESSION['setPaymentMsg']     = "<div class='notice d-flex bg-light-danger rounded border-danger border border-dashed mb-12 p-6'>
                                          <!--begin::Icon-->
                                          <i class='ki-duotone ki-information fs-2tx text-danger me-4'>
                                              <span class='path1'></span>
                                              <span class='path2'></span>
                                              <span class='path3'></span>
                                          </i>
                                          <!--end::Icon-->
                                          <!--begin::Wrapper-->
                                          <div class='d-flex flex-stack flex-grow-1'>
                                              <!--begin::Content-->
                                              <div class='fw-semibold'>
                                                  <h4 class='text-gray-900 fw-bold'>$msg</h4>
                                                  <div class='fs-6 text-gray-700'>$msg2</div>
                                              </div>
                                              <!--end::Content-->
                                          </div>
                                          <!--end::Wrapper-->
                                      </div>";
    }
}
  
function display_payment_message() {
  if (isset($_SESSION['setPaymentMsg'])) {
    echo $_SESSION['setPaymentMsg'];
    unset($_SESSION['setPaymentMsg']);
  }

}