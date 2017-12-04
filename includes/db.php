<?php
    if(!defined("DB_ADDR"))
        define("DB_ADDR", "localhost");
    if(!defined("DB_USER"))
        define("DB_USER", "root");
    if(!defined("DB_PASS"))
        define("DB_PASS", "");
    if(!defined("DB_NAME"))
        define("DB_NAME", "cms");
    

    $db_connect = mysqli_connect(DB_ADDR, DB_USER, DB_PASS, DB_NAME);
    if(!$db_connect){
        die("Failed to connect to database: " . mysqli_error($db_connect));
    }
?>