<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Film;
use App\Comment;
use App\Genre;
use Validator;
use App\Http\Controllers\Controller;
use App\Http\Resources\Film as FilmResource;

class ApiController extends Controller {

    public function show($id) {

        return new FilmResource(Film::find($id));
    }
    public function index() {

        return new FilmResource(Film::all());
    }

}
