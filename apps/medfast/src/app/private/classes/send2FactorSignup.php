<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


Class SendMessage {

public $email;
public $token;
public $time;
public $date;
public $site_title = 'Curricumate AI Teaching Assistant';
public $site_url;
public $header = 'Curricumate';
public $subject = "Confirm Email";
public $body = 'Welcome';
public $button = 'login.php';
public $button_name = 'Login';
public $address = "";


public function __construct()
		    {
		   
		    require 'PHPMailer/src/Exception.php';
		    require 'PHPMailer/src/PHPMailer.php';
		    require 'PHPMailer/src/SMTP.php';
		    $this->mail = new PHPMailer(true); 
		    
		    
		    }
		    
public function mailMessage(){	
	        
		        try {
			//Server settings
		  	$this->mail->SMTPDebug = 0;
		    	$this->mail->isSMTP();                                            // Send using SMTP
		    	$this->mail->Host       = 'mail.supremecluster.com';                    // Set the SMTP server to send through
		    	$this->mail->SMTPAuth   = true;                                   // Enable SMTP authentication
		    	$this->mail->Username   = 'info@curricumate.com';                     // SMTP username
		    	$this->mail->Password   = 'h4dsh5434561ff4!T';                               // SMTP password
		    	$this->mail->SMTPSecure = 'ssl';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
		    	$this->mail->Port       = 465;                                    // TCP port to connect to
		    	
		
		    	//Recipients
		    	$this->mail->setFrom('info@curricumate.com', $this->header);
		    	$this->mail->addAddress($this->email, $this->site_title );     // Add a recipient
		    	$this->mail->addReplyTo('support@curricumate.com', 'We cannot reply to this email');
		  
			    // Content
		    	
		    	$this->mail->isHTML(true);                                  // Set email format to HTML
		    	$this->mail->Subject = $this->subject;
		    	
		    	$this->mail->Body = '
<style>html,body { padding: 0; margin:0; }</style>
<div style="font-family:Arial,Helvetica,sans-serif; line-height: 1.5; font-weight: normal; font-size: 15px; color: #2F3044; min-height: 100%; margin:0; padding:0; width:100%; background-color:#edf2f7">
	<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse;margin:0 auto; padding:0; max-width:600px">
		<tbody>
			<tr>
				<td align="center" valign="center" style="text-align:center; padding: 40px">
					<a href="https://curricumate.com" rel="noopener" target="_blank">
						<img alt="Logo" src="https://curricumate.com/assets/media/logos/landing-dark.png" />
					</a>
				</td>
			</tr>
			<tr>
				<td align="left" valign="center">
					<div style="text-align:left; margin: 0 20px; padding: 40px; background-color:#ffffff; border-radius: 6px">
						<!--begin:Email content-->
						<div style="padding-bottom: 30px; font-size: 17px;">
							<strong>Hello!</strong>
						</div>
						<div style="padding-bottom: 30px">You are receiving this email because we received a password reset request for your account. To proceed with the password reset please click on the button below:</div>
						<div style="padding-bottom: 40px; text-align:center;">
							<a href="https://curricumate.com/new-password/'.$this->token.'" rel="noopener" style="text-decoration:none;display:inline-block;text-align:center;padding:12px 20px;font-size:15px;line-height:1.5;border-radius:5.6px;color:#ffffff;background-color:#009ef7;border:0px;margin-right:12px!important;font-weight:600!important;outline:none!important;vertical-align:middle" target="_blank">Reset Password</a>
						</div>
						<div style="padding-bottom: 30px">This password reset link will expire in 60 minutes. If you did not request a password reset, no further action is required.</div>
						<div style="border-bottom: 1px solid #eeeeee; margin: 15px 0"></div>
						<div style="padding-bottom: 50px; word-wrap: break-all;">
							<p style="margin-bottom: 10px;">Button not working? Try pasting this URL into your browser:</p>
							<a href="https://curricumate.com/new-password/'.$this->token.'" rel="noopener" target="_blank" style="text-decoration:none;color: #009ef7">https://curricumate.com/new-password/'.$this->token.'</a>
						</div>
						<!--end:Email content-->
						<div style="padding-bottom: 10px">Kind regards,
						<br>Curricumate Team.
						<tr>
							<td align="center" valign="center" style="font-size: 13px; text-align:center;padding: 20px; color: #6d6e7c;">
								<p>Copyright &copy;
								<a href="https://curricumate.com" rel="noopener" target="_blank">Curricumate</a>.</p>
							</td>
						</tr></br></div>
					</div>
				</td>
			</tr>
		</tbody>
	</table>
</div>';
		    	
		    	$this->mail->AltBody = '';
		
		    	$this->mail->send();
		    
		} 
		catch (Exception $e) {
	
		} 
	 }
		    


}



?>