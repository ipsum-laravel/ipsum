<h2>Liste des actualités (<?= $liste->count() ?>)</h2>
<?= $liste->pagination() ?>
<form method="get" id="recherche" action="">
    <div>
        <?= $liste->paramsListe(true) ?>
        <input type="text" name="mot" id="mot" value="<?= $liste->getRechercheValue('mot') ?>" />
        <input type="submit" name="submit" value="Chercher" />
    </div>
</form>
<table class="liste" width="75%">
    <thead>
        <tr>
            <th><?= $liste->labelTri('date_actu', 'Date') ?></th>
            <th><?= $liste->labelTri('nom', 'Titre') ?></th>
            <th><?= $liste->labelTri('description', 'Description') ?></th>
            <th>Photo</th>
            <th>Modif.</th>
            <th>Supp.</th>
        </tr>
    </thead>
    <tbody>
        <?php $i=0; foreach ($datas as $data): ?>
            <tr class="<?= (($i %2 ) == 0 ? "pair" : "impair") ?>">
                <td><?= $data->date_actu_format; ?></td>
                <td><?= e($data->nom) ?></td>
                <td><?= e($data->description) ?></td>
                <td>
                    <?php if ($data->image) : ?>
                   <img src="<?=Croppa::url('/'.$data->image, 150, 150)?>" alt="" />
                    <?php endif ?>
                </td>
                <td class="center"><a href="<?= route('admin.actualite.edit', array('id' => $data->id)) ?>"><img src="<?= asset('assets/admin/img/modifier.png') ?>" alt="Modifier" /></a></td>
                <td class="center">
                    <?= Form::open(array('method' => 'DELETE', 'route' => array('admin.actualite.destroy', $data->id))) ?>
                        <div>
                            <input type="image" src="<?= asset('assets/admin/img/supprimer.png') ?>" value="Supprimer" class="supprimer" data-message="<?= e($data->nom) ?>">
                        </div>
                    <?= Form::close() ?>
                </td>
           </tr>
        <?php $i++; endforeach; ?>
    </tbody>
</table>
<?= $liste->pagination() ?>
