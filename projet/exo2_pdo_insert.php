<?php
    $db='base_pdo';
    $host='localhost';
    $user='root';
    $mdp='12345';
    $dsn="mysql:dbname=$db;host=$host";
    try
    {
        $dbase=new PDO($dsn, $user,$mdp);
        $dbase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
    }
    catch(PDOException $ex)
    {
        die('Erreur de connexion à la bdd : '.$ex->getMessage());
        // Cette info est stockée dans un fichier plat (fichier texte de logs)
        // Appel méthode qui va écrire le message dans le fichier log

        // Cette info est stockée dans un bdd
        // Appel méthode qui écrirait le message dans la table dédiée aux logs
    }

    if($dbase)
    {
        try
        {
            $verif=$dbase->exec("INSERT INTO utilisateurs (login,mail,telephone) VALUES ('Sebastien','seb@gmail.com','07.05.03.01.00')");
            $verif=$dbase->exec("INSERT INTO utilisateurs (login,mail,telephone) VALUES ('Camille','camille@gmail.com','07.06.01.02.00')");
            $verif=$dbase->exec("INSERT INTO utilisateurs (login,mail,telephone) VALUES ('Carole','carole@gmail.com','06.52.41.21.00')");
            $verif=$dbase->exec("INSERT INTO utilisateurs (login,mail,telephone) VALUES ('Thierry','thierry@gmail.com','07.06.11.22.33')");
            $verif=$dbase->exec("INSERT INTO utilisateurs (login,mail,telephone) VALUES ('Thierry','thierry@orange.fr','06.25.32.41.65')");
        }
        catch(PDOException $ex)
        {
            die('Erreur d\'insert dans la base de données : '.$ex->getMessage());
        }
    }
