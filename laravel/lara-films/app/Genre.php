<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model {

    public function film() {
        return $this->belongsTo(Film::class);
    }
		protected $fillable=['film_id','genre'];
		
}
