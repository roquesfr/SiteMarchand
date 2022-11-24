<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="wmailth=device-wmailth, initial-scale=1.0">
<title>Nouvel Article</title>
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

    <h1>Les articles</h1>

<form id='nouvel_article' action="admin_new_article.php" method="post">

            <input type="text" name="nouvelle_photo" id="nouvelle_photo" maxlength='100' value="'url' alt=' '">
            <textarea type="text" name="nouvelle_description" id="nouvelle_description" maxlength='1000' placeholder='description du produit'></textarea>
            <input type="text" name="nouveau_prix_unitaire" id="nouveau_prix_unitaire" maxlength='11' placeholder='prix unitaire'>
            <!--input file -> import image, texte-->

            <button type="submit">Valider nouvel article</button>

    </form>

    <?php
        if(!empty($_POST))
            {
                $champ_rempli=!empty($_POST['nouvelle_description']) && !empty($_POST['nouveau_prix_unitaire']) && !empty($_POST['nouvelle_photo']);


                if($champ_rempli)
                    {
                        try
                            {   
                                $nouvelle_description=Cnx_bdd::$dbase->quote($_POST['nouvelle_description']);
                                $nouveau_prix_unitaire=Cnx_bdd::$dbase->quote($_POST['nouveau_prix_unitaire']);
                                $nouvelle_photo=Cnx_bdd::$dbase->quote($_POST['nouvelle_photo']);

                                $insert=new Execute();
                                $insert->Exec("INSERT INTO article (description,prix_unitaire,photo) VALUES ($nouvelle_description,$nouveau_prix_unitaire,$nouvelle_photo)");
                                header('Location:admin_article.php');

                            }
                        catch(PDOException $ex)
                            {
                                Die('Erreur de connexion à la bdd : '.$ex->getMessage());
                            }
                       
                    }
                
               
            }

    ?>

    
    
    <!--FOOTER-->
    <?php require_once('footer.php');?>

</body>
</html>