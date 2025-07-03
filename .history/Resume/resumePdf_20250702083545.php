
















<?php

    // On se connecte à là base de données
    session_start(); 
    
    if(!$_SESSION){
        header("location: ../404.php");
        return 0;
    }

    include "../connexion/conexiondb.php";

    require '../fpdf/fpdf.php';


    $id = $reception['idreceptionpoussin'];

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


    $pdf->Output();

