# Ipsum

Ipsum est un kit de démarage basé sur le Framework php Laravel 4.2.
L'architecture de base de Laravel a été modifié en module. On trouvera les modules dans le repertoire app/modules.
Le module app/modules/Actualite est là pour exemple.

## Instalation

### Copie des sources

Copier l'ensemble des fichiers dans votre repertoire de travail. Le serveur web devra pointer sur le repertoire public_html.

### Définition l'environnement

Pour définir l'environment, créer un fichier bootstrap/environment.php avec le contenu ci-dessous :

    <?php
    return 'local';

Valeur possible : local / production / test

### Configuration de l'environnement

Ajouter et modifier les fichiers ci-dessous dans le repertoire de configuration de l'environnement (app/config/xxxx).

- app.php (debug + url)
- database.php (accès mysql)
- mail.php (pretend true)

Ligne de commande :

    mkdir app/config/local
    cp app/config/app.php app/config/local/app.php
    cp app/config/database.php app/config/local/database.php
    cp app/config/mail.php app/config/local/mail.php

### Dossier storage

Vérifier la création du dossier storage avec les sous dossiers et les droits nécessaires

### Installation des dépendances

Commande pour l'instalation :

    composer install

#### Installation de composer si besoin

    curl -s https://getcomposer.org/installer | php

    $ curl -sS https://getcomposer.org/installer | php
    $ mv composer.phar /usr/local/bin/composer

### Nouveau projet : installation des packages

    php artisan ipsum:install

Voir les [dépots Ipsum](https://github.com/ipsum-laravel/) pour plus de détails sur leurs installations.

