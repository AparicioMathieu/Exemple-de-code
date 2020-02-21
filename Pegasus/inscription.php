<?php
session_start();
session_destroy();


try
{
	// On se connecte à MySQL
	$bdd=new PDO('mysql:host=localhost;dbname=pegasus','root','');
}
catch(Exception $e)
{
	// En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
}

$requete_insertion = $bdd->prepare('INSERT INTO utilisateurs( nom, mdp, email) VALUES (:nom,:mdp,:email)');
/* regarde les utilisateurs déjà existants */
$requete_selection = $bdd->query('SELECT nom FROM utilisateurs;');
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title> Pegasus - Jeu navigateur gratuit de conqu&ecirc;te spatiale</title>
<link rel="stylesheet" href="styletest.css" />
<link rel="shortcut icon" type="image/x-icon" href="icone_test_pegasus.jpg">
<meta name ="Author" content ="Overdoge">
<meta name ="Rev" content ="damienblanchardd@gmail.com">
<meta name ="Subject" content ="Pegasus, un jeu gratuit de simulation de gestion d'un empire spatial par navigateur">
<meta name ="Rating" content="jeux">
<meta name ="Description" content = "Développez votre empire, construisez une flotte de vaisseaux et colonisez de nombreuses planètes pour devenir le plus puissant de l'Univers. Les combats spatiaux et terrestres seront omniprésents, ainsi que divers choix pour personnaliser votre empire.">
<meta name="Abstract" content="Pegasus - Jeu par navigateur gratuit de conquête spatiale">
<meta name="Keywords" content="jeu par navigateur,jeux par navigateur,jeu par navigateur gratuit,jeux par navigateur gratuit,jeu navigateur,jeux navigateur,jeu navigateur gratuit,jeux navigateur gratuit,jeu gratuit,jeux gratuits,jeux spatial,jeu spatial,jeux spatial gratuit,jeu spatial gratuit,jeux de gestion,jeu de gestion,jeux de gestion gratuit,jeu de gestion gratuit,jeu simulation,jeux de simulation,jeu simulation gratuit,jeux de simulation gratuit,jeu en ligne,jeux en ligne,jeu en ligne gratuit,jeux en ligne gratuit,jeu stratégie spatial,jeux stratégie spatial,jeu stratégie spatial gratuit,jeux stratégie spatial gratuit,jeu de stratégie,jeux de stratégie,jeu de stratégie gratuit,jeux de stratégie gratuit,mmorts,mmorts gratuit,mmorts free,mmorts spatial,mmorts spatial gratuit,jeu gratuit en ligne,jeux gratuit en ligne,jeu navigateur en ligne,jeu navigateur en ligne gratuit,jeu navigateur stratégie,jeu navigateur spatial,jeu de conquête,jeu de conquêtes,jeux de conquête,jeux de conquêtes ">
</head>
<body>
	<div id="justdoit">
		<img src="justdoit.png" class="imgfill">
	</div>
<h1>PEGASUS</h1>

<?php
if(isset($_GET['statut']))
{
	if($_GET['statut']=="nomexistant")
	{
		?>
		<div class="redfont">
			Nom d'utilisateur déjà existant
		</div>
		<?php
	}
}


/* booléen déterminant si l'utilisateur existe déjà */


if (isset($_POST['nom']) && isset($_POST['mdp']) && isset($_POST['mail']))
{
	$bool_userexiste = false;
	while($donnees = $requete_selection->fetch())
	{
		if ($donnees['nom']==$_POST['nom'])
		{
			
			$bool_userexiste = true;
		}
	}
		if($bool_userexiste == true){
			header('location:inscription.php?statut=nomexistant');
		}

		else
		{
			if(strlen($_POST['nom'])>= 15 || strlen ($_POST['nom']) <= 3 || $_POST['mdp'] <> $_POST['mdp2'] || strlen($_POST['mdp']) >= 50 || strlen ($_POST['mdp']) <=6 )
			{
?>
<div class="ensemblecolle">
	<div class="bande">
		<div class="textbande">INSCRIPTION
		</div>
	</div>

	<div class="sousbande"><?php
			echo "foutage de gueule?";
			?>
	</div>
	<a href="accueil.php">
	<input type="button" value="Retour accueil"/>
	</a>
</div>
<?php
			}
			else{
				$requete_insertion->execute(array(
				'nom' => $_POST['nom'],
				'mdp' => password_hash($_POST['mdp'],PASSWORD_DEFAULT),
				'email' => $_POST['mail']
				));

?>
<div class="ensemblecolle">
	<div class="bande">
		<div class="textbande">INSCRIPTION
		</div>
	</div>

	<div class="sousbande"><?php
			echo "INSERTION REUSSIE";
			?>
	</div>
	<a href="accueil.php">
	<input type="button" value="Retour accueil"/>
	</a>
</div>
<?php
				}
		}
}
else
{
?>
<div class="ensemblecolle">
	<div class="bande">
		<div class="textbande">INSCRIPTION
		</div>
	</div>

	<div class="sousbande">
		<form method="post" action="inscription.php" class="testform">
			
				<label for="pseudo">Nom d'utilisateur </label>
				<br>
				<input type="text" name ="nom" id="pseudo" maxlength='20' required/>
				<br>
				<label for="password">Mot de passe </label>
				<br>
				<input type="password" name="mdp" id="password" required/>
				<br>
				<label for="password">Vérification mot de passe </label>
				<br>
				<input type="password" name="mdp2" id="password" required/>
				<br>
				<label for="mail">Email</label>
				<br>
				<input type="email" name="mail" id="mail" required/>
				<br>
				<br>
				<input type="submit" value="Envoyer" />
			
		</form>
 
			
	</div>


</div>

<?php

}

/* TODO
FERMER LES CURSEURS DE REQUETE*/
$requete_insertion->closeCursor();
$requete_selection->closeCursor();
?>


</body>
</html>