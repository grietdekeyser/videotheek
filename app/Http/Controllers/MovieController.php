<?php

namespace App\Http\Controllers;

use App\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movies = Movie::all()->sortBy('title');

        return view('movies.index', compact('movies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('movies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $movie = Movie::create($this->validateMovie());

        $message = $movie->title . " werd toegevoegd.";
        session()->flash('message', $message);

        return redirect('/movies/' . $movie->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function show(Movie $movie)
    {
        return view('movies.show', compact('movie'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function edit(Movie $movie)
    {
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movie $movie)
    {
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $attributes = $this->validateDelete();

        $movie = Movie::findOrFail($attributes['id']);

        $this->destroy($movie);

        return redirect('/movies');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        $movie->delete();

        $message = $movie['title'] . " werd verwijderd.";
        session()->flash('message', $message);

        return redirect('/movies');
    }

    public function chooseToDelete()
    {
        $movies = Movie::all()->sortBy('title');

        return view('movies.delete', compact('movies'));
    }


    public function validateMovie()
    {
        $rules = [
            'title' => ['required', 'min:3', 'unique:movies']
        ];

        $messages = [
            'title.required' => 'Titel is een verplicht veld.',
            'title.min' => 'De titel moet minsten 3 letters bevatten.',
            'title.unique' => 'Er bestaat reeds een film met deze titel.'
        ];

        return $this->validate(request(), $rules, $messages);
    }

    public function validateDelete()
    {
        $rules = [
            'id' => ['required', 'exists:movies,id', 'integer']
        ];

        $messages = [
            'id.required' => 'Kies een film.',
            'id.*' => 'Er gaat iets fout, probeer later opnieuw.'
        ];

        return $this->validate(request(), $rules, $messages);
    }
}
