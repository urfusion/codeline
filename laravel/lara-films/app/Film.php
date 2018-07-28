<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Genre;

class Film extends Model {

    protected $table = 'films';
    protected $fillable = ['name', 'slug', 'description', 'release_date', 'rating', 'ticket_price', 'country', 'poster'];

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function genres() {
        return $this->hasMany(Genre::class);
    }

    public static function addFilm($request) {

        $posterName = time() . '.' . request()->poster->getClientOriginalExtension();

        $request->poster->storeAs('posters', $posterName);

        $data = new Film();
        $data->name = $request->input('name');
        // slug convert into slug-slug
        $slug = $request->input('slug');
        $slugreplace = str_replace(" ", "-", strtolower($slug));
        $data->slug = $slugreplace;
        $data->description = $request->input('description');
        $data->release_date = $request->input('release_date');
        $data->rating = $request->input('rating');
        $data->ticket_price = $request->input('ticket_price');
        $data->country = $request->input('country');
        $data->poster = 'posters/' . $posterName;

        $data->save();


        $genre = $request->input('genre');
        $genexplode = explode(",", $genre);
        $genere_data = array();
        foreach ($genexplode as $value) {
            $genere_data[] = array(
                'film_id' => $data->id,
                'genre' => trim($value),
            );
            $genre = new Genre();
            $genre->film_id = $data->id;
            $genre->genre = trim($value);
            $genre->save();
        }
    }

    public static function updateFilm($request, $id) {

        $data = Film::find($id);
        $data->name = $request->input('name');
        // slug convert into slug-slug
        $slug = $request->input('slug');
        $slugreplace = str_replace(" ", "-", strtolower($slug));
        $data->slug = $slugreplace;
        $data->description = $request->input('description');
        $data->release_date = $request->input('release_date');
        $data->rating = $request->input('rating');
        $data->ticket_price = $request->input('ticket_price');
        $data->country = $request->input('country');

        if($request->hasFile('poster')) {
            $posterName = time() . '.' . request()->poster->getClientOriginalExtension();
            $request->poster->storeAs('posters', $posterName);
            $data->poster = 'posters/' . $posterName;
        }
        $data->save();
        
        Genre::where('film_id',$data->id)->delete();

        $genre = $request->input('genre');
        $genexplode = explode(",", $genre);
        $genere_data = array();
        foreach ($genexplode as $value) {
            $genere_data[] = array(
                'film_id' => $data->id,
                'genre' => trim($value),
            );
            $genre = new Genre();
            $genre->film_id = $data->id;
            $genre->genre = trim($value);
            $genre->save();
        }
    }

}
