<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	protected $table='comments';
    public function film(){
        return $this->belongsTo(Film::class);
    }
	
	public static function addComment($request){
		
		$data = new Comment();
		$data->name = $request->input('name');
		$data->comment = $request->input('comment');
		$data->film_id=$request->input('film_id');
		$data->user_id=$request->input('user_id');
		$data->save();
	}
		
		
	
}
