<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php';
?>
<title>Форма загрузки изображений</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous" />
<link rel="stylesheet" href="/css/styleIndex.css" />
</head>
<body>
  <br>
  <div class="form-wrapper">
    <form class="row g-3" action="/include/upload.php" enctype="multipart/form-data" method="post" id="my-form">
      <div class="mb-3">
        <input type="hidden" name="MAX_FILE_SIZE" value="5242880" />
        <label for="formFile" class="form-label">Выберите изображение для загрузки (только .jpeg, .jpg или .png, не более 5 Мб и 5 шт.):</label>
        <input class="form-control" type="file" name="images[]" multiple id="js-file" />

        <div class="btn-wrapper">
          <button type="submit" class="btn btn-success">
            Загрузить
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up-square-fill" viewbox="0 0 16 16">
              <path fill-rule="evenodd" d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm6.5 11.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11.5z" />
            </svg>
          </button>
        </div>
      </div>
    </form>
    <p id="message"></p>
  </div>
  <a href="/gallery.php" class="gallery-link">В галерею <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-circle" viewBox="0 0 16 16">
      <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
      <path fill-rule="evenodd" d="M4 8a.5.5 0 0 0 .5.5h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5A.5.5 0 0 0 4 8z" />
    </svg></a>
  <script src="/js/jquery-3.5.1.min.js"></script>
  <script src="/js/send.js"></script>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php'; ?>