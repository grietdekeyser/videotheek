@extends('layouts.app')

@section('title', 'Exemplaar toevoegen')

@section('content')
<h2>Exemplaar toevoegen</h2>
<form method="POST" action="/copies">
    @csrf

    <label for="movie_id">Titel</label>
    <br>
    <select name="movie_id" required>
        @foreach ($movies as $movie)
            <option value="{{ $movie->id }}" @if (old('movie_id') == $movie->id || request()->id == $movie->id) selected @endif>{{ $movie->title }}</option>
        @endforeach
    </select>
    <br>
    <br>
    <label for="id">Nummer</label>
    <br>
    <input type="number" name="id" value="{{ old('id') }}" required>
    <br>
    <br>
    <button type="submit">Exemplaar toevoegen</button>
    <br>
    @include ('errors')
</form>
@endsection
