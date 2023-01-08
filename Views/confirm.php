<?php
require_once(ROOT_PATH .'Controllers/controller.php');
$form_data = new ConfirmController();

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
            <tr><th class="contact-item">名前：</th><td class="contact-body"><?php echo $form_data->name; ?></td></tr>
            <tr><th class="contact-item">フリガナ：</th><td class="contact-body"><?php echo $form_data->kana;?></td></tr>
            <tr><th class="contact-item">電話番号：</th><td class="contact-body"><?php echo $form_data->tel;; ?></td></tr>
            <tr><th class="contact-item">メールアドレス：</th><td class="contact-body"><?php echo $form_data->email; ?></td></tr>
            <tr><th class="contact-item">本文：</th><td class="contact-body"><?php echo $form_data->body; ?></td></tr>
            </table>
            <input class="contact-submit" id="send" type="submit" value="登録">
        </form>
        <div class="contact-cancel" ><a href="contact.php?action=confirm">キャンセル</a></div>
    </div>
</body>
</html>