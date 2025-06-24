<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


Class SendMessage {

public $email;
public $recipient;
public $site_title = 'Message from Porfolio Contact Form';
public $site_url = "https://fs.kerwindows.com/";
public $header = 'Kerwin Thompson Porfolio Contact Form';
public $subject = "Porfolio Contact Form Alert";
public $body = 'Someone sent you a message';


public function __construct()
		    {
		   
		    require_once 'PHPMailer/src/Exception.php';
		    require_once 'PHPMailer/src/PHPMailer.php';
		    require_once 'PHPMailer/src/SMTP.php';
		    $this->mail = new PHPMailer(true); 
		    
		    
		    }
		    
public function mailMessage() {    
    try {
        // Server settings
        $this->mail->SMTPDebug = 0;
        $this->mail->isSMTP();
        $this->mail->Host       = 'mail.supremecluster.com';
        $this->mail->SMTPAuth   = true;
        $this->mail->Username   = 'info@kodelamp.com';
        $this->mail->Password   = '31s5tRKmC-';
        $this->mail->SMTPSecure = 'ssl';
        $this->mail->Port       = 465;

        // Recipients
        $this->mail->setFrom('info@kodelamp.com', $this->header);
        $this->mail->addAddress($this->email, $this->site_title);
        $this->mail->addReplyTo('kerwin@kerwindows.com', 'No reply');

        // Content
        $this->mail->isHTML(true);
        $this->mail->Subject = $this->subject;
        $this->mail->Body = "
        <body style='font-family: Arial, sans-serif; margin: 0; padding: 20px; background-color: #f4f4f4;'>
            <table style='max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);'>
                <!-- Header Section -->
                <tr style='background-color: #0073e6; color: #ffffff; padding: 20px; text-align: center;'>
                    <td style='padding: 20px;'>
                        <a href='{$this->site_url}' style='display: inline-block; text-decoration: none;'>
                            <img src='{$this->site_url}/img/kodelamp.jpg' alt='Logo' style='width: 80px;border-radius: 10px;'>
                        </a>
                        <h1 style='font-size: 24px; margin: 10px 0;'>{$this->site_title}</h1>
                    </td>
                </tr>

                <!-- Message Section -->
                <tr>
                    <td style='padding: 30px; font-size: 16px; color: #333333;'>
                        
                        <p>{$this->body}</p>
                        <a href='{$this->site_url}' target='_blank' style='display: inline-block; padding: 10px 20px; margin-top: 20px; background-color: #0073e6; color: #ffffff; text-decoration: none; border-radius: 4px;'>Visit Portfolio</a>
                    </td>
                </tr>

                <!-- Footer Section -->
                <tr>
                    <td style='padding: 20px; font-size: 12px; text-align: center; color: #888888; background-color: #f9f9f9;'>
                        <p style='margin: 0;'>This message was sent from Kerwin Thompson at your request.</p>
                        <p style='margin: 20px 0 0; font-size: 10px;'>© ".date('Y')." Kerwin's portfolio email messaging. All rights reserved.</p>
                    </td>
                </tr>
            </table>
        </body>";
        
        $this->mail->AltBody = strip_tags($this->body);
        $this->mail->send();
    } catch (Exception $e) {
        throw new Exception("Message could not be sent. Mailer Error: {$this->mail->ErrorInfo}");
    }
}


}