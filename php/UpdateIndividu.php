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
    $NumInd = verify_champ($_POST["Individu"]);
    $Nom = verify_champ($_POST["Nom"]);
    $Prenom = verify_champ($_POST["Prenom"]);
    // On initialise la requete dans une variable
    $sql = "";
    if ($Nom != -1){
        $sql .= "UPDATE l2_Individus SET Nom = '".$Nom."' WHERE NumInd = $NumInd;";
    }
    if($Prenom != -1){
        $sql .= "UPDATE l2_Individus SET Prenom = '".$Prenom."' WHERE NumInd = $NumInd;";
    }
    // On Verifie que la requete soit bien executé
    if(mysqli_multi_query($connexion,$sql)){
        echo "Individu Mis à jour<br>";  
    }else{  
        echo "Erreur sur la mise à jour :  ".mysqli_error($connexion);  
    }
    // On ferme la connexion
    mysqli_close($connexion);
    // On renvoi sur la page du début et on ferme la fenêtre
    header("Location: http://tp_requettes_php.test/");
    exit();
    

?>