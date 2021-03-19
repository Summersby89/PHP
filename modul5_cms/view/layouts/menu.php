<ul class="menu">
    <li class="menu__item <?= \App\Router::checkPath('/') ? ' menu__item_active' : '' ?>">
        <a href="/">Главная</a>
    </li>
    <li class="menu__item  <?= mb_stripos(\App\Router::getPath(), '/page') !== false ? 'menu__item_active' : '' ?>">
        <a data-target="#drop-down-pages-menu" onclick=""
           class="dropdown-trigger <?= \App\Router::checkPath('/admin') ? 'active' : '' ?>">
            Страницы
            <i class="material-icons right">arrow_drop_down</i>
        </a>
    </li>
    <?php if (isset($_SESSION['user']) && $_SESSION['user']->canDo('view_admin')) :
        $activeAdmin = mb_stripos(\App\Router::getPath(), '/admin') !== false ? 'menu__item_active' : '';
        ?>
        <li class="menu__item <?= $activeAdmin ?>">
            <a href="/admin">Админка</a>
        </li>
    <?php endif; ?>
</ul>

<ul id="drop-down-pages-menu" class="drop-down z-depth-3">
    <?php foreach (\App\Model\Post::where('type', 'page')->orderBy('created_at', 'desc')->get() as $post):?>
        <li><a href="/page/<?=$post->id?>" class="red-text text-darken-1"><?=$post->title?></a></li>
    <?php endforeach; ?>
</ul>