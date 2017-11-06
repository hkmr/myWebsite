@extends('main')

@section('title' ,$post->title)

@section('description', $post->title)

@section('content')


  <div class="uk-cover-container uk-margin-large-top">
      @if($post->image != null )
        <canvas width="400" height="200"></canvas>
        <img uk-cover src="/images/blog/{{$post->image}}" alt="" >
      @endif
  </div>
    <div class="uk-padding-large">
        <div uk-grid>
            <div class="uk-width-1-6@m"></div>
            <div class="uk-width-3-5@m">

                @if( $agent->isMobile() || $agent->isTablet() )
                <div class="uk-flex uk-flex-center">
                    <div uk-grid>
                          <div>
                            <a href="/posts/{{$post->id}}/edit" class="uk-icon-button" uk-icon="icon: file-edit" title="Edit this Story" ></a>
                          </div>
                          <div>
                              {!! Form::open([ 'route' =>['posts.destroy',$post->id] , 'method' => 'DELETE' ]) !!}

                              <button type="submit" class="uk-icon-button" uk-icon="icon:trash" onclick="return confirm('Delete This story ?')" id="delete" title="Delete Story" ></button>

                              {!! Form::close() !!}
                          </div>
                          <div>
                              <a href="/posts" uk-icon="icon:list" class="uk-icon-button" title="All Stories"></a>
                          </div>
                    </div>
                </div>

                @endif

                <p class="uk-text-lead">
                    <article class="uk-article">
                        <h1 class="uk-article-title"> <a class="uk-link-reset" href="{{ route('blog.single', $post->slug) }}"> {{ $post->title }} </a></h1>
                        <p class="uk-article-meta"><span class="uk-icon uk-icon-image" style="background-image: url(/images/user-profile/{{ $post->user->avatar }});"></span><a href="{{ '/profile/'. $post->user_id }}"> {{ $post->user->name }}</a> . {{ $post->created_at->diffForHumans() }}.
                        <span class="uk-badge uk-text-center uk-align-right"><a class="uk-link-reset" href="/categories/{{$post->category->name}}">{{ $post->category->name }}</a></span></p>

                        <div>
                          {!! $post->body !!}
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
                    <bookmark :post= {{ $post->id }} :bookmarked = {{ $post->bookmarked() ? 'true': 'false' }} :bookmarks ={{ $post->bookmarks }}
                     :user = {{ Auth::check() ? 'true' : 'false' }} ></bookmark> 
                    <div><a href="http://www.facebook.com/share.php?u={{route('blog.single', $post->slug)}}&title={{$post->slug}}" target="_blank" title="Share this story on Facebook" uk-icon="icon: facebook"></a></div>
                    <div><a href="http://twitter.com/home?status={{$post->slug}}+https://laravel.com/docs/5.5/collections#method-push" target="_blank" title="Share this story on Twiiter" uk-icon="icon: twitter"></a></div>
                    <div><a href="https://plus.google.com/share?url={{route('blog.single', $post->slug)}}" target="_blank" title="Share this story on Google-plus" uk-icon="icon: google-plus"></a></div>
                </div>

                <hr class="uk-divider-icon">
                {{-- comment section --}}
                <div class="ui comments">
                  <h3 class="ui dividing header">Comments</h3>
                  @if (Auth::check())

                    {{ Form::open(['route' => ['comments.store', $post->id ], 'method' => 'POST', 'class'=>'ui reply form']) }}
                    <div class="field">
                      {{ Form::textarea('comment',null, ['class' => 'form-control', 'rows' => '3', 'placeholder' => 'Enter Your comment here..']) }}
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
                      <img src="{{$comment->user->avatar}}">
                    </a>
                    <div class="content">
                      <a href="/profile/{{$comment->user->id}}" class="author">{{ $comment->user->name }}</a>
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

            @if( !$agent->isMobile() && !$agent->isTablet() )
            <div class="uk-margin">
                <ul class="uk-iconnav uk-iconnav-vertical ">
                    <li><a href="/posts/{{$post->id}}/edit" class="uk-icon-button" uk-icon="icon: file-edit" title="Edit this Story" ></a></li>
                    <li>
                      {!! Form::open([ 'route' =>['posts.destroy',$post->id] , 'method' => 'DELETE' ]) !!}

                      <button type="submit" class="uk-icon-button" uk-icon="icon:trash" onclick="return confirm('Delete This story ?')" id="delete" title="Delete Story" ></button>

                      {!! Form::close() !!}

                    </li>
                    <li><a href="/posts" uk-icon="icon:list" class="uk-icon-button" title="All Stories"></a></li>
                </ul>
            </div>
            @endif
        </div>

        {{-- recommends section --}}
        <hr class="uk-divider-icon">
            <h1 class="uk-heading-divider uk-padding-remove-bottom">More Like This ...<span class="uk-text-small uk-align-right "><a href="#"> Show more...</a></span></h1>
            <div class="uk-child-width-1-5@m uk-grid-small uk-grid-match" uk-grid>
                <div>
                    <div class="uk-card uk-card-primary uk-card-body">
                        <h3 class="uk-card-title">Title</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit... <a href="#" class="uk-link-reset">Read More</a></p>
                        <div class="uk-child-width-1-4" uk-grid>
                            <div><a href="" uk-icon="icon: heart" title="Like" uk-tooltip></a></div>
                            <div><a href="" uk-icon="icon: comments" title="Comment" uk-tooltip></a></div>
                            <div><a href="" uk-icon="icon: social" title="Share" uk-tooltip></a></div>
                            <div><a href="" uk-icon="icon: bookmark" title="Bookmark" uk-tooltip></a></div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="uk-card uk-card-primary uk-card-body">
                        <h3 class="uk-card-title">Title</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                        <div class="uk-child-width-1-4" uk-grid>
                            <div><a href="" uk-icon="icon: heart" title="Like" uk-tooltip></a></div>
                            <div><a href="" uk-icon="icon: comments" title="Comment" uk-tooltip></a></div>
                            <div><a href="" uk-icon="icon: social" title="Share" uk-tooltip></a></div>
                            <div><a href="" uk-icon="icon: bookmark" title="Bookmark" uk-tooltip></a></div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="uk-card uk-card-primary uk-card-body">
                        <h3 class="uk-card-title">Title</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                        <div class="uk-child-width-1-4" uk-grid>
                            <div><a href="" uk-icon="icon: heart" title="Like" uk-tooltip></a></div>
                            <div><a href="" uk-icon="icon: comments" title="Comment" uk-tooltip></a></div>
                            <div><a href="" uk-icon="icon: social" title="Share" uk-tooltip></a></div>
                            <div><a href="" uk-icon="icon: bookmark" title="Bookmark" uk-tooltip></a></div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="uk-card uk-card-primary uk-card-body">
                        <h3 class="uk-card-title">Title</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                        <div class="uk-child-width-1-4" uk-grid>
                            <div><a href="" uk-icon="icon: heart" title="Like" uk-tooltip></a></div>
                            <div><a href="" uk-icon="icon: comments" title="Comment" uk-tooltip></a></div>
                            <div><a href="" uk-icon="icon: social" title="Share" uk-tooltip></a></div>
                            <div><a href="" uk-icon="icon: bookmark" title="Bookmark" uk-tooltip></a></div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="uk-card uk-card-primary uk-card-body">
                        <h3 class="uk-card-title">Title</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                        <div class="uk-child-width-1-4" uk-grid>
                            <div><a href="" uk-icon="icon: heart" title="Like" uk-tooltip></a></div>
                            <div><a href="" uk-icon="icon: comments" title="Comment" uk-tooltip></a></div>
                            <div><a href="" uk-icon="icon: social" title="Share" uk-tooltip></a></div>
                            <div><a href="" uk-icon="icon: bookmark" title="Bookmark" uk-tooltip></a></div>
                        </div>
                    </div>
                </div>
            </div>
    </div>

@endsection