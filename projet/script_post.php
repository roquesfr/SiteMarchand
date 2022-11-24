<?php
	// Exemple d'échange entre Javascript et Php
	// C'est javascript qui interroge php
	
	if(isset($_POST['test']))
		{
			 print("SCRIPT EXECUTE AVEC VAR POST test");  // On retourne une simple chaîne, mais on peut retourner des objets 
		}
		else
		{
			 print("SCRIPT EXECUTE SANS VARIABLE POST test");
		}
?>