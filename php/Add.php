<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sakilanew";


$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
$Data = $_POST['Data'];
$Time = $_POST['Time'];
$Name = $_POST['Name'];

$sql2 = $conn->prepare("SELECT COUNT(*) AS `total` FROM uslugi WHERE nameUslugi = :name");//Команда для проверки наличия пользователя с таким логином
$sql2->execute(array(':name' => $Name));
$result = $sql2->fetchObject();
	
if ($result->total < 1)
{
	echo 'Такой услуги не существует';
	exit;
}

if (empty($Data) or empty($Time) or empty($Name))
{
	echo "Заполните все поля";
	exit;
}
if (($Name == "Тренажерный зал"))
{
	$sql = "INSERT INTO raspisanie VALUES (default, '$Data','$Time',1)"; 
	
	$conn->exec($sql);
	header("Refresh:0; url=../Admin.php");
}
if (($Name == "Кардио"))
{
	$sql = "INSERT INTO raspisanie VALUES (default, '$Data','$Time',2)"; 
	
	$conn->exec($sql);
	header("Refresh:0; url=../Admin.php");
}
if (($Name == "Аэробика"))
{
	$sql = "INSERT INTO raspisanie VALUES (default, '$Data','$Time',3)"; 
	
	$conn->exec($sql);
	header("Refresh:0; url=../Admin.php");
}
if (($Name == "Бассейн"))
{
	$sql = "INSERT INTO raspisanie VALUES (default, '$Data','$Time',3)"; 
	
	$conn->exec($sql);
	header("Refresh:0; url=../Admin.php");
}
if (($Name == "SPA"))
{
	$sql = "INSERT INTO raspisanie VALUES (default, '$Data','$Time',3)"; 
	
	$conn->exec($sql);
	header("Refresh:0; url=../Admin.php");
}


$conn = null;

?>