<?php

/**
 * _gestionBase.inc
 * Gitversion ??
 * PHP version 7
 *
 * Ce fichier regroupe les fonctions de gestion de la base de données "festival"
 * @author Pv
 * @version 1.0
 * @package Festival
 */

/**
 * Retourne un gestionnaire de connexion.
 *
 * Se connecte à la base de données "Projeteshop" du serveur de bases de données MYSQL et retourne un gestionnaire de connexion
 * 
 * @return PDO|null Un objet PDO en cas de succès, "null" en cas d'echec
 */
/*
 
function gestionnaireDeConnexion() {
    $pdo = null;
    try {
        $pdo = new PDO(
                'mysql:host=localhost;dbname=Projeteshop', 'root', 'root', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
        );
    } catch (PDOException $err) {
        $messageErreur = $err->getMessage();
        error_log($messageErreur, 0);
    }
    return $pdo;
}

*/

function verification($login, $password) {
    $compteExistant = false;
    $pdo = gestionnaireDeConnexion();
    if ($pdo != null) {
        $sql = "SELECT count(*) as nb FROM client "
                . " WHERE login=:login AND password=:password";
        $prep = $pdo->prepare($sql);
        $prep->bindParam(':login', $login, PDO::PARAM_STR);
        $prep->bindParam(':password', $password, PDO::PARAM_STR);
        $prep->execute();
        $resultat = $prep->fetch();
        if ($resultat["nb"] == 1) {
            $compteExistant = true;
        }
        $prep->closeCursor();
    }
    return $compteExistant;
}


?>