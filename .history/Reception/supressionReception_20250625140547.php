<?php

    session_start(); 

    if(!$_SESSION['nomcomplet']){
        header('Location: ../404.php');
    }

    // Pour la supression d'une reception avec un get de idsupreception pour reception detail
    include "../connexion/conexiondb.php";


    if(isset($_GET['idreceptionpoussin'])){
        $id = $_GET['idreceptionpoussin'];
        $sql = "UPDATE `receptionpoussin` set `actif`=0 where idreceptionpoussin=$id";
        $db->query($sql);

        header("location: receptionpoussin.php");
        exit;
    }


?>