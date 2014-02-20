
    <h4 class="form-signin-heading">Please sign in</h4>
    <?php if ( Session::has("alert_error") ) : ?>
          <div class="alert alert-danger">
              <strong>Oops, Something Wrong</strong> <br/>
              <?= Session::get("alert_error") ?>
          </div>
    <?php endif ?>
    <?php
    echo Form::open(array('url' => 'admin/users/login'));
    echo Form::label('identifiant', 'Nom :');
    echo Form::text('identifiant');
    echo Form::label('password', 'Mot de passe :');
    echo Form::password('password');
    echo Form::submit('Se connecter');
    echo Form::close();