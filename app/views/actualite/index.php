<h2>Liste des actualités</h2>

<?php foreach ($actualites as $actualite) : ?>
<h3><?= e($actualite->nom) ?></h3>
<?php endforeach ?>