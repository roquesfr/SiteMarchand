<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="wmailth=device-wmailth, initial-scale=1.0">
<title>Panier</title>
<link rel="stylesheet" href="../css/commun.css">
</head>

<body>
    
    <!--HEADER-->
    <?php require_once('header.php');?>
    
    <!--nav-->
    <?php require_once('nav.php');?>

    <h1>Panier</h1>
    <section> <!--le contenu central de la page-->

    <table>
        <tr>
            <th>Image du produit</th>
            <th>Description du produit</th>
            <th>Quantité</th>
            <th>Prix unitaire</th>
            <th>Status</th>
            <th colspan='3'>Modifier</th>
        </tr>

        <?php

            echo '<form action="../php/panier.php" method="post">';

            /*Affiche le panier qui est en cours uniquement, pas les panier déjà validés */
            $affiche=new Affiche();
            $affiche->AfficheTout("SELECT * FROM panier INNER JOIN article ON (panier.id_article=article.id_article) WHERE status=0 AND id_utilisateur=".$_SESSION['id']."");

            foreach(Affiche::$tableau as $ligne)
                {
                    echo '<tr><td><img src='.$ligne['photo'].' width=160px height=160px></td><td>'.$ligne['description'].'</td><td>'.$ligne['quantite'].'</td><td>'.$ligne['prix_unitaire'].' €</td><td>'.$ligne['status'].'</td><td><a href="../php/panier.php?article='.$ligne['id_article'].'">Supprimer</a></td><td><a href="../php/panier.php?moins='.$ligne['id_article'].'">Moins</a></td><td><a href="../php/panier.php?plus='.$ligne['id_article'].'">Plus</a></td></tr>';
                    echo "<input type='hidden' name='article".$ligne['id_article']."' id='article".$ligne['id_article']."'' value=".$ligne['id_article'].",".$ligne['quantite'].",".$ligne['prix_unitaire'].">";
                    //echo "<input type='hidden' name='quantite".$ligne['id_article']."'' id='quantite".$ligne['id_article']."'' value=".$ligne['quantite'].">";
                    //echo "<input type='hidden' name='prix_unitaire".$ligne['id_article']."'' prix_unitaire='quantite".$ligne['id_article']."'' value=".$ligne['prix_unitaire'].">";

                }
            
            echo '<button type=submit>Valider le panier</button>';

            echo '</form>';
        ?>
    </table>



    </section>
    
    <!--FOOTER-->
    <?php require_once('footer.php');?>

</body>
</html>

