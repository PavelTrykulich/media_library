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

        @foreach($audios as $audio)
            <tr>
                <th scope="row">{{$audio->id}}</th>
                <td>{{$audio->type_file}}</td>
                <td>{{$audio->title}}</td>
                <td>{{$audio->description}}</td>
                <td>{{$audio->short_description}}</td>
                <td>{{$audio->size}}</td>

                <td>

                    <a href="{{Route('audio.show',$audio->id)}}" class="btn btn-info">Show</a>

                </td>

            </tr>
        @endforeach

        </tbody>
    </table>



@endsection