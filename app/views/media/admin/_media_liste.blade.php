<tr class="{{ (isset($i) and ($i %2 ) == 0) ? "pair" : "impair" }}">
    <td>{{{ $media->created_at->format('d/m/Y') }}}</td>
    <td>{{{ $media->titre }}}</td>
    <td>{{{ $media->repertoire }}}</td>
    <td>{{{ $media->type }}}</td>
    <td class="center">
        <a href="{{ asset($media->path) }}">
            @if ($media->isImage())
            <img src="{{ Croppa::url('/'.$media->cropPath, 150, 150) }}" alt="" />
            @else
            <img src="{{ asset('admin/img/'.$media->icone) }}" alt="{{{ $media->type }}}" />
            @endif
        </a>
    </td>
    <td class="center">
        <a href="{{ route('admin.media.edit', $media->id) }}"><img src="{{ asset('packages/ipsum/admin/img/modifier.png') }}" alt="Modifier"></a>
    </td>
    <td class="center">
        {{ Form::open(array('method' => 'DELETE', 'route' => array('admin.media.destroy', $media->id))) }}
        <div>
            <input type="image" src="{{ asset('packages/ipsum/admin/img/supprimer.png') }}" value="Supprimer" class="supprimer" data-message="{{{ $media->titre }}}">
        </div>
        {{ Form::close() }}
    </td>
</tr>