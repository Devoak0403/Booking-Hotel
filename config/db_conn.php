<?php
    
    $conn = new mysqli("localhost", "root","root","db_backhome");
    mysql_set_charset($conn, "utf8");
    
    if ($conn->connect_error){die("connection failed : ".$conn->connect_error);}
?>