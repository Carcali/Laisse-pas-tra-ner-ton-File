<?php

require 'method-get.php';

// Je vérifie si le formulaire est soumis comme d'habitude
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    // Securité en php
    // chemin vers un dossier sur le serveur qui va recevoir les fichiers uploadés (attention ce dossier doit être accessible en écriture)
    $uploadDir = 'public/uploads/';
    // le nom de fichier sur le serveur est ici généré à partir du nom de fichier sur le poste du client (mais d'autre stratégies de nommage sont possibles)
    $uploadFile = $uploadDir . basename($_FILES['avatar']['name']);
    // Je récupère l'extension du fichier
    $extension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
    // Les extensions autorisées
    $authorizedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    // Le poids max géré par PHP par défaut est de 1M
    $maxFileSize = 1000000;

    // Je sécurise et effectue mes tests

    /****** Si l'extension est autorisée *************/
    if ((!in_array($extension, $authorizedExtensions))) {
        $errors[] = 'Veuillez sélectionner une image de type Jpg ou Jpeg ou Png ou Gif ou Webp !';
    }

    /****** On vérifie si l'image existe et si le poids est autorisé en octets *************/
    if (file_exists($_FILES['avatar']['tmp_name']) && filesize($_FILES['avatar']['tmp_name']) > $maxFileSize) {
        $errors[] = "Votre fichier doit faire moins de 1M !";
    }

    /****** On donne un nom unique à notre image ******/
    if ((!in_array($extension, $authorizedExtensions)) && filesize($_FILES['avatar']['tmp_name']) > $maxFileSize) {
        $uniqueName = uniqid('', true);
        $file = $uniqueName . "." . $extension;
        move_uploaded_file($tmpName, './upload/' . $file);
    }

    // Script d'upload ci-dessous

    // Je vérifie que le formulaire est soumis, comme pour tout traitement de formulaire.
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // chemin vers un dossier sur le serveur qui va recevoir les fichiers transférés (attention ce dossier doit être accessible en écriture)
        $uploadDir = 'public/uploads/';

        // le nom de fichier sur le serveur est celui du nom d'origine du fichier sur le poste du client (mais d'autres stratégies de nommage sont possibles)
        $uploadFile = $uploadDir . basename($_FILES['avatar']['name']);

        // on déplace le fichier temporaire vers le nouvel emplacement sur le serveur. Ça y est, le fichier est uploadé
        move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadFile);
    }
}

?>

<!DOCTYPE html>

<form action="/" method="post" enctype="multipart/form-data">
    <label for="firstname">Prénom</label>
    <input type="text" name="firstname" id="firstname" />
    <label for="lastname">Nom</label>
    <input type="text" name="lastname" id="lastname" />
    <label for="age">Âge</label>
    <input type="number" name="age" id="age" />
    <label for="imageUpload">Upload an profile image</label>
    <input type="file" name="avatar" id="imageUpload" />
    <button name="send">Send</button>
</form>