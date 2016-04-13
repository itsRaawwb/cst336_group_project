<?php

function getDatabaseConnection() {
    // Set the Cloud 9 MySQL related information...this is set in stone by C9!
    $servername = getenv('IP');
    $dbPort = 3306;
    
    // Which database (the name of the database in phpMyAdmin)?
    $database = "Catalog";
    
    // My user information...I could have prompted for password, as well, or stored in the
    // environment, or, or, or (all in the name of better security)
    $username = getenv('C9_USER');
    $password = "";
    
    // Establish the connection and then alter how we are tracking errors (look those keywords up)
    $dbConn = new PDO("mysql:host=$servername;port=$dbPort;dbname=$database", $username, $password);
    $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    
    return $dbConn;
}

function getDataBySQL($dbConn, $sql) {
    // Prepare the SQL...the DBMS uses this to figure out how best to execute the query
    $stmt = $dbConn->prepare($sql);

    // Execute the query
    $stmt->execute();
    
    return $stmt;
}
?>