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
    $resultats_films = mysqli_query($connexion, "select * from l2_Films");
    $error = "";
    if (!$resultats_films) {
        $error = mysqli_error($connexion);
    }
    if ($error != "") {
        echo "<p>Erreur : $error</p>\n";
    }
    if ($resultats_films) {
        $LesFimsArray = array();
        $LesFimsArray["body"] = array();
        while ($film = mysqli_fetch_array($resultats_films)) {
            $f = array(
                "NumFilm" => $film["NumFilm"],
                "Titre" => $film["Titre"],
                "Genre" => $film["Genre"],
            );
            array_push($LesFimsArray["body"], $f);
        }
        echo json_encode($LesFimsArray);
    }
    mysqli_close($connexion);
?>