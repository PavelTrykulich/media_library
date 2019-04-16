@extends('admin.layouts.layout')

@section('content')
   <form action="{{Route('users.update',$user->id)}}" method="post" >
       @method('put')
       @csrf
       <div class="form-group">
           <h2>second_name</h2>
           <input type="text" class="form-control" name="second_name" value="{{$user->second_name}}">
           <br>
           <h2>first_name</h2>
           <input type="text" class="form-control" name="first_name" value="{{$user->first_name}}">
           <br>
           <h2>patronymic</h2>
           <input type="text" class="form-control" name="patronymic" value="{{$user->patronymic}}">
           <br>
           <h2>email</h2>
           <input type="email" class="form-control" name="email" value="{{$user->email}}">
           <br>
           <h2>path_to_photo</h2>
           <input type="text" class="form-control" name="path_to_photo" value="{{$user->path_to_photo}}">
           <br>
           <h2>description</h2>
           <input type="text" class="form-control" name="description" value="{{$user->description}}">
           <br>
           <h2>date_birth</h2>
           <input type="date" class="form-control" name="date_birth" value="{{$user->date_birth}}">
           <br>

           <button class="btn btn-success">Update</button>
       </div>
   </form>


@endsection