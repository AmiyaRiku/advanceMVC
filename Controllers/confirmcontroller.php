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
