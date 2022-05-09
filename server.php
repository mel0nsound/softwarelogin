<?php 

    $servername = "localhost";
    $username = "s62042380106";
    $password = "pw62042380106@URU";
    $dbname = "dbs62042380106";

    // Create Connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
    if (!$conn) {
        die("Connection failed" . mysqli_connect_error());
    } 

?>