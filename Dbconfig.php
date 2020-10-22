<?php
$hostname = 'localhost';
$username = 'root';
$password = '';
$dbname = 'voorbereidinghbo';
try{
    $con = new PDO ("mysql:host=$hostname;dbname=$dbname","$username","$password");
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
    echo "error:".$e->getMessage();
}