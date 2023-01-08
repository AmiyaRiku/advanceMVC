<?php
require_once(ROOT_PATH .'Models/contactmodel.php');
$id = $_GET["id"];
$delete = new Delete($pdo, $id);
$result = $delete->getData($id);
$delete->index();
?>
<!DOCTYPE HTML>
<html lang="ja">
<link rel="stylesheet" type="text/css" href="../css/kadai.css">
<head>
<meta charset="utf-8">
<title>確認画面</title>
</head>

<body>
<div class="contact">
<h1 class="contact-ttl">削除画面</h1>
  <div class="contact">
    <form action="contact.php" method="post">
      <table class="contact-table">
      <tr><th class="contact-item">名前：</th><td class="contact-body"><?php if (!empty($result['name'])) echo(htmlspecialchars($result['name'], ENT_QUOTES, 'UTF-8'));?></td></tr>
      <tr><th class="contact-item">フリガナ：</th><td class="contact-body"><?php if (!empty($result['kana'])) echo(htmlspecialchars($result['kana'], ENT_QUOTES, 'UTF-8'));?></td></tr>
      <tr><th class="contact-item">電話番号：</th><td class="contact-body"><?php if (!empty($result['tel'])) echo(htmlspecialchars($result['tel'], ENT_QUOTES, 'UTF-8'));?></td></tr>
      <tr><th class="contact-item">メールアドレス：</th><td class="contact-body"><?php if (!empty($result['email'])) echo(htmlspecialchars($result['email'], ENT_QUOTES, 'UTF-8'));?></td></tr>
      <tr><th class="contact-item">本文：</th><td class="contact-body"><?php if (!empty($result['body'])) echo(htmlspecialchars($result['body'], ENT_QUOTES, 'UTF-8'));?></td></tr>
      </table>
      <input class="contact-submit" type="submit" name=dbtn value="削除">
      <p class="contact-cancel"><a href="contact.php">キャンセル</a></p>
    </form>
  </div>
</body>
</html>