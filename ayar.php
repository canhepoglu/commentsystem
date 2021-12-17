<?php

$siteAyarlari = [
    "siteadresi" => "https://yorumsistemi.canhepoglu.com"
];


header('Content-Type: text/html; charset=utf-8');
session_start();

if ($_SERVER['SCRIPT_NAME'] != '/yorumsistemi/login.php') {
    unset($_SESSION['loginreferer']);
}
$servername = "127.0.0.1";
$username = "canhepoglu";
$password = "43C4130h.";
$dbname = "canhepoglu";

// Create connection

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}
mysqli_query($conn, "SET NAMES 'utf8'; SET CHARACTER SET 'utf8'; SET COLLATION_CONNECTION = 'utf8_unicode_ci';");
/*
$sql= "Select * From yoneticiler";
$query = mysqli_query($conn,$sql);
$result = mysqli_fetch_all($query);
echo "<pre>".var_export($result,true);
*/
function debug($x)
{
    die("<pre>" . var_export($x, true));
}

try {
    $connb = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $connb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Bağlantı hatası: " . $e->getMessage();
}
