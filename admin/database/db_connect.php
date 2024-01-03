<?php  
$host = 'localhost';  
$username = 'root';  
$password = '';
$dbname = 'db_sample_system';
$connection = mysqli_connect($host, $username, $password, $dbname);  
if(! $connection )  
{  
    die('Database Connection failed: ' . mysqli_connect_error());  
}  
?>