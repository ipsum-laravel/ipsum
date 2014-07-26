@extends('layouts.website')
@section('title')Mentions légales @stop

@section('content')
    @parent
    <h1>Mentions légales</h1>

    <p>(réglementées par la Loi n° 2004-575 du 21 juin 2004 pour la confiance dans l'économie numérique)</p>

    <h2>Edition</h2>
    <p>
        Ce site est édité par <?= Config::get('IpsumCore::website.nom') ?><br>
        <?= Config::get('IpsumCore::website.adresse') ?><br>
        <?= Config::get('IpsumCore::website.cp') ?> - <?= Config::get('IpsumCore::website.ville') ?>
    </p>

    <p><strong>RCS : </strong> <?= Config::get('IpsumCore::website.rcs') ?></p>

    <p><strong>Numéro SIRET :</strong> <?= Config::get('IpsumCore::website.siret') ?></p>

    <p><strong>Numéro SIREN :</strong> <?= Config::get('IpsumCore::website.siren') ?></p>

    <p><strong>Capital social :</strong> <?= Config::get('IpsumCore::website.capital') ?></p>

    <p><strong>Directeur de la publication :</strong> <?= Config::get('IpsumCore::website.publication') ?></p>

    <p><strong>Responsable de la rédaction :</strong> <?= Config::get('IpsumCore::website.redaction') ?></p>

    <p><strong>Téléphone :</strong> <?= Config::get('IpsumCore::website.telephone') ?></p>

    <p><strong>Fax :</strong> <?= Config::get('IpsumCore::website.fax') ?></p>

    <h2>Réalisation, Référencement et hébergement du site</h2>

    <p>
        Société Pixell<br>
        Bâtiment Frigodom - Niveau 1<br>
        Z.I.P. de la Pointe des Grives<br>
        97200 Fort-de-France<br>
        Tél. 05 96 75 14 20<br>
        Fax 05 96 75 67 36
    </p>

    <p><a href="http://www.pixellweb.com">http://www.pixellweb.com</a></p>


    <h2>Déclaration du site à la CNIL</h2>
    <p>
        Conformément aux dispositons de la Loi n° 78-17 du 6 janvier 1978 relative à l'Informatique, aux Fichiers et aux
        Libertés, le traitement automatisé des données nominatives réalisé à partir de ce site Internet a fait l'objet d'une déclaration auprès de la
        Commision Nationale de l'Informatique et des Libertés (CNIL) sous le numèro <?= Config::get('IpsumCore::website.cnil') ?>.
    </p>

    <h2>Données nominatives</h2>
    <p>
        En application de la Loi n° 78-17 du 6 janvier 1978 relative à l'Informatique, aux Fichiers et aux
        Libertés, vous disposez des droits d'opposition (art. 26 de la loi), d'accès (art.34 à 38 de la loi) et de
        rectification (art. 36 de la loi) des données vous concernant. Ainsi, vous pouvez contacter la
        société <?= Config::get('IpsumCore::website.nom') ?> pour que soient rectifiées, complétées, mises à jour ou
        effacées les informations vous concernant qui sont inexactes, incomplètes, équivoques,
        périmées ou dont la collecte ou l'utilisation, la communication ou la conservation est interdite.
    </p>
    <p>
        Les informations qui vous concernent sont uniquement destinées à la société <?= Config::get('IpsumCore::website.nom') ?>.
        Nous ne transmettons ces informations à aucun tiers (partenaires commerciaux, etc.).
    </p>
@stop