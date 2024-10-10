<?php
    
    /*
    $number1 = 20;
    $number2 = 30;
    $addition = $number1 + $number2;
    echo $addition;
    */

    /*
    Database connection
    Developer: Diana
    */

    //se crean las variables de conectividad
    $host       = "localhost"; //127.0.0.1
    $username   = "postgres";
    $password   = "unicesmag";
    $dbname     = "beta";
    $port       = "5432";

    //se establece la conexión con la base de datos
    $data_connection = "
        host      = $host
        port      = $port
        dbname    = $dbname
        user      = $username
        password  = $password";

    $conn = pg_connect($data_connection);

    //condicional que nos permita validar si la conexión es correcta
    if (!$conn){
        die("Connection failed: ". pg_last_error());
    } else {
        //echo "Connected successfully";
    }

    //cerrar la conexion
    //pg_close($conn);


?>