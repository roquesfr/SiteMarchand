<?php
class ClasseRef
	{
		public string $nom="";
		
		public function AfficheUsers()
		{
			$requete=startBDD::$macnx->query('SELECT * FROM utilisateur');		// On récup la référence de la cnx PDO de la classe startBDD
																				// via la propriété statique $macnx;
			$result=$requete->fetchall(PDO::FETCH_ASSOC);						// Requete Mysql pour lister les utilisateurs
			foreach($result as $ligne)
			{
					echo "<br>".$ligne['login'];
			}
		}
	}