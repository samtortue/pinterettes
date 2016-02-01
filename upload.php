<?php
session_start();
$dossier = 'images/';
$fichier = basename($_FILES['image']['name']);
$taille_maxi = 2000000;
$taille = filesize($_FILES['image']['tmp_name']);
$extensions = array('.png', '.gif', '.jpg', '.jpeg');
$extension = strrchr($_FILES['image']['name'], '.');
//Début des vérifications de sécurité...
if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
{
  $erreur = 'You can only upload png, gif, jpg, jpeg type of files';
}
if($taille>$taille_maxi)
{
  $erreur = 'Your file is bigger than a baby elephant, go back and fix that…';
}
if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
{
  //On formate le nom du fichier ici...
  $fichier = strtr($fichier,
  'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ',
  'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
  $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
  if(move_uploaded_file($_FILES['image']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
  {
    try
    {
      $connexion = new PDO('mysql:host=localhost; dbname=pinterettes', 'root','root');
    } catch (Exception $e)
   {
     die('Erreur : '.$e->getMessage());
   }

    $iduser=$_SESSION['id'];
    $titre=$_POST['titre'];
     $req = "INSERT INTO images VALUES (NULL, '$iduser', 'images/$fichier', '$titre')";
     $connexion->query($req);

}

  else //Sinon (la fonction renvoie FALSE).
  {
    echo 'Sorry buddy, the upload failed';
  }
}
else
{
  echo $erreur;
}
?>
