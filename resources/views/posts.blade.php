 <!--This connects from the layout.blade.php-->
@extends('layout')

@section('content')
    <!--Now using php this loops through $posts which contains array of post files, and
    store it in $post variable. This then will be echo-->
    <?php foreach ($posts as $post): ?>
        <article>
            <h1><a href="/posts/<?php echo $post->slug;?>">
                    <?php echo $post -> title; ?>
                </a>
            </h1>
           <div><?php echo $post -> excerpt; ?></div>
        </article>
    <?php endforeach; ?>
@endsection
