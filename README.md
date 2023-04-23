# form_annonce_petwanted
Formulaire de création d'annonce d'animaux perdu/trouvé... réalisé par ChatGPT

J'ai voulu testé ChatGPT pour vous par curiosité ce qu'il pouvais faire.

Donc, je lui ai demander de : 
créer une formulaire html/css/javascript avec récupération dans une base de données, pour un animal perdu, volé ou trouvé

dans ce formulaire multi-étape je veux : 

- en page 1
le type de l'animal
s'il à été trouvé, perdu, volé
la ville, et le secteur
date et heure 

- en page 2 sur l'animal
nom de l'animal
photo de l'animal
caractéristiques de l'animal en champs textarea
un champ pour envoyer une photo de l'animal

- en page 3 sur le propriétaire
nom du propriétaire
email
numéro de téléphone
facebook

et un bouton submit qui permets de l'envoyer à une base de donnés et de pouvoir récupérer la photo

crée aussi une page qui réunit toutes les informations saisies pour vérifier si rien ne manque. 
Avec aussi un contrôle des champs pour ne pas y inclure de code malveillant, ainsi que le dossier réception de l'upload des données. 



L'envoi de fichiers (tels que des images) à partir d'un formulaire HTML nécessite l'utilisation de la méthode de formulaire enctype multipart/form-data et de la fonctionnalité de traitement de fichiers de PHP.

Pour recevoir et enregistrer les images soumises dans le formulaire, vous pouvez utiliser la fonctionnalité move_uploaded_file() de PHP. Cette fonction déplace le fichier téléchargé depuis le répertoire temporaire vers l'emplacement souhaité sur le serveur.

Voici un exemple de code PHP pour recevoir une image téléchargée et la stocker dans un dossier images sur le serveur : (pas encore appliqué)
```
<?php
if(isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
    $target_dir = "images/";
    $target_file = $target_dir . basename($_FILES["photo"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
    // Vérifie si le fichier est une image
    $check = getimagesize($_FILES["photo"]["tmp_name"]);
    if($check === false) {
        echo "Le fichier n'est pas une image.";
    }
    // Vérifie la taille maximale du fichier
    else if ($_FILES["photo"]["size"] > 500000) {
        echo "Désolé, votre fichier est trop volumineux.";
    }
    // Autorise uniquement certains formats de fichier
    else if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Désolé, seuls les fichiers JPG, JPEG, PNG et GIF sont autorisés.";
    }
    // Si tout est ok, déplace le fichier téléchargé vers le dossier images
    else if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
        echo "Le fichier ". htmlspecialchars( basename( $_FILES["photo"]["name"])). " a été téléchargé.";
    } else {
        echo "Une erreur s'est produite lors du téléchargement de votre fichier.";
    }
}
?>

```

Dans cet exemple, la variable $_FILES['photo'] contient les informations sur le fichier envoyé par le formulaire. La fonction move_uploaded_file() déplace le fichier de son emplacement temporaire vers le dossier images sur le serveur.

Notez que vous devez vous assurer que le dossier images sur le serveur a les bonnes permissions pour que PHP puisse y écrire.


# Problème rencontré

J'ai testé en local avec les identifiants de connexion (aucune erreur de ce côté)
le formulaire s'envoi, je n'ai pas de problème sur le front (en fin de formulaire), par contre dans la base de données, malgrès que le script de cfréation fonctionnne, je n'ai pas de nouvelle ligne ajouté suite à cet enregistrement. 
