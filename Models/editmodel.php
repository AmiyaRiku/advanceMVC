<?php
require_once(ROOT_PATH .'Controllers/editcontroller.php');

// データベースに接続
$host = 'localhost';
$user = 'root';
$passwd = 'root';
$dbname = 'casteria';

$pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $passwd);
$sql = 'SELECT * FROM contacts WHERE id = :id';
$stmt = $pdo->prepare($sql);
$stmt->execute(array(':id' => $_GET["id"]));
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if (!empty($a)) {
  try {
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->beginTransaction();
  
      $stmt = $pdo->prepare('UPDATE contacts SET name = :name, kana = :kana, tel = :tel, email = :email, body = :body WHERE id = :id');
      $stmt->execute(array(':name' => $_POST['name'], ':kana' => $_POST['kana'], ':tel' => $_POST['tel'], ':email' => $_POST['email'] , ':body' => $_POST['body'], ':id' => $_POST['id']));
  
  
  $pdo->commit();
      
  } catch (Exception $e) {
      $pdo->rollBack();
  }
}

?>