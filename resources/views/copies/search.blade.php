@extends('layouts.app')

@section('title', 'Exemplaar zoeken')

@section('content')
<h2>Exemplaar zoeken</h2>
<form method="POST" action="/copies/search">
    @csrf

    <label for="id">Nummer</label>
    <br>
    <input type="number" name="id">
    <br>
    <button type="submit">Opzoeken</button>
</form>
@endsection
