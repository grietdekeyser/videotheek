@extends('layouts.app')

@section('title', 'Film overzicht')

@section('content')
<h2>Overzicht films</h2>

@if (session('message'))
    <p class="alert alert-success">{{ session('message' )}}</p>
@endif

<table class="table">
    <thead>
        <tr>
            <th>Titel</th>
            <th>Nummer(s)</th>
            <th>Exemplaren aanwezig</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($movies as $movie)
            <tr>
                <td>
                    <a href="/movies/{{ $movie->id}}">{{ $movie->title }}</a>
                </td>
                <td>
                    @foreach ($movie->copies as $copy)
                        @if ($copy->available)
                            <strong>{{ $copy->id }}</strong>
                        @else
                            {{ $copy->id }}
                        @endif
                    @endforeach
                </td>
                <td>
                    {{ $movie->copies->where('available', true)->count() }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
