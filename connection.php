<?php
    try {
		$serverName = "localhost";
        $usernameDB = "root";
        $passwordDB = "root";
        $DBName = "wideworldimporters";
		
        $pdo = new PDO("mysql:host=$serverName;dbname=$DBName", $usernameDB, $passwordDB);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $exception) {
        echo "Database offline/can't connect to the database. Try to refresh the page!";
        exit;
    }
?>