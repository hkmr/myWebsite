@extends('main')

<?php $titleTag = htmlspecialchars($post->title); ?>
@section('title', $post->title )

@section('og-url', route('blog.single', $post->slug) )

@section('og-title', $post->title )

@section('og-description', $post->category->name )

@section('og-image', asset('/images/blog/' . $post->image) )

@section('description', $post->title.','.$post->category->name)


@section('content')
    
    @if ($post->image != null)
      <div class="uk-cover-container">
          <canvas width="400" height="200"></canvas>
          <img uk-cover src="{{'/images/blog/'.$post->image}}" >
      </div>
    @endif
    <div class="uk-padding-large">
        <div uk-grid>
            <div class="uk-width-1-6@m"></div>
            <div class="uk-width-3-5@m">
                <p class="uk-text-lead">
                    <article class="uk-article">
                        <h1 class="uk-article-title">{{ $post->title}}</h1>
                        <p class="uk-article-meta"><span class="uk-icon uk-icon-image" style="background-image: url({{ strpos($post->user->avatar, "http",0) ===0 ? $post->user->avatar : '/images/user-profile/'.$post->user->avatar   }});"></span><a href="{{ route('profile.show',$post->user->username) }}"> {{$post->user->name}}</a> <br>Written on : {{ $post->created_at->format('d-m-y') }} | Views: {{ $post->views }}
                        <span class="uk-badge uk-text-center uk-align-right"><a class="uk-link-reset" href="/category/{{$post->category->name}}">{{$post->category->name}}</a></span></p>
                        <hr>
                        <div id="story-body">
                          {!! $post->body!!}
                        </div>

                        <div class="uk-cover-container" uk-lightbox>
                            <a href="/images/blog/1493449659.jpg" data-caption="Caption">
                              <canvas width="400" height="200"></canvas>
                              <img uk-cover src="/images/blog/1493449659.jpg" alt="">
                            </a>
                        </div>

                    </article>  
                </p>

                <div class="uk-flex-center" uk-grid>
                    <favorite :post= {{ $post->id }} :favorited= {{ $post->favorited() ? 'true' : 'false' }}
                      :likes={{ $post->likes }} :user = {{ Auth::check() ? 'true' : 'false' }} >
                    </favorite>
                    <div class="uk-child-width-auto">
                      <a href="{{ route('blog.single', $post->slug.'#comments') }}">
                          <span uk-icon="icon: comments" title="Comment" uk-tooltip></span>
                        <span class="uk-text-meta uk-text-small"> {{ $post->comments()->count() }}</span> 
                      </a>
                    </div>
                    <bookmark :post= {{ $post->id }} :bookmarked = {{ $post->bookmarked() ? 'true': 'false' }} :bookmarks ={{ $post->bookmarks }} :user = {{ Auth::check() ? 'true' : 'false' }}
                    ></bookmark> 
                    <div><a href="http://www.facebook.com/share.php?u={{route('blog.single', $post->slug)}}&title={{$post->slug}}" target="_blank" title="Share this story on Facebook" uk-icon="icon: facebook"></a></div>
                    <div><a href="http://twitter.com/share?text={{$post->title}}&url={{route('blog.single', $post->slug)}}" target="_blank" title="Share this story on Twiiter" uk-icon="icon: twitter"></a></div>
                    <div><a href="https://plus.google.com/share?url={{route('blog.single', $post->slug)}}" target="_blank" title="Share this story on Google-plus" uk-icon="icon: google-plus"></a></div>
                </div>

                <hr class="uk-divider-icon">
                {{-- comment section --}}
                <div class="ui comments">
                  <h3 class="ui dividing header">Comments</h3>
                  @if (Auth::check())

                    {{ Form::open(['route' => ['comments.store', $post->id ], 'method' => 'POST', 'class'=>'ui reply form']) }}
                    <div class="field">
                      {{ Form::textarea('comment',null, ['class' => 'form-control', 'rows' => '3', 'placeholder' => 'Write Your comment here..']) }}
                    </div>
                    {{ Form::submit('Comment', ['class' => 'uk-button uk-button-primary']) }}
                    {{ Form::close() }}

                  @else

                    {{ Form::open(['route' => ['comments.store', $post->id ], 'method' => 'POST']) }}

                    <div class="field uk-margin">
                      {{ Form::text('name', null, ['class' => 'uk-input', 'placeholder' => 'Name']) }}
                    </div>

                    <div class="field uk-margin">
                      {{ Form::text('email', null, ['class' => 'uk-input', 'placeholder' => 'Email']) }}
                    </div>

                    <div class="field uk-margin">
                      {{ Form::textarea('comment',null, ['class' => 'uk-textarea', 'rows' => '5', 'placeholder' => 'Write Comment']) }}
                    </div>

                    {{ Form::submit('Add Comment', ['class' => 'uk-button uk-button-primary']) }}

                    {{ Form::close() }}
                  @endif

                  <hr class="uk-divider-small">
                  @forelse($comments as $comment)

                    <div class="comment">
                    <a class="avatar">
                      @if($comment->user_id == null)
                      <img src="https://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?f=y&d=mm">
                      @else
                      <img src="{{ strpos($comment->user->avatar, "http",0) ===0 ? $comment->user->avatar : '/images/user-profile/'.$comment->user->avatar   }}">
                      @endif
                    </a>
                    <div class="content">
                      @if($comment->user_id == null)
                        <a class="author">{{ $comment->name }}</a>
                      @else
                      <a href="/profile/{{$comment->user->username}}" class="author">{{ $comment->user->name }}</a>
                      @endif
                      <div class="metadata">
                        <span class="date">{{$comment->created_at->diffForHumans()}}</span>
                      </div>
                      <div class="text">
                        {!! $comment->comment !!}
                      </div>
                    </div>
                  </div>

                  @empty
                    <div class="uk-text-lead">No One has Commented</div>
                  @endforelse

                </div>
            </div>
        </div>

        {{-- recommends section --}}
        <hr class="uk-divider-icon">
            <h1 class="uk-heading-divider uk-padding-remove-bottom">More Like This ...</h1>
            <div class="uk-child-width-1-5@m uk-grid-small uk-grid-match" uk-grid>
                
              @forelse($recommends as $recommend)
                <div>
                    <div class="uk-card uk-card-primary uk-card-body">
                        <h3 class="uk-card-title"><a class="uk-link-reset" href="{{ route('blog.single', $recommend->slug) }}">{{ substr(strip_tags($recommend->title), 0 ,15) }} {{ strlen( strip_tags($recommend->title )) >15 ? '...' : '' }}</a></h3>

                        <p>{{ substr(strip_tags($recommend->body), 0 ,100) }} {{ strlen(strip_tags($recommend->body)) >250 ? '...' : '' }} <a href="{{ route('blog.single', $recommend->slug) }}" class="uk-link-reset">Read More</a></p>

                        <div class="uk-child-width-1-4" uk-grid>
                            <favorite :post= {{ $recommend->id }} :favorited= {{ $recommend->favorited() ? 'true' : 'false' }}
                            :likes={{ $recommend->likes }} >
                            </favorite>
                            <div><a href="" uk-icon="icon: comments" title="Comment"></a> {{ $recommend->comments()->count() }}</div>
                            <div class="uk-child-width-auto">
                            <a uk-icon="icon: social" title="Share"></a>
                            <div uk-dropdown="mode: click" class="uk-dark uk-background-secondary">
                                <ul class="uk-iconnav uk-padding-remove">
                                    <li><a href="http://www.facebook.com/share.php?u={{route('blog.single', $recommend->slug)}}&title={{$recommend->slug}}" target="_blank" uk-icon="icon: facebook" title="Facebook" ></a></li>
                                    <li><a href="http://twitter.com/share?text={{$recommend->title}}&url={{$recommend->slug}}" target="_blank" uk-icon="icon: twitter" title="Twiiter" ></a></li>
                                    <li><a href="https://plus.google.com/share?url={{route('blog.single', $post->slug)}}" target="_blank" uk-icon="icon: google-plus" title="Google Plus" ></a></li>
                                    <li><a href="#" uk-icon="icon: instagram" title="Instagram" ></a></li>
                                </ul>
                            </div>
                           </div>
                            <bookmark :post= {{ $recommend->id }} :bookmarked = {{ $recommend->bookmarked() ? 'true': 'false' }} :bookmarks ={{ $recommend->bookmarks }}
                            ></bookmark> 
                        </div>
                    </div>
                </div>
              @empty
                <div class="uk-flex uk-flex-center">
                  <h2 class="uk-text-lead">Sorry no Stories available</h2>
                </div>
              @endforelse

                
            </div>
    </div>



@endsection