<?php session_start();?>
<?php
if($_SESSION['user'] == "Administrateur" || $_SESSION['user'] == "Professeur"){

//connexion la base de donnée  
require('classeSing.php');
$conBD = Database::getInstance();
   ?>
<?php
//insert the informations in data base
if(isset($_POST['Valider'])){
  $etud1=$conBD->prepare('INSERT INTO etudiant (Nom,Maths,Info) values(:no, :ma, :in )');
  $etud2=array('no'=>$_POST['name'], 'ma'=>$_POST['math'], 'in'=>$_POST['info']);
  $etud1->execute($etud2);
  $Res=$_SESSION['Prof'];
  $oper='L ajoute';
  $reqqq=$conBD->query("INSERT INTO `audit` (`utilisateur`, `Operation`, `NomTable`, `Datemdf`) VALUES ('$Res', '$oper', 'Etudiant', NOW());");
  header("location:ListeCRUD.php");
}else if( isset($_POST['Annuler']) )  header("Location:ListeCRUD.php");   
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de l'insertion</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<form action="" method="post">
  <div>
    <label for="name">Etudiant:</label>
    <input type="text" id="name" name="name" />
  </div>
  <div>
    <label for="math">Maths:</label>
    <input type="number" id="math" name="math" />
  </div>
  <div>
   <label for="info">Informatique:</label>
   <input type="number" id="info" name="info" />
  </div>
  <div>
    <input type="submit" name="Valider"  value="Valider">
  </div>
  <input type="submit" name="Annuler" value="Annuler" >
  </div>
</form>
</body>
<?php  }else header("location:index.php"); ?>
</html>