<?php
    //DB connection
    require('../../../config/db_connection.php');  //me da las llaves de acceso

    //get data from register form


    $email = $_POST['email'];
    $pass = $_POST['passwd'];
    $enc_pass = md5($pass);

    //Query to insert data into users table
    $query = "INSERT INTO users (email, password)
         VALUES ('$email', '$enc_pass')";

         $result = pg_query($conn, $query);

         if($result) {
             echo "Registration successfull!";
         } else {
             echo "Registration failed!";
         }

         pg_close($conn);


    //echo "Email: " . $email;
    //echo "<br>Password: " . $pass;
    //echo "<br>Enc. Password: " . $enc_pass;
?>