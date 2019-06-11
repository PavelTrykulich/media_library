@extends('admin.layouts.layout')

@section('content')
    <h3 class="text-center">Audio`s genre</h3>
    <a href="{{Route('genre_audios.create')}}" class="btn btn-success my-2">Create</a>

    <table class="table">
        <thead class="thead-dark text-center">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Operations</th>

        </tr>
        </thead>
        <tbody class="text-center">

        @foreach($genres as $genre)
            <tr>
                <th scope="row">{{$genre->id}}</th>
                <td>{{$genre->title}}</td>
                <td>
                    <a href="{{Route('genre_audios.edit',$genre->id)}}" class="btn btn-warning">Update</a>

                    <form action="{{Route('genre_audios.destroy',$genre->id)}}"  method="post" class="btn" >
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