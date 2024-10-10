<?php
    //DB connection
    require('../../../config/db_connection.php');  //me da las llaves de acceso

    //get data from register form


    $email = $_POST['email'];
    $pass = $_POST['passwd'];
    $enc_pass = md5($pass); //encriptar contraseña

    //validar si el email ya existe
    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = pg_query ($conn, $query);
    $row = pg_fetch_assoc($result);
    if($row){
        echo "<script>alert('Email already exist!')</script>";
        header('refresh:0;url=http://127.0.0.1/beta/api/src/register_form.html');
        exit();
    }

    //Query to insert data into users table
    $query = "INSERT INTO users (email, password)
         VALUES ('$email', '$enc_pass')";

         $result = pg_query($conn, $query);

         if($result) {
             //echo "Registration successfull!";
             echo "<script>alert('Registration succesfull!')</script>";
             header('refresh:0;url=http://127.0.0.1/beta/api/src/login_form.html');
         } else {
             echo "Registration failed!";
         }

         pg_close($conn);


    //echo "Email: " . $email;
    //echo "<br>Password: " . $pass;
    //echo "<br>Enc. Password: " . $enc_pass;
?>