@extends('layouts.app')
@section('title')
index
@endsection
@section('content')
<dev class="container mt-5">
    <dev>
        <center>
            <a href="{{route('posts.create')}}" class="btn btn-success mb-5">Create Post</a>
        </center>
    </dev>

    <!-- table -->
    <table class="table mx-5">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Posted By</th>
                <th scope="col">Created At</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
            <tr>
                <th scope="row"> {{ $post -> id }} </th>
                <td> {{ $post -> title }} </td>
                <td> {{$post->user ? $post->user->name: "NOT Found"}} </td>
                <!-- <td> {{ $post -> created_at }} </td> -->
                <td> {{ $post -> created_at->format('Y-m-d') }} </td>
                <!-- <td> {{ $post -> created_at->addDays(35)->format('Y-m-d') }} </td> -->
                <td>
                    <a class="btn btn-info" href="{{route('posts.show',$post -> id)}}" role="button">View</a>
                    <a class="btn btn-primary" href="{{route('posts.edit',$post -> id)}}" role="button">Edit</a>
                    <form method="POST" action="{{route('posts.destroy', $post -> id)}}" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" role="button">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <!-- End Table -->

</dev>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
@endsection