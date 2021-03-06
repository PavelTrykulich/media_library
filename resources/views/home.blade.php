@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    You are logged in!
                </div>
                <a href="{{Route('files.create','audio')}}" class="btn btn-primary  btn-lg " role="button" >Create audio</a>
                <a href="{{Route('files.create','photo')}}" class="btn btn-warning btn-lg " role="button" >Create photo</a>
                <a href="{{Route('files.create','video')}}" class="btn btn-success btn-lg " role="button" >Create video</a>
            </div>
        </div>

    </div>
</div>




@endsection
