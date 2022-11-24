<!DOCTYPE html>
<html lang='fr'>
<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>S'inscrire</title>
    <link rel='stylesheet' href='../css/commun.css'>

</head>
<body>
   
    <!--HEADER-->
    <?php require_once('header.php');?>
    
    <!--nav-->
    <?php require_once('nav.php');?>
    
<form action='../php/inscription.php' method='post'>
     


        <h1>Page d'inscription</h1>

        <label for='nom'>Nom</label><br><!--maxlength='20' longueur max attendu-->
        <input type='text' name='nom' id='nom' placeholder='Nom' />
        <br>
        <label for='prenom'>Prenom</label><br>
        <input type='text' name='prenom' id='prenom' maxlength='30' placeholder='Prénom'/>
        <br>
        <label for='mdp'>Mot de Passe</label><br>
        <input type='password' name='mdp' id='mdp' maxlength='30' placeholder='Mot de passe'/>
        <br>
        <label for='mdp2'>Confirmation de mot de passe</label><br>
        <input type='password' name='mdp2' id='mdp2' maxlength='30' placeholder='Confirmation de mot de passe' size='30' />
        <br>
        <label for='mail'>Email</label><br>
        <input type='text' name='mail' id='mail' maxlength='30' placeholder='prenom.nom@exemple.fr'/>
        <br>
        <label for='telephone'>Telephone</label><br>
        <input type='text' name='telephone' id='telephone' maxlength='14' placeholder='06.03.02.01.01'/><br><br>

        <button type='submit'>S'inscrire</button>
    

</form>

<!--FOOTER-->
<?php require_once('footer.php');?>

</body>
</html>

