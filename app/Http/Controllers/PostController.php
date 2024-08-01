<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPUnit\Event\Code\Test;
use App\Http\Controllers;
use App\Models\Post;
use App\Models\User;

class PostController extends Controller
{
    public function index()
    {
        $postsFromDB = Post::all();
        // $allPosts = [
        //     ['id' => '1', 'title' => 'PHP', 'posted_by' => 'Ziad', 'created_at' => '2024/20/4'],
        //     ['id' => '2', 'title' => 'HTML', 'posted_by' => 'Hany', 'created_at' => '2024/23/5'],
        //     ['id' => '3', 'title' => 'JS', 'posted_by' => 'Wadea', 'created_at' => '2024/15/8'],
        //     ['id' => '4', 'title' => 'CSS', 'posted_by' => 'Khalil', 'created_at' => '2024/28/4'],
        // ];
        return view('posts.index', ['posts' => $postsFromDB]);
    }
    public function show(Post $post)
    {
        // $singlePostFromDB = Post::find($postId);

        // way to hanedel id isn't in database
        // $singlePostFromDB = Post::findOrFail($postId);

        // way to hanedel id isn't in database
        // if(is_null($singlePostFromDB)){
        //     return to_route(route: 'posts.index');
        // }
        //local data without database
        // $singlePost = ['id' => '1', 'title' => 'PHP', 'description' => 'This is Description ', 'posted_by' => 'Ziad', 'created_at' => '2024/20/4'];
        return view('posts.show', ['post' => $post]);
    }

    public function create()
    {
        //selaect * from user
        $users = User::all();
        return view('posts.create', ['users' => $users]);
    }

    public function store()
    {
        //validation
        request()->validate([
            'title'=>['required','min:3'],
            'description'=>['required', 'min:5'],
            'post_creator'=>['exist:users,id']
        ]);
        //1- get user data
        //$data = $_POST; //in PHP
        $data = request()->all(); //Global helper method called request in laravel 
        $title = request()->title;
        $description = request()->description;
        $postCreator = request()->postCreator;

        //dd($title,$description,$postCreator, $data); //  Dump and Die.” It’s a helper function provided by Laravel
        //return $data;

        //2- store the user data in database

        //-- Frist way to store in DB 

        // $post = new Post;
        // $post->title = $title;
        // $post->description = $description;
        // $post->postCreator = $postCreator;
        // //INSERT INTO POSTS ("title":,"descripton":)
        // $post->save();

        //-- Second way to store in DB 
        Post::create(
            [
                'title' => $title,
                'description' => $description,
                'user_id' => $postCreator,
            ]
        );

        //3- redirection to posts.index
        return to_route(route: 'posts.index');
    }

    public function edit(Post $post)
    {
        $users = User::all();
        return view('posts.edit', ['users' => $users, 'post' => $post]);
    }
    public function update($postId)
    { 
        //1- get user data
        //$data = $_POST; //in PHP
        // $data = request()->all(); //Global helper method called request in laravel 
        $title = request()->title;
        $description = request()->description;
        $postCreator = request()->postCreator;
        // dd($title,$description,$postCreator); //  Dump and Die.” It’s a helper function provided by Laravel
        //return $data;

        //2- Update the user data in database
        //select post
        $singlePostFromDB = Post::find($postId);
        $singlePostFromDB -> update(
            [
                'title' => $title,
                'description' => $description,
                'user_id' => $postCreator,
            ]
        );
        //3- redirection to posts.show
        return to_route(route: 'posts.show', parameters: $postId);
    }
    public function destroy($postId)
    {
        $singlePostFromDB=Post::find($postId);
        $singlePostFromDB->delete();
        return to_route(route: 'posts.index');
    }
}
