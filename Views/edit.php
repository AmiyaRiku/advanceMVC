<?php
require_once(ROOT_PATH .'Models/editmodel.php');
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
      <input class="contact-submit" type="submit"  value="更新">
      <p class="contact-cancel"><a href="contact.php">キャンセル</a></p>
    </form>
  </div>
</body>
</html>