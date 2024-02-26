<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require('./PHPMailer/src/Exception.php');
require('./PHPMailer/src/PHPMailer.php');
require('./PHPMailer/src/SMTP.php');

function generarCodigo() {
    $codigo = rand(10000, 99999);
    return $codigo;
}

$mail = new PHPMailer(true);
if(!isset($_POST['email'])){
    echo "mal";
}else{
    $email = $_POST['email'];

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
    $codigoAleatorio = generarCodigo();
    $mail->isHTML(true);
    $mail->Subject = 'TripAdvisor | Codigo de un Uso';
    $mail->Body = "<img src=\"cid:logoimg\" alt='Banner de TripAdvisor' style='width: 100%; max-width: 600px;'><br><br>
    <p>Bienvenido/a a <b>TripAdvisor</b>,  su codigo de verificación es: <b> $codigoAleatorio  </b></p>";
    $mail->AltBody = 'Confirma tu registro con el siguiente codigo';
    $mail->send();
    echo $codigoAleatorio;
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

unset($mail->SMTPDebug);
}
?>
