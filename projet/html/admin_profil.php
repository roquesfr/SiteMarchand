<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="wmailth=device-wmailth, initial-scale=1.0">
<title>Les profils clients</title>
<link rel="stylesheet" href="../css/commun.css">
</head>

<body>
    
    <!--HEADER-->
    <?php require_once('header.php');?>
    
    <!--nav-->
    <?php require_once('nav.php');?>

    <?php /*Vérifie que l'on est connecter en admin pour accéder à la page */

        if(empty($_SESSION['role']) || $_SESSION['role']!='admin')
            {
                header('Location:accueil.php');
            }

    ?>

    <h1>Les profils clients</h1><br><br>
    <section>
    <table class='widthnone'>
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Mail</th>
            <th>Telephone</th>
            <th colspan='2'>Modifier</th>
        </tr>

        <?php
            /*Récupere tous les profils avec option de supprimer ou modifier */
            $affiche=new Affiche();
            $affiche->AfficheTout("SELECT * FROM utilisateurs");

            foreach(Affiche::$tableau as $utilisateur)
                {
                    echo '<tr><td>'.$utilisateur['nom'].'</td><td>'.$utilisateur['prenom'].'</td><td>'.$utilisateur['mail'].'</td><td>'.$utilisateur['telephone'].'</td><td><a href="admin_profil.php?supprimer='.$utilisateur['id'].'">Supprimer</a></td><td><a href="admin_profil.php?modifier='.$utilisateur['id'].'">Modifier</a></td></tr>';
                }
            
            
        ?>


    </table>

    </section>

    <?php

    /*Supprimer un utilisateur si cliqué */
    if(!empty($_GET['supprimer'])) 
        {
            try
            {
                $delete=new Execute();
                $delete->Exec("DELETE FROM utilisateurs WHERE id=".$_GET['supprimer']."");
                header('Location:admin_profil.php');
            }
            catch(PDOException $ex)
                {
                    echo 'zutEUX';
                }

        }


    /*Ouvrir les champs pour modifier un utilisateur si cliqué */
    if(!empty($_GET['modifier']))
    {
        try
        {
            
            $requete='SELECT * FROM utilisateurs WHERE id='.$_GET['modifier'].' ';
            $recup=Cnx_bdd::$dbase->query($requete);
            $utilisateur=$recup->fetch(PDO::FETCH_ASSOC); //fetch??? on affiche une seule ligne 
            echo '<form action=admin_profil.php class=modifier method=post>';
            echo '<input type=hidden name=id_utilisateur id=id_utilisateur value='.$_GET['modifier'].'>';// on récupère l'id en cacher
            echo '<input name=nom id=nom maxlength=30 value='.$utilisateur['nom'].'>';
            echo '<input name=prenom id=prenom maxlength=30 value='.$utilisateur['prenom'].'>';
            echo '<input name=mail id=mail maxlength=30 value='.$utilisateur['mail'].'>';
            echo '<input name=telephone id=telephone maxlength=14 value='.$utilisateur['telephone'].'>';

            echo '<button type=submit>Modifier</button>';
            echo '</form>';   
            
        }
        catch(PDOException $ex)
            {
                echo 'zutEUX';
            }
    }

    /*Modifier un utilisateur*/
    if(!empty($_POST))
        {
            $champ_rempli=!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['mail']) && !empty($_POST['telephone']);
            $nom_valide=preg_match('/([a-zA-Z]|[\'.-]|[[:blank:]])+/',$_POST['nom']);
            $prenom_valide=preg_match('/([a-zA-Z]|[\'.-]|[[:blank:]])+/',$_POST['prenom']);
            $email_valide=preg_match('/^([a-zA-Z]|[0-9]|[-_.])+@([a-zA-Z]|[0-9]|[-_.])+[.][a-z]+$/',$_POST['mail']); //commence par lettre ou chiffre ou -_. plusieurs fois @ idem . lettre minuscule plusieurs fois
            $telephone_valide=preg_match('/^[0-9]{2}[.][0-9]{2}[.][0-9]{2}[.][0-9]{2}[.][0-9]{2}$/',$_POST['telephone']);// 2 chiffres. ... => 14 au total

            if($champ_rempli && $nom_valide && $prenom_valide && $email_valide && $telephone_valide)
                {
                    $nom=Cnx_bdd::$dbase->quote($_POST['nom']); // echappe les caractères qui peuvent causer problèmes mais sont parfois enkikinante pour echo 
                    $prenom=Cnx_bdd::$dbase->quote($_POST['prenom']);
            
                    $mail=Cnx_bdd::$dbase->quote($_POST['mail']);
                    $telephone=Cnx_bdd::$dbase->quote($_POST['telephone']);
            
                    $session_nom=Cnx_bdd::$dbase->quote($utilisateur['nom']);
                    $session_prenom=Cnx_bdd::$dbase->quote($utilisateur['prenom']);
            
                    $session_mail=Cnx_bdd::$dbase->quote($utilisateur['mail']);
                    $session_telephone=Cnx_bdd::$dbase->quote($utilisateur['telephone']);
            
            
                    // On vérifie que les nouvelles valeurs ne sont pas les mêmes que les anciennes avant de les maj
                    if($session_nom!=$nom)
                        {
                            $id=$_POST['id_utilisateur'];
                            try
                                {
                                    
                                    $update=new Execute();
                                    $update->Exec("UPDATE utilisateurs SET nom=$nom WHERE id=$id"); // on update sur l'id utilisateur et PAS LA SESSION !
                                    //$_SESSION['nom']=$_POST['nom']; // pas la session putaing !!!! 
            
                                }
                            catch(PDOException $ex)
                                {
                                    Die('Erreur de connexion à la bdd : '.$ex->getMessage());
                                }
                        }
                        
                    if($session_prenom!=$prenom) 
                        {
                            try
                                {
                                    $update=new Execute();
                                    $update->Exec("UPDATE utilisateurs SET prenom=$prenom WHERE id=$id");
                                    //$_SESSION['prenom']=$_POST['prenom'];// pas la session putaing !!!! 
            
                                }
                            catch(PDOException $ex)
                                {
                                    Die('Erreur de connexion à la bdd : '.$ex->getMessage());
                                }
                        }
                        
                    if($session_mail!=$mail) 
                        {
                            try
                                {
                                    $update=new Execute();
                                    $update->Exec("UPDATE utilisateurs SET mail=$mail WHERE id=$id");
                                    //$_SESSION['mail']=$_POST['mail'];// pas la session putaing !!!! 
                                }
                            catch(PDOException $ex)
                                {
                                    Die('Erreur de connexion à la bdd : '.$ex->getMessage());
                                }
                        }
            
                    if($session_telephone!=$telephone) 
                        {
                            try
                                {
                                    $update=new Execute();
                                    $update->Exec("UPDATE utilisateurs SET telephone=$telephone WHERE id=$id");
                                    //$_SESSION['telephone']=$_POST['telephone'];// pas la session putaing !!!! 
                                }
                            catch(PDOException $ex)
                                {
                                    Die('Erreur de connexion à la bdd : '.$ex->getMessage());
                                }
                        }
                    header('Location:admin_profil.php');

                }
                else { echo 'rempli tous les champs';}

        }
?>
    
    <!--FOOTER-->
    <?php require_once('footer.php');?>

</body>
</html>



