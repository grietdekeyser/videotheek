@extends('layouts.app')

@section('title', 'Film toevoegen')

@section('content')
<h2>Film toevoegen</h2>
<form method="POST" action="/movies">
    @csrf

    <label for="title">Titel</label>
    <br>
    <input type="text" name="title" value="{{ old('title') }}" required>
    <br>
    <button type="submit">Film toevoegen</button>

    @include ('errors')
</form>
@endsection
