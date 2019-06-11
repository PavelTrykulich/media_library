@extends('admin.layouts.layout')


@section('content')
    <table class="table">
        <thead class="thead-dark">
        <tr>

            <th scope="col">Text comment</th>
            <th scope="col">Author</th>
            <th scope="col">File</th>
            <th scope="col"></th>

        </tr>
        </thead>
        <tbody>

        @foreach($comments as $comment)
            <tr>

                <td>{{$comment->text_comment}}</td>
                <td><a href="{{Route('author.show',$comment->user_id)}}">{{$comment->user->getFullNameUser()}}</a></td>
                <td><a type="button" class="btn btn-sm btn-secondary" href="{{Route('files.show',$comment->file_id)}}">File</a></td>
                <td>
                    <a href="{{Route('comments.edit',$comment->id)}}" class="btn btn-warning">Update</a>

                    <form action="{{Route('comments.destroy',$comment->id)}}"  method="post" class="btn" >
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
