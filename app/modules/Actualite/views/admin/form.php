<h2><?= isset($data) ? 'Modification' : 'Nouvelle' ?> actualité</h2>
<?= Form::open(array('route' => isset($data) ? array('admin.actualite.update', $data->id) : 'admin.actualite.store', 'class' => 'saisie', 'method' => isset($data) ? 'PUT' : 'POST')) ?>
    <fieldset class="bloc_left">
        <legend>Description</legend>
        <p>
            <?= Form::label('date_actu', 'Date') ?>
            <?= Form::text('date_actu', isset($data) ? formateDate($data->date_actu) : null, array('class' => "date-pick")) ?>
        </p>
        <p>
            <?= Form::label('nom', 'Titre') ?>
            <?= Form::text('nom', isset($data) ? $data->nom : null) ?>
        </p>
        <p>
            <?= Form::label('description', 'Description') ?>
            <?= Form::textarea('description', isset($data) ? $data->description : null, array('class' => 'jwysiwyg', 'rows' => 15)) ?>
        </p>
        <p>
            <label for="submit">&nbsp;</label>
            <?= Form::submit('Enregistrer', array('id' => 'submit', 'class' => 'submit')) ?>
        </p>
    </fieldset>
<?= Form::close() ?>