<?php

    session_start(); 

    if(!$_SESSION['nomcomplet']){
        header('Location: ../404.php');
    }

    // Pour la supression d'une reception avec un get de idsupreception pour reception detail
    include "../connexion/conexiondb.php";


    if(isset($_GET['idstockagefrigo'])){
        $id = $_GET['idstockagefrigo'];
        $sql = "UPDATE `stockagefrigo` set `actif`=0 where idstockagefrigo=$id";
        $db->query($sql);

        header("location: stockagefrigo.php");
        exit;
    }


?>