@extends('admin.layouts.layout')

@section('content')

    <a href="{{Route('genre_photos.create')}}" class="btn btn-success">Create</a>

    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Operations</th>

        </tr>
        </thead>
        <tbody>

        @foreach($genres as $genre)
            <tr>
                <th scope="row">{{$genre->genre_photo_id}}</th>
                <td>{{$genre->title}}</td>
                <td>
                    <a href="{{Route('genre_photos.edit',$genre->genre_photo_id)}}" class="btn btn-warning">Update</a>

                    <form action="{{Route('genre_photos.destroy',$genre->genre_photo_id)}}"  method="post" class="btn" >
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