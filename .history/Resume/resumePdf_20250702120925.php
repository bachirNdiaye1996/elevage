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
    $Receptionpoussin = $result->fetchAll();

    $sql = "select * from achataliment where idachataliment=$id";
    $result = $db->query($sql);
    $Achataliments = $result->fetchAll();

    $sql = "select * from dette where iddette=$id";
    $result = $db->query($sql);
    $Dette = $result->fetchAll();

    $sql = "select * from divers where iddivers=$id";
    $result = $db->query($sql);
    $Divers = $result->fetchAll();

    $sql = "select * from mortalite where idmortalite=$id";
    $result = $db->query($sql);
    $Mortalite = $result->fetchAll();

    $sql = "select * from stockagefrigo where idstockagefrigo=$id";
    $result = $db->query($sql);
    $Stockagefrigo = $result->fetchAll();

    $sql = "select * from vente where idvente=$id";
    $result = $db->query($sql);
    $Vente = $result->fetchAll();

    $sql = "select * from vaccination where idvaccination=$id";
    $result = $db->query($sql);
    $Vaccination = $result->fetchAll();



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


    //Pour reception poussins
    $pdf->SetFont('Arial','B',9);
    $pdf->Cell(194,10,'',0,1);
    $pdf->SetTextColor(50,60,100);
    $pdf->Cell(190,8,utf8_decode("Liste des bandes de poussins réceptionnées :"),0,1,'C');
    $pdf->SetFont('Arial','B',7);

    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(30,5,utf8_decode('Nombre de poussin'),1,0,'C');  
    $pdf->Cell(30,5,utf8_decode('Provenance'),1,0,'C');
    $pdf->Cell(30,5,utf8_decode('Prix total (cfa)'),1,0,'C');
    $pdf->Cell(90,5,utf8_decode('Date de réception'),1,1,'C');

    $PrixReceptionPoussinTotal=0;
    foreach($Receptionpoussin as $receptionpoussin){ 
        $pdf->Cell(30,5,utf8_decode($receptionpoussin['nombrepoussin']),1,0,'C');
        $pdf->Cell(30,5,utf8_decode($receptionpoussin['provenance']),1,0,'C');
        $pdf->Cell(30,5,utf8_decode($receptionpoussin['prix']),1,0,'C');
        $pdf->Cell(90,5,utf8_decode($receptionpoussin['datereception']),1,1,'C');

        $PrixReceptionPoussinTotal +=  $receptionpoussin['prix'];
    }

    if($Achataliments){
        //Pour achat Aliments
        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(194,10,'',0,1);
        $pdf->SetTextColor(50,60,100);
        $pdf->Cell(190,8,utf8_decode("Liste des achats d'aliment :"),0,1,'C');
        $pdf->SetFont('Arial','B',7);

        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(30,5,utf8_decode('Nombresac'),1,0,'C');  
        $pdf->Cell(30,5,utf8_decode('Prix'),1,0,'C');
        $pdf->Cell(30,5,utf8_decode('Fournisseur'),1,0,'C');
        $pdf->Cell(90,5,utf8_decode('Date Achat'),1,1,'C');

        $PrixAlimentTotal=0;
        foreach($Achataliments as $achataliment){ 
            $pdf->Cell(30,5,utf8_decode($achataliment['nombresac']),1,0,'C');
            $pdf->Cell(30,5,utf8_decode($achataliment['prix']),1,0,'C');
            $pdf->Cell(30,5,utf8_decode($achataliment['fournisseur']),1,0,'C');
            $pdf->Cell(90,5,utf8_decode($achataliment['dateachat']),1,1,'C');

            $PrixAlimentTotal +=  $achataliment['prix'];
        }
    }

    if($Dette){
        //Pour Dette
        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(194,10,'',0,1);
        $pdf->SetTextColor(50,60,100);
        $pdf->Cell(190,8,utf8_decode("Liste des dettes :"),0,1,'C');
        $pdf->SetFont('Arial','B',7);

        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(30,5,utf8_decode('Nombre de poulet'),1,0,'C');  
        $pdf->Cell(30,5,utf8_decode('Prix'),1,0,'C');
        $pdf->Cell(40,5,utf8_decode('Payabilité (remboursé)'),1,0,'C');
        $pdf->Cell(30,5,utf8_decode('Client'),1,0,'C');
        $pdf->Cell(50,5,utf8_decode('Date dette'),1,1,'C');

        $PrixDette=0;
        foreach($Dette as $dette){ 
            $pdf->Cell(30,5,utf8_decode($dette['nombrepoulet']),1,0,'C');
            $pdf->Cell(30,5,utf8_decode($dette['prix']),1,0,'C');
            $pdf->Cell(35,5,utf8_decode($dette['paye']),1,0,'C');
            $pdf->Cell(30,5,utf8_decode($dette['client']),1,0,'C');
            $pdf->Cell(50,5,utf8_decode($dette['dateachat']),1,1,'C');

            $PrixDette +=  $dette['prix'];
        }
    }


    if($Divers){
        //Pour Dette
        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(194,10,'',0,1);
        $pdf->SetTextColor(50,60,100);
        $pdf->Cell(190,8,utf8_decode("Liste des divers :"),0,1,'C');
        $pdf->SetFont('Arial','B',7);

        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(30,5,utf8_decode('Nom'),1,0,'C');  
        $pdf->Cell(30,5,utf8_decode('Prix'),1,0,'C');
        $pdf->Cell(30,5,utf8_decode('Quantités'),1,0,'C');
        $pdf->Cell(90,5,utf8_decode('Date divers'),1,1,'C');

        $PrixDivers=0;
        foreach($Divers as $divers){ 
            $pdf->Cell(30,5,utf8_decode($divers['nom']),1,0,'C');
            $pdf->Cell(30,5,utf8_decode($divers['prix']),1,0,'C');
            $pdf->Cell(30,5,utf8_decode($divers['quantite']),1,0,'C');
            $pdf->Cell(90,5,utf8_decode($divers['datedivers']),1,1,'C');

            $PrixDivers +=  $divers['prix'];
        }
    }


    //if($Mortalite){
        //Pour Dette
        $pdf->SetFont('Arial','B',9);
        $pdf->Cell(194,10,'',0,1);
        $pdf->SetTextColor(50,60,100);
        $pdf->Cell(190,8,utf8_decode("Liste des divers :"),0,1,'C');
        $pdf->SetFont('Arial','B',7);

        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(30,5,utf8_decode('Nombre de morts'),1,0,'C');  
        $pdf->Cell(30,5,utf8_decode('Cause'),1,0,'C');
        $pdf->Cell(90,5,utf8_decode('Date de mortalite'),1,1,'C');

        foreach($Mortalite as $mortalite){ 
            $pdf->Cell(30,5,utf8_decode($mortalite['nombremort']),1,0,'C');
            $pdf->Cell(30,5,utf8_decode($mortalite['cause']),1,0,'C');
            $pdf->Cell(90,5,utf8_decode($mortalite['datemortalite']),1,1,'C');

        }
    //}
   

    $pdf->Output();

