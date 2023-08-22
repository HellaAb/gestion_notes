<?php  
    try{
            $conBD = new PDO('mysql:host=localhost;dbname=GesNotes', 'root', '');
            // setAttribute( ):    Set the PDO error mode to exception
            $conBD->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        }
    catch (PDOException $e){ die( 'Erreur : ' . $e->getMessage() .'Numéro : '.$e->getCode() );  }
 ?>