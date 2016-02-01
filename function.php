<?php
//recuperer le pseudo et le password dans la database. Pour aller dans la database il faut faire une requête //
session_start();

$_SESSION['pseudo'] = $_POST['pseudo'];

$password = $_POST['password'];

$table = [];
try
{
  $connexion = new PDO('mysql:host=localhost; dbname=pinterettes', 'root','root');
} catch (Exception $e)
{
  die('Erreur : '.$e->getMessage() );
}
$responses = $connexion->query("SELECT * FROM users");
while($donnees = $responses->fetch()){
  if (($_SESSION['pseudo'] == $donnees['pseudo'])&&($password == $donnees['password'])){
    $_SESSION['id']= $donnees['id'];
    array_push($table, header('Location: accueil.php'));
  }
};

$responses->closeCursor();

if ($table === []){
  header('Location: index.php');
}
else {
  echo $table[0];
}
?>
