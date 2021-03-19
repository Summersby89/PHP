<?php if ($paginator->hasPages()): ?>
    <div class="row">
        <div class="input-field col s10 offset-s1">
            <select name="perpage">
                <option value="10" <?= \App\Request::get('perpage') == 10 ? 'selected' : '' ?>>10</option>
                <option value="20" <?= \App\Request::get('perpage') == 20 ? 'selected' : '' ?>>20</option>
                <option value="50" <?= \App\Request::get('perpage') == 50 ? 'selected' : '' ?>>50</option>
                <option value="200" <?= \App\Request::get('perpage') == 200 ? 'selected' : '' ?>>200
                </option>
                <option value="all" <?= \App\Request::get('perpage') == 'all' ? 'selected' : '' ?>Все</option>
            </select>
            <label>Записей на странице</label>
        </div>
    </div>
<?php endif; ?>