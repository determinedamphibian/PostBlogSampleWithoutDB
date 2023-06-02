 <!--This connects from the layout.blade.php-->
@extends('layout')

@section('content')
    <article>
        <!-- This is a problem since you will need to manually create a view for each post-->
            
        <!-- 
            <h1><a href="/post">My First Post</a></h1>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Perferendis iure omnis fuga numquam saepe, reprehenderit facere facilis inventore magni nobis dolor deserunt, laborum, odit suscipit voluptatibus labore assumenda. Ab delectus esse officia debitis numquam suscipit ut mollitia iste expedita ipsam id incidunt quos dolorem perferendis, cumque optio harum aut iusto voluptatibus natus facere fugiat. Possimus assumenda quod quibusdam beatae aperiam, est asperiores inventore maiores eligendi cum porro dolore enim minima unde commodi provident similique velit voluptatibus optio! Optio at, fugit, distinctio dicta, rerum illo tempore odio suscipit iste laboriosam eligendi iure ullam. Natus fugit adipisci at voluptates ducimus nobis animi!</p>
        -->

        <!--To fix this you need to create a php variable to load dynamically a post content-->
        <!--This is loaded in web.php using get() route and a wildcard-->
        
        <h1><?php echo $post->title;?></h1>
        <div>
            <?php echo $post->body;?>
        </div>
    
    </article>

    <a href="/">Go back</a>
@endsection