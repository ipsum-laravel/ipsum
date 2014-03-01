        <?php foreach ($menus as $menu) : ?>
        <div class="menu <?= $menu['selected'] ?>">
            <div class="onglet"><a href="<?= action($menu['action']) ?>"><?= e($menu['nom']) ?></a></div>
            <?php if(!empty($menu['smenus'])) : ?>
            <ul>
                <?php foreach ($menu['smenus'] as $smenu) : ?>
                <li><a href="<?= action($smenu['action']) ?>">
                    <img src="<?= asset('assets/admin/img/'.$smenu['icone']) ?>" alt="<?= e($smenu['nom']) ?>" />
                    <?= e($smenu['nom']) ?></a>
                </li>
                <?php endforeach; ?>
            </ul>
            <?php endif ?>
        </div>
        <?php endforeach ?>