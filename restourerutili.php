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
