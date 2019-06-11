@extends('admin.layouts.layout')


@section('content')
    <div class="container">
        <h3>Update</h3>
        @include('admin.errors')
        <div class="row">
            <div class="col-md-12">
                <form action="{{Route('comments.update',$comment->id)}}" method="post" >
                    @method('put')
                    @csrf
                    <div class="form-group">
                        <label>Text comment</label>
                        <textarea type="text" class="form-control" name="text_comment">{{$comment->text_comment}}</textarea>
                        <button class="btn btn-success my-3">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection