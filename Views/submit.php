<?php
// セッションの開始
session_start();

  $name = $_SESSION['name'];
  $kana = $_SESSION['kana'];
  $tel = $_SESSION['tel'];
  $email = $_SESSION['email'];
  $body = $_SESSION['body'];

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
<!DOCTYPE html>
<html lang="ja">
<link rel="stylesheet" type="text/css" href="../css/kadai.css">
<head>
  <title>完了画面</title>
</head>
<body>
  <h1 class="contact-ttl">完了画面</h1>
  <p class="contact-table">お問い合わせ内容を送信しました。ありがとうございました。</p>
  <div class="contact-cancel"><a href="index.php">トップへ</a></div>
</body>
</html>