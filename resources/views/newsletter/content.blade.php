<h1>Hey there!</h1>
<p>Here's what's new with Pest this week:</p>
<ul>
    @foreach($posts as $post)
        <li>
            <a href="{{ route('posts.show', $post->slug) }}">
                {{ $post->title }}
            </a>
        </li>
    @endforeach
</ul>
<p>Thanks for supporting Pest PHP. Keep testing!</p>
<span>Regards, The Pest Team</span>
