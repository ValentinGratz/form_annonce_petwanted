<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Formulaire d'annonce pour animal perdu, volé ou trouvé</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<div class="form-container">

    <form id="form" method="post" enctype="multipart/form-data">

        <!-- Page 1 -->
        <div class="page" id="page1">
            <h2>Informations sur l'annonce</h2>
            <label>Type d'animal:</label>
            <select name="type" required>
                <option value="" selected disabled hidden>Sélectionnez le type d'animal</option>
                <option value="chat">Chat</option>
                <option value="chien">Chien</option>
                <option value="autre">Autre</option>
            </select>
            <br>
            <label>Statut:</label>
            <input type="radio" name="statut" value="trouve" required> Trouvé
            <input type="radio" name="statut" value="perdu"> Perdu
            <input type="radio" name="statut" value="vole"> Volé
            <br>
            <label>Ville:</label>
            <input type="text" name="ville" required>
            <br>
            <label>Secteur:</label>
            <input type="text" name="secteur" required>
            <br>
            <label>Date:</label>
            <input type="date" name="date" required>
            <br>
            <label>Heure:</label>
            <input type="time" name="heure" required>
            <br>
            <button type="button" class="next">Suivant</button>
        </div>

        <!-- Page 2 -->
        <div class="page" id="page2">
            <h2>Informations sur l'animal</h2>
            <label>Nom:</label>
            <input type="text" name="nom" required>
            <br>
            <label>Photo:</label>
            <input type="file" name="photo" accept="image/*" required>
            <br>
            <label>Caractéristiques:</label>
            <textarea name="caracteristiques" required></textarea>
            <br>
            <label>Envoyer une photo:</label>
            <input type="file" name="photo2" accept="image/*">
            <br>
            <button type="button" class="prev">Précédent</button>
            <button type="button" class="next">Suivant</button>
        </div>

        <!-- Page 3 -->
        <div class="page" id="page3">
            <h2>Informations sur le propriétaire</h2>
            <label>Nom:</label>
            <input type="text" name="nom_proprietaire">
            <br>
            <label>Email:</label>
            <input type="email" name="email">
            <br>
            <label>Numéro de téléphone:</label>
            <input type="tel" name="telephone">
            <br>
            <label>Facebook:</label>
            <input type="url" name="facebook">
            <br>
            <button type="button" class="prev">Précédent</button>
            <button type="submit" name="submit">Envoyer</button>
        </div>
    </form>
</div>
<!-- Script pour gérer les pages du formulaire -->
<script>
    $(document).ready(function() {
        var current_page = 1;

        $(".next").click(function() {
            $("#page" + current_page).hide();
            current_page++;
            $("#page" + current_page).show();
        });

        $(".prev").click(function() {
            $("#page" + current_page).hide();
            current_page--;
            $("#page" + current_page).show();
        });
    });
</script>
<!-- Script pour envoyer les données du formulaire -->
<script>
    $(document).ready(function() {
        $("#form").submit(function(event) {
            event.preventDefault();
            var form_data = new FormData(this);
            $.ajax({
                url: "traitement.php",
                type: "POST",
                data: form_data,
                processData: false,
                contentType: false,
                success: function(response) {
                    alert("Annonce enregistrée avec succès!");
                    // Réinitialiser le formulaire
                    $("#form")[0].reset();
                    $("#page1").show();
                    $("#page2").hide();
                    $("#page3").hide();
                }
            });
        });
    });
</script>
</body>
</html>