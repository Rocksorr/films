<?php

	session_start(); // Demarrage de la session

	include("en_tete.html"); // Importation du code contenu dans en_tete.html

	include("Phrase_redaction_avis.html"); // Importation du code contenu dans Phrase_redaction_avis.html

	include ("page_film.php"); // Importation du code contenu dans page_film.php

	include("redaction_avis.html"); // Importation du code contenu dans redaction_avis.html
		
	while ($donnees = $rep->fetch(PDO::FETCH_ASSOC)){ // On parcourt le résultat de la requête
		echo "<option>" .$donnees['Titre_film']; // On affiche les films dans la liste déroulante
	}

	include("fermeture_liste.html"); // // Importation du code contenu dans fermeture_liste.html

	include("note_avis.html"); // Importation du code contenu dans note_avis.html
			
	include("Bouton_fin_formulaire.html"); // Importation du code contenu dans Bouton_fin_formulaire.html

	include("pied_page.html"); // Importation du code contenu dans pied_page.html

?>