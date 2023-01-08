<?php
require_once(ROOT_PATH .'Models/model.php');
$contact = new Contact($pdo);
$result = $contact->index();
class ContactController {
  private $errorMessage = array();
  private $name;
  private $kana;
  private $tel;
  private $email;
  private $body;

  public function __construct() {
    session_start();
    if(!empty($_GET['action'])){
      $this->name = $_SESSION['name'];
      $this->kana = $_SESSION['kana'];
      $this->tel = $_SESSION['tel'];
      $this->email = $_SESSION['email'];
      $this->body = $_SESSION['body'];
    }
  }

  public function validate() {
    if( isset($_POST["btn"] ) && $_POST["btn"] ){
      if( !$_POST['name'] ) {
        $this->errorMessage[] = "名前を入力してください";
      } else if( mb_strlen($_POST['name']) > 10 ){
        $this->errorMessage[] = "名前は10文字以内にしてください";
      }

      if(!$_POST['kana']) {
        $this->errorMessage[] = "フリガナを入力してください";
      } else if( mb_strlen($_POST['kana']) > 10 ) {
        $this->errorMessage[] = "カナは10文字以内にしてください";
      }
      if(! preg_match("/^[0-9]+$/", $_POST['tel'])){
        $this->errorMessage[] = "電話番号は数字のみで記入してください";
      }
      if(!$_POST['email']) {
        $this->errorMessage[] = "メールアドレスを入力してください";
      } else if(! filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)) {
        $this->errorMessage[] = "正しく入力してください";
      }
      if(!$_POST['body']) {
        $this->errorMessage[] = "問い合わせ内容を記述してください";
      }
    }

    if (!empty($_POST['name']) && ($_POST['kana']) && ($_POST['email']) && ($_POST['body'])){
      header("Location: confirm.php", true, 307);
    } else if(!empty($_GET['action']) && $_GET['action']=='error'){
      $this->name = $_POST['name'];
      $this->kana = $_POST['kana'];
      $this->tel = $_POST['tel'];
      $this->email = $_POST['email'];
      $this->body = $_POST['body'];
    }
  }
  
  public function hasError() {
    return !empty($this->errorMessage);
  }
  
  public function getErrorMessage() {
    return $this->errorMessage;
  }
  
  public function getName() {
    return $this->name;
  }
  
  public function getKana() {
    return $this->kana;
  }
  
  public function getTel() {
    return $this->tel;
  }
  
  public function getEmail() {
    return $this->email;
  }
  
  public function getBody() {
    return $this->body;
  }
}

class ConfirmController
{
    // セッション変数を保存するプロパティ
    public $name;
    public $kana;
    public $tel;
    public $email;
    public $body;
  
    // コンストラクタ
    public function __construct()
    {
        // セッションの開始
        session_start();
  
        // POSTされた値をプロパティに格納
        $this->name = $_POST['name'];
        $this->kana = $_POST['kana'];
        $this->tel = $_POST['tel'];
        $this->email = $_POST['email'];
        $this->body = $_POST['body'];
  
        // 入力値をセッション変数に保存
        $_SESSION['name'] = $this->name;
        $_SESSION['kana'] = $this->kana;
        $_SESSION['tel'] = $this->tel;
        $_SESSION['email'] = $this->email;
        $_SESSION['body'] = $this->body;
    }
}

