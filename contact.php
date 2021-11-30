<?php 
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if (isset($_POST['submit'])) {


$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = "kngautosmail@gmail.com";                     // SMTP username
    $mail->Password   = "test123";                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('kngautosmail@gmail.com');
    $mail->addAddress('kngautoltd@gmail.com');     // Add a recipient

    // Attachments
    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $_POST['email'] . ' From KngAutos.net ' . $_POST['subject'];
    $mail->Body    = $_POST['message'];

    if ($mail->send()) {
	    $affirm = "Thank you for your message, we'll get back to you";
    }else{
    	$error = 'An error occurred, please try again';
    }
    
} catch (Exception $e) {
    $error = 'An error occurred, please try again';
 }

}

if (isset($_POST['submit'])) {
	$name = trim($_POST['fname']);
	$email = trim($_POST['email']);
	$subject = trim($_POST['subject']);
	$message = trim($_POST['message']);

	if (empty($name) || empty($email) || empty($subject) || empty($message)){
		$errorMsg = 'All fields are required, Thanks';
	}
}

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
 	<link rel="stylesheet" href="css/kenneth_index.css?v<?php echo time(); ?>">
 	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
</head>
<body>
  <div class="container">
	<?php include'./inc/header.php' ?>
		
		<?php include'./inc/navbar.php' ?>

	<form action="contact.php" method="POST" class="contactainer">
		<h1>Contact Us</h1>
		<label>Name: </label>
		<input type="text" placeholder="FullName" name="fname"> <br>
		<label>Email: </label>
		<input type="text" placeholder="Email" name="email"> <br>
		<label>Subject: </label>
		<input type="text" placeholder="E.g 'Inquiry'" name="subject"> <br> 
		<textarea placeholder="Tell us your message... " name="message"></textarea>
		<p id="error-text"><?php echo $errorMsg ?? ''; ?></p>
		<input type="submit" value="Send" name="submit">
		<p id="error-text"><?php echo $error ?? '' ?></p>
		<p id="success-text"><?php echo $affirm ?? '' ?></p>
	</form>
</div>
<?php include'./inc/footer.php' ?>
</body>
</html>