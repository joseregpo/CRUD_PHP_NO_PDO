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

    function verify_champ($UnChamp){
        if (isset($UnChamp)){
            return $UnChamp;
        }else{
            return -1;
        }
    }
    // La fonciton isset($_POST["NomChamp"]) retourne True si le champ a été rempli dans le formulaire
    // False sinon 
    $NumFilm = verify_champ($_POST["NumFilm"]);
    $Titre = verify_champ($_POST["Titre"]);
    $Realisateur = verify_champ($_POST["Realisateur"]);
    $Genre = verify_champ($_POST["Genre"]);
    $Annee = verify_champ($_POST["Annee"]);

    // On Verifie le Realisateur
    if ($Realisateur == "Aucun"){
        $Realisateur = -1;
    }
    // On initialise la requete dans une variable
    $sql = "";
    if ($Titre != -1){
        $sql .= "UPDATE l2_films SET Titre = '".$Titre."' WHERE NumFilm = $NumFilm;";
    }
    if($Realisateur != -1){
        $sql .= "UPDATE l2_films SET NumInd = $Realisateur WHERE NumFilm = $NumFilm;";
    }
    if($Genre != -1){
        $sql .= "UPDATE l2_films SET Genre = '".$Genre."' WHERE NumFilm  = $NumFilm;";
    }
    if($Annee != -1){
        $sql .= "UPDATE l2_films SET Annee  = '".$Annee."' WHERE NumFilm  = $NumFilm;";
    }
    // On Verifie que la requete soit bien executé
    if(mysqli_multi_query($connexion,$sql)){
        echo "Film Mis à jour<br>";  
    }else{  
        echo "Erreur sur la mise à jour :  ".mysqli_error($connexion);  
    }
    // On ferme la connexion
    mysqli_close($connexion);
    // On renvoi sur la page du début et on ferme la fenêtre
    header("Location: http://tp_requettes_php.test/");
    exit();
    

?>