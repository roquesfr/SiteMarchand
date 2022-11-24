<!DOCTYPE html>
<html lang='fr'>
<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Mon profil</title>
    <link rel='stylesheet' href='../css/commun.css'>

</head>
<body>
   
<!--HEADER-->
<?php require_once('header.php');?>

<!--nav-->
<?php require_once('nav.php');?>
    
<h1>Mon profil</h1>

<form action="../php/profil.php" method="post"> <!--en formulaire pour pouvoir modifier plus tard les informations-->


    <label for="nom">Mon nom</label><br>
    <input type="text" name='nom' id='nom' maxlength='30' value='<?php echo $_SESSION['nom'];?>' /><br><br>

    <label for="prenom">Mon prénom</label><br>
    <input type="text" name='prenom' id='prenom' maxlength='30' value='<?php echo $_SESSION['prenom'];?>' /><br><br>

    <label for="mdp">Mon mot de passe</label><br>
    <input type="password" name='mdp' id='mdp' maxlength='30' value='<?php echo $_SESSION['mdp'];?>' /><br><br>
    <button type='button' onclick=pdw_visible()>Afficher Mot de passe</button><br><br>

    <label for="mail">Mon email</label><br>
    <input type="text" name='mail' id='mail' maxlength='30' value='<?php echo $_SESSION['mail'];?>' /><br><br>

    <label for="telephone">Mon téléphone</label><br>
    <input type="text" name='telephone' id='telephone' maxlength='14' value='<?php echo $_SESSION['telephone'];?>' /><br><br>

    <button type="submit">Modifier</button>


</form>


<!--FOOTER-->
<?php require_once('footer.php');?>

<script>
    function pdw_visible()
        {
            if(document.getElementById('mdp').type=='password')
                {
                    document.getElementById('mdp').type='texte';
                }
            else
                {
                    document.getElementById('mdp').type='password';
                }

            
        }
</script>

</body>
</html>