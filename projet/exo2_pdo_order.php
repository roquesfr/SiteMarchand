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
            $utilisateur=$dbase->query("SELECT login FROM utilisateurs ORDER BY login ASC, mail ASC");
            $table=$utilisateur->fetchall(PDO::FETCH_ASSOC);
            echo "<br>Nombre d'utilisateurs ".count($table);
            $i=1;
            foreach($table as $ligne)
            {
                echo "<br>".$i." ".$ligne['login'];
                $i++;
            }

        }
        catch(PDOException $ex)
        {
            die('Erreur d\'insert dans la base de données : '.$ex->getMessage());
        }
    }
