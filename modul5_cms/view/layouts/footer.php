</div>
</div>
<footer class="page-footer">
    <div class="container">
        <div class="row">
            <div class="col l6 s12"><h5><a class="white-text" href="/">SkillBoxCMS</a></h5>
                <p class="gray-text text-lighten-4">Цмс написанная для дипломной работы второго курса онлайн
                    унивирситета SkillBox</p></div>
            <div class="col l4 offset-l2 s12">
                <ul class="menu">
                    <li class="menu__item"><a href="/">Главная</a></li>
                    <li class="menu__item"><a
                            href="<?= \App\Settings::getInstance()->get('privacy_policy', '#') ?>">Политика
                            конфидециальности</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container"><p>© 2020 Rachkov Roman</p></div>
    </div>
</footer>

<?php

includeView('layouts/base/footer');
