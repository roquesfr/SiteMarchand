<?php


    $champ_rempli=!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['mdp']) && !empty($_POST['mdp2']) && !empty($_POST['mail']) && !empty($_POST['telephone']);
    $mdp_identique=$_POST['mdp']===$_POST['mdp2'] ;
    $nom_valide=preg_match('/([a-zA-Z]|[\'.-])+/',$_POST['nom']);
    $prenom_valide=preg_match('/([a-zA-Z]|[\'.-])+/',$_POST['prenom']);
    $email_valide=preg_match('/^([a-zA-Z]|[0-9]|[-_.])+@([a-zA-Z]|[0-9]|[-_.])+[.][a-z]+$/',$_POST['mail']); //commence par lettre ou chiffre ou -_. plusieurs fois @ idem . lettre minuscule plusieurs fois
    $telephone_valide=preg_match('/^[0-9]{2}[.][0-9]{2}[.][0-9]{2}[.][0-9]{2}[.][0-9]{2}$/',$_POST['telephone']);// 2 chiffres. ... => 14 au total
    //var_dump($matches); $matches est le 3eme paramètres de preg_match

    if($champ_rempli && $mdp_identique && $nom_valide && $prenom_valide &&  $email_valide && $telephone_valide)// on vérifie que tous les champs ne sont pas vides et que le mdp et la confirmation de mdp sont identique
        {                             
            require_once('classe.php');
            $connexion=new Cnx_bdd();
            
            $nom=Cnx_bdd::$dbase->quote($_POST['nom']); // echappe les caractères qui peuvent causer problèmes
            $prenom=Cnx_bdd::$dbase->quote($_POST['prenom']);
            $mdp=Cnx_bdd::$dbase->quote($_POST['mdp']);
            $mdp=Cnx_bdd::$dbase->quote($_POST['mdp2']);
            $mail=Cnx_bdd::$dbase->quote($_POST['mail']);
            $telephone=Cnx_bdd::$dbase->quote($_POST['telephone']);

            /* on vérifie si il existe un compte avec ce mail s on en trouve 1 on s'arrete*/
            $affiche=new Affiche();
            $affiche->AfficheTout("SELECT mail FROM utilisateurs WHERE mail=$mail LIMIT 1");

            if (count(Affiche::$tableau)==0)
                {   
                    try
                        {
                            //echo 'Le compte est crée.' ;
                            $insert=new Execute();
                            $insert->Exec("INSERT INTO utilisateurs (nom, prenom, mdp, mail, telephone) VALUES ($nom,$prenom,$mdp,$mail,$telephone)");


                            header('Location:../html/connexion.php');
                        }
                    catch(PDOException $ex)
                        {
                            header('Location:../html/inscription.php'); // redirige vers page d'accueil
                        }
                }
            else
                {       
                    echo 'Mail déjà existant';
                }
            
            
        }
    else { echo 'Tous les champs ne sont pas remplis<br>OU<br>Confirmation mot de passe différents du mot de passe choisi<br>OU<br> Non conformité des champs';}
