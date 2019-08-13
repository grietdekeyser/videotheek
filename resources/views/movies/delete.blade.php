@extends('layouts.app')

@section('title', 'Film verwijderen')

@section('content')
<h2>Film verwijderen</h2>
<form method="POST" action="/movies/delete">
    @csrf
    @method('DELETE')

    <label for="id">Titel</label>
    <br>
    <select name="id" required>
        @foreach ($movies as $movie)
            <option value="{{ $movie->id }}" @if (old('id')==$movie->id) selected @endif>{{ $movie->title }}</option>
        @endforeach
    </select>
    <br>
    <br>
    <button type="submit">Film verwijderen</button>
    <br>
    @include ('errors')
</form>
@endsection
