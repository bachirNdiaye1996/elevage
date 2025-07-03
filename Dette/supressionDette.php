<?php

    session_start(); 

    if(!$_SESSION['nomcomplet']){
        header('Location: ../404.php');
    }

    // Pour la supression d'une reception avec un get de idsupreception pour reception detail
    include "../connexion/conexiondb.php";


    if(isset($_GET['iddette'])){
        $id = $_GET['iddette'];
        $sql = "UPDATE `dette` set `actif`=0 where iddette=$id";
        $db->query($sql);

        header("location: dette.php");
        exit;
    }


?>