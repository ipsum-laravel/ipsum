<h1>Contactez-nous</h1>

<h2>Nos coordonnées</h2>
<div class="vcard">
    <p>
        <strong class="fn"><?= Config::get('website.nom') ?></strong>
    </p>
    <p>
        <strong>Adresse :</strong><br>
        <span class="street-address"><?= Config::get('website.adresse') ?></span><br>
        <span class="postal-code"><?= Config::get('website.cp') ?></span> - <span class="locality"><?= Config::get('website.ville') ?></span><br>
        <strong>Téléphone :</strong> <span class="tel"><?= Config::get('website.telephone') ?></span><br>
        <strong>GSM :</strong> <span><?= Config::get('website.gsm') ?></span><br>
        <strong>Fax :</strong> <?= Config::get('website.fax') ?><br>
        <!--<strong>Courriel :</strong> <span class="email"></span>-->
    </p>
</div>
<h2>Envoyez-nous un message</h2>
<form class="saisie2" method="post" action="?">
    <p>
        <?= Form::label('nom', 'Nom') ?>
        <?= Form::text('nom') ?>
    </p>
    <p>
        <?= Form::label('prenom', 'Prénom') ?>
        <?= Form::text('prenom') ?>
    </p>
    <p>
        <?= Form::label('email', 'Email') ?>
        <?= Form::text('email') ?>
    </p>
    <p>
        <?= Form::label('telephone', 'Téléphone') ?>
        <?= Form::text('telephone') ?>
    </p>
    <p>
        <?= Form::label('message', 'Message') ?>
        <?= Form::textarea('message') ?>
    </p>
    <p>
        <label for="submit">&nbsp;</label>
        <input name="submit" id="submit" class="envoyer_mail" type="submit" value="Envoyer">
    </p>
</form>