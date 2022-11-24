<?php
session_start();

$champ_rempli=!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['mdp']) && !empty($_POST['mail']) && !empty($_POST['telephone']);
$nom_valide=preg_match('/([a-zA-Z]|[\'.-]|[[:blank:]])+/',$_POST['nom']);
$prenom_valide=preg_match('/([a-zA-Z]|[\'.-]|[[:blank:]])+/',$_POST['prenom']);
$email_valide=preg_match('/^([a-zA-Z]|[0-9]|[-_.])+@([a-zA-Z]|[0-9]|[-_.])+[.][a-z]+$/',$_POST['mail']); //commence par lettre ou chiffre ou -_. plusieurs fois @ idem . lettre minuscule plusieurs fois
$telephone_valide=preg_match('/^[0-9]{2}[.][0-9]{2}[.][0-9]{2}[.][0-9]{2}[.][0-9]{2}$/',$_POST['telephone']);// 2 chiffres. ... => 14 au total
if($champ_rempli && $email_valide && $telephone_valide && $nom_valide && $prenom_valide)
    {

        require_once('classe.php');
        $connexion=new Cnx_bdd();


        $nom=Cnx_bdd::$dbase->quote($_POST['nom']); // echappe les caractères qui peuvent causer problèmes mais sont parfois enkikinante pour echo 
        $prenom=Cnx_bdd::$dbase->quote($_POST['prenom']);
        $mdp=Cnx_bdd::$dbase->quote($_POST['mdp']);
        $mail=Cnx_bdd::$dbase->quote($_POST['mail']);
        $telephone=Cnx_bdd::$dbase->quote($_POST['telephone']);

        $session_nom=Cnx_bdd::$dbase->quote($_SESSION['nom']);
        $session_prenom=Cnx_bdd::$dbase->quote($_SESSION['prenom']);
        $session_mdp=Cnx_bdd::$dbase->quote($_SESSION['mdp']);
        $session_mail=Cnx_bdd::$dbase->quote($_SESSION['mail']);
        $session_telephone=Cnx_bdd::$dbase->quote($_SESSION['telephone']);


        // On vérifie que les nouvelles valeurs ne sont pas les mêmes que les anciennes avant de les maj
        if(Cnx_bdd::$dbase->quote($_SESSION['nom'])!=$nom) // les deux doivent être entre quote pour être == ...Bizarre
            {
                try
                    {   
                        $update=new Execute();
                        $update->Exec("UPDATE utilisateurs SET nom=$nom WHERE nom=$session_nom");
                        $_SESSION['nom']=$_POST['nom'];

                    }
                catch(PDOException $ex)
                    {
                        Die('Erreur de connexion à la bdd : '.$ex->getMessage());
                    }
            }
            
        if(Cnx_bdd::$dbase->quote($_SESSION['prenom'])!=$prenom) 
            {
                try
                    {
                        $update=new Execute();
                        $update->Exec("UPDATE utilisateurs SET prenom=$prenom WHERE prenom=$session_prenom");
                        $_SESSION['prenom']=$_POST['prenom'];

                    }
                catch(PDOException $ex)
                    {
                        Die('Erreur de connexion à la bdd : '.$ex->getMessage());
                    }
            }
        
        if(Cnx_bdd::$dbase->quote($_SESSION['mdp'])!=$mdp) 
            {
                try
                    {
                        $update=new Execute();
                        $update->Exec("UPDATE utilisateurs SET mdp=$mdp WHERE mdp=$session_mdp");
                        $_SESSION['mdp']=$_POST['mdp'];

                    }
                catch(PDOException $ex)
                    {
                        Die('Erreur de connexion à la bdd : '.$ex->getMessage());
                    }
            }
            
        if(Cnx_bdd::$dbase->quote($_SESSION['mail'])!=$mail) 
            {
                try
                    {
                        $update=new Execute();
                        $update->Exec("UPDATE utilisateurs SET mail=$mail WHERE mail=$session_mail");
                        $_SESSION['mail']=$_POST['mail'];
                    }
                catch(PDOException $ex)
                    {
                        Die('Erreur de connexion à la bdd : '.$ex->getMessage());
                    }
            }

        if(Cnx_bdd::$dbase->quote($_SESSION['telephone'])!=$telephone) 
            {
                try
                    {
                        $update=new Execute();
                        $update->Exec("UPDATE utilisateurs SET telephone=$telephone WHERE telephone=$session_telephone");
                        $_SESSION['telephone']=$_POST['telephone'];
                    }
                catch(PDOException $ex)
                    {
                        Die('Erreur de connexion à la bdd : '.$ex->getMessage());
                    }
            }   
    }
    //else { echo 'Tous les champs ne sont pas remplis';}
    header('Location:../html/profil.php'); // redirige vers profil
?>