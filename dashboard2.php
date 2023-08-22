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
<!DOCTYPE html>
<html>
<head>
	<title>Mon Dashboard</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<header>
		<h1>Mon Dashboard</h1>
	</header>
	<nav>
		<ul>
			<li><a href="index.php">Accueil</a></li>
			<li><a href="#">Tableau de bord</a></li>
			<li><a href="#">Statistiques</a></li>
			<li><a href="#">Paramètres</a></li>
		</ul>
	</nav>
	<main>
		<aside>
			<ul>
				<li><a href="#" id="tb_etud">Tableau des etudiants</a></li>
				<li><a href="#" id="tb_use">Tableau des utilisateurs</a></li>
                <li><a href="#" id="liste_opr">Liste des operations effectuee</a></li>
				<li><a href="#" id="donnees_sup">les donnees supprimer </a></li>
				<li><a href="#" id="prmt">Paramètres</a></li>
			</ul>
		</aside>
		<section>
			<h2>Statistiques</h2>
			<p>Voici les statistiques actuelles:</p>
			<ul>
				<li>Nombre d'operations effectuee : 100</li>
				<li>Nombre des etudiants : 10 000 €</li>
				<li>Nombre des professeurs: 5%</li>
			</ul>
		</section>
	</main>
    
    <form action="" id="use_page" method="post" style="display: none;">
    <span class="close">&times;</span>
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
	<footer>
		<p>Copyright © Mon Dashboard</p>
	</footer>
	<!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->
	<script src="app.js"></script>
</body>
</html>
