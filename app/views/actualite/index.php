<h2>Liste des actualités (<?= $liste->count() ?>)</h2>
<?= $liste->pagination() ?>
<form method="get" id="recherche" action="">
    <div>
        <?= $liste->paramsListe(true); ?>
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
            <th>Modif.</th>
            <th>Supp.</th>
        </tr>
    </thead>
    <tbody>
        <?php $i=0; foreach ($datas as $data): ?>
            <tr class="<?= (($i %2 ) == 0 ? "pair" : "impair"); ?>">
                <td><?= $data->date_actu_format; ?></td>
                <td><?= $data->nom; ?></td>
                <td><?= Str::words($data->description, 30, '...'); ?></td>
                <td class="center"><a href="<?= url('admin/actualite/'.$data->id.'/edit') ?>"><img src="<?= asset('assets/admin/img/modifier.png') ?>" alt="Modifier" /></a></td>
                <td class="center">
                    <?= Form::open(array('method' => 'DELETE', 'action' => array('ActualiteController@destroy', $data->id))) ?>
                        <div>
                            <input type="image" src="<?= asset('assets/admin/img/supprimer.png') ?>" value="Supprimer">
                            <button type="submit">Delete</button>
                        </div>
                    <?= Form::close() ?>
                    <?php /* TODO faire confirmation javascript 
                    array(
                        "alt" => "Supprimer",
                        'class' => 'supprimer',
                        'title' => 'supprimer '.$data->nom
                    ))); */?>
                </td>
           </tr>
        <?php $i++; endforeach; ?>
    </tbody>
</table>
<?= $liste->pagination() ?>
