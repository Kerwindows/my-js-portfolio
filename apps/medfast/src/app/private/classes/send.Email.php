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
public $site_url = "https://curricumate.com";
public $header = 'Curricumate';
public $subject = "Confirm Email";
public $body = 'Welcome';
public $button = 'login.php';
public $button_name = 'Login';



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
		    	
		    	$this->mail->Body = $this->body;
		    	
		    	$this->mail->AltBody = $this->body;
		
		    	$this->mail->send();
		    
		} 
		catch (Exception $e) {
	
		} 
	 }
		    


}



?>