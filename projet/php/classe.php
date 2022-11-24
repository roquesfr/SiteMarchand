<?php

/*En travaux...encore */
   
class Cnx_bdd
    {
        private $db='projet';
        private $host='localhost';
        private $user='root';
        private $mdp='12345';
        static $dbase; // pour pouvoir le récupérer après, on le met en propriété; static est une constante
        //static $test=1;

        function __construct() // construct pour que la connexion se face à instantiation d'objet
            {
                try
                    {
                        $base=new PDO("mysql:dbname=$this->db;host=$this->host", $this->user,$this->mdp); // on se connecte à la bdd
                        $base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        self::$dbase=$base; // on change la valeur de la static avec self::
                        //self::$test+=1;
                        //var_dump(self::$dbase);
                    }
                catch(PDOException $ex)
                    {
                        Die('Erreur de connexion à la bdd : '.$ex->getMessage());
                    }
            }
    }

class Affiche// exemple de nouvelle classe qui a quand meme accès à la static $dbase
    {
        static $tableau;
        
        function AfficheTout(string $requete)
            {
                $recup=Cnx_bdd::$dbase->query($requete);
                self::$tableau=$recup->fetchall(PDO::FETCH_ASSOC);
            }
    }

class Execute
    {
        function Exec(string $requete)
        {
            try
                {
                    Cnx_bdd::$dbase->exec($requete);
                }

            catch(PDOExeception $ex)
                {
                    Die('Erreur de connexion à la bdd : '.$ex->getMessage());
                }
        }
    }

class Page
    {
        function Affiche_par_page(int $num_page) // affiche 3 article par page
            {
                $affiche=new Cnx_bdd();
                $affiche=new Affiche();
                $affiche->AfficheTout("SELECT * FROM article WHERE ($num_page*3)-2<=id_article AND id_article<($num_page*3)-2+3");
                //var_dump(Affiche::$tableau);
                foreach(Affiche::$tableau as $ligne)
                    {
                        echo $ligne['photo'].'  '.$ligne['id_article'];
                    }
            }
    }
       

/*$objet=new Page();
$objet->Affiche_par_page(1);
echo '<br>';
$objet->Affiche_par_page(2);
$objet->Affiche_par_page(3);*/
?>