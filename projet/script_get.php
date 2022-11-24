<?php
	// Exemple d'échange entre Javascript et Php
	// C'est javascript qui interroge php
	
	if(isset($_GET['test']))
		{
			 print("SCRIPT EXECUTE AVEC VAR GET test"); // On retourne une simple chaîne, mais on peut retourner des objets 
		}
		else
		{
			 print("SCRIPT EXECUTE SANS VARIABLE GET test");
		}
?>