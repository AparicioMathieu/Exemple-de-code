<?php

session_start();
ob_start();

if (!isset($_SESSION['logged'])) { // Verifie si on loggé , puis va cherché l'index.php
    header('Location: index.php');
    die();
}

$staffPerms = $_SESSION['perms']; // Verifie les permissions
$user = $_SESSION['user'];

$conecG = 'work';
$_SESSION['conecFail'] = $conecG;

include 'verifyPanel.php';
masterconnect();

$players = 0; // Initiation de variable
$money = 0;   // Initiation de variable

$sqlget = 'SELECT * FROM players'; // Requete
$sqldata = mysqli_query($dbcon, $sqlget) or die('Connexion non établie');

while ($row = mysqli_fetch_array($sqldata, MYSQLI_ASSOC)) { // Boucle permettant de recupérée sous forme de tableau des donnée de la requete précedente
    ++$players;
    $money = $money + $row['cash'] + $row['bankacc'];
}

$sqlgetVeh = 'SELECT * FROM vehicles';// Requete
$sqldataVeh = mysqli_query($dbcon, $sqlgetVeh) or die('Connexion non établie');
$vehicles = mysqli_num_rows($sqldataVeh);

include 'header/header.php';
?>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 style = "margin-top: 70px">Tableau de bord</h1>
     	  <p class="page-header">Tableau de bord du panel.</p>
<?php
    // Compteur de joueur
    echo '
    <div class="row">
    <div class="col-md-4">
    ';

    echo    "<div id='rcorners1'>";
    echo        "<div class='box-top'><center><h1>Players</h1></div>";
    echo        "<div class='box-panel'><p></p>";
    echo        '<p><br><center>Il y a actuellement '.$players.' personnes fichée dans nos services.</p>';
    echo        '</div>';
    echo    '</div>';

    echo    '</div>';
    echo '<div class="col-md-4">';

    //Liste de véhicule

    echo    "<div id='rcorners2'>";
    echo        "<div class='box-top'><center><h1>Véhicules</h1></div>";
    echo        "<div class='box-panel'><p></p>";
    echo        '<p><br><center>Il y a actuellement. '.$vehicles.' Véhicules.</p>';
    echo        '</div>';
    echo    '</div>';

    echo    '</div>';
    echo '<div class="col-md-4">';

    //?
$money = '$'.number_format($money, 2);

    echo    "<div id='rcorners3'>";
    echo        "<div class='box-top'><center><h1>Total Money</h1></div>";
    echo        "<div class='box-panel'><p></p>";
    echo        '<p><br><center>Il y a un total de '.$money.' sur le serveur.</p>';
    echo        '</div>';
    echo    '</div>';

    echo    '</div>';
    echo    '</div>';
    echo    '<div class="row">';
    echo '<div class="col-lg-4">';

    echo    "<div id='rcorners5'>";
    echo        "<div class='box-top'><center><h1>Redémarrer le server</h1></div>";
    echo        "<div class='box-panel'><p></p>";
    echo            '<form action=home.php method=post>';
    echo        "<div class = 'textSend'><td>"."<center><input class='btn btn-primary btn-outline' type=submit name=restart value=Redémarrer".' </td></div>';
    echo        '</div>';
    echo    '</div>';
    echo  '</form>';

    echo    '</div>';
    echo '<div class="col-lg-4">';

    echo    "<div id='rcorners4'>";
    echo        "<div class='box-top'><center><h1>Message global </h1></div>";
    echo        "<div class='box-panel'><p></p>";
    echo            '<form action=home.php method=post>';
    echo        "<div class = 'textInput'><td>"."<center><input class='form-control' type=text name=global value='' < /td></div><br>";
    echo        "<div class = 'textSend'><td>"."<center><input class='btn btn-primary btn-outline' type=submit name=send value=Envoyer".' </td></div>';
    echo        '</div>';
    echo    '</div>';
    echo  '</form>';

    echo    '</div>';
    echo '<div class="col-lg-4">';

    echo    "<div id='rcorners6'>";
    echo        "<div class='box-top'><center><h1>Arreter le server</h1></div>";
    echo        "<div class='box-panel'><p></p>";
    echo            '<form action=home.php method=post>';
    echo        "<div class = 'textSend'><td>"."<center><input class='btn btn-primary btn-outline' type=submit name=stop value=Stop".' </td></div>';
    echo        '</div>';
    echo    '</div>';
    echo  '</form>';

    echo    '</div>';
    echo    '</div>';
    echo    '<div class="row">';
    echo    '<div class="col-md-2">';
    echo    '</div>';
    echo    '<div class="col-lg-4">';

    echo    "<div id='rcorners8'>";
    echo        "<div class='box-top'><center><h1>Aide</h1></div>";
    echo        "<div class='box-top'><center><h4>Pour une aide générale sur le panel!</h4></div>";
    echo        "<div class='box-panel'><p></p>";
    echo            '<form action=home.php method=post>';
    echo        "<div class = 'textSend'><td>"."<center><input class='btn btn-primary btn-outline' type=submit name=help value=Aide".' </td></div>';
    echo        '</div>';
    echo    '</div>';
    echo  '</form>';

    echo    '</div>';
    echo '<div class="col-lg-4">';

if (isset($_POST['send'])) {
    if ($staffPerms['globalMessage'] == '1') {
        $send = $_POST['global'];
        $_SESSION['send'] = $send;
        header('Location: rCon/rcon-mess.php');
        $message = 'Admin '.$user.' has sent a global message ('.$send.')';
        logIt($user, $message, $dbcon);
    } else {
        header('Location: lvlError.php');
        die();
    }
}

if (isset($_POST['restart'])) {
    if ($staffPerms['restartServer'] == '1') {
        $message = 'Admin '.$user.' has restarted the server.';
        logIt($user, $message, $dbcon);
        header('Location: rCon/rcon-restart.php');
    } else {
        header('Location: lvlError.php');
        die();
    }
}

if (isset($_POST['stop'])) {
    if ($staffPerms['stopServer'] == '1') {
        $message = 'Admin '.$user.' has stopped the server.';
        logIt($user, $message, $dbcon);
        header('Location: rCon/rcon-stop.php');
    } else {
        header('Location: lvlError.php');
        die();
    }
}

if (isset($_POST['help'])) {
    header('Location: help.php');
    die();
}
ob_end_flush();
?>


</div>
</div>
          </div>
        </div>
      </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="dist/js/bootstrap.min.js"></script>
    
    <script src="../../assets/js/vendor/holder.min.js"></script>
   
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
