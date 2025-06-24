<?php


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendRegistrationSuccessEmail($EmailAddress, $FirstName, $LastName)
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
		$mail->setFrom('info@linkwi.co', ' LinkWi');
		$mail->addAddress($EmailAddress, $FirstName . $LastName); // Add a recipient
		$mail->addReplyTo(
			'info@linkwi.co',
			'LinkWi Support Team'
		);

		// // Attachments
		// $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

		// Content
		$url =
			"https://linkwi.co/linkwi/login.php";
		$mail->isHTML(true); // Set email format to HTML
		$mail->Subject =
			"Welcome to LINKWI";
		$mail->Body = "<body style='background-color:#ffffff;'><br />
			  <center>
			    <table style='max-width:500px;background:#fff;margin-top:10px;' 
			    cellpadding='20'>
			      <th>
			        <tr>
			          <td style='text-align:center'>
					  <img width='100%' src=\"http://linkwi.co/images/linkwi-og.webp\" onerror=\"this.onerror=null; this.src='http://linkwi.co/images/linkwi-og.jpg'\" alt='logo'>
			        </td>
			        </tr>
			        
			      </th>
			      <tr >
			        <td style='text-align:center'>Hello $FirstName, we at LinkWi would like to thank you personally for signing up for our service. We created this platform to help entrepreneurs be more creative and innovative. We'd love to hear what you think of our product and how we can improve it. If you have any questions, please contact help@linkwi.co. We are always willing to assist!</td>
			      </tr>
			      
			      <tr>
			        <td style='text-align:center'>To gain access to your dashboard, click the button below.
			        </td>
			      </tr>
			      <tr>
			        <td style='text-align:center;'>
			          <a style='box-sizing:border-box;
			          display:inline-block;
			          text-align:center;
			          border-radius:.25rem;
			          min-width:50%;
			          padding:20px;color: #000;
			          background-color: #ff3b6c;
			          text-decoration:none;' href=\"$url\">
			            <b>LOGIN 
			            </b>
			          </a> 
			        </td>
			      </tr>
			    </table><br />
			    <p>CYVERSIFY LINKWI
			    </p>
			    <p>www.linkwi.co
			    </p>
			  </center>
			</body>";

		$mail->send();
	} catch (Exception $e) {
		echo "<script>alert('Email could not be sent ')</script>";
	}
}