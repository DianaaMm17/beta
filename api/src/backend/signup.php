<?php

     function save_data_supabase($email, $passwd){
        //supabase database configuration
        $SUPABASE_URL = 'https://lswxskmdesfmvqywcpro.supabase.co';
        $SUPABASE_KEY = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6Imxzd3hza21kZXNmbXZxeXdjcHJvIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MzAzODg2OTMsImV4cCI6MjA0NTk2NDY5M30.M43JfDWtiElEV_nWPQN89S5DDll3oUlnRoKfYTdoqnk';

        $url = "$SUPABASE_URL/rest/v1/users";
        $data = [
            'email' => $email,
            'password' => $passwd,
        ];

        $options = [
            'http' => [
                'header'  => [
                    "Content-Type: application/json",
                    "Authorization: Bearer $SUPABASE_KEY",
                    "apikey: $SUPABASE_KEY",
                ],

                'method'  => 'POST',
                'content' => json_encode($data),
            ],
        ];

        $context  = stream_context_create($options);
        $response = file_get_contents($url, true, $context);
       //$response_data = json_decode($response, true);

        if($response === false) {
            echo "Error: Unable to save data to Supabase.";
            exit;
        }

        echo "User has been created."; // . json_encode($response_data);

     }
    //DB connection
    require('../../config/db_connection');  //me da las llaves de acceso

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
             save_data_supabase($email, $enc_pass);
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