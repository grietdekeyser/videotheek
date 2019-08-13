@extends('layouts.app')

@section('title', 'Exemplaar verwijderen')

@section('content')
<h2>Exemplaar verwijderen</h2>
<form method="POST" action="/copies/delete">
    @csrf
    @method('DELETE')

    <label for="id">Nummer</label>
    <br>
    <select name="id" required>
        @foreach ($copies as $copy)
            <option value="{{ $copy->id }}" @if (old('id')==$copy->id) selected @endif>{{ $copy->id }} - {{ $copy->movie->title }}</option>
        @endforeach
    </select>
    <br>
    <br>
    <button type="submit">Exemplaar verwijderen</button>
    <br>
    @include ('errors')
</form>
@endsection
