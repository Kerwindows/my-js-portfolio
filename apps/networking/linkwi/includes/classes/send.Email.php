<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


Class sendMessage {

public $email;
public $parent;
public $student;
public $time;
public $date;
public $site_title;
public $site_url;
public $header = 'Linkwi Notification';
public $subject = "Linkwi Message";
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
		    	$this->mail->Username   = 'info@linkwi.co';                     // SMTP username
		    	$this->mail->Password   = 'h4dsh5434561ff4!T';                               // SMTP password
		    	$this->mail->SMTPSecure = 'ssl';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
		    	$this->mail->Port       = 465;                                    // TCP port to connect to
		    	
		
		    	//Recipients
		    	$this->mail->setFrom('no-reply@linkwi.co', $this->header);
		    	$this->mail->addAddress($this->email, $this->site_title );     // Add a recipient
		    	$this->mail->addReplyTo('support@linkwi.co', 'We cannot reply to this email');
		  
			    // Content
		    	
		    	$this->mail->isHTML(true);                                  // Set email format to HTML
		    	$this->mail->Subject = $this->subject;
		    	
		    	$this->mail->Body = "<body style='padding:30px 0;'>
			  
			    <table style='border-radius:4px;
			    margin:0 auto;width:450px;
			    margin-top:20px;
			    box-shadow: 0 1px 3px rgb(0 0 0 / 12%), 0 1px 2px rgb(0 0 0 / 24%);'
			    cellpadding='20'><td>
			            <a href='$this->site_url/$this->button' target='_blank' rel='noopener noreferrer' data-auth='NotApplicable'><img src='http://linkwi.co/images/linkwi-og.webp' alt='logo' width='96px'></a> 
			                 </td>
			                 
			        </tr>
			        <tr>
			        <td><h2>$this->site_title</h2></td>
			        </tr>
			      </th>
			      <tr >
			        <td>$this->body;
			        </td>
			      </tr>
			      
			      <tr>
			        <td style='text-align:center;'>
			          <a style='box-sizing:border-box;
			          display:inline-block;text-align:center;
			          border-radius:8px;min-width:100%;
			          padding:15px;color: #fff;
			          background-color:#000;
			          text-decoration:none;' href='$this->site_url/$this->button'>
			            <b>$this->button_name
			            </b>
			          </a> 
			        </td>
			      </tr>
			    
			    <td style='font-size: 12px; color: rgb(138, 141, 145) !important; line-height: 16px; font-weight: 400;'><hr style='border-top:solid 1px #e5e5e5;width:100%;margin-bottom:20px'>This message was sent to $this->parent as an automated response to a digital purchase made through Linkwi.co.<br aria-hidden='true'>$this->address</td>
			    </table>
			    
			  
			</body>
			";
		    	
		    	
		    	
		    	
		    	$this->mail->AltBody = "$this->body";
		
		    	$this->mail->send();
		    
		} 
		catch (Exception $e) {
	
		} 
	 }
		    


}



?>