<?php
    require_once "Connection.php";
    $connexion = mysqli_connect($URL, $USER, $MDP);
    // On verifie la connexion
    if (!$connexion) {
        echo "Connexion au serveur impossible\n";
        exit;
    }
    if (!mysqli_select_db($connexion, $BDD)) {
        echo "Accès à la base impossible\n";
        exit;
    }
    mysqli_set_charset($connexion,"utf8");
    // La fonciton isset($_POST["NomChamp"]) retourne True si le champ a été rempli dans le formulaire
    // False sinon
    if (isset($_POST["NumFilm"]) && isset($_POST["Titre"]) && isset($_POST["Realisateur"]) && isset($_POST["Genre"]) && isset($_POST["Annee"])){
        $NumFilm = $_POST["NumFilm"];
        $Titre = $_POST["Titre"];
        $Realisateur = $_POST["Realisateur"];
        $Genre = $_POST["Genre"];
        $Annee = $_POST["Annee"];
        // On initialise la requete dans une variable
        $sql = "INSERT INTO l2_films Values ($NumFilm, ".$Realisateur.", '".$Titre."','".$Genre."','".$Annee."');";
        // On Verifie que la requete soit bien executé
        if(mysqli_query($connexion,$sql)){  
            echo "Film Ajouté<br>";  
        }else{  
            echo "Erreur sur l'ajout :  ".mysqli_error($connexion);  
        }
        // On ferme la connexion
        mysqli_close($connexion);
        // On renvoi sur la page du début et on ferme la fenêtre
        header("Location: http://tp_requettes_php.test/");
        exit();
    }else{
        echo "Veuillez Saisir tout les champs";
        exit();
    }

?>