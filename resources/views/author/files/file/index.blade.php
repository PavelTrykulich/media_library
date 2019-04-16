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

        @foreach($files as $file)
            <tr>
                <th scope="row">{{$file->id}}</th>
                <td>{{$file->type_file}}</td>
                <td>{{$file->title}}</td>
                <td>{{$file->description}}</td>
                <td>{{$file->short_description}}</td>
                <td>{{$file->size}}</td>
                <td>
                    <a href="{{Route('file.show',$file->id)}}" class="btn btn-info">Show</a>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>





@endsection