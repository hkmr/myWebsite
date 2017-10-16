@extends('main')

@section('title','| All Posts')


@section('content')

    <div class="uk-padding-large">
        
    <div uk-grid>
        <div class="uk-width-1-6@m"></div>
        <div class="uk-width-3-5@m">
            <h1 class="uk-heading-divider">Stories Written by You</h1>
            <a class="uk-button uk-button-default" href="/posts/create">Write New Story</a>

            @foreach( $posts as $post )

            <h4 class="uk-heading-bullet uk-text-meta">{{ $post->created_at->diffForHumans() }}</h4>
            <div class="uk-card-default uk-card-body">
                <div class="uk-card-header">
                    <h3 class="uk-card-title"> <a class="uk-link-reset" href="{{ route('posts.show',$post->id) }}">
                        {{ $post->title }}
                    </a>
                    </h3>
                    <div class="uk-child-width-1-2" uk-margin>
                        <div><span>lorem</span></div>
                        <div class="uk-align-right"><span class="uk-badge">{{ $post->category->name }}</span></div>
                    </div>
                </div>
                <p>{{ substr(strip_tags($post->body),0,250)}} {{ strlen(strip_tags($post->body)) >250 ? "..." : "" }} <a class="uk-link-reset" href="{{ route('posts.show',$post->id) }}"> read more.</a></p>
                <div class="uk-card-footer ">
                    <div class="uk-child-width-1-5" uk-grid>
                        <div>
                            <favorite :post= {{ $post->id }} :favorited= {{ $post->favorited() ? 'true' : 'false' }} :likes={{ $post->likes }} >
                            </favorite>
                        </div>
                        <div><a href="{{ route('blog.single', $post->slug.'#comments') }}" uk-icon="icon: comments"></a> {{ $post->comments()->count() }} </div>
                        <div>
                            <a uk-icon="icon: social" title="Share" class="uk-link-reset" ></a>
                            <div uk-dropdown="mode: click">
                                <ul class="uk-iconnav uk-padding-remove">
                                    <li><a href="http://www.facebook.com/share.php?u={{route('blog.single', $post->slug)}}&title={{$post->slug}}" target="_blank" uk-icon="icon: facebook" title="Share this Story on Facebook"></a></li>
                                    <li><a href="http://twitter.com/home?status={{$post->slug}}+{{route('blog.single', $post->slug)}}" target="_blank" uk-icon="icon: twitter" title="Share this Story on Twiiter"></a></li>
                                    <li><a href="https://plus.google.com/share?url={{route('blog.single', $post->slug)}}" target="_blank" uk-icon="icon: google-plus" title="Share this Story on Google Plus"></a></li>
                                    <li><a href="#" target="_blank" uk-icon="icon: instagram" title="Share this Story on Instagram"></a></li>
                                </ul>
                            </div>
                        </div>
                        <div>
                            <bookmark :post= {{ $post->id }} :bookmarked = {{ $post->bookmarked() ? 'true': 'false' }} :bookmarks ={{ $post->bookmarks }} ></bookmark> 
                        </div>
                        <div>
                            <a class="uk-link-reset" uk-icon="icon: chevron-down"> More</a>
                            <div uk-dropdown="mode: click">
                                <ul class="uk-iconnav uk-padding-remove">
                                    <li><a href="" uk-icon="icon: trash" title="Delete this Story"></a></li>
                                    <li><a href="" uk-icon="icon: pencil" title="Edit this Story"></a></li>
                                    <li><a href="" uk-icon="icon: lock" title="Make private"></a></li>
                                </ul>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>

            @endforeach

        </div>
    </div>

    </div>



@endsection