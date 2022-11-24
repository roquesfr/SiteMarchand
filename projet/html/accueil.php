</body><!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="wmailth=device-wmailth, initial-scale=1.0">
<title>Page d'accueil</title>
<link rel="stylesheet" href="../css/commun.css">
</head>

<body>
    
    <!--HEADER-->
    <?php require_once('header.php');?>  

    <!--nav-->
    <?php require_once('nav.php');?>

    <section> <!--le contenu central de la page-->

    <table>
        <tr>
            <th>Image du produit</th>
            <th>Description du produit</th>
            <th>Prix unitaire</th>

        </tr>

<?php

    require_once('../php/classe.php');
    $connexion=new Cnx_bdd();
    $affiche=new Affiche();
    $affiche->AfficheTout("SELECT * FROM article");

    foreach(Affiche::$tableau as $ligne)
        {
            //var_dump($article);
            echo '<tr><td><img src='.$ligne['photo'].' width=160px height=160px></td><td width=max-content height=max-content>'.$ligne['description'].'</td><td>'.$ligne['prix_unitaire'].' €</td>';
            //<td><a href="article.php">Ajouter au panier</a></td></tr>
        }
        
    ?>
    </table>
    </section>
    
    <!--FOOTER-->
    <?php require_once('footer.php');?>

</body>
</html>
</html>
