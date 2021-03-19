<?php if (isset($paginator) && $paginator->hasPages()) : ?>
    <nav aria-label="Pagination">
        <ul class="pagination">
            <?php if ($paginator->currentPage() == 1) : ?>
                <li class='disabled'><a><i class='material-icons'>chevron_left</i></a></li>
            <?php else : ?>
                <li><a href='<?= \App\Router::buildQueryString(['page' => $paginator->currentPage() - 1]) ?>'><i class='material-icons'>chevron_left</i></a></li>
            <?php endif; ?>

            <?php if ($paginator->currentPage() - 2 > 0) : ?>
                <li>
                    <a href='<?= \App\Router::buildQueryString(['page' => $paginator->currentPage() - 2]) ?>'><?= ($paginator->currentPage() - 2) ?></a>
                </li>
            <?php endif; ?>

            <?php if ($paginator->currentPage() - 1 > 0) : ?>
                <li>
                    <a href='<?= \App\Router::buildQueryString(['page' => $paginator->currentPage() - 1]) ?>'><?= ($paginator->currentPage() - 1) ?></a>
                </li>
            <?php endif; ?>

            <li class='active'><a><?= $paginator->currentPage() ?></a></li>

            <?php if ($paginator->currentPage() + 1 <= $paginator->lastPage()) : ?>
                <li>
                    <a href='<?= \App\Router::buildQueryString(['page' => $paginator->currentPage() + 1]) ?>'><?= ($paginator->currentPage() + 1) ?></a>
                </li>
            <?php endif; ?>

            <?php if ($paginator->currentPage() + 2 <= $paginator->lastPage()) : ?>
                <li>
                    <a href='<?= \App\Router::buildQueryString(['page' => $paginator->currentPage() + 2]) ?>'><?= ($paginator->currentPage() + 2) ?></a>
                </li>
            <?php endif; ?>

            <?php if (!$paginator->hasMorePages()) : ?>
                <li class='disabled'><a><i class='material-icons'>chevron_right</i></a></li>
            <?php else : ?>
                <li>
                    <a href='<?= \App\Router::buildQueryString(['page' => $paginator->currentPage() + 1]) ?>'><i class='material-icons'>chevron_right</i></a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
<?php endif; ?>