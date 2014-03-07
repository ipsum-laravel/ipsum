<html>
<body style="background: #ddd">

<table width="100%" border="0" cellspacing="0" cellpadding="10">
    <tr>
        <td align="center">
            <table width="600" style="background-color: white;">
                <tr>
                    <td>
                        <p>Bonjour,</p>

                        <p>Vous avez reçu un nouveau message en provenance du site <a href="<?= Config::get('app.url') ?>"><?= Config::get('website.nom_site') ?></a></p>

                        <p>
                            <strong>Nom :</strong> <?= $name ?><br />
                            <strong>Email :</strong> <?= $email ?><br />
                            <?php if(isset($subject)) : ?>
                            <strong>Sujet :</strong> <?= $subject ?><br />
                            <?php endif ?>
                            <strong>Message :</strong><br />
                        </p>

                        <p>
                            <?= $mailContent ?>
                        </p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>


</body>
</html>
