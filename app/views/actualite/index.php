<h2>Liste des actualités (<?php echo $liste->count() ?>)</h2>
<?php echo $liste->pagination() ?>
<form method="get" id="recherche" action="">
    <div>
        <?php echo $liste->paramsListe(true); ?>
        <input type="text" name="mot" id="mot" value="<?php echo $liste->getRechercheValue('mot') ?>" />
        <input type="submit" name="submit" value="Chercher" />
    </div>
</form>
<table class="liste" width="75%">
    <thead>
        <tr>
            <th><?php echo $liste->labelTri('date_actu', 'Date') ?></th>
            <th><?php echo $liste->labelTri('nom', 'Titre') ?></th>
            <th><?php echo $liste->labelTri('description', 'Description') ?></th>
            <th>Modif.</th>
            <th>Supp.</th>
        </tr>
    </thead>
    <tbody>
        <?php $i=0; foreach ($datas as $data): ?>
            <tr class="<?php echo (($i %2 ) == 0 ? "pair" : "impair"); ?>">
                <td><?php echo $data->date_actu_format; ?></td>
                <td><?php echo $data->nom; ?></td>
                <td><?php echo Str::words($data->description, 30, '...'); ?></td>
                <td class="center"><?php //echo Html::anchor('admin/actualite/actualite/edit/'.$data->id, Asset::img('modifier.png', array("alt" => "Modifier"))); ?></td>
                <td class="center">
                    <?php /*echo Html::anchor('admin/actualite/actualite/delete/'.$data->id, Asset::img('supprimer.png',
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
<?php echo $liste->pagination() ?>
