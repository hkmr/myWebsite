@extends('main')

@section('title','All Stories')


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
                        <div><span>{{$post->created_at->diffForHumans()}}</span></div>
                        <div class="uk-align-right">
                            <span class="uk-badge uk-text-center uk-align-right"><a class="uk-link-reset" href="{{'/categories/'.$post->category->name }}">{{$post->category->name}}</a></span>
                        </div>
                    </div>
                </div>
                <p>{{ substr(strip_tags($post->body),0,250)}} {{ strlen(strip_tags($post->body)) >250 ? "..." : "" }} <a class="uk-link-reset" href="{{ route('posts.show',$post->id) }}"> read more.</a></p>
                <div class="uk-card-footer ">
                    <div class="uk-child-width-1-5" uk-grid>
                        <div>
                            <favorite :post= {{ $post->id }} :favorited= {{ $post->favorited() ? 'true' : 'false' }} :likes={{ $post->likes }} :user = {{ Auth::check() ? 'true' : 'false' }} >
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
                            <bookmark :post= {{ $post->id }} :bookmarked = {{ $post->bookmarked() ? 'true': 'false' }} :bookmarks ={{ $post->bookmarks }} :user = {{ Auth::check() ? 'true' : 'false' }} ></bookmark> 
                        </div>
                        <div>
                            <a class="uk-link-reset" uk-icon="icon: chevron-down"> More</a>
                            <div uk-dropdown="mode: click">
                                <ul class="uk-iconnav uk-padding-remove">
                                    <li>
                                        {!! Form::open([ 'route' =>['posts.destroy',$post->id] , 'method' => 'DELETE' ]) !!}

                                          <button type="submit" class="uk-icon-button" uk-icon="icon:trash" onclick="return confirm('Delete This story ?')" id="delete" title="Delete Story" onclick="confirm('Are Your Sure to DELETE This story')" ></button>

                                          {!! Form::close() !!}
                                    </li>
                                    <li>
                                        <a href="/posts/{{$post->id}}/edit" class="uk-link-reset" title="Edit this Story" >
                                          <span class="uk-icon-button" uk-icon="icon: file-edit"></span>
                                        </a>
                                    </li>
                                    <li>
                                        @if($post->status == 1)
                                        <a href="#" title="Make private">
                                            <span uk-icon="icon:lock" class="uk-icon-button"></span>
                                        </a>
                                        @else
                                        <a href="#" title="Make Public">
                                            <span uk-icon="icon:unlock" class="uk-icon-button"></span>
                                        </a>
                                        @endif
                                    </li>
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