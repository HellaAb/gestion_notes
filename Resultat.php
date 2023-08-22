<?php 
    session_start()
?>
<?php 
 require('classeSing.php');
 $conBD = Database::getInstance();
?>
<?php
    if(isset($_GET['Indice']) ){
      $id= (int) $_GET['Indice'];
      require('fpdf/fpdf.php');
      class PDF extends FPDF
    {
    // En-tête
    function Header()
    {
        // Logo
        $this->Image('image/logo.png',10,6,40);
        $this->Image('image/logo2.jpg',180,6,20);
        $this->Image("image/Tampon.png" ,150,70,20);
        // Police Arial gras 15
        $this->SetFont('Arial','B',15);
        // Décalage à droite
        $this->Cell(80);
        // Titre
        $this->Cell(30,10,'Bulletin',4,1,'C');
        // Saut de ligne
        $this->Ln(20);
    }

// Pied de page
    function Footer()
    {
        // Positionnement à 1,5 cm du bas
        $this->SetY(-15);
        // Police Arial italique 8
        $this->SetFont('Arial','I',8);
        // Numéro de page
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
}

// Create new PDF document
    $pdf = new PDF();
// Add new page
    $pdf->AddPage();
// Set font and font size
    $pdf->SetFont('Arial','B',12);
// Add table headers
    $pdf->Cell(50,10,'Nom',1,0,'C');
    $pdf->Cell(40,10,'Math',1,0,'C');
    $pdf->Cell(40,10,'Informatique',1,0,'C');
    $pdf->Cell(40,10,'Moyenne',1,0,'C');
    $pdf->Ln();
// Retrieve data from database
    $sql = "SELECT Nom, Maths, Info FROM etudiant where IdE=$id";
    $result = $conBD->query($sql);
// Loop through data and add to PDF document
  while($data = $result->fetch()) {
    $name=$data['Nom'];
    $NoteMath= floatval($data['Maths']);
    $NoteInfo=floatval($data['Info']);
    $Moyenne=($NoteMath+$NoteInfo)/2;
    if($Moyenne>=0 && $Moyenne<10){
        $Mention="Non Admit";
    }
    if($Moyenne>=10 and $Moyenne<12){
        $Mention="Passable";
    }
    elseif($Moyenne>=12 and $Moyenne<14){
        $Mention="A Bien";
    } 
    elseif($Moyenne>=14 and $Moyenne<16){
        $Mention=" Bien";
    }
    elseif($Moyenne>=16 and $Moyenne<=20){
        $Mention="Tres Bien";
    } 
    $pdf->Cell(50,10,$name,1);
    $pdf->Cell(40,10,$NoteMath,1,0,'C');
    $pdf->Cell(40,10,$NoteInfo,1,0,'C');
    $pdf->Cell(40,10,$Moyenne,1,0,'C');
   
    $pdf->Ln();
    $pdf->Cell(40,10,$Mention,1,0,'C');
  }
// Close database connection
    $pdo=NULL;
// Output PDF document to browser
    $pdf->Output();
    $pdf->Output("etd$i.pdf",'F');
// header("Location:ListeCRUD.php"); 
}
?>