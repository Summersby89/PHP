<h1 class="alert alert-success"><?= $title ?></h1>
<h2> Всего книг у вас: <?= count($books); ?> шт.</h2>
<?php foreach ($books as $book) : ?>
<p>Книга: <?= $book['title']; ?></p> 
<p>Автор: <?= $book['author']; ?></p>
<p>Описание: <?= $book['description']; ?></p>
<?php endforeach; ?>
