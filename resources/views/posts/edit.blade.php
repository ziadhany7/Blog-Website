@extends('layouts.app')
@section('title') Create @endsection

@section('content')
<form method="POST" action="{{route('posts.update', $post -> id)}}">
    @csrf
    @method('PUT')
    <div class="card mx-5 mt-3">
        <div class="mx-5 mb-3 mt-3">
            <label class="form-label">Title</label>
            <input name="title" type="text" class="form-control" id="formGroupExampleInput" placeholder="Title" value="{{$post->title}}">
        </div>

        <div class="mx-5 mb-3">
            <label for="formGroupExampleInput2" class="form-label">Description</label>
            <!-- <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Another input placeholder"> -->
            <textarea name="description" class="form-control" rows="3" placeholder="Description"> {{ $post -> description }} </textarea>
        </div>

        <div class="mx-5 mb-3">
            <label for="formGroupExampleInput2" class="form-label">Post Creator</label>
            <select name="postCreator" class="form-select" aria-label="Default select example">
                @foreach ($users as $user)
                <!-- <option @if ($user->id==$post->user_id)selected @endif value="{{$user->id}}">{{$user->name}}</option> -->
                <option @selected($user->id ==$post->user_id) value="{{$user->id}}">{{$user->name}}</option>

                @endforeach

            </select>
        </div>


        <button type="submit" class="btn btn-primary mx-5  mb-3" style="height: 40px; width: 100px;">Edit</button>
        </dev>
</form>


@endsection