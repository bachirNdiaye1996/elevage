                                            <!-- Pour le status !--> 
                                                        <div class="modal fade" id="Information<?= $i ?>" tabindex="-1" aria-labelledby="fileModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-xl modal-dialog-centered" style="width=750px">
                                                                <div class="modal-content">
                                                                    <div class="card">
                                                                        <div class="card-header bg-primary text-center">
                                                                            <h5 class="modal-title" id="fileModalLabel" style="color:white"></h5>
                                                                        </div>
                                                                        <div class="card-body">
                                                                            <div class="col-lg-12 mt-5 mb-5">

                                                                                <div class="form-group row">
                                                                                    <label for="staticEmail" class="col-sm-4 col-form-label"><h5>Numéro de la bande :</h5></label>
                                                                                    <div class="col-sm-4">
                                                                                        <h5 style="color:blue;"><?= $Receptionpoussin['idreceptionpoussin'] ?></h5>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group row">
                                                                                    <label for="staticEmail" class="col-sm-4 col-form-label"><h5>Nombre poussin :</h5></label>
                                                                                    <div class="col-sm-4">
                                                                                        <h5 style=""><?= "REC00-".$Receptionpoussin['nombrepoussin'] ?></h5>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group row">
                                                                                    <label for="staticEmail" class="col-sm-4 col-form-label"><h5>Prix total poussin :</h5></label>
                                                                                    <div class="col-sm-4">
                                                                                        <h5><?= $Receptionpoussin['prix'] ?></h5>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group row">
                                                                                    <label for="staticEmail" class="col-sm-4 col-form-label"><h5>Date de réception :</h5></label>
                                                                                    <div class="col-sm-6">
                                                                                        <h5><?= $Receptionpoussin['datereception'] ?></h5>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="card position-relative">
                                                                                    <div class="card-header py-3">
                                                                                        <h6 class="m-0 font-weight-bold text-primary">Liste des achats d'aliment</h6>
                                                                                    </div>
                                                                                    <div class="row m-2">
                                                                                        <div class="table-responsive">
                                                                                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                                                                <thead>
                                                                                                    <tr>       
                                                                                                        <th></th>                                                                                
                                                                                                        <th></th>
                                                                                                        <th></th>
                                                                                                        <th></th>
                                                                                                    </tr>
                                                                                                </thead>
                                                                                                <tbody>
                                                                                                    <?php
                                                                                                        foreach(){
                                                                                                    ?>
                                                                                                        <tr>
                                                                                                            <td style="background-color:#CFFEDA ;"><?=  ?></td>
                                                                                                            <td style="background-color:#CFFEDA ;"><?=  ?></td>
                                                                                                            <td style="background-color:#CFFEDA ;"><?=  ?></td>
                                                                                                            <td style="background-color:#CFFEDA ;"><?=  ?></td>
                                                                                                        </tr>
                                                                                                    <?php
                                                                                                        }
                                                                                                    ?> 
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </div>                                                                
                                                                                    </div>
                                                                                </div>


                                                                            </div>
                                                                            <div class="col text-center">
                                                                                <a href="" class="btn btn-primary text-center">Retour</a>
                                                                            </div>
                                                                        </div>
                                                                        <div class="card-footer bg-primary text-muted text-center">
                                                                            <h5 style="color:white">SAMA *** GUINAR</h5>
                                                                        </div>
                                                                    </div>
                                                                </div>    
                                                            </div>
                                                        </div>
















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


    //Pour les arrets
    $pdf->SetFont('Arial','B',9);
    $pdf->Cell(194,10,'',0,1);
    $pdf->SetTextColor(50,60,100);
    $pdf->Cell(190,8,utf8_decode("Géstion des temps d'arret"),0,1,'C');
    $pdf->SetFont('Arial','B',7);

    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(30,5,utf8_decode('Nombresac'),1,0,'C');
    $pdf->Cell(30,5,utf8_decode('Prix'),1,0,'C');
    $pdf->Cell(30,5,utf8_decode('Fournisseur'),1,0,'C');
    $pdf->Cell(130,5,utf8_decode('Date Achat'),1,1,'C');

    $TotalArretH=0;
    foreach($Achataliments as $achataliment){        
        $pdf->Cell(30,5,utf8_decode($achataliment['nombresac']),1,0,'C');
        $pdf->Cell(30,5,utf8_decode($achataliment['prix']),1,0,'C');
        $pdf->Cell(30,5,utf8_decode($achataliment['fournisseur']),1,0,'C');
        $pdf->Cell(130,5,utf8_decode($achataliment['dateachat']),1,1,'C');

        if(((strtotime($arret['finarret']) - strtotime($arret['debutarret'])) > 0)){
            $TotalArretH +=  (strtotime($arret['finarret']) - strtotime($arret['debutarret']));
        }else{
            $TotalArretH +=  (-strtotime($arret['debutarret']) + strtotime($arret['finarret']));
        }
    }

    //Pour les consommations
    $pdf->SetFont('Arial','B',9);
    $pdf->Cell(190,10,'',0,1);
    $pdf->SetTextColor(50,60,100);
    $pdf->Cell(190,8,utf8_decode("Consommations"),0,1,'C');
    $pdf->SetFont('Arial','B',7);

    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(38,5,utf8_decode('Diamétre'),1,0,'C');
    $pdf->Cell(38,5,utf8_decode('Numéro fil machine'),1,0,'C');
    $pdf->Cell(38,5,utf8_decode('Poids'),1,0,'C');
    $pdf->Cell(38,5,utf8_decode('Heure de montage'),1,0,'C');
    $pdf->Cell(38,5,utf8_decode('Déchet'),1,1,'C');
    foreach($consommations as $consommation){        
        $pdf->Cell(38,5,utf8_decode($consommation['diametre']),1,0,'C');
        $pdf->Cell(38,5,utf8_decode($consommation['numerofin']),1,0,'C');
        $pdf->Cell(38,5,utf8_decode($consommation['poids']),1,0,'C');
        $pdf->Cell(38,5,utf8_decode($consommation['heuremontagebobine']),1,0,'C');
        $pdf->Cell(38,5,utf8_decode($consommation['dechet']),1,1,'C');
    }

    //Pour les productions
    $pdf->SetFont('Arial','B',9);
    $pdf->Cell(194,10,'',0,1);
    $pdf->SetTextColor(50,60,100);
    $pdf->Cell(194,8,utf8_decode("Productions"),0,1,'C');
    $pdf->SetFont('Arial','B',7);

    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(32,5,utf8_decode('Diamétre'),1,0,'C');
    $pdf->Cell(32,5,utf8_decode('Numéro fil machine'),1,0,'C');
    $pdf->Cell(32,5,utf8_decode('Poids'),1,0,'C');
    $pdf->Cell(32,5,utf8_decode('Echantillon Longueur'),1,0,'C');
    $pdf->Cell(32,5,utf8_decode('Echantillon Poids'),1,0,'C');
    $pdf->Cell(32,5,utf8_decode('Echantillon N° DF'),1,1,'C');
    foreach($productions as $production){        
        $pdf->Cell(32,5,utf8_decode($production['proddiametre']),1,0,'C');
        $pdf->Cell(32,5,utf8_decode($production['prodnumerofin']),1,0,'C');
        $pdf->Cell(32,5,utf8_decode($production['prodpoids']),1,0,'C');
        $pdf->Cell(32,5,utf8_decode($production['echanlongueur']),1,0,'C');
        $pdf->Cell(32,5,utf8_decode($production['echanpoids']),1,0,'C');
        $pdf->Cell(32,5,utf8_decode($production['echandf']),1,1,'C');
    }


    //C'est pour les arrets
    $TotalArretHReel = explode(':',date('H:i',$TotalArretH) );
    $TotalArretHReelH = $TotalArretHReel[0]-1;

    //C'est pour le temps de fonction
    $TotalHeureTravaille = 0;
    if(((strtotime($Cranteuse['heurefinquart']) - strtotime($Cranteuse['heuredepartquart'])) > 0)){
        $TotalHeureTravaille =  (strtotime($Cranteuse['heurefinquart']) - strtotime($Cranteuse['heuredepartquart']));
    }else{
        $TotalHeureTravaille =  (-strtotime($Cranteuse['heurefinquart']) + strtotime($Cranteuse['heuredepartquart']));
    }
    $TotalHeureTravaillerelle = explode(":",date("H:i",$TotalHeureTravaille - $TotalArretH) );
    $TotalHeureTravaillerelleH = $TotalHeureTravaillerelle[0]-1;

    $pdf->SetFont('Arial','B',10);
    $pdf->SetTextColor(50,60,100);
    $pdf->Cell(190,15,utf8_decode(""),0,1,'C');
    $pdf->Cell(190,13,utf8_decode("Total arret : $TotalArretHReelH Heures $TotalArretHReel[1] minutes          Vitesse : $Cranteuse[vitesse]          Poids estimatif travaillé et non noté : $Cranteuse[poidsestimetravaillenonnote] "),0,1,'C');
    $pdf->Cell(190,2,utf8_decode("Temps de fonction : $TotalHeureTravaillerelleH Heures $TotalHeureTravaillerelle[1] min   "),0,1,'C');


    $pdf->Output();

