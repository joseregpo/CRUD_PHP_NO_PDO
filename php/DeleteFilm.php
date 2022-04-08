<?php
    require_once "Connection.php";
    $connexion = mysqli_connect($URL, $USER, $MDP);

    if (!$connexion) {
        echo "Connexion au serveur impossible\n";
        exit;
    }
    if (!mysqli_select_db($connexion, $BDD)) {
        echo "Accès à la base impossible\n";
        exit;
    }
    mysqli_set_charset($connexion,"utf8");
    $Numfilm = $_POST["Film"];
    $sql = "DELETE FROM l2_Films WHERE NumFilm = ".$Numfilm.";";
    if(mysqli_query($connexion,$sql)){  
        echo "Film Effacé<br>";  
    }else{  
        echo "Erreur sur le delete ".mysqli_error($connexion);  
    }
    mysqli_close($connexion);
    header("Location: http://tp_requettes_php.test/");
    exit();

?>