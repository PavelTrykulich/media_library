@extends('layouts.app')


@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card my-5">
                    <div class="card-header bg-dark text-light">Update</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('author.update',$user->id) }}" enctype="multipart/form-data">
                            @method('put')
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">First name</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="first_name" value="{{ $user->first_name }}" required autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Second name</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="second_name" value="{{ $user->second_name }}" required autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Patronymic</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="patronymic" value="{{ $user->patronymic }}" required autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Description</label>
                                <div class="col-md-6">
                                    <textarea id="name" type="text" class="form-control" name="description"  autofocus>{{ $user->description }}</textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="example-date-input" class="col-md-4 col-form-label text-md-right">Date birth</label>
                                <div class="col-md-6">
                                    <input class="form-control" type="date" name="date_birth" value="{{ $user->date_birth }}" id="example-date-input">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label  class="col-md-4 col-form-label text-md-right">Avatar</label>
                                <input type="file" class="form-control-file col-md-6" id="exampleInputFile" aria-describedby="fileHelp" name="avatar" value="{{$user->avatar}}">
                            </div>



                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">Update
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection