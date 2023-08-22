<?php session_start()?>
<?php 
if($_SESSION['user'] == "Administrateur" || $_SESSION['user'] == "Professeur" || $_SESSION['user'] == "Etudiant"){?>
<?php 
//connexion la base de donnée
require_once 'classeSing.php';
$conBD = Database::getInstance();
  ?>
<?php 
  if(isset($_POST['val'])){
    header("location:Nouveau.php");
  }else if(isset($_POST['annul'])){
    session_destroy();
    echo'The programme is finish good bay';exit(1);
  }
  ?>
  <?php
  function CalculMention($m){
        if($m>=0 && $m<10)return "Non Admit";
        if($m>=10 and $m<12)return "Passable";
        elseif($m>=12 and $m<14)return "A Bien";
        elseif($m>=14 and $m<16)return " Bien";
        elseif($m>=16 and $m<=20)return "Tres Bien";
    }
?>
<?php
if(isset($_POST['admin'])){
  header("location:dashboard.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ListeCRUD</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>
    <form action="" method="post">
        <?php if($_SESSION['user'] == "Administrateur") { ?>
        <input type="submit" name="admin" value="Admin">
        <input type="submit" name="val" value="Nouveau">
        <input type="submit" name="annul"value="Quitter">
        <?php } ?>
        <?php if($_SESSION['user'] == "Professeur"){?>
        <input type="submit" name="val" value="Nouveau">
        <input type="submit" name="annul"value="Quitter">
        <?php } ?>
        <?php if($_SESSION['user']== "Etudiant"){?>
        <input type="submit" name="annul"value="Quitter">
        <?php } ?>
        <table>
            <tr>
                <td>Code_Etud</td>
                <td>Nom</td>
                <td>Maths</td>
                <td>Informatique</td>
                <td>Moyenne</td>
                <td>Mention</td>
            </tr>
<?php
      $etud3=$conBD->query("SELECT * FROM etudiant WHERE valide= 1");
      while($TabEtud=$etud3->fetch()){
      $codeEd=$TabEtud["IdE"];
      $name=$TabEtud["Nom"];
      $math=$TabEtud["Maths"];
      $info=$TabEtud["Info"];
      //calcul le moyenne 
      $Moyenne=floatval($math+$info)/2;
      //calcul le mention
      $Mention=CalculMention($Moyenne);
    
            echo"<tr>";
                echo"<td>".$codeEd."</td>";
                echo"<td>".$name."</td>";
                echo"<td>". $math."</td>";
                echo"<td>". $info."</td>";
                echo"<td>".$Moyenne."</td>";
                echo"<td>".$Mention."</td>";
                if($_SESSION['user'] == "Administrateur" || $_SESSION['user'] == "Professeur" ){
                echo '<td>
                <a href="Modifier.php?Indice='.$codeEd.'"> <img src="image/user_edit.png"> </a>
                <a href="Supremer.php?Indice='.$codeEd.'"> <img src="image/user_delete.png"> </a>
                
                      </td>';
                }
                echo '<td>
                <a href="Resultat.php?Indice='.$codeEd.'"> <img class="imp" src="image/imp.png"> </a>
                </td>';
                echo"</tr>";
              }
?>
<?php }else header("location:index.php"); ?>
    </form>
</body>
</html>
