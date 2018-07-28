@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                {!! Form::open(['url' => 'films', 'files' => true]) !!}
                <div class="card-header">Add New Film</div>
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
                        {{ Form::text('name', null, ['class' => 'form-control']) }}
						
                    </div>
                    <div class="form-group">
                        {{ Form::label('slug', 'Slug:', ['class' => 'control-label']) }}
                        {{ Form::text('slug', null, ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('description', 'Description:', ['class' => 'control-label']) }}
                        {{ Form::textarea('description', null, ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('release_date', 'Release Date:', ['class' => 'control-label']) }}
                        {{ Form::date('release_date', null, ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('rating', 'Rating:', ['class' => 'control-label']) }}
                        {{ Form::select('rating', ['1' => '1','2' => '2','3' => '3','4'=> '4','5' => '5'], ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('ticket_price', 'Ticket Price:', ['class' => 'control-label']) }}
                        {{ Form::text('ticket_price', null, ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('country', 'Country:', ['class' => 'control-label']) }}
                        {{ Form::text('country', null, ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('poster', 'Poster:', ['class' => 'control-label']) }}
                        {{ Form::file('poster') }}
                    </div>
                     <div class="form-group">
                     {{ Form ::label ('genre','Genre:',['class' =>'control-label']) }}
                     {{ Form::text('genre' ,null, ['class' =>'form-control','id'=>'tags','data-role'=>'tagsinput']) }}  
                      <script type="text/javascript">
                          $('#tags').tagsinput()
					
                      </script>
                       
                </div>
                <div class="card-footer">
                    <div class="form-group">
                        {{ Form::hidden('created_at', NOW() ) }}
                        {{ Form::submit('Save',['class' => 'btn btn-primary']) }}
                    </div>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
