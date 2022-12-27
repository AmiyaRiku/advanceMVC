<?php
require_once(ROOT_PATH .'Models/contactmodel.php');
$id = $_GET["id"];
$edit = new Edit($pdo, $id);
$data = $edit->getData($id);

//  バリデーションの設定
$error_message = array();
if( isset($_POST["btn"] ) && $_POST["btn"] ){

  if( !$_POST['name'] ) {
    $error_message[] = "名前を入力してください";
  } else if( mb_strlen($_POST['name']) > 10 ){
    $error_message[] = "名前は10文字以内にしてください";
  }
  if(!$_POST['kana']) {
    $error_message[] = "フリガナを入力してください";
  } else if( mb_strlen($_POST['kana']) > 10 ) {
    $error_message[] = "カナは10文字以内にしてください";
  }
  if(! preg_match("/^[0-9]+$/", $_POST['tel'])){
    $error_message[] = "電話番号は数字のみで記入してください";
  }
  if(!$_POST['email']) {
    $error_message[] = "メールアドレスを入力してください";
  } else if(! filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)) {
    $error_message[] = "正しく入力してください";
  }
  if(!$_POST['body']) {
    $error_message[] = "問い合わせ内容を記述してください";
  }
}
if (!empty($_POST['name']) && ($_POST['kana']) && ($_POST['email']) && ($_POST['body'])){
  header("Location: index.php", true, 307);
  $edit = new Edit($pdo, $id);
  $edit->index($id, $name, $kana, $tel, $email, $body) ;
}


?>