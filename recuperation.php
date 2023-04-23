<?php
// Récupération des données du formulaire et nettoyage des entrées utilisateur
$type_animal = htmlspecialchars(trim($_POST['type_animal']));
$etat_animal = htmlspecialchars(trim($_POST['etat_animal']));
$ville = htmlspecialchars(trim($_POST['ville']));
$secteur = htmlspecialchars(trim($_POST['secteur']));
$date = htmlspecialchars(trim($_POST['date']));
$heure = htmlspecialchars(trim($_POST['heure']));
$nom_animal = htmlspecialchars(trim($_POST['nom_animal']));
$caracteristiques = htmlspecialchars(trim($_POST['caracteristiques']));
$nom_proprietaire = htmlspecialchars(trim($_POST['nom_proprietaire']));
$email = htmlspecialchars(trim($_POST['email']));
$telephone = htmlspecialchars(trim($_POST['telephone']));
$facebook = htmlspecialchars(trim($_POST['facebook']));

// Vérification des entrées utilisateur
if(empty($type_animal) || empty($etat_animal) || empty($ville) || empty($nom_animal) || empty($nom_proprietaire) || empty($email) || empty($telephone)){
    die("Erreur: Veuillez remplir tous les champs obligatoires");
}

if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    die("Erreur: Adresse email invalide");
}

if(!preg_match("/^[0-9]{10}$/", $telephone)){
    die("Erreur: Numéro de téléphone invalide");
}

// Connexion à la base de données
$host = "localhost";
$user = "utilisateur";
$password = "motdepasse";
$database = "animaux";
$conn = mysqli_connect($host, $user, $password, $database);

// Vérification de la connexion
if (!$conn) {
    die("Connexion à la base de données échouée: " . mysqli_connect_error());
}

// Enregistrement des données dans la base de données
$sql = "INSERT INTO annonces (type_animal, etat_animal, ville, secteur, date, heure, nom_animal, caracteristiques, nom_proprietaire, email, telephone, facebook) 
	VALUES ('$type_animal', '$etat_animal', '$ville', '$secteur', '$date', '$heure', '$nom_animal', '$caracteristiques', '$nom_proprietaire', '$email', '$telephone', '$facebook')";

if (mysqli_query($conn, $sql)) {
    echo "L'annonce a été enregistrée avec succès";
} else {
    echo "Erreur: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>
