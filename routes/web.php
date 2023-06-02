<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', function () {
//     return view('posts');
// });

//This is a problem since there is no way to determine which among the post clickables 
//should show a specific post. That is why when My Second or Third Post was chosen it will always show the My First Post content

// Route::get('post', function () {
//     return view('post');
// });



// //It needs to dynamically get the post, by using wildcard /{}
// //The $slug is the file in the link in a href = "" in posts.blade.php
// //The problem now here is that posts should be a model. To avoid repetition. 
// Route::get('posts/{post}', function ($slug) {

//     //file path
//     $path = __DIR__."/../resources/posts/{$slug}.html";

//     //checks if the file path exist, return home if not
//     if(! file_exists($path)){

//         return redirect('/');
//     }

//     //Use Cache class and its remember()
//     //posts.{slug} is a unique key
//     //5 is the second it is stored in the memory
//     //It then uses file_get_contents to retrieve the post from path.
//     $post = Cache::remember("posts.{$slug}", 5, fn () => file_get_contents($path));

//     //it returns the view of post.blade.php relative to the $post that was loaded.
//     return view('post', ['post' => $post]); 
// });

//To fix that  we need to modify the code above, and use a Model class
//Now the route method is only used for routing with no extra codes can be seen.
Route::get('posts/{post}', function ($slug) {

    $post = Post::find($slug);

    return view('post', ['post' => $post]);
});

//This function is for displaying all the posts in home page.
Route::get('/', function () {


    //It retrieves all posts in Post model using all() method
    $posts = Post::all();

    //It returns a view for the posts.blade.php for each $posts.
    return view('posts', ['posts' => $posts]);
});