<?php includeView('layouts/base/header', compact('title')); ?>
<body class="<?= $pageClass ?? 'index' ?>-page">
<header>
    <div class="container">
        <nav class="nav-extended">
            <div class="nav-wrapper">
                <a class="brand-logo" href="/">MyCMS</a>
                <a class="sidenav-trigger" href="#" data-target="mobile">
                    <i class="material-icons">menu</i>
                </a>
                <div class="hide-on-med-and-down" id="top-menu">
                    <?php includeView('layouts/menu'); ?>
                    <?php includeView('layouts/user_login'); ?>

                </div>
            </div>
            <?php if (isset($_SESSION['user']) && $_SESSION['user']->canDo('view_admin')): ?>
                <div class="nav-content">
                    <?php includeView('layouts/admin_menu'); ?>
                </div>
            <?php endif; ?>
        </nav>
    </div>
</header>
<div class="sidenav" id="mobile">
    <?php includeView('layouts/user_login'); ?>
    <?php includeView('layouts/menu'); ?>
</div>

<div class="container">
    <?php printErrors(); printSuccess();?>
</div>

<div class="content-wrapper">
    <div class="container">
        <?php if (isset($title)):?>
            <h1 class="header center-align"><?=$title?></h1>
        <?php endif;?>
