<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="wmailth=device-wmailth, initial-scale=1.0">
<title>Gestion des articles</title>
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

    <h1>Gestion des articles</h1><br><br>
    <section> <!--le contenu central de la page-->

    <table>
        <tr>
            <th>Photo</th>
            <th>Description</th>
            <th>Prix unitaire</th>
            <th colspan='2'>Modifier</th>
        </tr>

        <?php
        
        /*Affiche tous les articles */
        $affiche=new Affiche();
        $affiche->AfficheTout("SELECT * FROM article");

        foreach(Affiche::$tableau as $article)
            {
                echo '<tr><td><img src='.$article['photo'].' width=160px height=160px></td><td>'.$article['description'].'</td><td>'.$article['prix_unitaire'].' €</td><td><a href="admin_article.php?supprimer='.$article['id_article'].'">Supprimer</a></td><td><a href="admin_article.php?modifier='.$article['id_article'].'">Modifier</a></td></tr>';
            }
        
        
        ?>


    </table>

    </section>

<?php
    /*Supprimer un article si cliqué */
    if(!empty($_GET['supprimer'])) 
        {
            try
            {   $delete=new Execute();
                $delete->Exec("DELETE FROM article WHERE id_article=".$_GET['supprimer']."");
                header('Location:admin_article.php');
            }
            catch(PDOException $ex)
                {
                    Die('Erreur de connexion à la bdd : '.$ex->getMessage());
                }

        }

    if(!empty($_GET['modifier']))
    {
        try
        {
            $requete='SELECT * FROM article WHERE id_article='.$_GET['modifier'].' ';
            $recup=Cnx_bdd::$dbase->query($requete);
            $article=$recup->fetch(PDO::FETCH_ASSOC);//fetch ?? pas touche au cas ou => on a juste besoin de 1 ligne
            echo '<form action=admin_article.php class=modifier method=post>';
            echo '<input type=hidden name=id_article id=id_article value='.$_GET['modifier'].'>';// on récupère l'id en cacher
            echo '<input name=photo id=photo value='.$article['photo'].'>';
            echo '<textarea name=description id=description>'.$article['description'].'</textarea>';
            echo '<input name=prix_unitaire id=prix_unitaire value='.$article['prix_unitaire'].'>';

            echo '<button type=submit>Modifier</button>';
            echo '</form>';   
            
        }
        catch(PDOException $ex)
            {
                Die('Erreur de connexion à la bdd : '.$ex->getMessage());
            }
    }

    /*Modifier un article*/
    if(!empty($_POST))
        {
            $champ_rempli=!empty($_POST['description']) && !empty($_POST['prix_unitaire']) && !empty($_POST['photo']);


            
            if($champ_rempli)
                {
                    $id_article=Cnx_bdd::$dbase->quote($_POST['id_article']); // echappe les caractères qui peuvent causer problèmes mais sont parfois enkikinante pour echo 
                    $description=Cnx_bdd::$dbase->quote($_POST['description']);
                    $prix_unitaire=Cnx_bdd::$dbase->quote($_POST['prix_unitaire']);
                    $photo=Cnx_bdd::$dbase->quote($_POST['photo']);

                        try
                            {
                                $maj=new Execute();
                                $maj->Exec("UPDATE article SET description=$description WHERE id_article=$id_article");
                                $maj->Exec("UPDATE article SET prix_unitaire=$prix_unitaire WHERE id_article=$id_article");
                                $maj->Exec("UPDATE article SET photo=$photo WHERE id_article=$id_article");                                
                            }
                        catch(PDOException $ex)
                            {
                                Die('Erreur de connexion à la bdd : '.$ex->getMessage());
                            }
                    //header('Location:admin_article.php'); // le header ici casse les noisettes, pq ???? Cannot modify header information - headers already sent
                }                                           // car le form envoie ici et le header fait la meme chose en meme temps mais sur la meme page?
            else { echo 'rempli tous les champs';}
        } 
?>

    
    
    <!--FOOTER-->
<?php require_once('footer.php');?>

</body>
</html>

