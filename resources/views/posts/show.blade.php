@extends('layouts.app')
@section('title')
Show
@endsection

@section('content')

<div class="card mx-5 mt-5">
    <div class="card-header ">
        Post info
    </div>
    <div class="card-body">
        <h5 class="card-title">Title: {{$post->title}}</h5>
        <p class="card-text">Description: {{$post->description}}</p>
    </div>
</div>
<div class="card mx-5 mt-5">
    <div class="card-header ">
        Post Creator info
    </div>
    <div class="card-body">
        <h5 class="card-title">Name: {{$post->user ? $post->user->name: "NOT Found"}}</h5>
        <p class="card-text">E-mail: {{$post->user->email}}</p>
        <p class="card-text">Created at: {{$post->user->created_at}} </p>
    </div>
</div>

@endsection