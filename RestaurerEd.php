<?php session_start();
  if($_SESSION['user'] != "Administrateur"){
    header("location:index.php");
}
?>
<?php     
//connexion la base de donnée  
    require_once 'classeSing.php';
    $conBD = Database::getInstance();
?>
<?php     
    if(isset($_GET['Indice']) ){
       $id= (int) $_GET['Indice'];
       $req=$conBD->query("UPDATE Etudiant Set valide = 1 WHERE IdE=$id");
       header("location:ListeCRUD.php");
    }
    else header("location:ListeCRUD.php");   
?>