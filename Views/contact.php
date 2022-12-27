<?php
require_once(ROOT_PATH .'Controllers/contactController.php');
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
            }if(name.length > 10){
                message.push("名前は10文字以内にしてください");
            }
            if(kana.value==""){
                message.push("フリガナが未入力です。");
            }else if(kana.length > 10){
                message.push("カナは10文字以内にしてください");
            }
            if(tel.value =="/^[0-9]+$/"){
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

<!DOCTYPE html>
<html lang="ja">
<link rel="stylesheet" type="text/css" href="../css/kadai.css">
<head>
    <title>入力画面</title>
</head>
<h1 class="contact-ttl">入力画面</h1>
<body>
  <div class="contact">
    <?php
      if( $error_message ){
        echo '<div style="color:red;">';
        echo implode('<br>', $error_message );
        echo '</div>';
      }
    ?>
    <form action="contact.php?action=error" method="post">
      <table  class="contact-table">
        <tr>
          <th class="contact-item"><label for="name">名前</label></th>
          <td class="contact-body"><input type="text" id="name" name="name"  class="form-text" value="<?php if(isset($name)){echo $name;} ?>"></input></td>
        </tr>
        <tr>
          <th class="contact-item"><label for="kana">フリガナ</label></th>
          <td class="contact-body"><input type="text" id="kana" name="kana"  class="form-text" value="<?php if(isset($kana)){echo $kana;} ?>"></input></td>
        </tr>
        <tr>
          <th class="contact-item"><label for="tel">電話番号</label></th>
          <td class="contact-body"><input type="text" id="tel" name="tel"  class="form-text" value="<?php if(isset($tel)){echo $tel;} ?>"></input></td>
        </tr>
        <tr>
          <th class="contact-item"><label for="email">メールアドレス</label></th>
          <td class="contact-body"><input type="text" id="email" name="email"  class="form-text" value="<?php if(isset($email)){echo $email;} ?>"></input></td>
        </tr>
        <tr>
          <th class="contact-item"><label for="body">問い合わせ内容</label></th>
          <td class="contact-body"><input id="body" name="body"  class="form-textarea" value="<?php if(isset($body)){echo $body;} ?>"></input></td>
        </tr>
      </table>
      <input class="contact-submit" type="submit" name = btn id =btn value="送信">
    </form>
    <div>
      <table>
        <tr>
          <th class="data-item">名前</th>
          <th class="data-item">フリガナ</th>
          <th class="data-item">電話番号</th>
          <th class="data-item">メールアドレス</th>
          <th class="data-item">本文</th>
          <th class="data-item"></th>
          <th class="data-item"></th>
        </tr>
        <?php foreach ($result as $contacts) { ?>
          <tr>
            <td class="data-body"><?php echo $contacts["name"]; ?></td>
            <td class="data-body"><?php echo $contacts["kana"]; ?></td>
            <td class="data-body"><?php echo $contacts["tel"]; ?></td>
            <td class="data-body"><?php echo $contacts["email"]; ?></td>
            <td class="data-body"><?php echo $contacts["body"]; ?></td>
            <td class="data-body"><a href="edit.php?id=<?php echo $contacts["id"]; ?>">更新</a></td>
            <td class="data-body"><a href="delete.php?id=<?php echo $contacts["id"]; ?>">削除</a></td>
            </td>
          </tr>
        <?php } ?>
      </table>
    </div>
</body>
</html>