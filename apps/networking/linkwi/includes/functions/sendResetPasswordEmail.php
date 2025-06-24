<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendResetPasswordEmail($EmailAddress, $FirstName, $LastName,$token)
{

	// Import PHPMailer classes into the global namespace

	// These must be at the top of your script, not inside a function

	// Load  autoloader
	require 'PHPMailer/src/Exception.php';
	require 'PHPMailer/src/PHPMailer.php';
	require 'PHPMailer/src/SMTP.php';

	// Instantiation and passing `true` enables exceptions
	$mail = new PHPMailer(true);

	try {
		//Server settings

		$mail->isSMTP(); // Send using SMTP
		$mail->Host = 'mail.supremecluster.com'; // Set the SMTP server to send through
		$mail->SMTPAuth = true; // Enable SMTP authentication
		$mail->Username = 'info@linkwi.co'; // SMTP username
		$mail->Password = 'h4dsh5434561ff4!T'; // SMTP password
		$mail->SMTPSecure = 'ssl'; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
		$mail->Port = 465; // TCP port to connect to

		//Recipients
		$mail->setFrom('info@linkwi.co', 'Your Password Reset Link');
		    	$mail->addAddress($EmailAddress, 'LinkWi DigitalBusiness Cards');     // Add a recipient
		    	$mail->addReplyTo('no-reply@linkwi.co', 'We cannot reply to this email');
		  
			    // Content
		    	$url = "https://" .$_SERVER["HTTP_HOST"] . dirname($_SERVER["PHP_SELF"]) . "/new-password.php?reset=$token";
		    	$mail->isHTML(true);                                  // Set email format to HTML
		    	$mail->Subject = "LINKWI Password Change Request";
		    	
		$mail->Body = "<body style='padding:30px 0;'>
			  
			    <table style='border-radius:4px;
			    margin:0 auto;width:450px;
			    margin-top:20px;
			    box-shadow: 0 1px 3px rgb(0 0 0 / 12%), 0 1px 2px rgb(0 0 0 / 24%);'
			    cellpadding='20'>
			      <th><td'>
			            <a href='https://linkwi.co/linkwi/login.php' target='_blank' rel='noopener noreferrer' data-auth='NotApplicable'><img src='https://linkwi.co/linkwi/images/icons/link-icon.jpg' alt='logo'></a>
			                 </td>
			        </tr>
			     
			      </th>
			      <tr >
			        <td>Hi $FirstName ,<br/> <br/><br/>We received a request to reset the password for your LINKWI Digital Business Card. If this is not you, please disregard this email.<br/><br/><br/> To change your password click the button below.
			        </td>
			      </tr>
			      
			      <tr>
			        <td style='text-align:center;'>
			          <a style='box-sizing:border-box;
			          display:inline-block;text-align:center;
			          border-radius:8px;min-width:100%;
			          padding:15px;color: #fff;
			          background-color:#007bff;
			          text-decoration:none;
			          ' href=\"$url\">
			            <b>CHANGE PASSWORD
			            </b>
			          </a> 
			        </td>
			      </tr>
			    
			    <td style='font-size: 12px; color: rgb(138, 141, 145) !important; line-height: 16px; font-weight: 400;'><hr style='border-top:solid 1px #e5e5e5;width:100%;margin-bottom:20px'>This message was sent to <a href='mailto:$EmailAddress' target='_blank' rel='noopener noreferrer' data-auth='NotApplicable' style='color: rgb(27, 116, 228) !important; text-decoration: none;' data-linkindex='3'>$EmailAddress</a> at your request.<br aria-hidden='true'>LINKWI DIGITAL BUSINESS CARDS</td>
			    </table>
			    
			  
			</body>";

		$mail->send();
	} catch (Exception $e) {
		echo "<script>alert('Email could not be sent ')</script>";
	}
}