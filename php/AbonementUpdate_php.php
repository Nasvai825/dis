<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sakilanew";


$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
$Phone = $_POST['Phone'];
$Number = $_POST['Number'];

$sql2 = $conn->prepare("SELECT COUNT(*) AS `total` FROM klient WHERE phoneKlient = :phone");//Команда для проверки наличия пользователя с таким логином
$sql2->execute(array(':phone' => $Phone));
$result = $sql2->fetchObject();

if ($result->total < 1)
{
	echo 'У вас нет абонемента или нет такого пользователя';
	exit;
}

if (empty($Phone) or empty($Number))
{
	echo "Заполните все поля";
	exit;
}
if ($Phone > 0)
{
	
	$date = date("Ymd");
	$date2 = date('Ymd', strtotime($date. ' + 30 days'));
	
	
	$sql4 = "UPDATE klient, karta SET start = '$date', end = '$date2', `abonement_idAbonement` = $Number WHERE `karta_idKarta` = `idKarta` AND `phoneKlient`='$Phone';"; 
	$conn->exec($sql4);
	header("Refresh:0; url=../Thanks.php");
}
else
{
	echo "Несовпадают или введены не верно данные";
}


$conn = null;

?>