<?php
session_start();

if(!empty($_SESSION))
{

    require_once('classe.php');
    $connexion=new Cnx_bdd();

    /* Supprime un article du panier si on clique sur le lien*/     
    if(!empty($_GET['article'])) // get considère que 0 est NULL
        {
            try
                {   
                    $id_article=$_GET['article'];
                    $id_utilisateur=$_SESSION['id'];

                    $delete=new Execute();
                    $delete->Exec("DELETE FROM panier WHERE id_utilisateur=$id_utilisateur AND id_article=$id_article");
                    header('Location:../html/panier.php');
                }
            catch(PDOException $ex)
                {
                    Die('Erreur de connexion à la bdd : '.$ex->getMessage());
                }
        }
    //else { echo 'zut';}


    /* Diminue la quantité d'un article de 1 si on clique sur le lien */
    if(!empty($_GET['moins'])) // get considère que 0 est NULL
    {
        try
            {   
                $id_article=$_GET['moins'];
                $id_utilisateur=$_SESSION['id'];

                $update=new Execute();
                $update->Exec("UPDATE panier SET quantite=quantite-1 WHERE id_utilisateur=$id_utilisateur AND id_article=$id_article");
                $delete=new Execute();
                $delete->Exec("DELETE FROM panier WHERE id_utilisateur=$id_utilisateur AND id_article=$id_article AND quantite=0");
                header('Location:../html/panier.php');
            }
        catch(PDOException $ex)
            {
                Die('Erreur de connexion à la bdd : '.$ex->getMessage());
            }
    }
    //else { echo 'zut';}


    /* Augmente la quantité d'un article de 1 si on clique sur le lien */
    if(!empty($_GET['plus'])) // get considère que 0 est NULL
    {
        try
            {   
                $id_article=$_GET['plus'];
                $id_utilisateur=$_SESSION['id'];

                $update=new Execute();
                $update->Exec("UPDATE panier SET quantite=quantite+1 WHERE id_utilisateur=$id_utilisateur AND id_article=$id_article");
                header('Location:../html/panier.php');
            }
        catch(PDOException $ex)
            {
                Die('Erreur de connexion à la bdd : '.$ex->getMessage());
            }
    }
    //else { echo 'zut';}

    /*On valide le panier avec un gros bouton sympa */
    if(!empty($_POST))
        {

            try
            {   
                $insert=new Execute();
                $insert->Exec("INSERT INTO entete_commande (id_utilisateur, total) VALUES (".$_SESSION['id'].",0)");//total = 0 car on à pas encore de valeur 
            }
        catch(PDOException $ex)
            {
                Die('Erreur de connexion à la bdd : '.$ex->getMessage());
            }

            $affiche=new Affiche();
            $affiche->AfficheTout("SELECT id FROM entete_commande WHERE id_utilisateur=".$_SESSION['id']."");
 

            $entete_id=end(Affiche::$tableau)['id']; //récupere la dernière ligne contenant l'utilisateur car on peut avoir plusieurs commandes d'un meme utilisateur

            /*Ajoute le panier dans ligne commande */
            foreach($_POST as $cle => $valeur)
                {
                    try
                        {   
                            // $value = id id_article quantite prix_unitaire => récupéré de html/panier
                            $insert->Exec("INSERT INTO ligne_commande (id_commande, id_article, quantite, prix_unitaire, total) VALUES (".$entete_id.",$valeur,quantite*prix_unitaire)");       
                        }

                    catch(PDOException $ex)
                        {
                            Die('Erreur de connexion à la bdd : '.$ex->getMessage());
                        }
                
                }

            /*on récupère le total des total de ligne commande */
            $affiche=new Affiche();
            $affiche->AfficheTout("SELECT SUM(ligne_commande.total) as 'entete_total' FROM ligne_commande INNER JOIN panier ON (ligne_commande.id_article=panier.id_article) WHERE  panier.status=0 AND ligne_commande.id_commande=$entete_id");
            $entete_total=Affiche::$tableau[0]['entete_total'];

            /*on met à jour le total dans entete commande  */
            $update=new Execute();
            $update->Exec("UPDATE entete_commande SET total=$entete_total WHERE total='0' AND id_utilisateur=".$_SESSION['id']."");

            /*on met a jour le panier en status 1  */
            $update->Exec("UPDATE panier SET status=1 WHERE status=0 AND id_utilisateur=".$_SESSION['id']."");
            header('Location:../html/panier.php');
        }
        else 
            {
                header('Location:../html/panier.php');
            }
    
}