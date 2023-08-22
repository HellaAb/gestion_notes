<?php
 session_start();
 ?>
 <?php
//connexion la base de donnée  
    require('classeSing.php');
    $conBD = Database::getInstance();
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
            <?php if($_SESSION['user'] == "Administrateur") { ?>
            <?php } ?>
            <?php if($_SESSION['user'] == "Professeur"){?>
            <?php } ?>
            <?php if($_SESSION['user']== "Etudiant"){?>
            <input type="submit" name="annul"value="Quitter">
            <?php } 
            ?>
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
                $etud3=$conBD->query("SELECT * FROM etudiant WHERE valide= 0;");
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
                            <a href="RestaurerEd.php?Indice='.$codeEd.'"> Restaurer </a>        
                                </td>';
                            }
                            echo '<td>
                            <a href="Resultat.php?Indice='.$codeEd.'"> <img class="imp" src="image/imp.png"> </a>
                            </td>';
                            echo"</tr>";
                        }
            ?>
    </form><br><br><br>
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
        $etud3=$conBD->query("SELECT Code,login,Motpass,Categorie,Email FROM Utilisateur where valide = 0;");
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
                <a href="Restaurer.php?Indice='.$code.'"> Restourer </a>
                      </td>';
                echo"</tr>";
              }
        ?>
        </table>
    </form>