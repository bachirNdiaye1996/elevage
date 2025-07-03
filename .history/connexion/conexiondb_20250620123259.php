<?php
    #$servername = "mysql-boulangerie.alwaysdata.net";
    $username = "root";
    $password = "";
    $db_name = "elevage";   

    $db = new PDO("mysql:host=localhost;dbname=$db_name;charset=utf8", $username, $password);

?>