<?php 
	session_start(); // Demarrage de la session
	
	include("en_tete.html"); // Importation du code contenu dans en_tete.html
	
		// On récupère les valeurs entrées par le client :
		$pseudo=$_POST['pseudo'];
		$nom=$_POST['nom'];
		$prenom=$_POST['prenom'];
		$email=$_POST['email'];
		$tel=$_POST['tel'];
		$ville=$_POST['ville'];
		$cp=$_POST['cp'];
		$num_voierie=$_POST['numerovoirie'];
		$nom_rue=$_POST['nom_rue'];
		$mdp=$_POST['mot_de_passe'];
		$mdp_conf=$_POST['mot_de_passe_confirmation'];

	if (($_POST['mot_de_passe'] <> $_POST['mot_de_passe_confirmation']) or ($pseudo=="" or $nom=="" or $prenom=="" or $email=="" or $tel=="" or $ville=="" or $cp=="" or $num_voierie=="" or $nom_rue=="" or $mdp=="" or $mdp_conf=="")) { // Si le mot de passe rentré n'est pas le même que celui confirmé et qu'il y a des informations manquantes
		include("phrase_echec_inscription.html");
		include("retour_ligne.html");
		include("bouton_echec_inscription.html"); // On renvoie l'utilisateur sur la page d'inscription via un bouton
		exit();
	}else{ // Sinon
		include("nouvel_enregistrement.html");;
		include("bouton_connexion_inscription.html"); // On lui redemande de se connecter
		include("parametres_connexion_base.php"); // Importation du code contenant les paramètres de connexion à la base
		
	

		try { // Ouverture d'un try
			$conn = new PDO("mysql:host=$serveur;dbname=$nom_base", $login, $password); // Création de la connexion avec les paramètres de connexion
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$req='INSERT INTO clients (Pseudo,Nom,Prenom,email,num_tel,ville_residence,code_postal,numero_voierie,nom_rue,mot_de_passe) VALUES("'.$pseudo.'","'.$nom.'","'.$prenom	.'","'.$email.'","'.$tel.'","'.$ville.'","'.$cp.'","'.$num_voierie.'","'.$nom_rue.'","'.$mdp.'")';
			$conn->exec($req); // On exécute la requête
			
		}catch (PDOException $e) { // Ouverture d'un catch, nécessaire lorsqu'on effectue un try
			echo $req . "<br>" . $e->getMessage();

		}	
		
		$conn = null; // Fermeture de la connexion

	}	
			
	include("pied_page.html"); // Importation du code contenu dans pied_page.html
  ?>