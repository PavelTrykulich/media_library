@extends('admin.layouts.layout')

@section('content')
    <h3 class="text-center">Video`s formats</h3>
    <a href="{{Route('format_videos.create')}}" class="btn btn-success my-2">Create</a>

    <table class="table">
        <thead class="thead-dark text-center">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Operations</th>

        </tr>
        </thead>
        <tbody class="text-center">

        @foreach($formats as $format)
            <tr>
                <th scope="row">{{$format->id}}</th>
                <td>{{$format->title}}</td>
                <td>
                    <a href="{{Route('format_videos.edit',$format->id)}}" class="btn btn-warning">Update</a>

                    <form action="{{Route('format_videos.destroy',$format->id)}}"  method="post" class="btn" >
                        @method('delete')
                        @csrf
                        <button class="btn btn-danger">Delete</button>
                    </form>
                </td>

            </tr>
        @endforeach
        </tbody>
    </table>
@endsection