<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="wmailth=device-wmailth, initial-scale=1.0">
<title>Les commandes</title>
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

    <h1>Les commandes</h1><br>
    <section> <!--le contenu central de la page-->

    <table class='widthnone'>
        <tr>
            <th>N°</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Mail</th>
            <th>Telephone</th>
            <th>Montant</th>
            <th>Consulter</th>
        </tr>

        <?php
            /* Affiche toutes les entetes de commande */
            $affiche=new Affiche();
            $affiche->AfficheTout("SELECT * FROM  utilisateurs  INNER JOIN entete_commande ON (entete_commande.id_utilisateur=utilisateurs.id)");

            foreach(Affiche::$tableau as $entete_commande)
                {
                    //var_dump($entete_commande);
                    echo '<tr><td>'.$entete_commande['id'].'</td><td>'.$entete_commande['nom'].'</td><td>'.$entete_commande['prenom'].'</td><td>'.$entete_commande['mail'].'</td><td>'.$entete_commande['telephone'].'</td><td>'.$entete_commande['total'].' €</td><td><a href=admin_commande.php?consulter='.$entete_commande['id'].'>Consulter</a></td>';
                    

                }
        ?>
    </table>

  

    </section>

    <?php
        /*Consulter la commande qui a été cliquée */
        if(!empty($_GET['consulter']))
            {
                $id_commande=$_GET['consulter'];
                $affiche=new Affiche();
                $affiche->AfficheTout("SELECT * FROM ligne_commande WHERE id_commande=$id_commande");
                //var_dump($commande);
                echo '<section class=consulter>';
                foreach(Affiche::$tableau as $ligne)
                    {
                        echo '<p>client n° '.$ligne['id_commande'].'- article n° '.$ligne['id_article'].'- quantité: '.$ligne['quantite'].'- prix unitaire: '.$ligne['prix_unitaire'].' €</p>';  
                    }
                    echo '</section>';
            }

?>

    
    <!--FOOTER-->
    <?php require_once('footer.php');?>

</body>
</html>


