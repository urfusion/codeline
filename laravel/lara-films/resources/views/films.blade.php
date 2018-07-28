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

                    @foreach($films as $film)
                    <div class="film-list">
                        <h4>
                            <a href="{{url('films/'.$film->slug)}}">
                                @if ($film->poster)
                                <img src="<?php echo config("app.url") . "storage/app/" . $film->poster ?>" width="200"><br /><br />
                                @endif
                                {{$film->name}}
                            </a>
                        </h4>
                        <p><strong>Rating: </strong>{{$film->rating}}</p>
                    </div>
                    @endforeach

                    @if (!count($films))
                    No results found!
                    @endif

                    {{ $films->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
