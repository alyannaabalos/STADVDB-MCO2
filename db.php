<?php
$hostname="127.0.0.1";
$dbName = "mco2_imdb_database";
$port = "63895";

$connection = mysqli_init();
//$connection->ssl_set(NULL, NULL, $ssl, NULL, NULL);
$connection->real_connect($hostname, '', '', $dbName, $port);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
?>
