<?php

namespace App\Http\Controllers;

use App\Copy;
use App\Movie;
use Illuminate\Http\Request;

class CopyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect('/movies');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $movies = Movie::all()->sortBy('title');

        return view('copies.create', compact('movies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = $this->validateCopy();
        $attributes['available'] = true;

        Copy::create($attributes);

        $message = "Exemplaar " . $attributes['id'] . " werd toegevoegd aan " . Movie::findOrFail($attributes['movie_id'])['title'] . ".";
        session()->flash('message', $message);

        return redirect('/copies/' . $attributes['id']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Copy  $copy
     * @return \Illuminate\Http\Response
     */
    public function show(Copy $copy)
    {
        $movie = $copy->movie;

        return view('movies.show', compact('movie'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Copy  $copy
     * @return \Illuminate\Http\Response
     */
    public function edit(Copy $copy)
    {
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function rent(Request $request)
    {
        $attributes = $this->validateChange();

        $copy = Copy::findOrFail($attributes['id']);
        
        $copy->available = false;

        $copy->save();

        $movie = $copy->movie;

        $message = 'Exemplaar ' . $copy['id'] . " van " . $movie->title . " werd verhuurd.";
        session()->flash('message', $message);

        return redirect('/copies/' . $copy->id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function return(Request $request)
    {
        $attributes = $this->validateChange();

        $copy = Copy::findOrFail($attributes['id']);
        
        $copy->available = true;

        $copy->save();

        $movie = $copy->movie;

        $message = 'Exemplaar ' . $copy['id'] . " van " . $movie->title . " werd teruggebracht.";
        session()->flash('message', $message);

        return redirect('/copies/' . $copy->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $attributes = $this->validateChange();

        $copy = Copy::findOrFail($attributes['id']);

        $copy->delete();

        $movie = $copy->movie;

        $message = 'Exemplaar ' . $copy->id . " van " . $movie->title . " werd verwijderd.";
        session()->flash('message', $message);

        return redirect('/movies/' . $movie->id);
    }

    public function chooseToDelete()
    {
        $copies = Copy::all();

        return view('copies.delete', compact('copies'));
    }

    public function chooseToRent()
    {
        $copies = Copy::all()->where('available', true);

        return view('copies.rent', compact('copies'));
    }

    public function chooseToReturn()
    {
        $copies = Copy::all()->where('available', false);

        return view('copies.return', compact('copies'));
    }

    public function search(Request $request)
    {
        return redirect('/copies/' . $request->id);
    }

    public function validateCopy()
    {
        $rules = [
            'id' => ['required', 'unique:copies,id', 'min:1', 'integer'],
            'movie_id' => ['required', 'exists:movies,id', 'min:1', 'integer']
        ];

        $messages = [
            'id.required' => 'Nummer is een verplicht veld.',
            'id.unique' => 'Er bestaat reeds een exemplaar met dit nummer.',
            'id.*' => 'Nummer moet groter dan nul zijn.',
            'movie_id.required' => 'Kies een film',
            'movie_id.*' => 'Er gaat iets fout, probeer later opnieuw'
        ];

        return $this->validate(request(), $rules, $messages);
    }

    public function validateChange()
    {
        $rules = [
            'id' => ['required', 'exists:copies,id', 'integer']
        ];

        $messages = [
            'id.required' => 'Kies een exemplaar.',
            'id.*' => 'Er gaat iets fout, probeer later opnieuw.'
        ];

        return $this->validate(request(), $rules, $messages);
    }
}
