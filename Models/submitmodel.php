<?php
require_once(ROOT_PATH .'Controllers/submitcontroller.php');


// データベースに接続
  $host = 'localhost';
  $user = 'root';
  $passwd = 'root';
  $dbname = 'casteria';

  $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $passwd);

  // データをデータベースに保存
  try {
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->beginTransaction();

      $sql = "INSERT INTO contacts (name, kana, tel, email, body)
              VALUES ('$name', '$kana', '$tel', '$email', '$body')";
      $pdo->exec($sql);

$pdo->commit();
  
} catch (Exception $e) {
  $pdo->rollBack();
}

?>