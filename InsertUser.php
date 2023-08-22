<?php session_start();?>
<?php
//connexion la base de donnée  
require('connexionBD.php');?>
<?php 
 //virifier si la categorie de l'utilisateur si administrateur
 if($_SESSION['user'] != "Administrateur"){
  header("location:index.php");
}?>
<?php
//insert the informations in data base
if(isset($_POST['valider'])){
  $etud1=$conBD->prepare('INSERT INTO Utilisateur ( Login,Motpass ,Categorie,Email) values( :lo, :pa, :ca, :em )');
  $etud2=array('lo'=>$_POST['user_name'], 'pa'=>$_POST['code'], 'ca'=>$_POST['cat'],'em'=>$_POST['email']);
  $etud1->execute($etud2);
  header("location:dashboard.php");
}else if( isset($_POST['annuler']) )  header("Location:dashboard.php");   
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Page Insert user </title>
    <style>
      form{
        /* Uniquement centrer le formulaire sur la page */
        margin: 0 auto;
        /* width: 400px; */
        /* Encadré pour voir les limites du formulaire */
        padding: 1em;
        border: 1px solid #CCC;
        border-radius: 1em; 
        background-color: rgb(50, 137, 184);
        margin:auto;
        width: 600px;
}
label {
  /* Pour être sûrs que toutes les étiquettes ont même taille et sont correctement alignées */
  display: inline-block;
  width: 90px;
  text-align: right;
}
    </style>
</head>
<body>
<form action="" method="post">
  <div>
    <label for="">Login:</label>
    <input type="text" id="user_name" name="user_name"/>
  </div>
  <div>
    <label for="">Password:</label>
    <input type="password" id="code" name="code"/>
  </div>
  <div>
  <label for="">Category:</label>
<select id="cat" name="cat">
  <option value="Administrateur">Administrateur</option>
  <option value="Professeur" >Professeur</option>
  <option value="Etudiant" selected>Etudiant</option>
</select>
  </div>
  <label for="">Email:</label>
    <input type="email" id="email" name="email"/>
  </div>
  <div>
    <input type="submit" name="valider"  value="valider">
</div>
<div>
<div>
    <input type="submit" name="annuler"  value="Annuler">
  </div>
</label>
</form>
</body>
</html>