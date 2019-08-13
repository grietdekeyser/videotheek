@extends('layouts.app')

@section('title', 'Film detail')

@section('content')
<h2>{{ $movie->title }}</h2>

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
        <tr>
            <td>
                {{ $movie->title }}
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
    </tbody>
</table>

<form method="POST" action="/movies/{{ $movie->id }}">
    @csrf
    @method('DELETE')

    <button type="submit">Verwijder film</button>
</form>
    
<form method="POST" action="/copies/create">
    @csrf
    
    <input type="hidden" name="id" value="{{ $movie->id }}">
    <button type="submit">Voeg exemplaar toe</button>
</form>
@endsection
