<?php session_start();
if($_SESSION['user'] == "Administrateur" || $_SESSION['user'] == "Professeur"){?>
<?php     
//connexion la base de donnée  
require('connexionBD.php');?>
<?php     
//deposer le contenu dans les champs
$a=0;
        if(isset($_GET['Indice']) ){
            $id= (int) $_GET['Indice'];
            $a=$id;
            $req=$conBD->query("SELECT Nom , Maths , Info FROM etudiant where IdE=$id");
            while($TabEtud1=$req->fetch()){
              $name=$TabEtud1["Nom"];
              $math=$TabEtud1["Maths"];
              $info=$TabEtud1["Info"];
          } 
            $Res=$_SESSION['Prof'];
            $oper='modification';
            $reqqq=$conBD->query("INSERT INTO `audit` (`utilisateur`, `Operation`, `NomTable`, `Datemdf`) VALUES ('$Res', '$oper', 'Etudiant', NOW());");
        }    
?>
<?php  
//pronez le nouveau contenu
if(isset($_POST['Valider'])){
  $etud1=$conBD->prepare("UPDATE etudiant SET Nom = :no, Maths= :ma , Info= :in WHERE IdE = $a ");
  $etud2=array('no'=>$_POST['name'], 'ma'=>$_POST['math'], 'in'=>$_POST['info']);
  $etud1->execute($etud2);
  header("location:ListeCRUD.php");
}else if( isset($_POST['Annuler']) )  header("Location:ListeCRUD.php");  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<form action="" method="post">
  <div>
    <label for="name">Etudiant:</label>
    <input type="text" id="name" name="name" value="<?php echo $name; ?>" />
  </div>
  <div>
    <label for="math">Maths:</label>
    <input type="number" id="math" name="math" value="<?php echo $math; ?>"/>
  </div>
  <div>
   <label for="info">Informatique:</label>
   <input type="number" id="info" name="info" value="<?php echo $info; ?>"/>
  </div>
  <div>
    <input type="submit" name="Valider"  value="Valider">
  </div>
  <input type="reset" name="Annuler" value="Annuler" >
  </div>
</form>
<?php }else{
  header("location:index.php");
}?>
</body>
</html>