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
    $NumInd = $_POST["Individu"];
    $NumFilm = $_POST["Film"];
    if (isset($_POST["Role"])){
        $Role = $_POST["Role"];
        $sql = "INSERT INTO l2_acteurs Values ($NumInd, $NumFilm, '".$Role."');";
        if(mysqli_query($connexion,$sql)){  
            echo "Role Ajouté<br>";  
        }else{  
            echo "Erreur sur l'ajout :  ".mysqli_error($connexion);  
        }
        mysqli_close($connexion);
        header("Location: http://tp_requettes_php.test/");
        exit();
    }else{
        echo "Veuillez Assigner un Role";
        exit();
    }


?>