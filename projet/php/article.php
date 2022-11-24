<?php
    session_start();

    /*Connexon à la bdd */
    if(!empty($_SESSION))
    {

        require_once('classe.php');
        $connexion=new Cnx_bdd();
        
        /*Ajoute au panier si cliqué */
        if(!empty($_GET['article'])) // get considère que 0 est NULL?
            {
                try
                    {   
                        $id_article=$_GET['article'];
                        $id_utilisateur=$_SESSION['id'];
                        $affiche=new Affiche();
                        $affiche->AfficheTout("SELECT * FROM panier WHERE status=0 AND id_utilisateur=$id_utilisateur AND id_article=$id_article");
                        
                        /*si l'article n'est pas dans le panier, on l'ajoute sinon on ajoute 1 à la quantité */
                        if(empty(Affiche::$tableau))
                            {
                                //echo 'on ajoute au panier';
                                $insert=new Execute();
                                $insert->Exec("INSERT INTO panier (id_utilisateur, id_article, quantite, status) VALUES ($id_utilisateur,$id_article,1,0)");
                            }
                        else
                            {   //echo 'on fait +1 à la quantité';
                                $quantite=Affiche::$tableau[0]['quantite']+1;
                                $update=new Execute();
                                $update->Exec("UPDATE panier SET quantite=$quantite WHERE id_utilisateur=$id_utilisateur AND id_article=$id_article");
                            }
                        
                        
                        header('Location:../html/article.php');
                    }
                catch(PDOException $ex)
                    {
                        Die('Erreur de connexion à la bdd : '.$ex->getMessage());
                    }
            }

    }

