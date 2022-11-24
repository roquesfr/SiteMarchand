<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="wmailth=device-wmailth, initial-scale=1.0">
<title>Les paniers en cours</title>
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

    <h1>Les paniers en cours</h1>
    <section>

    <table class='widthnone'>
        <tr>
            <th>Utilisateur</th>
            <th>Articles</th>
            <th>Quantite</th>
        </tr>

        <?php
            /*Affiche les panier en cours => status = 0  */
            $affiche=new Affiche();
            $affiche->AfficheTout("SELECT * FROM panier WHERE status=0 ORDER BY id_utilisateur");

            foreach(Affiche::$tableau as $panier)
                {
                    echo '<tr><td>'.$panier['id_utilisateur'].'</td><td>'.$panier['id_article'].'</td><td>'.$panier['quantite'].'</td>';
                }
            
            
        ?>


    </table>

    </section>
    
    <!--FOOTER-->
    <?php require_once('footer.php');?>

</body>
</html>
