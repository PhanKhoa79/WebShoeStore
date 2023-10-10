<?php 
    function connectDB() {
        $servername = "localhost:3310";
        $username = "root";
        $password = "";

        try {
        $conn = new PDO("mysql:host=$servername;dbname=projectphp", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
             return $conn;
        } catch(PDOException $e) {
            return null;
        }
    }
?>