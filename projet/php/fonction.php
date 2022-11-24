<?php

/*En travaux...encore */
function cnx_bdd()
    {
        session_start();
        $db='projet';
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
                Die('Erreur de connexion à la bdd : '.$ex->getMessage());
            }
    }

function ajout_panier()
    {
        
    }

?>