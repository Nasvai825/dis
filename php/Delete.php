<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sakilanew";

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
$IdRaspisanie = $_POST['IdRaspisanie'];

$sql2 = $conn->prepare("SELECT COUNT(*) AS `total` FROM raspisanie WHERE IdRaspisanie = :Id");
$sql2->execute(array(':Id' => $IdRaspisanie));
$result = $sql2->fetchObject();

if ($result->total < 1)
{
	echo 'Расписания не существует';
	exit;
}

if (empty($IdRaspisanie))
{
	echo "Заполните все поля";
	exit;
}
if ($IdRaspisanie > 0)
{
	$sql = "DELETE FROM `raspisanie` WHERE `idRaspisanie`=$IdRaspisanie"; 
	
	$conn->exec($sql);
	header("Refresh:0; url=../Admin.php");
	exit;
}
else
{
	echo "Несовпадают или введены не верно данные";
}


$conn = null;

?>