                                            <!-- Pour le status !--> 
                                                        <div class="modal fade" id="Information<?= $i ?>" tabindex="-1" aria-labelledby="fileModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog modal-xl modal-dialog-centered" style="width=750px">
                                                                <div class="modal-content">
                                                                    <div class="card">
                                                                        <div class="card-header bg-primary text-center">
                                                                            <h5 class="modal-title" id="fileModalLabel" style="color:white">Details de la reception :</h5>
                                                                        </div>
                                                                        <div class="card-body">
                                                                            <div class="col-lg-12 mt-5 mb-5">
                                                                                <?php
                                                                                    $id = $reception['idreceptionpoussin'];
                                                                                    $sql = "select * from receptionpoussin where idreceptionpoussin=$id";
                                                                                    $result = $db->query($sql);
                                                                                    $Receptionpoussin = $result->fetch();
                                                                                ?>
                                                                                <?php
                                                                                    $id = $reception['idreceptionpoussin'];
                                                                                    $sql = "select * from achataliment where idachataliment=$id";
                                                                                    $result = $db->query($sql);
                                                                                    $Achataliments = $result->fetch();
                                                                                ?>
                                                                                <?php
                                                                                    $id = $reception['idreceptionpoussin'];
                                                                                    $sql = "select * from dette where iddette=$id";
                                                                                    $result = $db->query($sql);
                                                                                    $dette = $result->fetch();
                                                                                ?>
                                                                                <?php
                                                                                    $id = $reception['idreceptionpoussin'];
                                                                                    $sql = "select * from divers where iddivers=$id";
                                                                                    $result = $db->query($sql);
                                                                                    $divers = $result->fetch();
                                                                                ?>
                                                                                <?php
                                                                                    $id = $reception['idreceptionpoussin'];
                                                                                    $sql = "select * from mortalite where idmortalite=$id";
                                                                                    $result = $db->query($sql);
                                                                                    $mortalite = $result->fetch();
                                                                                ?>
                                                                                <?php
                                                                                    $id = $reception['idreceptionpoussin'];
                                                                                    $sql = "select * from stockagefrigo where idstockagefrigo=$id";
                                                                                    $result = $db->query($sql);
                                                                                    $stockagefrigo = $result->fetch();
                                                                                ?>
                                                                                <?php
                                                                                    $id = $reception['idreceptionpoussin'];
                                                                                    $sql = "select * from vente where idvente=$id";
                                                                                    $result = $db->query($sql);
                                                                                    $vente = $result->fetch();
                                                                                ?>
                                                                                <?php
                                                                                    $id = $reception['idreceptionpoussin'];
                                                                                    $sql = "select * from vaccination where idvaccination=$id";
                                                                                    $result = $db->query($sql);
                                                                                    $vaccination = $result->fetch();
                                                                                ?>
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
                                                                                                        <th>Nombresac</th>                                                                                
                                                                                                        <th>Prix</th>
                                                                                                        <th>Fournisseur</th>
                                                                                                        <th>Date Achat</th>
                                                                                                    </tr>
                                                                                                </thead>
                                                                                                <tbody>
                                                                                                    <?php
                                                                                                        foreach($Achataliments as $achataliment){
                                                                                                    ?>
                                                                                                        <tr>
                                                                                                            <td style="background-color:#CFFEDA ;"><?= $achataliment['nombresac'] ?></td>
                                                                                                            <td style="background-color:#CFFEDA ;"><?= $achataliment['prix'] ?></td>
                                                                                                            <td style="background-color:#CFFEDA ;"><?= $achataliment['fournisseur'] ?></td>
                                                                                                            <td style="background-color:#CFFEDA ;"><?= $achataliment['dateachat'] ?></td>
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