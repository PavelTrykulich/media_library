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

        @foreach($videos as $video)
            <tr>
                <th scope="row">{{$video->id}}</th>
                <td>{{$video->type_file}}</td>
                <td>{{$video->title}}</td>
                <td>{{$video->description}}</td>
                <td>{{$video->short_description}}</td>
                <td>{{$video->size}}</td>

                <td>

                    <a href="{{Route('video.show',$video->id)}}" class="btn btn-info">Show</a>

                </td>

            </tr>
        @endforeach

        </tbody>
    </table>



@endsection