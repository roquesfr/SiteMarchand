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
    }

    if($dbase)
    {
        try
        {
            $verif=$dbase->query("SELECT * FROM technos WHERE techno='PGSQL'");
            $result=$verif->fetchall(PDO::FETCH_ASSOC);
            if(count($result)==0)
            {
                $requete="INSERT INTO technos (techno) VALUES ('PGSQL')";
                $dbase->exec($requete);
            }

            $verif=$dbase->query("SELECT * FROM technos WHERE techno='Java'");
            $result=$verif->fetchall(PDO::FETCH_ASSOC);
            if(count($result)==0)
            {
                $requete="INSERT INTO technos (techno) VALUES ('Java')";
                $dbase->exec($requete);
            }

            $verif=$dbase->query("SELECT * FROM technos WHERE techno='Java_Erreur'");
            $result=$verif->fetchall(PDO::FETCH_ASSOC);
            if(count($result)==0)
            {
                $requete="INSERT INTO technos (techno) VALUES ('Java_Erreur')";
                $dbase->exec($requete);
            }

        }
        catch(PDOException $ex)
        {
            die('Erreur d\'insert dans la base de données : '.$ex->getMessage());
        }
    }
