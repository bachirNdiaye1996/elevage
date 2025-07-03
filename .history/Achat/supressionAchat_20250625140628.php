<?php

    session_start(); 

    if(!$_SESSION['nomcomplet']){
        header('Location: ../404.php');
    }

    // Pour la supression d'une reception avec un get de idsupreception pour reception detail
    include "../connexion/conexiondb.php";


    if(isset($_GET['idachataliment'])){
        $id = $_GET['idachataliment'];
        $sql = "UPDATE `achataliment` set `actif`=0 where idachataliment=$id";
        $db->query($sql);

        header("location: achataliment.php");
        exit;
    }


?>