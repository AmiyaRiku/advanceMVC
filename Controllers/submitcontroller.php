<?php
// セッションの開始
session_start();

  $name = $_SESSION['name'];
  $kana = $_SESSION['kana'];
  $tel = $_SESSION['tel'];
  $email = $_SESSION['email'];
  $body = $_SESSION['body'];

  require_once(ROOT_PATH .'Models/contactmodel.php');
  $submit = new Submit($pdo);
  $submit->index($name, $kana, $tel, $email, $body) ;