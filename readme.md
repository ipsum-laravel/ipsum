# Ipsum

Basé sur Laravel 4

## Instalation

Installation de composer
    curl -s https://getcomposer.org/installer | php

    $ curl -sS https://getcomposer.org/installer | php
    $ mv composer.phar /usr/local/bin/composer

Instalation des dépendances
    composer install

Pour définir l'environment, créer un fichier bootstrap/environment.php avec le contenu ci-dessous :
```php
<?php
return 'local';
```

Création du dossier de configuration de test dans app\local avec les fichiers suivant :
- app.php
- database.php
- mail.php

    mkdir app/config/local
    cp app/config/database.php app/config/local/database.php

Vérifier la création du dossier storage avec les sous dossiers et les droits nécessaires
    chmod -R 0777 app/storage

Création des tables
    php artisan migrate
    php artisan migrate --path="app/modules/Actualite/migrations"

Modification de la clé de cryptage si besoin
    php artisan key:generate

Population des tables
    php artisan db:seed