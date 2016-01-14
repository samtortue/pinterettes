<?php
//recuperer le pseudo et le password dans la database. Pour aller dans la database il faut faire une requête //
$pseudo = $_POST['pseudo'];//$responses va créer un tableeau de tableaux //
$password = $_POST['password'];
 try
 {
   $connexion = new PDO('mysql:host=localhost; dbname=pinterettes', 'root','root');
 } catch (Exception $e)
{
  die('Erreur : '.$e->getMessage() );
}

$responses = $connexion->query("SELECT * FROM users");
while($donnees = $responses->fetch()){
if (($pseudo == $donnees['pseudo'])&&($password == $donnees['password'])){
echo " come in you slut ";
}
else{ header('Location: index.php'); }
};

$responses->closeCursor();
 ?>
