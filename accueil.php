<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="style.css"  title="no title" charset="utf-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  <link href='https://fonts.googleapis.com/css?family=Josefin+Sans:400,400italic,600italic,600,700,700italic,300italic,300,100italic,100' rel='stylesheet' type='text/css'>
  <title>Pinterettes</title>
</head>
<body>

  <!-- *************************************************************************  hello user + searchbar -->
  <a href="userpage.php"><SVG<i class="fa fa-user fa-5x" id="btn"></i></a>
  <div id="helloUser">
    <?php
    echo 'Hello ' .$_SESSION['pseudo'].$_SESSION['id'].' !';
    ?>
  </div>

  <div id="searchbar">
    <form action="" class="formulaire">
      <input class="champ" type="text" value="what are you pinning for ?"/>
      <input class="bouton" type="submit" value=""/>
    </form>
  </div>


  <!-- ***************************************************************************** Connexion à la database -->
  <?php
  try
  {
    $connexion = new PDO('mysql:host=localhost; dbname=pinterettes', 'root','root');
  } catch (Exception $e)
  {
    die('Erreur : '.$e->getMessage() );
  }
    ?>



    <!-- *************************************************************************** Affichage des images -->
    <?php
    $auteur = $connexion->query("SELECT * FROM users INNER JOIN images ON users.id=images.user_id");
    while($afficheAuteur = $auteur->fetch()){
    ?>

    <div class="pimpmypic">
      <div class="pic">
        <img src="<?php echo $afficheAuteur["img_url"]?>"/>
        <p id="imgTitle"><?php echo $afficheAuteur['img_name']?></p>
      <p id='userName'> Pinteretté par <?php echo $afficheAuteur['pseudo'] ?></p>
        </div>
        <?php
      };
      ?>

    </div>


  </body>
  </html>
