<h2>Liste des articles (<?= Liste::count() ?>)</h2>
<?= Liste::pagination() ?>
<form method="get" id="recherche" action="">
    <div>
        <?= Liste::inputsHidden() ?>
        <input type="text" name="mot" id="mot" value="<?= Liste::getFiltreValeur('mot') ?>" />
        <?php if (!Input::has('type') or Input::get('type') == 'page') : ?>
        <?= Form::select('categorie', ['' => '----- Catégories -----'] + $categories, Liste::getFiltreValeur('categorie')) ?>
        <?php endif ?>
        <input type="hidden" name="type" value="<?= Liste::getFiltreValeur('type') ?>">
        <input type="submit" name="submit" value="Chercher" />
    </div>
</form>
<table class="liste" style="width: 100%;">
    <thead>
        <tr>
            <th><?= Liste::lienTri('Date', 'creation') ?></th>
            <th><?= Liste::lienTri('Titre', 'titre') ?></th>
            <th><?= Liste::lienTri('Extrait', 'extrait', 'asc') ?></th>
            <th><?= Liste::lienTri('Type', 'type') ?></th>
            <th><?= Liste::lienTri('Catégorie', 'categorie') ?></th>
            <th>Illustration</th>
            <th>Modif.</th>
            <th>Supp.</th>
        </tr>
    </thead>
    <tbody>
        <?php $i=0; foreach ($datas as $data): ?>
            <tr class="<?= (($i %2) == 0 ? "pair" : "impair") ?>">
                <td><?= $data->created_at->format('d/m/Y') ?></td>
                <td><a href="<?= url(e($data->url)) ?>"><?= e($data->titre) ?></a></td>
                <td><?= e(Str::words($data->extrait, 30)) ?></td>
                <td><?= $data->typeNom ?></td>
                <td><?= $data->categorie ? $data->categorie->nom : '' ?></td>
                <td>
                    <?php if ($data->illustration) : ?>
                   <img src="<?= Croppa::url('/'.$data->illustration->cropPath, 150, 150) ?>" alt="" />
                    <?php endif ?>
                </td>
                <td class="center"><a href="<?= route('admin.article.edit', array('id' => $data->id)) ?>"><img src="<?= asset('packages/ipsum/admin/img/modifier.png') ?>" alt="Modifier" /></a></td>
                <td class="center">
                    <?php if ($data->deletable) : ?>
                    <?= Form::open(array('method' => 'DELETE', 'route' => array('admin.article.destroy', $data->id))) ?>
                        <div>
                            <input type="image" src="<?= asset('packages/ipsum/admin/img/supprimer.png') ?>" value="Supprimer" class="supprimer" data-message="<?= e($data->titre) ?>">
                        </div>
                    <?= Form::close() ?>
                    <?php endif ?>
                </td>
           </tr>
        <?php $i++; endforeach; ?>
    </tbody>
</table>
<?= Liste::pagination() ?>
