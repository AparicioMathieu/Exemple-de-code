<?php
session_start();
// CONNEXION A LA BASE
try
{
	// On se connecte à MySQL
	$bdd=new PDO('mysql:host=localhost;dbname=pegasus;charset=utf8','root','');
}
catch(Exception $e)
{
	// En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
}

// VERIFICATION DE LA SESSION
$connexionvalide=1;
if (isset($_POST['nom']) AND isset($_POST['mdp']))
{

	$req_session = $bdd->prepare('SELECT mdp from utilisateurs WHERE nom=:nom');

	$req_session->execute(array(
		'nom'=> $_POST['nom']));
	$mdp = $req_session->fetch()['mdp'];
	$value_session= $_POST['mdp'];

	
/*Pour avoir l'id du joueur aussi*/

$requete_id = $bdd->prepare('SELECT id FROM utilisateurs WHERE nom=:nom');



	if( password_verify($value_session,$mdp) )
	{
	$_SESSION['nom']=htmlspecialchars($_POST['nom']);
	$requete_id->execute(array(
		'nom' => $_SESSION['nom']
	));
	$_SESSION['id']=$requete_id->fetch()['id'];
	$requete_planetes = $bdd->query("SELECT id_planete from planetes WHERE est_pm=1 AND id_joueur='".$_SESSION['id']."'");
	$_SESSION['planete']=$requete_planetes->fetch()['id_planete'];
	header('Location: index.php?page=salledecontrole');
	}
	else
	{
		$connexionvalide=0;
		
	}


	
}


// ACTUALISATION DE LA PLANETE
$isgoodplanete=0;
if(isset($_POST['planete'])){
	
	$requete_isgoodplanete = $bdd->query("SELECT id_planete FROM planetes WHERE id_joueur='".$_SESSION['id']."'");
while($idpla=$requete_isgoodplanete->fetch()){
if($idpla['id_planete']==$_POST['planete']){
	$isgoodplanete=1;
}
}

if($isgoodplanete==1){
	$_SESSION['planete']=$_POST['planete'];
	if(isset($_GET['page'])){
		header("Location:index.php?page=".$_GET['page']);

	}
	else{
		header('Location: index.php');
	}
}
else{
$isgoodplanete=2;
}


}


?>



<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title> Pegasus - Jeu navigateur gratuit de conqu&ecirc;te spatiale</title>
<link rel="stylesheet" href="styletest.css" />
<link rel="shortcut icon" type="image/x-icon" href="icone_test_pegasus.jpg">

</head>


<body>
<?php
//FONCTIONS POUR CLEAN UP AFFICHAGE DES VALEURS RESSOURCES ET TEMPS
$scroptrsactivated=0;
$scroptrsrechactivated=0;
function CleanNumber($nombre){
	$int = (int)($nombre);
	return number_format($int,0,"",".");
}
function CleanDuration($nombre){
	if($nombre<60){
		return strval((int)($nombre))." sec";
	}
	elseif($nombre<3600){
		$minutes=(int)($nombre / 60);
		$secondes=(int)($nombre % 60);
		return strval($minutes)." min ".strval($secondes)." sec";
	}
	elseif($nombre<86400){
		$heures=(int)($nombre / 3600);
		$minutes=(int)($nombre / 60) - $heures*60;
		$secondes=(int)($nombre %60);
		return strval($heures)." h ".strval($minutes)." min ".strval($secondes)." sec";
	}
	else{
		$jours= (int)($nombre / 86400);
		$heures= (int)($nombre /3600) - $jours*24;
		$minutes= (int)($nombre / 60) - $jours*1440 - $heures*60;
		$secondes= (int)($nombre%60);
		return strval($jours)." j ".strval($heures)." h ".strval($minutes)." min ".strval($secondes)." sec";
	}
}


?>
	<div id="justdoit">
		<img src="justdoit.png" class="imgfill">
	</div>
<h1>PEGASUS</h1>

<?php /* Si la session est ok on affiche la page */

