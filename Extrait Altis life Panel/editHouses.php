<?php

session_start();
ob_start();
$version = '';

if (!isset($_SESSION['logged'])) {  // Verifie si on loggé , puis va cherché l'index.php
    header('Location: index.php');
    die();
}

$staffPerms = $_SESSION['perms']; // Initialisation du systéme de permission. Cela permet ensuite de verifier si les personnes connectée ont les permissions de voir les informations demandées.
$user = $_SESSION['user'];

$houseID = $_POST['hidden']; // Iniatialisation de variable

include 'verifyPanel.php';
masterconnect();
include 'header/header.php';
?>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 style = "margin-top: 70px">Menu Propriété</h1>
		  <p class="page-header">modifier Menu Propriété du panel, vous permet de modifier les valeurs de la base de données maison.</p>
          <div id="alert-area"></div>
            <div class="table-responsive">
            <table class="table table-striped" style = "margin-top: -10px">
              <thead>
                <tr>
					<th>Inventaire</th>
					<th>Équipement</th>
                    <th>actif</th>
                    <th>Propriété</th>
                </tr>
              </thead>
              <tbody>

<?php


$sqlget = "SELECT * FROM containers WHERE id='$houseID';"; // requete
$search_result = mysqli_query($dbcon, $sqlget) or die('Connection could not be established');


//Boucle qui va affichée les information recupérée dans des requetes
while ($row = mysqli_fetch_array($search_result, MYSQLI_ASSOC)) {
    echo '<tr>';
    echo '<td>' ?>
    <input class="form-control" onBlur="dbSave(this.value, '<?php echo $row['id']; ?>', 'inventory', '<?php echo $row['inventory']; ?>')"; type=text value= '<?php echo $row['inventory']; ?>' >
    <?php
    echo '</td>';
    echo '<td>' ?>
    <input class="form-control" onBlur="dbSave(this.value, '<?php echo $row['id']; ?>', 'gear', '<?php echo $row['gear']; ?>')"; type=text value= '<?php echo $row['gear']; ?>' >
    <?php
    echo '</td>';
    echo '<td>' ?>
    <input class="form-control" onBlur="dbSave(this.value, '<?php echo $row['id']; ?>', 'active', '<?php echo $row['active']; ?>')"; type=text value= "<?php echo $row['active']; ?>" >
    <?php
    echo '</td>';
    echo '<td>' ?>
    <input class="form-control" onBlur="dbSave(this.value, '<?php echo $row['id']; ?>', 'ownedCrate', '<?php echo $row['owned']; ?>')"; type=text value= "<?php echo $row['owned']; ?>" >
    <?php
    echo '</td>';
    echo '</tr>';
}
  echo '</table></div>';
  ?>

  <script>
  function newAlert (type, message) {
      $("#alert-area").append($("<div class='alert " + type + " fade in' data-alert><p> " + message + " </p></div>"));
      $(".alert").delay(2000).fadeOut("slow", function () { $(this).remove(); });
  }


  function dbSave(value, uid, column, original){

          if (value != original) {

              newAlert('alert-success', 'Value Updated!');

              $.post('Backend/updateHouses.php',{column:column, editval:value, id:uid},
              function(){
                  //alert("Sent values.");
              });
          };

  }
  </script>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
  </body>
</html>
