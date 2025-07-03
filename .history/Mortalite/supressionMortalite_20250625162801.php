<?php

    session_start(); 

    if(!$_SESSION['nomcomplet']){
        header('Location: ../404.php');
    }

    // Pour la supression d'une reception avec un get de idsupreception pour reception detail
    include "../connexion/conexiondb.php";


    if(isset($_GET['idmortalite'])){
        $id = $_GET['idmortalite'];
        $sql = "UPDATE `mortalite` set `actif`=0 where idmortalite=$id";
        $db->query($sql);

        header("location: vente.php");
        exit;
    }


?>