<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class Post
{
    //The $slug is the file in the link in a href = "" in posts.blade.php
    //It returns post content

    public $title;
    public $excerpt;
    public $date;
    public $body;
    public $slug;

    public function __construct($title, $excerpt, $date, $body, $slug)
    {
        $this->title = $title;
        $this->excerpt = $excerpt;
        $this->date = $date;
        $this->body = $body;
        $this->slug = $slug;
    }


    public static function find($slug)
    {
        // $path = resource_path("posts/{$slug}.html");
        
        // //checks if the file path exist, return home if not
        // if(! file_exists($path)){

        //    throw new ModelNotFoundException(); 
        // }

        // //Use Cache class and its remember()
        // //posts.{slug} is a unique key
        // //5 is the second it is stored in the memory
        // //It then uses file_get_contents to retrieve the post from path.
        // return Cache::remember("posts.{$slug}", 5, fn () => file_get_contents($path));
        //The code above

        $post = static::all() -> firstWhere('slug', $slug);
        if(! $post){
            throw new ModelNotFoundException();
        }

        return $post;
    }

    public static function all()
    {
        // $files = File::files(resource_path("posts/"));

        //  return array_map(function($file){
        //     return $file -> getContents();
        //  }, $files);
         
        //return array_map(function($file){
            
        //     $document = YamlFrontMatter::parseFile($file);
        //     return new Post(
        //         $document->title,
        //         $document->excerpt,
        //         $document->date,
        //         $document->body(),
        //         $document->slug
        //     );
        // }, $files);

        
        // $posts = collect($files) 
        // -> map(function ($file){
        //     $document = YamlFrontMatter::parseFile($file);
        // })
        // ->map(function ($document){
        
        //     return new Post(
        //         $document->title,
        //         $document->excerpt,
        //         $document->date,
        //         $document->body(),
        //         $document->slug
        //     );
        // });
        
        return cache() -> rememberForever('posts.all', function(){

            return collect(File::files(resource_path("posts/"))) 
            ->map(fn($file) => YamlFrontMatter::parseFile($file))
            ->map(fn($document) => new Post(
                    $document->title,
                    $document->excerpt,
                    $document->date,
                    $document->body(),
                    $document->slug
            ))-> sortByDesc('date');
        });


    }
}