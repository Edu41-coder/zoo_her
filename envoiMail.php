<?php
$mail = $_POST['mail'];
$nom = $_POST['nom'];
$subject = $_POST['subject'];
$message = $_POST['message'];
$destinataire = 'Eduardo Hermosilla <hehermosilla@gmail.com>';
$headers[] = 'From: ' . $nom . ' <' . $mail . '>';

if (mail($destinataire, $subject, $message, $headers)) {
    header('Location: formulaire_contact.php?message=mailOk');
} else {
    header('Location: formulaire_contact.php?message=mailKo');
}