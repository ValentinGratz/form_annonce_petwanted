<?php

// Vérifier si le formulaire a été soumis
if (isset($_POST['submit'])) {

    // Récupérer les données du formulaire
    $type_animal = $_POST['type_animal'];
    $etat_animal = $_POST['etat_animal'];
    $ville = $_POST['ville'];
    $secteur = $_POST['secteur'];
    $date = $_POST['date'];
    $heure = $_POST['heure'];
    $nom_animal = $_POST['nom_animal'];
    $caracteristiques = $_POST['caracteristiques'];
    $nom_proprietaire = $_POST['nom_proprietaire'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $facebook = $_POST['facebook'];

    // Vérifier si un fichier a été téléchargé
    if (isset($_FILES['photo_animal']) && $_FILES['photo_animal']['error'] == 0) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["photo_animal"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $extensions_arr = array("jpg","jpeg","png","gif");
        // Vérifier si le fichier est une image
        if (in_array($imageFileType,$extensions_arr)) {
            // Déplacer le fichier téléchargé vers le dossier des téléchargements
            move_uploaded_file($_FILES['photo_animal']['tmp_name'],$target_dir.$_FILES['photo_animal']['name']);
        }
    }

    // Enregistrer les données dans la base de données
    $servername = "localhost";
    $username = "username";
    $password = "password";
    $dbname = "myDB";

    // Connexion à la base de données
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Vérifier la connexion
    if ($conn->connect_error) {
        die("La connexion a échoué: " . $conn->connect_error);
    }

    // Préparer la requête SQL
    $sql = "INSERT INTO annonces (type_animal, etat_animal, ville, secteur, date, heure, nom_animal, caracteristiques, photo_animal, nom_proprietaire, email, telephone, facebook) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssssssss", $type_animal, $etat_animal, $ville, $secteur, $date, $heure, $nom_animal, $caracteristiques, $target_file, $nom_proprietaire, $email, $telephone, $facebook);

    // Exécuter la requête SQL
    if ($stmt->execute()) {
        echo "Annonce enregistrée avec succès!";
    } else {
        echo "Une erreur est survenue: " . $stmt->error;
    }

    // Fermer la connexion à la base de données
    $stmt->close();
    $conn->close();

}

?>