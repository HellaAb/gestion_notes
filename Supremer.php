<?php session_start();
if($_SESSION['user'] == "Administrateur" || $_SESSION['user'] == "Professeur"){
?>
<?php     
//connexion la base de donnée  
    require_once 'classeSing.php';
    $conBD = Database::getInstance();
?>
<?php     
    if(isset($_GET['Indice']) ){
       $id= (int) $_GET['Indice'];
       $Res=$_SESSION['Prof'];
       $oper='supprission';
       $req=$conBD->query("UPDATE etudiant SET valide = 0 WHERE IdE=$id");
       $reqqq=$conBD->query("INSERT INTO `audit` (`utilisateur`, `Operation`, `NomTable`, `Datemdf`) VALUES ('$Res', '$oper', 'Etudiant', NOW());");
       header("location:ListeCRUD.php");
    } 
    
 
?>
<?php }else   header("location:index.php");?>