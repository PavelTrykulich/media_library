@extends('admin.layouts.layout')

@section('content')

    <a href="{{Route('format_videos.create')}}" class="btn btn-success">Create</a>

    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Operations</th>

        </tr>
        </thead>
        <tbody>

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