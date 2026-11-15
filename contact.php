<?php
require_once 'C:/xampp/private_config/mail_config.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

include 'connect.php';
$name = $_POST['name'] ?? ' ';
$phone = $_POST['phone'] ?? ' ';
$email = $_POST['email'] ?? ' ';
$message = $_POST['message'] ?? ' ';

$sql="INSERT INTO contact_details(name,phone,email,message) VALUES('$name','$phone','$email','$message')";
if(mysqli_query($conn,$sql)){
$mail = new PHPMailer(true);

try {
    
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;

    $mail->Username =MAIL_USERNAME; // Your Gmail
    $mail->Password =MAIL_PASSWORD; // Gmail App Password

    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->addAddress(MAIL_USERNAME);

    $mail->addReplyTo($email);

    $mail->Subject = 'New Contact Form Submission';

    $mail->Body =
    "Name: $name\n\n" .
    "Phone: $phone\n\n" .
    "Email: $email\n\n" .
    "Message: $message";

    $mail->send();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Message Sent Successfully</title>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial, sans-serif;
}

body{
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background:linear-gradient(135deg,#ff6b6b,#6c63ff);
}

.success-card{
    background:white;
    width:550px;
    padding:40px;
    border-radius:80px;
    text-align:center;
    box-shadow:0 0 10px #8A2BE2;
    animation:fadeIn 0.8s ease;
}

.checkmark{
    width:100px;
    height:100px;
    background:#28a745;
    color:white;
    border-radius:50%;
    margin:auto;
    font-size:60px;
    line-height:100px;
}

h1{
    color:#28a745;
    margin-top:20px;
    white-space:nowrap;
    font-size:30px;
}

p{
    margin-top:15px;
    color:#555;
    font-size:18px;
    line-height:1.6;
}

.btn{
    display:inline-block;
    margin-top:25px;
    padding:12px 30px;
    background:#6c63ff;
    color:white;
    text-decoration:none;
    border-radius:30px;
    font-size:18px;
    transition:0.3s;
}

.btn:hover{
    transform:scale(1.05);
}

@keyframes fadeIn{
    from{
        opacity:0;
        transform:translateY(30px);
    }
    to{
        opacity:1;
        transform:translateY(0);
    }
}
</style>

</head>
<body>

<div class="success-card">
    <div class="checkmark">✓</div>

    <h1>Message Sent Successfully!</h1>

    <p>
        Thank you for contacting us.<br>
        Your message has been delivered to the administrator.
    </p>

    <a href="home.html" class="btn">Go to Home</a>
</div>

</body>
</html>
<?php
} catch (Exception $e) {
    echo "Email not sent. Error: {$mail->ErrorInfo}";
}
}
else{
echo "Database Error:".mysqli_error($conn);
}
?>