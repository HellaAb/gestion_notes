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
       $req=$conBD->query("UPDATE Utilisateur Set valide = 1 WHERE Code=$id");
       header("location:dashboard.php");
    }
    else header("location:dashboard.php");   
?>