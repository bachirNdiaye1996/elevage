<?php

    session_start(); 

    if(!$_SESSION['nomcomplet']){
        header('Location: ../404.php');
    }

    // Pour la supression d'une reception avec un get de idsupreception pour reception detail
    include "../connexion/conexiondb.php";


    if(isset($_GET['idvaccination'])){
        $id = $_GET['idvaccination'];
        $sql = "UPDATE `vaccination` set `actif`=0 where idvaccination=$id";
        $db->query($sql);

        header("location: vaccination.php");
        exit;
    }


?>