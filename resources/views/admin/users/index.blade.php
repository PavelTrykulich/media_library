@extends('admin.layouts.layout')

@section('content')
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">second_name</th>
            <th scope="col">first_name</th>
            <th scope="col">patronymic</th>

            <th scope="col">email</th>
            <th scope="col">path_to_photo</th>
            <th scope="col">description</th>
            <th scope="col">date_birth</th>
            <th scope="col"></th>

        </tr>
        </thead>
        <tbody>

        @foreach($users as $user)
            <tr>
                <th scope="row">{{$user->id}}</th>
                <td>{{$user->second_name}}</td>
                <td>{{$user->first_name}}</td>
                <td>{{$user->patronymic}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->path_to_photo}}</td>
                <td>{{$user->description}}</td>
                <td>{{$user->date_birth}}</td>
                <td>

                    <a href="{{Route('users.show',$user->id)}}" class="btn btn-info">Show</a>

                </td>

            </tr>
        @endforeach

        </tbody>
    </table>



@endsection