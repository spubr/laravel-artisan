@extends('laravel-artisan::layout')

@section('title', 'Artisan commands list')

@section('content')
    <h1 class="py-2 text-bold text-center">Artisan commands list</h1>

    @if (isset($error))
        <div class="s-rounded text-tiny toast toast-error">
            {!! Str::replaceFirst('<br />', '', Str::replaceLast('<br />', '', Str::replaceLast('<br />', '', nl2br($error)))) !!}
        </div>
    @endif

    @if (isset($result))
        <div class="s-rounded text-tiny toast toast-success">
            {!! Str::replaceFirst('<br />', '', Str::replaceLast('<br />', '', Str::replaceLast('<br />', '', nl2br($result)))) !!}
        </div>
    @endif

    <ul>
        @foreach ($commands as $category => $commands)
            <li>{{ strtoupper($category) }}</li>
            <ul>
                @foreach ($commands as $slug => $cmd)
                    <li>
                        <a href="{{ $baseUrl }}/artisan/{{ $slug }}" title="{{ $cmd['description'] }}">
                            {{ $cmd['cmd']}}
                        </a>
                    </li>
                @endforeach
            </ul>
        @endforeach
    </ul>
@endsection
