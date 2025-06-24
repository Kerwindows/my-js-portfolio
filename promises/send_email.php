<?php
header('Content-Type: text/html; charset=UTF-8');

require_once '../classes/SendMessage.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check for required fields
    if (!isset($_POST['name'], $_POST['email'], $_POST['message'])) {
        http_response_code(400);
        echo json_encode(["error" => "Missing required fields."]);
        exit;
    }


    // Sanitize inputs with UTF-8 encoding
	$name = str_replace(['<', '>'], '', trim($_POST['name']));
	$email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
	$message = htmlspecialchars(trim($_POST['message']), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8', false);



    // Define character limits
    $nameCharLimit = 50;
    $messageCharLimit = 300;

    // Validate character limits
    if (strlen($name) > $nameCharLimit) {
        http_response_code(400);
        echo json_encode(["error" => "Name exceeds character limit of $nameCharLimit characters."]);
        exit;
    }

    if (strlen($message) > $messageCharLimit) {
        http_response_code(400);
        echo json_encode(["error" => "Message exceeds character limit of $messageCharLimit characters."]);
        exit;
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo json_encode(["error" => "Invalid email address."]);
        exit;
    }

    // Prepare SendMessage instance to send your message
    $sendMessage = new SendMessage();
    $sendMessage->email = 'kerwin@kerwindows.com'; // Your email
    $sendMessage->recipient = $name; // Name of the sender
    $sendMessage->subject = "New Message from $name";
    $sendMessage->body = "From: $name<br>Email: $email<br>Message:<br>$message";

    try {
        // Send the email to you
        $sendMessage->mailMessage();

        // Prepare confirmation message to send back to the sender
        $confirmation = new SendMessage();
        $confirmation->email = $email; // Sender's email
        $confirmation->recipient = $name; // Name of the sender
        $confirmation->subject = "Thank You for Reaching Out, $name";
        $confirmation->body = "
            <h2 style='margin-top: 0;'>Hello $name,</h2>
            <p>Thank you for reaching out! I received your message and will get back to you as soon as possible.</p>
            <p><strong>Your message:</strong></p>
            <div style='padding:10px;background:#f9e7c3;border:1px dashed #eee'>$message</div>
            <p>If you have any additional questions or updates, feel free to reach out again.</p>
            <p>\"The only limit to our realization of tomorrow is our doubts of today.\" - Franklin D. Roosevelt</p>
            <p>Best regards,<br>Kerwin</p>";

        // Send confirmation email to the user
        $confirmation->mailMessage();

        http_response_code(200);
        echo json_encode(["success" => "Message sent successfully! Confirmation email sent to the user."]);
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(["error" => "Failed to send message: " . $e->getMessage()]);
    }
}
?>