<?php
    require "ClasseRef.php";
    class startBDD
    {
            static public PDO $macnx;            // $macnx est de type objet PDO propriété publique statique membre de la classe startBDD

            static public function Init()
            {
                $db='ldnr';
                $host='localhost';
                $user='root';
                $mdp='12345';
                $dsn="mysql:dbname=$db;host=$host";
                try
                {
                    self::$macnx=new PDO($dsn,$user,$mdp,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
                }
                catch(PDOException $ex)
                {
                    Die('Erreur de cnx à la bdd -> '.$ex->getMessage());
                }
                echo "<br>on est connecté!";
            }
           
    }

    startBDD::Init();                   // On lance la connexion à PDO, la méthode statique Init permet d'établir la cnx à la BDD
                                        // On est sur une méthode statique, donc pas d'instanciation de la classe

    $monobj=new ClasseRef();            // On créé une instance de ClasseRef

    $monobj->AfficheUsers();            // Affiche la liste des utilisateurs
