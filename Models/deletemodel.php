<?php
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

  try {
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->beginTransaction();

      $delete = $pdo->prepare('DELETE contacts FROM contacts WHERE id = :id');
      $delete->execute(array(':id' => $_GET["id"]));

    $pdo->commit();
    
  } catch (Exception $e) {
      $pdo->rollBack();
  }

?>