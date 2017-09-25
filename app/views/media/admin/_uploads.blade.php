<h3>Téléchargement des fichiers</h3>
{{ Form::open(
    [
        'route' => ['admin.media.upload'],
        'method' => 'PUT',
        'files' => true
    ]
) }}
<div id="fileupload">
    {{ Form::hidden('publication_id', isset($publication) ? $publication->id : null) }}
    {{ Form::hidden('publication_type', 'App\Article\Article') }}
    {{ Form::hidden('repertoire', $dossier) }}
    <input name="medias[]" id="files" type="file" multiple="multiple">
    <input name="submit" type="submit" value="Télécharger">
</div>
{{ Form::close() }}
<div id="fileupload-message"></div>

<h3 style="margin-top: 20px;">Liste des fichiers</h3>
<div id="medias">
    @if (isset($publication) and $publication->medias->count())
        @foreach ($publication->medias as $media)
            @include('media.admin._media')
        @endforeach
    @endif
</div>

<!--  fileupload -->
<script src="{{ asset('packages/ipsum/admin/js/jquery.ui.widget.js') }}"></script>
<script src="{{ asset('admin/js/jquery.knob.js') }}"></script>
<script src="{{ asset('admin/js/jquery.iframe-transport.js') }}" ></script>
<script src="{{ asset('admin/js/jquery.fileupload.js') }}" ></script>
<script src="{{ asset('admin/js/jquery.formFileupload.js') }}" ></script>
<script>
    $(function() {
        @if ($markItUpAddMedia_textarea_id)
            function markItUpAddMedia() {
                $(".markItUpAddMedia").click(function() {
                    var src = $(this).data("fichier");
                    var alt = $(this).attr("title");

                    var arguments = []
                    arguments.push(src);
                    var alignement = $(this).parents('.media').find('.alignement option:selected').val();
                    if (typeof alignement !== "undefined") {
                        arguments.push(alignement);
                    }
                    taille = $(this).parents('.media').find('.taille option:selected').val();
                    if (typeof taille !== "undefined" && taille != "") {
                        arguments.push(taille);
                    }

                    if ($.markItUp.focused) {
                        target = false;
                    } else {
                        target = '.markItUpEditor:first';
                    }
                    $.markItUp({
                        target: target,
                        openWith: "!media[",
                        closeWith: "](" + arguments.join('|') + ")",
                        placeHolder: alt
                    });
                    return false;
                });
            }
            markItUpAddMedia();
        @endif

        $("#fileupload").formFileupload({
            "afterDone" : function (e, data) {
                data.result.views.forEach(function(element) {
                    $("#medias").prepend(element);
                });
                markItUpAddMedia();
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

    .media {
        overflow: hidden;
        margin-bottom: 10px;
        padding: 5px;
        background: #f5f5f5;
        text-align: right;
    }
        .media-illustration {
            background: #d7d7d7;
        }
        .media-details {
            float: right;
            width: 170px;
        }
            .media-menu > * {
                display: inline-block;
            }
            .media label {
                display: inline-block;
                width: 50%;
                text-align: right;
            }
            .media select {
                width: 45%;
            }
            .media-addMedia {
                display: {{ $markItUpAddMedia_textarea_id ? 'block' : 'none' }}
            }
</style>