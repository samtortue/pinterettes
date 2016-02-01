<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="style.css"  title="no title" charset="utf-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  <title>Pinterettes</title>
</head>
<body>

  <!-- ********************************************************************************** Welcome User text -->
  <div id="welcomeUser">
    <?php
    echo 'Hello ' .$_SESSION['pseudo'].$_SESSION['id'].' !';
    ?>
  </div>

  <!-- ********************************************************************************** End welcome user text -->

  <!-- ************************************************************************************ Upload Form -->
  <div id="btnContainer">
    <form method="post" action="upload.php" enctype="multipart/form-data"/>
    <input type="file" name="image" placeholder="image"/>
    <label>your file shouldn't exceed 2Mo</label>
    <input type="hidden" name="MAX_FILE_SIZE" value="2000000"/>
    <label>Comment</label><textarea name="titre" rows="2" cols="40" placeholder="titre"></textarea>
    <input type="submit" name="submit" value="submit"/>
  </form>


  <!-- ******************************************************************************** Connexion database -->
  <?php
  try
  {
    $connexion = new PDO('mysql:host=localhost; dbname=pinterettes', 'root','root');
  } catch (Exception $e)
  {
    die('Erreur : '.$e->getMessage() );
  }

  $iduser = $_SESSION['id'];
  // ********************************************************************************** Requête -->
  $img_req = "SELECT img_url FROM images WHERE user_id ='$iduser'";
  $donnees = $connexion->query($img_req);
  while($img_perso = $donnees->fetch()){
    ?>
    <img src="<?php echo $img_perso['img_url']?>"/>
    <?php } ?>


  </body>
  </html>
