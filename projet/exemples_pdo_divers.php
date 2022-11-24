<?php
    $db='base_pdo';
    $host='localhost';
    $user='root';
    $mdp='12345';
    $dsn="mysql:dbname=$db;host=$host";
    try
    {
        // Connexion à la BDD
        $dbase=new PDO($dsn, $user,$mdp);

        // Active le report des erreurs PDO et les Exceptions PDO
        $dbase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // On peut aussi faire ça pour remplacer ces 2 lignes par une seule, au choix:
        // $dbase=new PDO($dsn, $user,$mdp, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }
    catch(PDOException $ex)
    {
        die('Erreur de connexion à la bdd : '.$ex->getMessage());
    }

    if($dbase)
    {
        // Rechercher un login en particulier dans la table utilisateurs
        //
        $nom='stephane@ldnr.fr';
        echo '<br>$nom avant quote = '.$nom;
        $nom=$dbase->quote($nom);                   // Si données de formulaire on sécurise avec quote
        echo '<br>$nom après l\'appel à quote = '.$nom;
        $marequete='SELECT * FROM utilisateurs WHERE mail='.$nom;       // ma requete mysql
        echo "<br>".$marequete;
        $execrequete=$dbase->query($marequete);
        $result=$execrequete->fetch(PDO::FETCH_ASSOC);   // Retour une ligne (fetch) dans Tableau Associatif
        echo "<pre>";
        var_dump($result);
        echo "</pre>";

        // Utiliser une fonction d'agrégat (ici COUNT) dans une requete et récupérer le résultat
        // 
        $marequete='SELECT COUNT(*) FROM utilisateurs';     // Combien de comptes dans utilisateurs
        $execrequete=$dbase->query($marequete);
        $combien=$execrequete->fetchColumn();               // L'aggregat ne retourne qu'une colonne
        echo 'Nombre de comptes dans la table utilisateurs : '.$combien;

        // Vérifier qu'un compte avec un login particulier et une adresse mail particuliere existe
        // Similaire à l'authentification, ou l'on utilise un login + mdp
        $login=$dbase->quote("sebastien");
        $mail=$dbase->quote("seb@gmail.com");
        $marequete='SELECT COUNT(*) FROM utilisateurs WHERE login='.$login.' AND mail='.$mail;
        $execrequete=$dbase->query($marequete);
        $combien=$execrequete->fetchColumn();
        echo "<br>".$combien;
        if($combien==1)
            {
                echo '<br>un compte existe';
            }
            else
            {
                echo '<br>ce compte avec ce login et cette adresse mail n\'existe pas';
            }
    }
