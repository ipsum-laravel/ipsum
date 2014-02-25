<h2><?= isset($data) ? 'Modification' : 'Nouvelle' ?> utilisateur</h2>
<?= Form::open(array('url' => 'admin/user'.(isset($data) ? '/'.$data->id : ''), 'class' => 'saisie', 'method' => isset($data) ? 'PUT' : 'POST')) ?>
    <fieldset class="bloc_left">
        <legend>Description</legend>
        <p>
            <?= Form::label('nom', 'Nom') ?>
            <?= Form::text('nom', isset($data) ? $data->nom : null) ?>
        </p>
        <p>
            <?= Form::label('prenom', 'Prénom') ?>
            <?= Form::text('prenom', isset($data) ? $data->prenom : null) ?>
        </p>
        <p>
            <?= Form::label('email', 'Email') ?>
            <?= Form::text('email', isset($data) ? $data->email : null) ?>
        </p>
        <p>
            <span class="textNotice">Laisser vide pour conserver l'ancien</span>
            <?= Form::label('password', 'Mot de passe') ?>
            <?= Form::password('password') ?>
        </p>
        <p>
            <?= Form::label('password_again', 'Confirmation mot de passe') ?>
            <?php echo Form::password('password_again') ?>
        </p>
        <p>
            <?= Form::label('role', 'Rôle') ?>
            <?= Form::select('role', $role) ?>
        </p>
        <p>
            <label for="submit">&nbsp</label>
            <?= Form::submit('Enregistrer', array('id' => 'submit', 'class' => 'submit')) ?>
        </p>
    </fieldset>
<?= Form::close() ?>
