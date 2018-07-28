@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                {!! Form::open(['url' => 'films/'.$film->id, 'files' => true, 'method' => 'put']) !!}
                <div class="card-header">Edit: {{$film->name}}</div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="form-group">
                        {{ Form::label('name', 'Name:', ['class' => 'control-label']) }}
                        {{ Form::text('name',$film->name, ['class' => 'form-control']) }}
						
                    </div>
                    <div class="form-group">
                        {{ Form::label('slug', 'Slug:', ['class' => 'control-label']) }}
                        {{ Form::text('slug', $film->slug, ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('description', 'Description:', ['class' => 'control-label']) }}
                        {{ Form::textarea('description',$film->description, ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('release_date', 'Release Date:', ['class' => 'control-label']) }}
                        {{ Form::date('release_date', $film->release_date, ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('rating', 'Rating:', ['class' => 'control-label']) }}
                        {{ Form::select('rating', ['1' => '1','2' => '2','3' => '3','4'=> '4','5' => '5'],  $film->rating, ['class' => '']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('ticket_price', 'Ticket Price:', ['class' => 'control-label']) }}
                        {{ Form::text('ticket_price',$film->ticket_price, ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('country', 'Country:', ['class' => 'control-label']) }}
                        {{ Form::text('country', $film->country, ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('poster', 'Poster:', ['class' => 'control-label']) }}
                        {{ Form::file('poster')}}
			<br>
                        @if ($film->poster)
                        <img class="img-responsive form-img" src="<?php echo config("app.url")."storage/app/". $film->poster; ?>" />
                        @endif
                    </div>
                     <div class="form-group">
                     {{ Form ::label ('genre','Genre:',['class' =>'control-label']) }}
                     <br />
                     <input type="text" name="genre" value="{{$genre_string}}" data-role="tagsinput" class="form-control" id="tags"/>
                       
                </div>
                <div class="card-footer">
                    <div class="form-group">
                        {{ Form::hidden('updated_at', NOW() ) }}
                        {{ Form::hidden('id', $film->id) }}
                        {{ Form::submit('Save',['class' => 'btn btn-primary']) }}
                    </div>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
