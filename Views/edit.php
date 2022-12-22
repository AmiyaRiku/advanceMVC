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
      header("Location: contact.php", true, 307);
      $stmt = $pdo->prepare('UPDATE contacts SET name = :name, kana = :kana, tel = :tel, email = :email, body = :body WHERE id = :id');
      $stmt->execute(array(':name' => $_POST['name'], ':kana' => $_POST['kana'], ':tel' => $_POST['tel'], ':email' => $_POST['email'] , ':body' => $_POST['body'], ':id' => $_POST['id']));
    }

$pdo->commit();
    
} catch (Exception $e) {
    $pdo->rollBack();
}
?>

<script>
    window.onload = function(){
        const btn = document.getElementById('btn');
        const name = document.getElementById('name');
        const kana = document.getElementById('kana');
        const email = document.getElementById('email');
        const body = document.getElementById('body');
        const reg = /^[A-Za-z0-9]{1}[A-Za-z0-9_.-]*@{1}[A-Za-z0-9_.-]{1,}.[A-Za-z0-9]{1,}$/;
        
        btn.addEventListener('click', function(event) {
            let message = [];
            /*入力値チェック*/
            if(name.value ==""){
                message.push("氏名が未入力です。");
            }else if(name.length > 10){
                message.push("名前は10文字以内にしてください");
            }
            if(kana.value==""){
                message.push("フリガナが未入力です。");
            }else if(kana.length > 10){
                message.push("カナは10文字以内にしてください");
            }
            if(tel.value !=="/^[0-9]+$/"){
                message.push("電話番号は数字のみで記入してください");
            }
            if(email.value==""){
                message.push("メールアドレスが未入力です。");
            }else if(!reg.test(email.value)){
                message.push("メールアドレスの形式が不正です。");
            }
            if(body.value ==""){
                message.push("問い合わせ内容を記述してください");
            }
            if(message.length > 0){
                alert(message);
                return;
            }
            alert('入力チェックOK');
        });
    };
</script>
<!DOCTYPE HTML>
<html lang="ja">
<link rel="stylesheet" type="text/css" href="../css/kadai.css">

<head>
<meta charset="utf-8">
<title>更新画面</title>
</head>

<body>
  <div class="contact">
  <h1 class="contact-ttl">更新画面</h1>
  <?php
    if( $error_message ){
      echo '<div style="color:red;">';
      echo implode('<br>', $error_message );
      echo '</div>';
    }
  ?>
    <form action="edit.php?id=<?php echo(htmlspecialchars($result['id']));?>" method="post">
      <input type="hidden" name="id" value="<?php if (!empty($result['id'])) echo(htmlspecialchars($result['id'], ENT_QUOTES, 'UTF-8'));?>">
      <table  class="contact-table">
        <tr>
          <th class="contact-item"><label for="name">名前</label></th>
          <td class="contact-body"><input type="text" name="name" class="form-text" value="<?php if (!empty($result['name'])) echo(htmlspecialchars($result['name'], ENT_QUOTES, 'UTF-8'));?>"></td>
        </tr>
        <tr>
          <th class="contact-item"><label for="kana">フリガナ</label></th>
          <td class="contact-body"><input type="text" name="kana" class="form-text" value="<?php if (!empty($result['kana'])) echo(htmlspecialchars($result['kana'], ENT_QUOTES, 'UTF-8'));?>"></td>
        </tr>
        <tr>
          <th class="contact-item"><label for="tel">電話番号</label></th>
          <td class="contact-body"><input type="text" name="tel" class="form-text" value="<?php if (!empty($result['tel'])) echo(htmlspecialchars($result['tel'], ENT_QUOTES, 'UTF-8'));?>"></td>
        </tr>
        <tr>
          <th class="contact-item"><label for="email">メールアドレス</label></th>
          <td class="contact-body"><input type="text" name="email" class="form-text" value="<?php if (!empty($result['email'])) echo(htmlspecialchars($result['email'], ENT_QUOTES, 'UTF-8'));?>"></td>
        </tr>
        <tr>
          <th class="contact-item"><label for="body">問い合わせ内容</label></th>
          <td class="contact-body"><input type="text" name="body" class="form-textarea" value="<?php if (!empty($result['body'])) echo(htmlspecialchars($result['body'], ENT_QUOTES, 'UTF-8'));?>"></td>
        </tr>
      </table>
      <input class="contact-submit" type="submit" name = btn id =btn value="更新">
      <p class="contact-cancel"><a href="contact.php">キャンセル</a></p>
    </form>
  </div>
</body>
</html>