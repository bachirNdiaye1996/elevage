<?php

    // On se connecte à là base de données
    session_start(); 
    
    if(!$_SESSION){
        header("location: ../404.php");
        return 0;
    }

    include "../connexion/conexiondb.php";

    require '../fpdf/fpdf.php';


    $id = $_GET['idreceptionpoussin'];

    $sql = "select * from receptionpoussin where idreceptionpoussin=$id";
    $result = $db->query($sql);
    $Receptionpoussin = $result->fetch();

    $sql = "select * from achataliment where idachataliment=$id";
    $result = $db->query($sql);
    $Achataliments = $result->fetch();

    $sql = "select * from dette where iddette=$id";
    $result = $db->query($sql);
    $Dette = $result->fetch();

    $sql = "select * from divers where iddivers=$id";
    $result = $db->query($sql);
    $Divers = $result->fetch();

    $sql = "select * from mortalite where idmortalite=$id";
    $result = $db->query($sql);
    $Mortalite = $result->fetch();

    $sql = "select * from stockagefrigo where idstockagefrigo=$id";
    $result = $db->query($sql);
    $Stockagefrigo = $result->fetch();

    $sql = "select * from vente where idvente=$id";
    $result = $db->query($sql);
    $Vente = $result->fetch();

    $sql = "select * from vaccination where idvaccination=$id";
    $result = $db->query($sql);
    $Vaccination = $result->fetch();



    $pdf = new FPDF('P','mm','A4');


    $pdf->AddPage();
    $pdf->SetFont('Arial','B',16);

    /* Pour l'entete */

    $pdf->SetTextColor(50,60,100);
    $pdf->Cell(190,5,"SAMA *** GUINAR",0,1,'C');
    $pdf->SetFont('Arial','B',10);
    $pdf->SetTextColor(50,60,100);
    $pdf->Cell(190,14,utf8_decode(""),0,1,'C');
    $pdf->Cell(190,14,"Details de la reception de poussin",0,1,'C');


    //Pour achat Aliments
    $pdf->SetFont('Arial','B',9);
    $pdf->Cell(194,10,'',0,1);
    $pdf->SetTextColor(50,60,100);
    $pdf->Cell(190,8,utf8_decode("Liste des achats d'aliment"),0,1,'C');
    $pdf->SetFont('Arial','B',7);

    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(30,5,utf8_decode('Nombresac'),1,0,'C');  
    $pdf->Cell(30,5,utf8_decode('Prix'),1,0,'C');
    $pdf->Cell(30,5,utf8_decode('Fournisseur'),1,0,'C');
    $pdf->Cell(130,5,utf8_decode('Date Achat'),1,1,'C');

    $PrixAlimentTotal=0;
    foreach($Achataliments as $achataliment){        
        $pdf->Cell(30,5,utf8_decode($achataliment['nombresac']),1,0,'C');
        $pdf->Cell(30,5,utf8_decode($achataliment['prix']),1,0,'C');
        $pdf->Cell(30,5,utf8_decode($achataliment['fournisseur']),1,0,'C');
        $pdf->Cell(130,5,utf8_decode($achataliment['dateachat']),1,1,'C');

        $PrixAlimentTotal +=  $achataliment['prix'];
    }

   

    $pdf->Output();

