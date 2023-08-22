<?php session_start();
if($_SESSION['user'] != "Administrateur"){
  header("location:index.php");
}?>
<?php     
//connexion la base de donnée  
require('./classeSing.php');
$conBD = Database::getInstance();?>
<?php     
//deposer le contenu dans les champs
$a=0;
        if(isset($_GET['Indice']) ){
            $id= (int) $_GET['Indice'];
            $a=$id;
            $req=$conBD->query("SELECT  Login, Motpass ,categorie,Email  FROM Utilisateur where Code=$id");
            while($TabEtud1=$req->fetch()){
              $login=$TabEtud1["Login"];
              $category=$TabEtud1["categorie"];
              $password=$TabEtud1["Motpass"];
              $email=$TabEtud1["Email"];
          } }    
?>
<?php  
//pronez le nouveau contenu
if(isset($_POST['valider'])){
  $etud1=$conBD->prepare("UPDATE Utilisateur SET  Login = :lo , Motpass= :pa , categorie = :ca WHERE Code = $a ");
  $etud2=array('no'=>$_POST['name'], 'lo'=>$_POST['user_name'], 'pa'=>$_POST['code'],'ca'=>$_POST['cat']);
  $etud1->execute($etud2);
  header("location:dashboard.php"); 
}else if(isset($_POST['annuler']))header("location:dashboard.php");   
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
  <!-- <div>
    <label for="">Name:</label>
    <input type="text" id="name" name="name" value="<?php echo $name;?>"/>
  </div> -->
  <div>
    <label for="">Login:</label>
    <input type="text" id="user_name" name="user_name" value="<?php echo $login;?>"/>
  </div>
  <div>
    <label for="">Password:</label>
    <input type="password" id="code" name="code" value="<?php echo $password;?>"/>
  </div>
  <div>
  <label for="">Category:</label>
<?php  if($category == "Etudiant"){?>
<select id="cat" name="cat">
  <option value="Administrator">Administrateur</option>
  <option value="Professor" >Professeur</option>
  <option value="Etudiant" selected>Etudiant</option>
</select>
<?php  }?>
<?php  if($category == "Professor"){?>
<select id="cat" name="cat">
  <option value="Administrator">Administrateur</option>
  <option value="Professor" selected>Professeur</option>
  <option value="Etudiant" >Etudiant</option>
</select>
<?php  }?>
<?php  if($category == "Administrator"){?>
<select id="cat" name="cat">
  <option value="Administrator" selected>Administrateur</option>
  <option value="Professor" >Professeur</option>
  <option value="Etudiant" >Etudiant</option>
</select>
<?php  }?>
  </div>
  <label for="">Email:</label>
    <input type="email" id="email" name="email"value="<?php echo $email;?>"/>
  </div>
  <div>
    <input type="submit" name="valider"  value="Valider">
  </div>
  </div>
  <input type="submit" name="annuler" value="Annuler" >
  </div>
</label>
</form>
</body>
</html>