if (isset($_SESSION['nom']))
{

	$requete_planetes2 = $bdd->query("SELECT * from planetes WHERE id_planete='".$_SESSION['planete']."'");
$donnees=$requete_planetes2->fetch();
//ACTUALISATION DES RESSOURCES
//temps depuis la derniere actualisation
$req_temps= $bdd->query("SELECT TIMESTAMPDIFF(SECOND, '".$donnees['last_actu']."',NOW()) AS ddif");
$temps_ecoule= $req_temps->fetch()['ddif'];
//changement des valeurs de la base
$req_updateress= $bdd->prepare("UPDATE planetes SET Fer=:fer,Gold=:gold,Cristal=:cristal,Uranium=:uranium,Antimatière=:anti,last_actu=NOW() WHERE id_planete='".$_SESSION['planete']."'");
$req_updateress->execute(array(
'fer' => $donnees['Fer']+$temps_ecoule*$donnees['Prod_fer']*$donnees['mult_fer'],
'gold' => $donnees['Gold']+$temps_ecoule*$donnees['Prod_gold']*$donnees['mult_or'],
'cristal' => $donnees['Cristal']+$temps_ecoule*$donnees['Prod_cristal']*$donnees['mult_cri'],
'uranium' => $donnees['Uranium']+$temps_ecoule*$donnees['Prod_uranium']*$donnees['mult_uranium'],
'anti' => $donnees['Antimatière']+$temps_ecoule*$donnees['Prod_anti']*$donnees['mult_anti']
));

//PREPARATION DES VARIABLES

$lvlminefer = 0;
$lvlmineor = 0;
$lvlminecri = 0;
$lvlgeneuranium = 0;
$lvlgeneanti = 0;
$lvlusinerobo = 0;
$lvlusinenanites = 0;
$lvlcentralegeo = 0;
$lvlcentralesol = 0;
$lvlcentralehydro = 0;
$lvlcentralenuc = 0;
$lvlpylone = 0;
$lvlcentregvt =0;
$lvllabo =0;
$lvlcaserne =0;
$lvlcomplexe =0;
$lvlchantierspatial=0;
$lvlcentredef =0;
$lvlbunker =0;
$lvlbunkersouterrain =0;
$lvlterraformeur=0;

//AFFICHAGE DES RESSOURCES ET SETUP DES INFOS PLANETE


if (isset($_SESSION['planete'])){
	$requete_pla_affichage = $bdd->query('SELECT * from planetes WHERE id_planete="'.$_SESSION['planete'].'"');
$donnees_aff=$requete_pla_affichage->fetch();
$fer = $donnees_aff['Fer']/3600;
$gold = $donnees_aff['Gold']/3600;
$cri = $donnees_aff['Cristal']/3600;
$uranium = $donnees_aff['Uranium']/3600;
$anti = $donnees_aff['Antimatière']/3600;

// POUR LENERGIE IL FAUT FAIRE UNE SIMPLE OPERATION EN FONCtiON DES LVLCENTRALES ET DES MODIFICATEURS DE LA PLANETE
$lvlminefer = $donnees_aff['minefer_lvl'];
$lvlmineor = $donnees_aff['mineor_lvl'];
$lvlminecri = $donnees_aff['minecristal_lvl'];
$lvlgeneuranium = $donnees_aff['generateururanium_lvl'];
$lvlgeneanti = $donnees_aff['generateuranti_lvl'];
$lvlusinerobo = $donnees_aff['usinerobo_lvl'];
$lvlusinenanites = $donnees_aff['usinenanites_lvl'];
$lvlcentralegeo = $donnees_aff['centralegeo_lvl'];
$lvlcentralesol = $donnees_aff['centralesolaire_lvl'];
$lvlcentralehydro = $donnees_aff['centralehydro_lvl'];
$lvlcentralenuc = $donnees_aff['centralenucleaire_lvl'];
$lvlpylone = $donnees_aff['pylonevortex_lvl'];
$lvlcentregvt = $donnees_aff['centregvt_lvl'];
$lvllabo = $donnees_aff['labo_lvl'];
$lvlcaserne = $donnees_aff['caserne_lvl'];
$lvlcomplexe = $donnees_aff['complexe_lvl'];
$lvlchantierspatial = $donnees_aff['chantierspatial_lvl'];
$lvlcentredef = $donnees_aff['centredef_lvl'];
$lvlbunker = $donnees_aff['bunker_lvl'];
$lvlbunkersouterrain = $donnees_aff['bunkersouterrain_lvl'];
$lvlterraformeur = $donnees_aff['terraformeur_lvl'];
$taille_prise = $lvlminefer + $lvlmineor + $lvlminecri + $lvlgeneuranium + $lvlgeneanti + $lvlusinerobo + $lvlusinenanites + $lvlcentralegeo + $lvlcentralesol + $lvlcentralehydro + $lvlcentralenuc + $lvlpylone + $lvlcentregvt + $lvllabo + $lvlcaserne + $lvlcomplexe + $lvlchantierspatial + $lvlcentredef + $lvlbunker + $lvlbunkersouterrain + $lvlterraformeur;
$taille_max = min($donnees_aff['taille_base']+20*$lvlterraformeur, $donnees_aff['taille_max']);
$nb_lanceurmissiles=$donnees_aff['nb_lanceurmissiles'];
$nb_missilesnuc=$donnees_aff['nb_missilesnuc'];
$nb_missilesnucav=$donnees_aff['nb_missilesnucav'];
$nb_rayonlaser=$donnees_aff['nb_rayonlaser'];
$nb_canonlaserlourd=$donnees_aff['nb_canonlaserlourd'];
$nb_canonelectro=$donnees_aff['nb_canonelectro'];
$nb_batterieions=$donnees_aff['nb_batterieions'];
$nb_protoplasma=$donnees_aff['nb_protoplasma'];
$nb_canonplasma=$donnees_aff['nb_canonplasma'];
$nb_rayonsplasma=$donnees_aff['nb_rayonsplasma'];
$nb_rayonanti=$donnees_aff['nb_rayonanti'];
$nb_blindageacier=$donnees_aff['nb_blindageacier'];
$nb_blindagetitane=$donnees_aff['nb_blindagetitane'];
$nb_blindagenatre=$donnees_aff['nb_blindagenatre'];
$nb_blindageorga=$donnees_aff['nb_blindageorga'];
$nb_blindagenano=$donnees_aff['nb_blindagenano'];
$nb_protobou=$donnees_aff['nb_protobou'];
$nb_boudef=$donnees_aff['nb_boudef'];
$nb_champforce=$donnees_aff['nb_champforce'];
$nb_bouelectro=$donnees_aff['nb_bouelectro'];
$nb_bouplasma=$donnees_aff['nb_bouplasma'];
$nb_bouanti=$donnees_aff['nb_bouanti'];
$nb_reacprimal=$donnees_aff['nb_reacprimal'];
$nb_reacav=$donnees_aff['nb_reacav'];
$nb_reacimp=$donnees_aff['nb_reacimp'];
$nb_reacsub=$donnees_aff['nb_reacsub'];
$nb_reacanti=$donnees_aff['nb_reacanti'];
$nb_reachyper=$donnees_aff['nb_reachyper'];
$nb_brouelec=$donnees_aff['nb_brouelec'];
$nb_transfonde=$donnees_aff['nb_transfonde'];
$nb_brouhyper=$donnees_aff['nb_brouhyper'];
$nb_radarspa=$donnees_aff['nb_radarspa'];
$nb_radarhyper=$donnees_aff['nb_radarhyper'];
$nb_radargalac=$donnees_aff['nb_radargalac'];
$nb_occio=$donnees_aff['nb_occio'];
$nb_occanti=$donnees_aff['nb_occanti'];
$nb_infra_cle=$donnees_aff['nb_infra_cle'];
$nb_infra_clo=$donnees_aff['nb_infra_clo'];
$nb_infra_corv=$donnees_aff['nb_infra_corv'];
$nb_infra_freg=$donnees_aff['nb_infra_freg'];
$nb_infra_crole=$donnees_aff['nb_infra_crole'];
$nb_infra_crolo=$donnees_aff['nb_infra_crolo'];
$nb_infra_dest=$donnees_aff['nb_infra_dest'];
$nb_infra_mere=$donnees_aff['nb_infra_mere'];
$nb_infra_ruche=$donnees_aff['nb_infra_ruche'];
$nb_infra_amiral=$donnees_aff['nb_infra_amiral'];

$requete_pla_techno = $bdd->query('SELECT * from utilisateurs WHERE id="'.$_SESSION['id'].'"');
$donnees_rech = $requete_pla_techno->fetch();
$lvlcapteurs=$donnees_rech['lvlcapteurs'];
$lvlbrouillage=$donnees_rech['lvlbrouillage'];
$lvlcombustion=$donnees_rech['lvlcombustion'];
$lvlsublu=$donnees_rech['lvlsublu'];
$lvlpropanti=$donnees_rech['lvlpropanti'];
$lvlarmnuc=$donnees_rech['lvlarmnuc'];
$lvlocc=$donnees_rech['lvlocc'];
$lvllaser=$donnees_rech['lvllaser'];
$lvlions=$donnees_rech['lvlions'];
$lvlplasma=$donnees_rech['lvlplasma'];
$lvlarmanti=$donnees_rech['lvlarmanti'];
$lvlinfra=$donnees_rech['lvlinfra'];
$lvlexplo=$donnees_rech['lvlexplo'];
$lvlboubou=$donnees_rech['lvlboubou'];
$lvlcoque=$donnees_rech['lvlcoque'];
$lvlmaivortex=$donnees_rech['lvlmaivortex'];
$lvlgenetique=$donnees_rech['lvlgenetique'];
$lvlnano=$donnees_rech['lvlnano'];
$lvlteleport=$donnees_rech['lvlteleport'];
$lvlhyper=$donnees_rech['lvlhyper'];
$lvlphy=$donnees_rech['lvlphy'];
$lvlinfo=$donnees_rech['lvlinfo'];

//vitesse de construction des bats
	$modifconstruction = 0.9**$lvlusinerobo * 0.5**$lvlusinenanites;
//vitesse de recherche de techno
	$modifrecherche = 0.85**$lvllabo;
//vitesse de création des composants
	$modifcompos = 0.9**$lvlusinerobo * 0.5**$lvlusinenanites * 0.9**$lvlchantierspatial;
}
?>
	<div class="profil"><?php echo htmlspecialchars($_SESSION['nom']) ;

?>
	</div>

	<div class="ensemblecolle">
		<div class="bande">
			<div class="textbande"> BIENVENUE <?php echo htmlspecialchars($_SESSION['nom']) ;
			if (isset($_SESSION['planete'])){
echo " Vous êtes actuellement sur la planète ".$donnees_aff['nom_planete'];
echo " Fer ".cleanNumber($fer);
echo " Or ".cleanNumber($gold);
echo " Cristal ".cleanNumber($cri);
echo " Uranium ".cleanNumber($uranium);
echo " Antimatière ".cleanNumber($anti);
echo " datediff ".cleanNumber($temps_ecoule);
echo " Place occupée ".$taille_prise." / ".$taille_max;
} ?>
<!-- fin de textbande -->
			</div>
<!-- fin de bande -->
		</div>

<?php // AFFICHAGE DU MENU ?>
		<div class="sousbande">
			<div id="menu">
				<h2 class="barre_menu"> Contrôle galactique </h2>
				<li> <a class="menu_txt" href="index.php?page=salledecontrole"> Salle de contrôle </a> </li>
				<li> <a class="menu_txt" href="index.php?page=galaxie"> Galaxie </a> </li>
				<li> <a class="menu_txt" href="index.php?page=flotte"> Flottes </a> </li>
				<li> <a class="menu_txt" href="index.php?page=pylone"> Pylône du Vortex </a> </li>
				<h2 class="barre_menu"> Gestion de planètes </h2>
				<li> <a class="menu_txt" href="index.php?page=batiments"> Bâtiments </a> </li>
				<li> <a class="menu_txt" href="index.php?page=recherche"> Recherche </a> </li>
				<li> <a class="menu_txt" href="index.php?page=chantierspatial"> Chantier spatial </a> </li>
				<li> <a class="menu_txt" href="index.php?page=defenses"> Défenses planétaires </a> </li>
				<li> <a class="menu_txt" href="index.php?page=caserne"> Caserne militaire </a> </li>
				<li> <a class="menu_txt" href="index.php?page=doctrines"> Doctrines </a> </li>
				<li> <a class="menu_txt" href="index.php?page=production"> Production </a> </li>
				<h2 class="barre_menu"> Univers </h2>
				<li> <a class="menu_txt" href="index.php?page=prerequis"> Technologies et pré-requis </a> </li>
				<li> <a class="menu_txt" href="index.php?page=commerce"> Commerce </a> </li>
				<li> <a class="menu_txt" href="index.php?page=alliances"> Alliances </a> </li>
				<li> <a class="menu_txt" href="index.php?page=classement"> Classement </a> </li>
				<li> <a class="menu_txt" href="index.php?page=rares"> Objets rares </a> </li>
				<h2 class="barre_menu"> Portail joueur </h2>
				<li> <a class="menu_txt" href="index.php?page=boutique"> Boutique </a> </li>
				<li> <a class="menu_txt" href="index.php?page=messagerie"> Messagerie </a> </li>
				<li> <a class="menu_txt" href="index.php?page=forum"> Forum </a> </li>
				<li> <a class="menu_txt" href="accueil.php"> Déconnexion </a> </li>
<br />

			</div>

<div id="restepage">
<?php /* MENU DEROULANT POUR LES PLANETES */

$requete_planetes3 = $bdd->query("SELECT * from planetes WHERE id_joueur='".$_SESSION['id']."'");

// LE GROS TRUC DANS ACTION = PERMET DE GARDER LA MEME PAGE (BATIMENTS, CHANTIER SPATIAL, ETC.) QUAND ON CHANGE DE PLANETE
?>
<form id="menuplanetes" method="post" action="index.php<?php if(isset($_GET['page'])){
echo "?page=".$_GET['page'];
}
?>">
<select name="planete">
<?php while($i = $requete_planetes3->fetch()){
if($i['id_planete']==$_SESSION['planete']){
?>

<option value=<?php echo $i['id_planete']?> ; selected="selected"><?php echo $i['nom_planete'] ?></option>
<?php										}
else{?>
<option value=<?php echo $i['id_planete'] ?> ><?php echo $i['nom_planete'] ?></option>
<?php
}
//fin du while
}
?>
</select>
<input type="submit" value="Envoyer" />
</form>
	
