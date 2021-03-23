<?php require_once LAYOUTS_DIR . 'error/header/header.php'; ?>
    <div class="d-flex container-fluid container-custom align-items-center">
        <div class="container error-message">
            <?= $content; ?>
            <p> Без паники! Просто вернитесь <a href="/">на главную</a></p>
        </div>
    </div>
<?php require_once LAYOUTS_DIR . 'error/footer/footer.php'; ?>
