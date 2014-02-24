        <?php foreach ($menus as $menu) : ?>
        <div class="menu <?php echo $menu['selected'] ?>">
            <div class="onglet"><?= link_to_action($menu['action'], $menu['nom']) ?></div>
            <?php if(!empty($menu['smenus'])) : ?>
            <ul>
                <?php foreach ($menu['smenus'] as $smenu) : ?>
                <li><?php echo asset('assets/admin/img/'.$smenu['icone'], array('alt' => $smenu['nom'])) ?><?= link_to_action($menus['action'], $menus['nom']) ?></li>
                <?php endforeach; ?>
            </ul>
            <?php endif ?>
        </div>
        <?php endforeach ?>