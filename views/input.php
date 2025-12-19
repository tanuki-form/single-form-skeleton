<?php
/**
 * @var Tanuki\Form $form
 * @var Tanuki\Utils\FormTagBinder $binder
 */

$errors = $form->getValidationErrors();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>Mail form</title>
</head>

<body>
  <form action="./" method="post" id="inquiry-form">
    <dl>
      <div>
        <dt>名前</dt>
        <dd>
          <?php echo $binder->input("text", "name", ["required"]); ?>
          <?php if(isset($errors["name"])): ?>
          <p class="error"><?php echo getErrorMessage($errors["name"][0], "名前"); ?></p>
          <?php endif; ?>
        </dd>
      </div>
      <div>
        <dt>メールアドレス</dt>
        <dd>
          <?php echo $binder->email("email", ["required"]); ?>
          <?php if(isset($errors["email"])): ?>
          <p class="error"><?php echo getErrorMessage($errors["email"][0], "メールアドレス"); ?></p>
          <?php endif; ?>
        </dd>
      </div>
      <div>
        <dt>メールアドレス (確認)</dt>
        <dd>
          <?php echo $binder->email("email2", ["required"]); ?>
          <?php if(isset($errors["email2"])): ?>
          <p class="error"><?php echo getErrorMessage($errors["email2"][0], "メールアドレス (確認)"); ?></p>
          <?php endif; ?>
        </dd>
      </div>
      <div>
        <dt>アンケート</dt>
        <dd>
          <?php $enqueteDataset = ["A", "B", "C", "D"]; ?>
          <ul>
            <?php foreach($binder->checkboxes($enqueteDataset, "enquete") as $label => $cb): ?>
            <li>
              <label>
                <?php echo $cb; ?>
                <span><?php echo $label; ?></span>
              </label>
            </li>
            <?php endforeach; ?>
          </ul>
          <?php if(isset($errors["enquete"])): ?>
          <p class="error"><?php echo getErrorMessage($errors["enquete"][0], "アンケート"); ?></p>
          <?php endif; ?>
        </dd>
      </div>
      <div>
        <dt>メッセージ</dt>
        <dd>
          <?php echo $binder->textarea("message", ["required"]); ?>
          <?php if(isset($errors["message"])): ?>
          <p class="error"><?php echo getErrorMessage($errors["message"][0], "メッセージ"); ?></p>
          <?php endif; ?>
        </dd>
      </div>
      <div>
        <dt></dt>
        <dd>
          <label>
            <?php echo $binder->checkbox("1", "agreement"); ?>
            <span>同意する</span>
          </label>
          <?php if(isset($errors["agreement"])): ?>
          <p class="error"><?php echo getErrorMessage("agreement"); ?></p>
          <?php endif; ?>
        </dd>
      </div>
    </dl>

    <input type="hidden" name="csrf-token" value="<?php echo $form->helper->getCsrfToken(); ?>">
    <button type="submit" name="action" value="confirm">確認</button>
  </form>
</body>
</html>
