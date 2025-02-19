<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sakilanew";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

   $login = $_POST['login'];
   $pas2 =$_POST['pas'];
   $pas = hash('md5',$_POST['pas']);

  if ((empty($login)) || (empty($pas2))){
      echo "Не введены все данные";
      exit;
  }
  else{

   $sql = "SELECT * FROM sotrudnic Where phoneSotrudnic = $login ";
   foreach ($conn->query($sql) as $row) {
        if ($row['phoneSotrudnic']==$login and $row['password']==$pas){
            echo "Успех";
            $new_url = '../Admin.php';
            header('Location: '.$new_url);
            exit();
            break;
        }
        else{
            echo "Неверный логин или пароль";
            $new_url = '../AdminAvtoriz.php';
            header('Location: '.$new_url);
            exit();
            break;
        }
   }
   }


} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>