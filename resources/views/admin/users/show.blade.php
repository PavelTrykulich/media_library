@extends('admin.layouts.layout')

@section('content')

<h1>{{$user->first_name}}</h1>
<h1>{{$user->second_name}}</h1>
<h1>{{$user->first_name}}</h1>
<h1>{{$user->patronymic}}</h1>
<h1>{{$user->email}}</h1>
<h1>{{$user->path_to_photo}}</h1>
<h1>{{$user->description}}</h1>
<h1>{{$user->date_birth}}</h1>

<img src='{{asset('avatars/' . $user->avatar)}}'>

<a href="{{Route('users.edit',$user->id)}}" class="btn btn-warning">Update</a>

<form action="{{Route('users.destroy',$user->id)}}"  method="post" class="btn" >
    @method('delete')
    @csrf
    <button class="btn btn-danger">Delete</button>
</form>
@endsection