<!-- fin de restepage -->
		</div>
<!-- fin de sousbande -->
	</div>
<!-- fin de ensemblecolle -->
</div>
	<?php 
}
else
{ 
if($connexionvalide==0){
		header('Location: accueil.php?statut=mdpincorrect');}
		else{
	header('Location: accueil.php?statut=wtf');
			}
?>
<div class="ensemblecolle">
	<div class="bande">
		<div class="textbande"> CETTE PAGE NE DEVRAIT PAS ETRE ACCESSIBLE. CONTACTEZ OVERDOGE
			
		</div>
	</div>


	<div class="sousbande">
	
	</div>
</div>
<?php

}

/* 
FERMER LES CURSEURS DE REQUETE*/
if(isset($req_session)){
$req_session->closeCursor();
}
if(isset($requete_id)){
$requete_id->closeCursor();
}
if(isset($requete_planetes)){
$requete_planetes->closeCursor();
}
if(isset($requete_insertion_com)){
$requete_insertion_com->closeCursor();
}
if(isset($req_temps)){
$req_temps->closeCursor();
}
if(isset($req_updateress)){
$req_updateress->closeCursor();
}
if(isset($requete_planetes3)){
$requete_planetes3->closeCursor();
}
if(isset($requete_pla_affichage)){
$requete_pla_affichage->closeCursor();
}
if(isset($requete_pla_encours)){
$requete_pla_encours->closeCursor();
}
if(isset($requete_insertion_construction)){
$requete_insertion_construction->closeCursor();
}
if(isset($requete_insertion_destruction)){
$requete_insertion_destruction->closeCursor();
}
if(isset($requete_datediff_construction)){
$requete_datediff_construction->closeCursor();
}
if(isset($req_updateprod)){
$req_updateprod->closeCursor();
}
if(isset($requete_insertion_annulation)){
	$requete_insertion_annulation->closeCursor();
}
if(isset($requete_pla_techno)){
	$requete_pla_techno->closeCursor();
}
if(isset($requete_insertion_recherche)){
	$requete_insertion_recherche->closeCursor();
}
if(isset($requete_datediff_recherche)){
	$requete_datediff_recherche->closeCursor();
}
if(isset($requete_insertion_newtech)){
	$requete_insertion_newtech->closeCursor();
}
if(isset($requete_insertion_newcomp)){
	$requete_insertion_newcomp->closeCursor();
}
if(isset($requete_insertion_newcomp2)){
	$requete_insertion_newcomp2->closeCursor();
}
if(isset($requete_annulationrech1)){
	$requete_annulationrech1->closeCursor();
}
if(isset($requete_annulationrech2)){
	$requete_annulationrech2->closeCursor();
}
if(isset($requete_isgoodplanete)){
	$requete_isgoodplanete->closeCursor();
}
if(isset($req_regardercompos)){
	$req_regardercompos->closeCursor();
}
if(isset($requete_composants)){
	$requete_composants->closeCursor();
}

?>
</body>
</html>
