<?php

	session_start(); // Demarrage de la session
	
	include("en_tete.html"); // Importation du code conteu dans en_tete.html
	
	$_SESSION['film']=$_POST['film']; // Récupération du film
	
	$_SESSION['date']=date("Y-m-d"); // Récupération de la date et stockage dans un format exploitable par Phpmyadmin
	
	$delai=strtotime("+1 month",strtotime($_SESSION['date'])); // Création d'une variable délai qui permet de fixer la date de fin de réservation
	
	$_SESSION['date_retour']=date("Y-m-d",$delai); // Stockage de la date de retour dans une variable 
	
	include("parametres_connexion_base.php"); // Paramètres de connexion
	
    try { // Ouverture d'un try
        $conn = new PDO("mysql:host=$serveur;dbname=$nom_base", $login, $password);
        // set the PDO error mode to exception
		// Insertion des paramètres dans la table clients_films
        $req_insertion_film_clients='INSERT INTO clients_films(Pseudo_client,Id_film,Date_debut,Date_fin) 
		VALUES("'.$_SESSION['pseudo'].'",(SELECT Id_film FROM films WHERE Titre_film="'.$_SESSION['film'].'"),"'.$_SESSION['date'].'","'.$_SESSION['date_retour'].'")';
        $conn->exec($req_insertion_film_clients); // Execution de la requête
        include("location_prise_compte.html");

    }catch (PDOException $e) { // Ouverture d'un try
            echo $req_insertion_film_clients . "<br>" . $e->getMessage();
    }
	
	include("pied_page.html"); // On importe le code contenu dans pied_page.html

?>