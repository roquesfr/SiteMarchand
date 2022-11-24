<?php 
session_start();

/*On vérifie que la session est toujorus correcte avant de se connecter à la base de donner */
if(!empty($_SESSION['mail']) && !empty($_SESSION['mdp']))
    {
        require_once('../php/classe.php');
        $connexion=new Cnx_bdd();

    }
?>
<header><!--en tete de page-->


        <img src="../image/fox.png" alt="Renard">
        
        <section id="header_titre" >
            <h1>Tout pour nos P'tits Bouts !!!</h1>
            <h3>Tous nos articles sont certifiés NF</h3>
        </section>

    </header>