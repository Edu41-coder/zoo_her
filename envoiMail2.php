<?php
$mail = $_POST['mail'];
$nom = $_POST['nom'];
$subject = $_POST['subject'];
$message = $_POST['message'];
$destinataire = 'Eduardo Hermosilla <hehermosilla@gmail.com>';

$headers = "From: $nom <$mail>" . "\r\n";
$headers .= "Reply-To: $mail" . "\r\n";
$headers .= "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

if (mail($destinataire, $subject, $message, $headers)) {
    header('Location: formulaire_contact.php?message=mailOk');
} else {
    header('Location: formulaire_contact.php?message=mailKo');
}