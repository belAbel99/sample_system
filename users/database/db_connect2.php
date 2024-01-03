<?php

$host = "localhost";
$port = "9100";
$dbname = "db_sample_system";
$user = "postgres";
$password = "root"; 
$connection_string = "host={$host} port={$port} dbname={$dbname} user={$user} password={$password} ";
$dbconn = pg_connect($connection_string);

if (!$dbconn) {
    die("Connection failed: " . pg_last_error());
}
?>
