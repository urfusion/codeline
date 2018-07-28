@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    @if ($film->poster)
                    <img src="<?php echo config("app.url") . "storage/app/" . $film->poster ?>" />
                    @endif

                    <div class="film-list">
                        <h4>
                            <a href="{{url('films/'.$film->slug)}}">	<br>
                                {{$film->name}}
                            </a>
                        </h4>


                        <p>{{$film->description}}</p>
                        <p><strong>Release Date: </strong>{{$film->release_date}}</p>
                        <p><strong>Ticket Price: </strong>{{$film->ticket_price}}</p>
                        <p><strong>Country: </strong>{{$film->country}}</p>
                        <p><strong>Rating: </strong>{{$film->rating}} / 5</p>

                        <strong>Genres: </strong>
                        <ul>
                            @foreach($film->genres as $genre)
                            <li>{{$genre->genre}}</li>
                            @endforeach
                        </ul>

                        <strong>Comments: </strong>
                        <ol>
                            @foreach($film->comments as $comment)
                            <li>
                                <h5>{{$comment->name}}</h5>
                                {{$comment->comment}}
                            </li>
                            @endforeach
                            <?php if (!count($film->comments)) { ?>
                                Be the first to review!
                            <?php } ?>
                        </ol>
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <?php if (Auth::id()) { ?>
                            <div class="card">
                                <div class="card-body">
                                    <form method="POST"action="{{URL('films/comments')}}">
                                        {{csrf_field()}}
                                        <div class="col-md-8">
                                            <div class="col-md-8">
                                                <div class="col-md-8">
                                                    <input type="hidden"value="{{$film->slug}}"name="slug" >
                                                    <input type="hidden"value="{{$film->id}}"name="film_id" >
                                                    <input type="hidden" value="{{Auth::id()}}" name ="user_id">
                                                    <label for="title">Name :</label>
                                                </div>

                                                <div class="col-md-12">
                                                    <input type="text"name ="name" class="form-control"required>
                                                </div>

                                                <div class="col-md-12">
                                                    <label for="title">Comments :</label></div>
                                                <div class="col-md-12">
                                                    <textarea name="comment"  class="form-control"></textarea>
                                                </div>

                                                <div class="col-md-4">
                                                    <br>
                                                    <input type="submit" name="submit" value="Submit"class="btn btn-primary"></div>

                                            </div>
                                        </div>
                                    </form>
                                    <ul>

                                    </ul>
                                </div>

                            </div>
                            <a href="{{url('films/'.$film->slug.'/edit')}}">Edit</a>

                            <form action="{{url('films/'.$film->slug)}}" method="POST">
                                @method('DELETE')
                                {{csrf_field()}}
                                <button type="submit">Remove</button>
                            </form>
                        <?php } else { ?>
                            <a href="{{url('login')}}"> Please login to post comments!</a>
                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
        @endsection
