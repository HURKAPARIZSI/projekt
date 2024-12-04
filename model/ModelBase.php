<?php
function connect() {
    $host = 'localhost';
    $user = 'root';
    $passwd = 'root';
    $db = 'dualis';
    $port = '3306';
    // Próbáljuk meg csatlakozni az adatbázishoz
    $connection = new mysqli($host, $user, $passwd, $db, $port);
    //mysqli_connect(....)
    // Hibaellenőrzés
    if ($connection->connect_error) {
        die('Csatlakozási hiba: ' . $connection->connect_error);
    }

    return $connection;
}


?>