@extends('layouts.app')

@section('title', 'Film huren')

@section('content')
<h2>Film huren</h2>
@if ($copies->count())
    <form method="POST" action="/copies/rent">
        @csrf
        @method('PATCH')

        <label for="id">Nummer</label>
        <br>
        <select name="id" required>
            @foreach ($copies as $copy)
                <option value="{{ $copy->id }}" @if (old('id')==$copy->id) selected @endif>{{ $copy->id }} - {{ $copy->movie->title }}</option>
            @endforeach
        </select>
        <br>
        <br>
        <button type="submit">Film huren</button>
        <br>
        @include ('errors')
    </form>
@else
    <p>Geen films beschikbaar</p>
@endif
@endsection
