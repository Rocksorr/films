<?php

session_start(); // Demarrage de la session

include("en_tete.html"); // Importation du code contenu dans en_tete.html

$_SESSION['choix_avis_film']=$_POST['film']; // Récupération du nom du film et stockage dans une variable de session

include("parametres_connexion_base.php"); // Paramètres de connexion
		
try {
	$conn = new PDO("mysql:host=$serveur;dbname=$nom_base", $login, $password); // Ouverture de la connexion avec les bons paramètres
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	// set the PDO error mode to exception
	// Requête pour avoir la moyenne du film choisi 
	$req_traitement_moyenne='SELECT avg(note) as moyenne FROM retour,films WHERE retour.Id_film=films.Id_film and Titre_film="'.$_SESSION['choix_avis_film'].'"';
	// Requête pour avoir la liste des avis d'un film choisi 
	$req_traitement_avis='SELECT Pseudo_client,avis FROM retour,films WHERE retour.Id_film=films.Id_film and Titre_film="'.$_SESSION['choix_avis_film'].'"';
	// Execution des requêtes
	$rep_moyenne=$conn->query($req_traitement_moyenne);
	$rep_avis=$conn->query($req_traitement_avis);		
			
			
}catch (PDOException $e) {
	echo $rep_moyenne . "<br>" . $e->getMessage();
	echo $rep_avis . "<br>" . $e->getMessage();
}	

$conn=null; // Fermeture de la connexion

while ($donnees = $rep_moyenne->fetch(PDO::FETCH_ASSOC)){ // On parcourt le resultat de la requête
	echo "La moyenne pour ce film est " .$donnees['moyenne']; // Affichage du résultat de la requête.
	echo "/20";	
	
}

// On revient deux fois à la ligne

include("retour_ligne.html");
include("retour_ligne.html");

echo "Voici les avis concernant ce film : ";


while ($donnees = $rep_avis->fetch(PDO::FETCH_ASSOC)){ // On parcourt le resultat de la requête
	
	include("retour_ligne.html"); // On revient à la ligne
	
	if ($_SESSION['pseudo']==$donnees['Pseudo_client']){
		echo "Vous : ";
	}else{
		echo $donnees['Pseudo_client']. " : "; // On affiche le pseudo de l'utilisateur
	}
	echo $donnees['avis']; // On affiche l'avis de l'utilisateur en question
		
}

include("retour_page_acceuil.html");

include("retour_ligne.html");

include("pied_page.html");
?>
