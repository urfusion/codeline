<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Film;
use App\Comment;
use App\Genre;
use Validator;
use App\Http\Controllers\Controller;

class FilmsController extends Controller {

    public function index() {
        $films = DB::table('films')->simplePaginate(1);
        return view('films', compact('films'));
    }

    public function create() {
        return view('films.create');
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
                    'name' => 'required|max:255',
                    'slug' => 'required|max:255|unique:films',
                    'description' => 'required|max:1000',
                    'release_date' => 'required',
                    'rating' => 'required',
                    'ticket_price' => 'required',
                    'country' => 'required|max:32',
                    'poster' => 'required',
                    'genre' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('films/create')
                            ->withErrors($validator)
                            ->withInput();
        }

        Film::addFilm($request);
        return redirect('films/create')
                        ->with('status', 'Film Saved Successfully!');
    }

    public function show($slug) {

        $film = Film::where('slug', $slug)->first();
        return view('films.show', compact('film'));
    }

    public function edit($slug) {

        $film = Film::where('slug', $slug)->first();
        $genres = Genre::where('film_id', $film->id)->get();
        
        $genre_string = '';
        foreach ($genres as $genre) {
            $genre_string .= $genre->genre . ',';
        }
        $genre_string = rtrim($genre_string, ',');

        return view('films.edit', compact('film', 'genre_string'));
    }

    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), [
                    'name' => 'required|max:255',
                    'slug' => 'required|max:255',
                    'description' => 'required|max:1000',
                    'release_date' => 'required',
                    'rating' => 'required',
                    'ticket_price' => 'required',
                    'country' => 'required|max:32',
                    'genre' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('films/create')
                            ->withErrors($validator)
                            ->withInput();
        }
        Film::updateFilm($request, $id);

        return redirect('films')
                        ->with('status', 'Film Updated Successfully!');
    }

    public function destroy($slug) {
        Film::where('slug', $slug)->delete();
        return redirect('films')
                        ->with('status', 'Film Removed Successfully!');
    }

    public function addcomment(Request $request) {
        $validator = Validator::make($request->all(), [
                    'name' => 'required|max:64',
                    'comment' => 'required|max:500'
        ]);
        if ($validator->fails()) {

            return redirect('films/' . $request->input('slug'))
                            ->withErrors($validator)
                            ->withInput();
        }

        Comment::addComment($request);
        return redirect('films/' . $request->input('slug'));
    }

}
