<?php
/*session_start();

if(!empty($_SESSION))
{

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

        //var_dump($_POST);
        
         foreach($_POST as $cle => $valeur)
            {
                try
                {   
                    //echo $valeur.' '.$_SESSION['id'].'<br>'; // $value entre () pour les requetes, id id_article quantite prix_unitaire total=opération depuis la bdd donc autre requete en plus
                    $requete="INSERT INTO ligne_commande (id_utilisateur, id_article, quantite, prix_unitaire, total) VALUES (".$_SESSION['id'].",$valeur,quantite*prix_unitaire)"; 
                    $dbase->exec($requete);
                    
                    
                }

                catch(PDOException $ex)
                    {
                        Die('Erreur de connexion à la bdd : '.$ex->getMessage());
                    }
            
            }


            $requete="SELECT SUM(ligne_commande.total) as 'entete_total' FROM ligne_commande INNER JOIN panier ON (ligne_commande.id_article=panier.id_article) WHERE  panier.status=0 AND ligne_commande.id_utilisateur=".$_SESSION['id']."";
            $totaux=$dbase->query($requete);
            $total=$totaux->fetchall(PDO::FETCH_ASSOC);
            $entete_total=$total[0]['entete_total'];
            
            try
                {
                    $requete="INSERT INTO entete_commande (id_utilisateur, total) VALUES (".$_SESSION['id'].",$entete_total)"; 
                    $dbase->exec($requete);

                    //$requete="UPDATE panier SET status=1 WHERE status=0 AND id_utilisateur=".$_SESSION['id']."";
                    //$dbase->exec($requete);
                }
            catch(PDOException $ex)
                {
                    Die('Erreur de connexion à la bdd : '.$ex->getMessage());
                }


            header('Location:../html/panier.php');

            
    
}       
else{echo 'pb de session';}
*/
