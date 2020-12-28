<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php';
?>
<title>Моя галерея</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous" />
<link rel="stylesheet" href="/css/styleGallery.css" />
<link rel="preconnect" href="https://fonts.gstatic.com" />
<link href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:wght@300&display=swap" rel="stylesheet" />
</head>

<body>
  <header class="header">
    <div class="container">
      <form id="form">
        <div class="header__body">
          <h1 class="heading">Моя галерея</h1>
          <div class="header-buttons">
            <a href="/" class="gallery-link">Загрузить ещё</a>
            <button type="submit" name="submit" id="submit" class="btn btn-danger" form="form">Удалить выбранные</button>
          </div>
        </div>
    </div>
  </header>
  <div class="container">
    <h4 id="response"></h4>
    <div class="row row-cols-1 row-cols-md-3">
      <!-- карточка -->
      <?php include $_SERVER['DOCUMENT_ROOT'] . '/templates/card.php'; ?>
      <!-- карточка -->
    </div>
  </div>
  <script src="/js/delete.js"></script>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php'; ?>