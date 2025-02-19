<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sakilanew";


$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
$Id = $_POST['Id'];
$Number = $_POST['Number'];
$Value = $_POST['Value'];
$Column;

$sql2 = $conn->prepare("SELECT COUNT(*) AS `total` FROM raspisanie WHERE idRaspisanie = :Id");//Команда для проверки наличия пользователя с таким логином
$sql2->execute(array(':Id' => $Id));
$result = $sql2->fetchObject();

switch ($Number) {
	case 0:
		echo 'ошибка';
		exit;
    case 1:
       $Column = 'Date';
       break;
    case 2:
       $Column = 'Vremya_Zanyatii';
       break;
    case 3:
	   $Column = 'Uslugi_idUslugi';
       break;
}

if ($result->total < 1)
{
	echo 'Расписания не существует';
	exit;
}

if (empty($Id) or empty($Number) or empty($Value))
{
	echo "Заполните все поля";
	exit;
}
if ($Id > 0)
{
	$sql = "UPDATE `raspisanie` SET `$Column`=$Value WHERE `idRaspisanie`=$Id"; 
	
	$conn->exec($sql);
	header("Refresh:0; url=../Admin.php");
}
else
{
	echo "Несовпадают или введены не верно данные";
}


$conn = null;

?>