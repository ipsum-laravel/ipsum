<h2>Liste des actualités (<?= Liste::count() ?>)</h2>
<?= Liste::pagination() ?>
<form method="get" id="recherche" action="">
    <div>
        <?= Liste::inputsHidden() ?>
        <input type="text" name="mot" id="mot" value="<?= Liste::getFiltreValeur('mot') ?>" />
        <input type="submit" name="submit" value="Chercher" />
    </div>
</form>
<table class="liste" style="width: 100%;">
    <thead>
        <tr>
            <th><?= Liste::lienTri('Date', 'date') ?></th>
            <th><?= Liste::lienTri('Titre', 'titre') ?></th>
            <th><?= Liste::lienTri('Description', 'description', 'asc') ?></th>
            <th>Photo</th>
            <th>Modif.</th>
            <th>Supp.</th>
        </tr>
    </thead>
    <tbody>
        <?php $i=0; foreach ($datas as $data): ?>
            <tr class="<?= (($i %2 ) == 0 ? "pair" : "impair") ?>">
                <td><?= e($data->date_actu) ?></td>
                <td><?= e($data->nom) ?></td>
                <td><?= e($data->description) ?></td>
                <td>
                    <?php if ($data->image) : ?>
                   <img src="<?= Croppa::url('/'.$data->image, 150, 150) ?>" alt="" />
                    <?php endif ?>
                </td>
                <td class="center"><a href="<?= route('admin.actualite.edit', array('id' => $data->id)) ?>"><img src="<?= asset('packages/ipsum/admin/img/modifier.png') ?>" alt="Modifier" /></a></td>
                <td class="center">
                    <?= Form::open(array('method' => 'DELETE', 'route' => array('admin.actualite.destroy', $data->id))) ?>
                        <div>
                            <input type="image" src="<?= asset('packages/ipsum/admin/img/supprimer.png') ?>" value="Supprimer" class="supprimer" data-message="<?= e($data->nom) ?>">
                        </div>
                    <?= Form::close() ?>
                </td>
           </tr>
        <?php $i++; endforeach; ?>
    </tbody>
</table>
<?= Liste::pagination() ?>
