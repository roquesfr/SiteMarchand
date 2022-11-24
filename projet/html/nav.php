<nav>

<?php
    if(!empty($_SESSION))
        {   
            /*echo '<style>
            li {
            list-style:none !important;
            color:#FFF;
            padding:10px;
            font-size:20px;
            text-decoration:none;
            }
            nav ul {
            background-color:#64abfb;
            padding:0;
            margin:0;
            }
            nav ul li {
            list-style: none;
            line-height:44px;
            float:left;
            background-color:#8c98a7;
            }
            nav ul li a {
            color:#FFF;
            padding:10px;
            font-size:20px;
            text-decoration:none;
            }
            li a:hover {
            border-bottom:3px
            #FFF
            solid;
            }
            nav ul li ul { display:none; } /* Rend le menu déroulant caché par défaut */
           // nav ul li:hover ul { /* Affiche la dropNav au survol de la souris avec la class .drop */
           /* z-index:99999;
            display:list-item !important;
            position:absolute;
            margin-top:5px;
            margin-left:-10px;
            }
            nav ul li:hover ul li {
            float:none;
            }
            
            
            </style><nav>
                    <ul>
                        <li class="navigation-item"><a class="navigation-link" href="accueil.php">Accueil</a></li>
                        <!-- Début du menu déroulant -->
                        <li><a href="#">Admin</a>
                            <ul>
                                <a class="navigation-link" href="admin_article.php">Gérer les articles</a>
                                <a class="navigation-link" href="admin_new_article.php">Nouvel Article</a>
                                <a class="navigation-link" href="admin_profil.php">Profils clients</a>
                                <a class="navigation-link" href="admin_panier.php">Paniers clients</a>
                                <a class="navigation-link" href="admin_commande.php">Commandes validées</a>
                            </ul>
                        </li>
                        <li class="navigation-item"><a class="navigation-link" href="article.php">Shopping</a></li>
                        <li class="navigation-item"><a class="navigation-link" href="panier.php">Mon Panier</a></li>
                        <li class="navigation-item"><a class="navigation-link" href="profil.php">Mon Profil</a></li>

                    </ul>
                 </nav>';*/


            echo '<a class="navigation-link" href="accueil.php">Accueil</a><br>' ;
            echo '<a class="navigation-link" href="profil.php">Mon Profil</a><br>' ;
            echo '<a class="navigation-link" href="panier.php">Mon panier</a><br>' ;
            echo '<a class="navigation-link" href="article.php">Shopping</a><br>' ;
            if(!empty($_SESSION['role']) && $_SESSION['role']=='admin')
                {
                    echo '<a class="navigation-link" href="admin_article.php">Gérer les articles</a><br>' ;
                    echo '<a class="navigation-link" href="admin_new_article.php">Nouvel Article</a><br>';
                    echo '<a class="navigation-link" href="admin_profil.php">Profils clients</a><br>' ;
                    echo '<a class="navigation-link" href="admin_panier.php">Paniers clients</a><br>' ;
                    echo '<a class="navigation-link" href="admin_commande.php">Commandes validées</a><br>' ;
                }
            echo '<a href="../php/deconnecter.php">Se déconnecter</a><br>'; 
        }
    else
        {
            echo '<a href="connexion.php">Se connecter</a>';
        }
?>

</nav>
