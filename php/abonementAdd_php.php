<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sakilanew";


$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
$Phone = $_POST['Phone'];
$FIO = $_POST['FIO'];
$Number = $_POST['Number'];

$sql2 = $conn->prepare("SELECT COUNT(*) AS `total` FROM klient WHERE phoneKlient = :phone");//Команда для проверки наличия пользователя с таким логином
$sql2->execute(array(':phone' => $Phone));
$result = $sql2->fetchObject();

if ($result->total > 0)
{
    header("Refresh:0; url=../Error.php");
	exit;
}

if (empty($Phone) or empty($FIO) or empty($Number))
{
	echo "Заполните все поля";
	exit;
}
if ($Phone > 0)
{
	
	$date = date("Ymd");
	$date2 = date('Ymd', strtotime($date. ' + 30 days'));
	
	$sql3 = "INSERT INTO `karta`(`idKarta`, `start`, `end`, `abonement_idAbonement`) VALUES (default,$date,$date2,$Number)";
	$conn->exec($sql3);
	
	$q = $conn->prepare("SELECT max(`idKarta`) as total2 FROM `karta`");
	$q->execute(array());
	$result2 = $q->fetchObject();
	
	
	$sql4 = "INSERT INTO `klient`(`idKlient`, `phoneKlient`, `FIOKlient`, `karta_idKarta`) VALUES (default,'$Phone','$FIO','$result2->total2')"; 
	$conn->exec($sql4);
	header("Refresh:0; url=../Thanks.php");
}
else
{
	echo "Несовпадают или введены не верно данные";
}


$conn = null;

?>