<?php
// Vérifier si le formulaire est soumis 
if (isset($_GET['submit'])) {
    /* récupérer les données du formulaire en utilisant 
        la valeur des attributs name comme clé 
       */
    $nom = $_GET['firstname'];
    $nom = $_GET['lastname'];
    $age = $_GET['age'];
    $image = $_GET['avatar'];
    // afficher le résultat
    echo '<h3>Informations récupérées en utilisant GET</h3>';
    echo 'Nom : ' . $nom . ' Age : ' . $age . ' Image : ' . $image;
    exit;
}
