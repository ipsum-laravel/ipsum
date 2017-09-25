<div class="media{{ (isset($publication) and $publication->media_id == $media->id) ? ' media-illustration' : '' }}">
    <a class="markItUpAddMedia media-image" href="{{ asset($media->path) }}" title="{{{ $media->titre }}}" data-fichier="{{{ $media->repertoire }}}/{{{ $media->fichier }}}">
        @if ($media->isImage())
            <img src="{{ Croppa::url('/'.$media->cropPath, 150, 150) }}" alt="" />
        @else
            <img src="{{ asset('admin/img/'.$media->icone) }}" alt="{{{ $media->type }}}" />
        @endif
    </a>
    <div class="media-details">
        <div class="media-menu">
            <div>
                <a href="{{ route('admin.media.edit', $media->id) }}"><img src="{{ asset('packages/ipsum/admin/img/modifier.png') }}" alt="Modifier"></a>
            </div>
            @if (isset($publication) and $media->isImage() and $publication->media_id != $media->id)
                {{ Form::open(['method' => 'PUT', 'route' => ['admin.media.illustrer', $media->id]]) }}
                <div>
                    {{ Form::hidden('publication_id', $publication->id) }}
                    {{ Form::hidden('publication_type', get_class($publication)) }}
                    <input title="Illustrer avec cette image" type="image" src="{{ asset('admin/img/picture_add.png') }}" value="Illustrer">
                </div>
                {{ Form::close() }}
            @endif
            {{ Form::open(['method' => 'DELETE', 'route' => ['admin.media.destroy', $media->id]]) }}
            <div>
                <input title="Supprimer le média" type="image" src="{{ asset('packages/ipsum/admin/img/supprimer.png') }}" value="Supprimer" class="supprimer" data-message="{{{ $media->titre }}}">
            </div>
            {{ Form::close() }}
        </div>
        @if ($media->isImage())
        <div class="media-addMedia">
            <p>
                <label>Taille</label>
                <select name="taille" class="taille">
                    <option value="250">Petite taille</option>
                    <option value="960">Grande taille</option>
                    <option value="">Original</option>
                </select>
            </p>
            <p>
                <label>Alignement</label>
                <select name="alignement" class="alignement">
                    <option value="">---</option>
                    <option value="img-left">Centré</option>
                    <option value="left">Gauche</option>
                    <option value="right">Droite</option>
                </select>
            </p>
            <p>
                <a class="markItUpAddMedia"
                   href="{{ asset($media->path) }}"
                   title="{{{ $media->titre }}}"
                   data-fichier="{{{ $media->repertoire }}}/{{{ $media->fichier }}}">
                    Ajouter
                </a>
            </p>
        </div>
        @endif
    </div>
</div>