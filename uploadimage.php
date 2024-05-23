<?php
$dossier = "image/";
$extension = pathinfo($_FILES["image_id"]["name"], PATHINFO_EXTENSION); 

$erreurImage = "";

if (in_array(strtolower($extension), ['jpg', 'jpeg', 'png'])) {
    $nomRandom = uniqid() . '.' . $extension;
    $cible = $dossier . $nomRandom;
    $fichier = $_FILES['image_id']['tmp_name'];
    $upload = move_uploaded_file($fichier, $cible);

    if (!$upload) {
        $erreurImage = "erreurImage";
    }
} else {
    $erreurImage = "erreurImageExtension";
}