<?php 
    session_start();
    if($_SESSION['user'] != "Administrateur"){
    header("location:index.php");}
?>
<?php
//connexion la base de donnée  
    require('classeSing.php');
    $conBD = Database::getInstance();
?>
<?php
    if(isset($_POST['Nouveau'])){
        header("location:InsertUser.php");
    }
    else if (isset($_POST['Liste'])){
        header("location:Listesupp.php");
    }
    else if(isset($_POST['annuler'])){
        session_destroy();
        echo'The programme is finish good bay';exit(1);
        
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Dashboord</title>
</head>
<body>
    <form action="" method="post">
        <input type="submit" name="Nouveau" value="Nouveau">
        <input type="submit" name="Liste" value="Liste">
        <input type="submit" name="annuler" value="Quitter">
        <table>
        <tr>
            <td>Id</td>
            <td>User</td>
            <td>Password</td>
            <td>Category</td>
            <td>Email</td>
        </tr>
        <?php
        $etud3=$conBD->query("SELECT Code,login,Motpass,Categorie,Email FROM Utilisateur where valide = 1;");
        while($TabEtud=$etud3->fetch()){
        $code=$TabEtud["Code"];
        $login=$TabEtud["login"];
        $category=$TabEtud["Categorie"];
        $password=str_repeat("*", strlen($TabEtud["Motpass"]));;
        $email=$TabEtud["Email"];
            echo"<tr>";
                echo"<td>".$code."</td>";
                echo"<td>". $login."</td>";
                echo"<td>". $password."</td>";
                echo"<td>". $category."</td>";
                echo"<td>". $email."</td>";
                echo '<td>
                <a href="ModUser.php?Indice='.$code.'"> <img src="image/user_edit.png"> </a>
                <a href="SupUser.php?Indice='.$code.'"> <img src="image/user_delete.png"> </a>
                      </td>';
                echo"</tr>";
              }
        ?>
        </table>
    </form>
</body>
</html>