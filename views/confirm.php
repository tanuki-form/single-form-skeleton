<?php
/**
 * @var Tanuki\Form $form
 * @var GreenSpot\Utils\FormTagBinder $binder
 */
$data = $form->getRawData();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>Mail form</title>
</head>

<body>
  <dl>
    <div>
      <dt>名前</dt>
      <dd><?php echo h($data["name"]); ?></dd>
    </div>
    <div>
      <dt>メールアドレス</dt>
      <dd><?php echo h($data["email"]); ?></dd>
    </div>
    <div>
      <dt>アンケート</dt>
      <dd><?php echo implode(", ", array_map("h", $data["enquete"])); ?></dd>
    </div>
    <div>
      <dt>メッセージ</dt>
      <dd><?php echo nl2br(h($data["message"])); ?></dd>
    </div>
  </dl>

  <form action="./" method="post" id="inquiry-form">
    <?php foreach($binder->keys() as $key) echo $binder->hidden($key); ?>

    <button type="submit" name="action" value="back">戻る</button>
    <button type="submit" name="action" value="send">送信</button>
  </form>

  <?php //view("parts/recaptcha", ["form" => $form]); ?>
  <?php //view("parts/turnstile", ["form" => $form]); ?>
</body>
</html>
