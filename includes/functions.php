<?php 
    include __DIR__ . "/db.php";
    if(session_status() == PHP_SESSION_NONE) {
        session_start();
    }  
?>
<?php

    //////////////////////////////////
    // ALL
    //////////////////////////////////
    function getTableCount($table) {
        global $db_connect;
        $query = "SELECT COUNT(*) FROM " . $table;
        $result = mysqli_query($db_connect, $query);
        return mysqli_fetch_row($result)[0];
    }
    //////////////////////////////////
    //////////////////////////////////    
    
?>