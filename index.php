<?php 
      session_start()
?>
<?php
      require_once 'classeSing.php';
      $conBD = Database::getInstance();
?>
<?php 
      $etud3=$conBD->query("SELECT  Login, Motpass , Categorie FROM Utilisateur");
      while($TabEtud=$etud3->fetch()){
        $login=$TabEtud["Login"]; $password=$TabEtud["Motpass"];  $category=$TabEtud["Categorie"];
          if(isset($_POST['Valider'])){
              if($_POST['name']==$login and $_POST['code'] == $password){
                $_SESSION['user']=$category;
                $_SESSION['Prof']=$login;
                header("location:ListeCRUD.php");
              }
          }
      }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autentification</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>
    <form action="" method="post">
    <img src="./image/Conex.png" alt="Image de fond">
    <h2>Autentification</h2>
    <div class="div1">
    <label for="name">Identifiant:</label><br>
    <input class="input1" type="text" id="name" name="name"/>
    </div>
    <div class="div1">
    <label for="code">Mot de passe:</label><br>
    <input class="input1" type="password" id="code" name="code" />
    </div><br><br>
  <input class="btn" type="submit" name="Valider" value="Valider" >
  <input class="btn" type="reset" name="Annuler" value="Annuler" >
  
</form>
</body>
</html>
<style>
  form {
  /* Uniquement centrer le formulaire sur la page */
  margin: 0 auto;
  width: 400px;
  /* Encadré pour voir les limites du formulaire */
  padding: 1em;
  border: 4px solid #818ac1;
    border-radius: 3em;
  /* background-color: rgb(184, 126, 50); */
}
form h2{
  text-align: center;

}
label {
  /* Pour être sûrs que toutes les étiquettes ont même taille et sont correctement alignées */
  display: inline-block;
  width: 90px;
  text-align: right;
}
form .btn{
   margin: 0px 0 0 152px;
   width: 150px; 
   height: 30px;
   text-align: center; 
  
}
form img{
  WIDTH: 75px;
    HEIGHT: 75px;
    MARGIN: 36px 0 8px 154px;
}
form .div1{
  color: black;
    text-align: center; 
}
form .input1{
  color: burlywood;
  text-align: center;
  width: 250px; 
  height: 30px;

}
 

</style>