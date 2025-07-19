<?php
    
    session_start(); 

    if(!$_SESSION['nomcomplet']){
        header('Location: ../404.php');
    }

    include "../connexion/conexiondb.php";
 
    //Insertion des réceptions
    if(isset($_POST['CreerReception'])){
        $nombrepoussin=htmlspecialchars($_POST['nombrepoussin']);
        $provenance=htmlspecialchars($_POST['provenance']);
        $prix=htmlspecialchars($_POST['prix']);
        $commentaire=htmlspecialchars($_POST['commentaire']);
        $datereception=htmlspecialchars($_POST['datereception']);

        //print_r($_POST['nbbobine']);
    
        
        $insertUser=$db->prepare("INSERT INTO `receptionpoussin` (`idreceptionpoussin`, `datecreation`, `nombrepoussin`, `provenance`, `datereception`,`actif`,`prix`, `commentaire`) 
        VALUES (NULL, current_timestamp(),?, ?, ?, 1, ?, ?);");
        $insertUser->execute(array($nombrepoussin,$provenance, $datereception, $prix,$commentaire));
          
        //** Debut select des receptions
            $sql = "SELECT MAX(id) FROM receptionpoussin;";

            // On prépare la requête
            $query = $db->prepare($sql);

            // On exécute
            $query->execute();

            // On récupère les valeurs dans un tableau associatif
            $MaxID = $query->fetch();
        //** Fin select des receptions

        // Pour inserer dans les fiches 
        $insertUser=$db->prepare("INSERT INTO `ficheachataliment` (`idficheachataliment`,`idreceptionpoussin`, `actif`) 
        VALUES (NULL, ?, 1);");
        $insertUser->execute(array($nombrepoussin,$provenance, $datereception, $prix,$commentaire));

        $insertUser=$db->prepare("INSERT INTO `fichevaccination` (`idfichevaccination`, `idreceptionpoussin`, `actif`) 
        VALUES (NULL, ?, 1);");
        $insertUser->execute(array($nombrepoussin,$provenance, $datereception, $prix,$commentaire));

        $insertUser=$db->prepare("INSERT INTO `fichevente` (`idfichevente`, `idreceptionpoussin`, `actif`) 
        VALUES (NULL, ?, 1);");
        $insertUser->execute(array($nombrepoussin,$provenance, $datereception, $prix,$commentaire));

        $insertUser=$db->prepare("INSERT INTO `fichedette` (`idfichedette`, `idreceptionpoussin`, `actif`) 
        VALUES (NULL, ?, 1);");
        $insertUser->execute(array($nombrepoussin,$provenance, $datereception, $prix,$commentaire));

        $insertUser=$db->prepare("INSERT INTO `fichedivers` (`idfichedivers`, `idreceptionpoussin`, `actif`) 
        VALUES (NULL, ?, 1);");
        $insertUser->execute(array($nombrepoussin,$provenance, $datereception, $prix,$commentaire));

        $insertUser=$db->prepare("INSERT INTO `fichemortalite` (`idfichemortalite`, `idreceptionpoussin`, `actif`) 
        VALUES (NULL, ?, 1);");
        $insertUser->execute(array($nombrepoussin,$provenance, $datereception, $prix,$commentaire));

        $insertUser=$db->prepare("INSERT INTO `fichestockagefrigo` (`idfichestockagefrigo`, `idreceptionpoussin`, `actif`) 
        VALUES (NULL, ?, 1);");
        $insertUser->execute(array($nombrepoussin,$provenance, $datereception, $prix,$commentaire));

        header("location: receptionpoussin.php");
        exit;
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="shortcut icon" href="../image/iconOnglet.jpg" />
    <title>SAMA GUINAR</title>

    <!-- Custom fonts for this template -->
    <link href="../indexPage/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Sweet Alert -->
    <link href="../libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css"/>
    <script src="../libs/sweetalert2/sweetalert2.min.js"></script>
    <script src="../libs/sweetalert2/jquery-1.12.4.js"></script>

    <!-- Custom styles for this template -->
    <link href="../indexPage/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="../indexPage/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <script>
        $(document).ready(() => { 
            // Removing Row on click to Remove button
            $('#dynamicadd').on('click', '.remove', function () {
                //console.log("TestRemove");
                $(this).parent('td.text-center').parent('tr.rowClass').remove(); 
            });
        })
    </script>

    <script type="text/javascript"> 
        $(document).ready(function(){  
            var i = 1;         
            $('#add').click(function(){           
            //alert('ok');           
            i++;           
            $('#dynamicadd').append(`
            <tr id="row'+i+'" class="rowClass">
                <td style="background-color:#CFFEDA ;">
                    <div class="">
                        <div class="mb-1 text-start">
                            <select class="form-control" name="epaisseur[]" placeholder="Taper l'épaisseur de la bobine" value="">
                                <option>3</option>
                                <option>3.5</option>
                                <option>4</option>
                                <option>4.5</option>
                                <option>5</option>
                                <option>5.5</option>
                                <option>6</option>
                                <option>6.5</option>
                                <option>7</option>
                                <option>7.5</option>
                                <option>8</option>
                                <option>8.5</option>
                                <option>9</option>
                                <option>9.5</option>
                                <option>10</option>
                                <option>10.5</option>
                                <option>11</option>
                                <option>11.5</option>
                                <option>12</option>
                                <option>12.5</option>
                                <option>13</option>
                                <option>13.5</option>
                                <option>14</option>
                                <option>14.5</option>
                                <option>15</option>
                                <option>15.5</option>
                                <option>16</option>
                                <option>16.5</option>
                                <option>17</option>
                            </select> 
                        </div>
                    </div>
                </td>
                <td style="background-color:#CFFEDA ;">
                    <div class="col-md-10">
                        <div class="mb-1 text-start">
                            <input class="form-control" type="number" name="nbbobine[]" value="" id="validationDefault0<?$i+9?>" required>
                        </div>
                    </div>
                </td>
                <td style="background-color:#CFFEDA ;">
                <div class="col-md-10">
                    <div class="mb-1 text-start">
                        <input class="form-control designa" type="number" step="0.01" name="poidsdeclare[]" id="validationDefault0<?$i+10?>" required>
                    </div>
                </div>
                </td>
                <td style="background-color:#CFFEDA ;">
                    <div class="col-md-10">
                        <div class="mb-1 text-start">
                            <input class="form-control designa" type="number" step="0.01" name="poidspese[]">
                        </div>
                    </div>
                </td>
                <td style="background-color:#CFFEDA ;">
                    <div class="col-md-10">
                        <div class="mb-1 text-start">
                            <select class="form-control" name="lieutransfert[]" value="">
                                <option>Metal1</option>
                                <option>Niambour</option>
                                <option>Metal Mbao</option>
                            </select>                                                  
                        </div>
                    </div>
                </td>
                <td style="background-color:#CFFEDA ;">
                    <div class="col-md-10">
                        <div class="mb-1 text-start">
                            <select class="form-control" name="etatbobine[]" value="">
                                <option>Normale</option>
                                <option>Disloquée</option>
                                <option>Autres</option>
                            </select>                                                  
                        </div>
                    </div>
                </td>
                <td style="background-color:#CFFEDA ;" class="text-center"> 
                    <button class="btn btn-danger remove"
                        type="button">Enlever
                    </button> 
                </td>
            </tr>`
            );});
            $(document).on('click','.remove_row',function(){ 
            var row_id = $(this).attr("id");          
            $('#row'+row_id+'').remove();});});      
    </script> 

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">


        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid" style="margin-bottom: 200px;">
                    <!-- Content Row -->
                    <div class="row">
                        <!-- Modale pour ajouter reception -->
                        <div class="col-lg-12 ">
                            <div class="modal-dialog-centered">
                                <div class="modal-content col-lg-12">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="myExtraLargeModalLabel">Ajouter une réception de poussin</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="#" method="POST" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-md-2 ml-5 mr-5 mt-3">
                                                    <div class="mb-5 text-start">
                                                        <label class="form-label fw-bold" for="nom">Nombre de poussin</label> 
                                                        <input class="form-control" type="text" name="nombrepoussin" value="" id="validationDefault01" placeholder="Nombre de poussin">
                                                    </div>
                                                </div>
                                                <div class="col-md-2 mr-2 mt-3">
                                                    <div class="mb-1 text-start">
                                                        <label class="form-label fw-bold" for="nom">Provenance</label>
                                                        <input class="form-control" type="text" name="provenance" value="" id="validationDefault02" required placeholder="Mettez la provenance">
                                                    </div>
                                                </div>
                                                <div class="col-md-2 ml-5 mt-3">
                                                    <div class="mb-1 text-start">
                                                        <label class="form-label fw-bold" for="nom">Prix</label>
                                                        <input class="form-control" type="text" name="prix" value="" id="validationDefault03" placeholder="Mettez le prix">
                                                    </div>
                                                </div>
                                                <div class="col-md-2 mt-3 ml-5 mb-5">
                                                    <div class="mb-1 text-start">
                                                        <label class="form-label fw-bold" for="nom">Date de reception</label>
                                                        <input class="form-control" type="date" name="datereception" value="" id="validationDefault25" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 invisible">
                                                    <div class="mb-1 text-start">
                                                        <label class="form-label fw-bold" for="user" ></label>
                                                        <input class="form-control " type="text" value="<?php
                                                            echo $_SESSION['nomcomplet']; 
                                                        ?>" name="user" id="example-date-input2">
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="mb-1 text-start">
                                                        <label class="form-label fw-bold" for="commentaire" >Commentaire</label>
                                                        <textarea class="form-control"  name="commentaire" rows="4" cols="50" placeholder="Commentaire en quelques mots ( pas obligatoire... )"></textarea>
                                                    </div>
                                                </div> 
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 text-end">
                                                    <div class="col-md-8 align-items-center col-md-12 text-end">
                                                        <div class="d-flex gap-2 pt-4">                           
                                                            <a href="receptionpoussin.php ?>"><input class="btn btn-danger  w-lg bouton mr-3" name=""  value="Annuler"></a>
                                                            <input class="btn btn-success  w-lg bouton mr-3" name="CreerReception" type="submit" value="ENREGISTRER">
                                                        </div>
                                                        <hr/>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>  
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

             <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="text-center text-dark p-3" style="background-color: rgba(0, 0, 0, 0.1);">
                    SAMA GUINAR © <script>document.write(new Date().getFullYear())</script> Copyright:
                    <a class="text-dark" href="#">BY @BACHIR</a>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>


    <!-- Bootstrap core JavaScript-->
    <script src="../indexPage/vendor/jquery/jquery.min.js"></script>
    <script src="../indexPage/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../indexPage/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../indexPage/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../indexPage/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../indexPage/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../indexPage/js/demo/datatables-demo.js"></script>

</body>

</html>