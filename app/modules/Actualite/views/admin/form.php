<h2><?= isset($data) ? 'Modification' : 'Nouvelle' ?> actualité</h2>
<?= Form::open(array('route' => isset($data) ? array('admin.actualite.update', $data->id) : 'admin.actualite.store', 'class' => 'saisie', 'method' => isset($data) ? 'PUT' : 'POST')) ?>
    <fieldset class="bloc_left">
        <legend>Description</legend>
        <p class="oblig<?= $errors->has('date_actu') ? ' form_erreur' : '' ?>">
            <?= Form::label('date_actu') ?>
            <?= Form::text('date_actu', isset($data) ? formateDate($data->date_actu) : date('d/m/Y'), array('class' => "date-pick")) ?>
        </p>
        <p class="oblig<?= $errors->has('nom') ? ' form_erreur' : '' ?>">
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

<?php if (isset($data)) : ?>
<div class="saisie">
    <fieldset class="bloc_right">
        <legend>Image</legend>
        <?= Form::open(array('route' => array('admin.actualite.upload', $data->id), 'method' => 'PUT', 'files'=> true)) ?>
        <p>
            <?= Form::label('image', 'Image') ?>
            <?= Form::file('image') ?>
        </p>
        <p>
            <?= Form::submit('Télécharger', array('id' => 'submit', 'class' => 'submits')) ?>
        </p>
        <?= Form::close() ?>
        <?php if ($data->image) : ?>
        <p>
            <img src="<?=Croppa::url('/'.$data->image, 310)?>" alt="" />
        </p>
        <?= Form::open(array('method' => 'DELETE', 'route' => array('admin.actualite.deleteImage', $data->id))) ?>
        <p class="center">
            <button type="submit" class="supprimer" data-message="l'image">Supprimer l'image</button>
         </p>
         <?= Form::close() ?>
        <?php endif ?>

    </fieldset>
</div>
<?php endif ?>