<?php
include $_SERVER['DOCUMENT_ROOT'] . '/include/functions.php';
$images = glob('upload/*');
?>
<form id="form">
<?php foreach ($images as $image) : ?>
  
  <div class="col mb-4">
    <div class="card h-100">
      <img src="<?= rawurlencode($image); ?>" class="card-img-top" alt="фото" />
      <div class="card-body">
        <h5 class="card-title"><?= cutString(pathinfo($image, PATHINFO_FILENAME)); ?></h5>
        <p class="card-text">
          Размер файла: <?= getSize($image) ?>
        </p>
          <label class="check-label">
        <input class="check-input" type="checkbox" name="checked[]" value="<?= $image; ?>">
          Удалить
        </label>
      </div>
      <div class="card-footer">
        <small class="text-muted">
          <?= "Изменялся:" . date(" Y-m-d H:i:s", filectime($image)); ?>
        </small>
      </div>
    </div>
  </div>
  
<?php endforeach; ?>
</form>