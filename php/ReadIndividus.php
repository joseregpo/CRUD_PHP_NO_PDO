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
    $resultatsIndividus = mysqli_query($connexion, "select * from l2_individus");
    $error = "";
    if (!$resultatsIndividus) {
        $error = mysqli_error($connexion);
    }
    if ($error != "") {
        echo "<p>Erreur : $error</p>\n";
    }
    if ($resultatsIndividus) {
        $LesIndividusArray = array();
        $LesIndividusArray["body"] = array();
        while ($film = mysqli_fetch_array($resultatsIndividus)) {
            $ind = array(
                "NumInd" => $film["NumInd"],
                "Nom" => $film["Nom"],
                "Prenom" => $film["Prenom"],
            );
            array_push($LesIndividusArray["body"], $ind);
        }
        echo json_encode($LesIndividusArray);
    }
    mysqli_close($connexion);
?>