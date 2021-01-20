
<ul id="files">
    @foreach($files as $file)
        <li>
            @if ($permission)
                <a href="{{route('download.file', ['id' => $file->id ])}}">{{ $file->name }}</a>
            @else
             {{ $file->name }}
            @endif
            <small>From user:{{ $file->user->name }}</small>
            <small>Date: {{ $file->created_at }}</small>
            <small>Version: v{{ $file->version }}</small>
        </li>
    @endforeach
</ul>
