<div class="user">
<?php if (empty($_SESSION['user'])): ?>
<p>Привет, Гость!</p>
    <p>
        <a class="light-blue-text text-accent-4" href="/login"> Войти </a>&nbspили<a class="light-blue-text text-accent-4" href="/registration">Зарегистрироваться</a>!
    </p>
<?php else: ?>
    <p>Привет,  <a href="/profile"><?=$_SESSION['user']->username?></a>! <a href="/logout" class="logout"><i class="material-icons tiny">exit_to_app</i></a></p>
<?php endif; ?>
</div>
