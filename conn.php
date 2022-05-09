<?php 

    $db_host = "localhost";
    $db_user = "s62042380106";
    $db_password = "pw62042380106@URU";
    $db_name = "dbS62042380106";

    try {
        $db = new PDO("mysql:host={$db_host}; dbname={$db_name}", $db_user, $db_password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOEXCEPTION $e) {
        $e->getMessage();
    }


?>