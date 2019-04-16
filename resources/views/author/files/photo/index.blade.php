@extends('layouts.app')

@section('content')
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">type_file</th>
            <th scope="col">title</th>
            <th scope="col">description</th>

            <th scope="col">short_description</th>

            <th scope="col">size</th>

            <th scope="col"></th>

        </tr>
        </thead>
        <tbody>

        @foreach($photos as $photo)
            <tr>
                <th scope="row">{{$photo->id}}</th>
                <td>{{$photo->type_file}}</td>
                <td>{{$photo->title}}</td>
                <td>{{$photo->description}}</td>
                <td>{{$photo->short_description}}</td>
                <td>{{$photo->size}}</td>

                <td>

                    <a href="{{Route('photo.show',$photo->id)}}" class="btn btn-info">Show</a>

                </td>

            </tr>
        @endforeach

        </tbody>
    </table>



@endsection