<?php
// セッションの開始
session_start();

  $name = $_SESSION['name'];
  $kana = $_SESSION['kana'];
  $tel = $_SESSION['tel'];
  $email = $_SESSION['email'];
  $body = $_SESSION['body'];

  require_once(ROOT_PATH .'Models/model.php');
  $submit = new Submit($pdo);
  $submit->index($name, $kana, $tel, $email, $body) ;
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