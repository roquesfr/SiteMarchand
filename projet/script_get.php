<?php
	// Exemple d'�change entre Javascript et Php
	// C'est javascript qui interroge php
	
	if(isset($_GET['test']))
		{
			 print("SCRIPT EXECUTE AVEC VAR GET test"); // On retourne une simple cha�ne, mais on peut retourner des objets 
		}
		else
		{
			 print("SCRIPT EXECUTE SANS VARIABLE GET test");
		}
?>