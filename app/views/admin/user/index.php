<h2>Liste des utilisateurs (<?= $liste->count() ?>)</h2>
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
            <th><?= $liste->labelTri('nom', 'Nom') ?></th>
            <th><?= $liste->labelTri('email', 'Email') ?></th>
            <th>Modif.</th>
            <th>Supp.</th>
        </tr>
    </thead>
    <tbody>
        <?php $i=0; foreach ($datas as $data): ?>
            <tr class="<?= (($i %2 ) == 0 ? "pair" : "impair"); ?>">
                <td><?= e($data->nom) ?></td>
                <td><?= e($data->email) ?></td>
                <td class="center"><a href="<?= url('admin/user/'.$data->id.'/edit') ?>"><img src="<?= asset('assets/admin/img/modifier.png') ?>" alt="Modifier" /></a></td>
                <td class="center">
                    <?= Form::open(array('method' => 'DELETE', 'action' => array('UsersController@destroy', $data->id))) ?>
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
