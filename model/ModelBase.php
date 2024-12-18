<?php



function connect() {
    $host = 'localhost';
    $user = 'dualis';
    $passwd = 'dualis';
    $db = 'dualis';
    $port = '8889';
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