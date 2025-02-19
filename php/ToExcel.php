<?php
require_once('PHPExcel.php');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sakilanew";


$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


// Создайте запрос к базе данных
$query = "select `idRaspisanie`,`Date`,`Time`,`nameUslugi`,`nameZal`,`FIOSotrudnic`,`phoneSotrudnic` from `raspisanie`,`uslugi`,`zal`,`sotrudnic` where (raspisanie.uslugi_idUslugi=idUslugi) and (zal_idZal=idZal) and (sotrudnic.uslugi_idUslugi=idUslugi)";
// Выполняем запрос к базе данных
//$result = mysql_query($query) or die(mysql_error());
$conn->exec($query);
// Создаем новый объект PHPExcel
$objPHPExcel = new PHPExcel();
// Устанавливаем активный рабочий лист Excel на лист 0
$objPHPExcel->setActiveSheetIndex(0);
// Инициализировать номер строки Excel
$rowCount = 1;
// Перебираем каждый результат SQL-запроса по очереди
// Мы извлекаем каждую строку результата из базы данных в $row по очереди
while($row = mysql_fetch_array($result)){
    // Установите ячейку An в столбец "name" из базы данных (при условии, что у вас есть столбец с именем name)
    // где n — номер строки Excel (т. е. ячейка A1 в первой строке)
    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $row['idRaspisanie']);
    // Установите ячейку Bn в столбец "возраст" из базы данных (при условии, что у вас есть столбец с названием age)
    // где n - номер строки Excel (т.е. ячейка A1 в первой строке)
    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $row['Date']);
    // Увеличиваем счетчик строк Excel
    $rowCount++;
}
// Инстанцируем Writer для создания файла OfficeOpenXML Excel .xlsx
$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
// Запись файла Excel в файл с именем some_excel_file.xlsx в текущем каталоге
$objWriter->save('some_excel_file.xlsx');


$conn = null;

?>