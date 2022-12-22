<?php
// セッションの開始
session_start();

$name = $_POST['name'];
$kana = $_POST['kana'];
$tel = $_POST['tel'];
$email = $_POST['email'];
$body = $_POST['body'];
  
// 入力値をセッション変数に格納
$_SESSION['name'] = $name;
$_SESSION['kana'] = $kana;
$_SESSION['tel'] = $tel;
$_SESSION['email'] = $email;
$_SESSION['body'] = $body;

$input = $_POST['name'];
$count_input = mb_strlen($input);

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
        <h1 class="contact-ttl">確認画面</h1>
        <form action="submit.php" method="post">
            <table class="contact-table">
            <tr><th class="contact-item">名前：</th><td class="contact-body"><?php echo $name; ?></td></tr>
            <tr><th class="contact-item">フリガナ：</th><td class="contact-body"><?php echo $kana; ?></td></tr>
            <tr><th class="contact-item">電話番号：</th><td class="contact-body"><?php echo $tel; ?></td></tr>
            <tr><th class="contact-item">メールアドレス：</th><td class="contact-body"><?php echo $email; ?></td></tr>
            <tr><th class="contact-item">本文：</th><td class="contact-body"><?php echo $body; ?></td></tr>
            </table>
            <input class="contact-submit" id="send" type="submit" value="登録">
        </form>
        <div class="contact-cancel" ><a href="contact.php?action=confirm">キャンセル</a></div>
    </div>
</body>
</html>