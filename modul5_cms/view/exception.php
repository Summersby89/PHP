<?php includeView('layouts/header', ['title' => $exception->getCode().' - '.$exception->getMessage()]); ?>

<h1>Ошибка: <?=$exception->getCode()?></h1>

<p><?=$exception->getMessage();?></p>
<a href="javascript:history.back()">Вернуться назад</a>

<?php includeView('layouts/footer');?>
