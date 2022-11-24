<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Se connecter</title>
    <link rel="stylesheet" href="../css/commun.css">

</head>
<body>

<!--HEADER-->
<?php require_once('header.php');?>

<!--nav-->
<?php require_once('nav.php');?>
  
<form action="../php/connexion.php" method="post">
     


        <h1>Page de connexion</h1>

        <label for="mail">Email</label><br>
        <input type="text" name="mail" id="mail" maxlength='30' placeholder="Email"/><br>
        
        <label for="mdp">Mot de Passe</label><br>
        <input type="password" name="mdp" id="mdp" maxlength='30' placeholder="Mot de passe"/><br>

        <a href="inscription.php">S'inscrire</a><br>
        <button type="submit">Se connecter</button>
    

</form>

<!--FOOTER-->
<?php require_once('footer.php');?>

</body>
</html>