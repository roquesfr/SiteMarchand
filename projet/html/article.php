<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="wmailth=device-wmailth, initial-scale=1.0">
<title>Articles</title>
<link rel="stylesheet" href="../css/commun.css">
</head>

<body>
    
    <!--HEADER-->
    <?php require_once('header.php');?>
    
    <!--nav-->
    <?php require_once('nav.php');?>

    <h1>Articles</h1>
    <section> <!--le contenu central de la page-->

    <table>
        <tr>
            <th>Image du produit</th>
            <th>Description du produit</th>
            <th>Prix unitaire</th>
            <th>Ajouter au panier</th>
        </tr>

        <?php
            /*On affiche les articles et on les ajoute a son panier */
            $article=new Affiche();
            $article->AfficheTout("SELECT * FROM article");

            foreach(Affiche::$tableau as $ligne)
                {
                    //var_dump($article);
                    echo '<tr><td><img src='.$ligne['photo'].' width=160px height=160px></td><td width=max-content height=max-content>'.$ligne['description'].'</td><td>'.$ligne['prix_unitaire'].' €</td><td><a href="../php/article.php?article='.$ligne['id_article'].'">Ajouter au panier</a></td>';
                    //<td><a href="article.php">Ajouter au panier</a></td></tr>
                }
            
        ?>


    </table>

    </section>
    
    <!--FOOTER-->
    <?php require_once('footer.php');?>

</body>
</html>
