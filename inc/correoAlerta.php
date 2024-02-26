<?php
session_start();
include_once('./conexion.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require('./PHPMailer/src/Exception.php');
require('./PHPMailer/src/PHPMailer.php');
require('./PHPMailer/src/SMTP.php');


$mail = new PHPMailer(true);
if(!isset($_POST['email']) && !isset($_POST['email'])){
    echo "mal";
}else{
    $email = $_POST['email'];
    $restaurante = $_POST['nombre'];
echo $email;
// $email = 'lucaluma2004@gmail.com';

try {
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->SMTPDebug = 0;
    $mail->Host       = 'smtp.office365.com'; // Servidor SMTP de Outlook
    $mail->SMTPAuth   = true;
    $mail->Username   = 'tripadvisordaw@outlook.com'; // Tu dirección de correo de Outlook
    $mail->Password   = 'asdASD123'; // Tu contraseña de Outlook
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Usar STARTTLS para cifrado TLS
    $mail->Port       = 587; // Puerto SMTP de Outlook
    
    $mail->setFrom('tripadvisordaw@outlook.com', 'TripAdvisorDaw');
    $mail->addAddress($email);
    $mail->AddEmbeddedImage('./img/tripadvisor.png', 'logoimg', 'logo.jpg'); 
    $mail->isHTML(true);
    $mail->Subject = 'TripAdvisor | Cambio de Banner';
    $mail->Body = "<img src=\"cid:logoimg\" alt='Banner de TripAdvisor' style='width: 100%; max-width: 600px;'><br><br>
    <p>Se a cambiado la imagen del banner <b>$restaurante</b>.</p>";
    $mail->AltBody = "Se a cambiado el banner de $restaurante";
    $mail->send();
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

unset($mail->SMTPDebug);
}
?>
