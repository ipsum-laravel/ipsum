
<div>
    <h2>Ajouter des fichiers</h2>
    <div id="fileupload-message"></div>
    {{ Form::open([
        'route' => array('admin.media.upload'),
        'method' => 'PUT',
        'files' => true
    ]) }}
        <div id="fileupload">
            <input name="medias[]" id="files" type="file" multiple="multiple">
            {{ Form::hidden('media_view', 'media.admin._media_liste') }}
            <input name="submit" type="submit" value="Télécharger">
            <p>{{ Form::select('repertoire', $repertoires, Liste::getFiltreValeur('repertoire')) }}</p>
        </div>
    {{ Form::close() }}

    <h2 style="margin-top: 20px;">Liste des médias ({{ Liste::count() }})</h2>
    {{ Liste::pagination() }}
    <form method="get" id="recherche" action="">
        <div>
            {{ Liste::inputsHidden() }}
            <input type="text" name="mot" id="mot" value="{{ Liste::getFiltreValeur('mot') }}" />
            {{ Form::select('repertoire', $repertoires, Liste::getFiltreValeur('repertoire')) }}
            {{ Form::select('type', $types, Liste::getFiltreValeur('type')) }}
            <input type="submit" name="submit" value="Chercher" />
        </div>
    </form>
    <table class="liste" style="width: 100%;">
        <thead>
            <tr>
                <th>{{ Liste::lienTri('Date', 'date') }}</th>
                <th>{{ Liste::lienTri('Titre', 'titre') }}</th>
                <th>{{ Liste::lienTri('Répertoire', 'repertoire') }}</th>
                <th>{{ Liste::lienTri('Type', 'type') }}</th>
                <th>Média</th>
                <th>Modif.</th>
                <th>Supp.</th>
            </tr>
        </thead>
        <tbody id="medias">
            <?php $i=0; foreach ($medias as $media): ?>
            @include('media.admin._media_liste')
            <?php $i++; endforeach; ?>
        </tbody>
    </table>
    {{ Liste::pagination() }}
</div>

<!--  fileupload -->
<script src="<?= asset('packages/ipsum/admin/js/jquery.ui.widget.js') ?>"></script>
<script src="<?= asset('admin/js/jquery.knob.js') ?>"></script>
<script src="<?= asset('admin/js/jquery.iframe-transport.js') ?>" ></script>
<script src="<?= asset('admin/js/jquery.fileupload.js') ?>" ></script>
<script src="<?= asset('admin/js/jquery.formFileupload.js') ?>" ></script>
<script>
    $(function() {
        $("#fileupload").formFileupload({
            "afterDone" : function (e, data) {
                data.result.views.forEach(function(element) {
                    $("#medias").prepend(element);
                });
            }
        });
    });
</script>

<style>
    .fileupload {
        padding: 20px;
        background-color: #fafafa;
        border: dashed 4px #9f9f9f;

        text-align: center;
    }
    .fileupload-hover {
        border-color: #dedede;
    }
    .fileupload-error {
        border: dashed 4px red;
    }
    .fileupload input{
        display:none;
    }
</style>

