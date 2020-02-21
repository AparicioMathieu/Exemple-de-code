<?php
session_start();
session_destroy();

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
		<img src="img/justdoit.png" class="imgfill">
	</div>
<h1><img class="image" src="img/pegasuslogo.png"  /></h1>

 
<div class=navbar>
<img src="img/accueil.png" >
<a href="http://localhost/pegasus/inscription.php"><img src="img/inscription.png" ></a> 
<a href="//"><img src="img/reglement.png" ></a> 
<a href="//"><img src="img/tutorial.png" ></a> 
<a href="//"><img src="img/reseau.png" ></a> 
</div>

<div class="ensemblecolle">
	<div class="bande">
		<div class="textbande">Connexion :

		</div>
	</div>

	<div class="sousbande">
		<?php
if (isset($_GET['statut'])) {
    if ($_GET['statut'] == "mdpincorrect") {
        ?>
		<div class="redfont">
			Nom d'utilisateur ou mot de passe incorrect
		</div>
			<?php
}
}
?>
		<form method="post" action="index.php">
			<p>
				<label class="label" for="pseudo">Nom d'utilisateur : &nbsp; </label>
				<input type="text" name ="nom" id="pseudo" />
				<label class="label"for="password">Mot de passe : &nbsp;</label>
				<input type="password" name="mdp" id="password" />
				<input type="submit" value="Envoyer" />

		</form>

	<form method="post" action="inscription.php">
		<label class="label"for="inscr"> Vous n'êtes pas encore inscrit? Cliquez ici pour vous inscrire !</label>
		<input type="submit" name="inscr" value="Inscription" />
	</form>
			</p>
	</div>
	<div class="imgbarre"><img src="img/barre.png" ></div>
<h2>
Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of
 type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised 
 in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</h2>

 <h2>
 Inter has ruinarum varietates a Nisibi quam tuebatur accitus Vrsicinus, cui nos obsecuturos iunxerat imperiale praeceptum, dispicere litis exitialis certamina cogebatur abnuens et reclamans,
  adulatorum oblatrantibus turmis, bellicosus sane milesque semper et militum ductor sed forensibus iurgiis longe discretus, qui metu sui discriminis anxius cum accusatores quaesitoresque 
  subditivos sibi consociatos ex isdem foveis cerneret emergentes, quae clam palamve agitabantur, occultis Constantium litteris edocebat inplorans subsidia, quorum metu tumor notissimus Caesaris 
  exhalaret.</h2>
</div>




</body>
</html>