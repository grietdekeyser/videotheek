@extends('layouts.app')

@section('content')
<ul>
    <li>
        <a href="/movies">Overzicht films</a>
    </li>
    <li>
        <a href="/copies/search">Zoeken op nummer</a>
    </li>
    <li>
        <a href="/movies/create">Nieuwe titel toevoegen</a>
    </li>
    <li>
        <a href="/copies/create">Nieuw exemplaar toevoegen</a>
    </li>
    <li>
        <a href="/movies/delete">Verwijder een titel</a>
    </li>
    <li>
        <a href="/copies/delete">Verwijder een exemplaar</a>
    </li>
    <li>
        <a href="/copies/rent">Film huren</a>
    </li>
    <li>
        <a href="/copies/return">Film terugbrengen</a>
    </li>
</ul>
@endsection
