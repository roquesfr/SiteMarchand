<?php

    /*Connexion bdd */
    if(!empty($_POST['mail']) && !empty($_POST['mdp']))
    {

        require_once('classe.php');
        $connexion=new Cnx_bdd();


        /*Vérifie que le mail et le mdp sont identiques avec la bdd et connexion session */
        $mdp=Cnx_bdd::$dbase->quote($_POST['mdp']);
        $mail=Cnx_bdd::$dbase->quote($_POST['mail']);
        $affiche=new Affiche();
        $affiche->AfficheTout("SELECT * FROM utilisateurs WHERE mdp=$mdp AND mail=$mail");
        if (count(Affiche::$tableau)==1)
                {
                    
                    session_start();
                    //echo 'Vous êtes connecté';
                    $_SESSION['id']=Affiche::$tableau [0]['id'];
                    $_SESSION['nom']=Affiche::$tableau [0]['nom'];
                    $_SESSION['prenom']=Affiche::$tableau [0]['prenom'];
                    $_SESSION['mdp']=Affiche::$tableau [0]['mdp'];
                    $_SESSION['mail']=Affiche::$tableau[0]['mail'];
                    $_SESSION['telephone']=Affiche::$tableau [0]['telephone'];


                /* 
                    si le mail de connexion correspond à un mail de cette liste, on est admin => virer des gens, ajouter ou pas des articles, voir les panier en cours et les commandes
                */
                    $admin_mail=['frederic@ldnr.fr', 'missipssa@ldnr.fr', 'queen@ldnr.fr', 'alexia@ldnr.fr'];
                    foreach($admin_mail as $mail)
                        {
                            if( $_SESSION['mail']==$mail)
                                {
                                    $_SESSION['role']='admin';
                                }
                        }
                        
                

                    echo '<br>'.$_SESSION['nom'];
                    header('Location:../html/profil.php');
                    
                    
                }
        else 
                {

                echo 'Mot de passe ou email incorrect';
                }



    }

