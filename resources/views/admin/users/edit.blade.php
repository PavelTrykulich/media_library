@extends('admin.layouts.layout')

@section('content')
    <p class="h4 text-center my-3">Update user</p>
   <form action="{{Route('users.update',$user->id)}}" method="post" >
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

       <div class="form-group row mb-0">
           <div class="col-md-6 offset-md-4">
               <button type="submit" class="btn btn-primary">Update
               </button>
           </div>
       </div>
   </form>


@endsection