@extends('main')

@section('title', $user->name.'\'s profile')


@section('content')

    <div class="uk-container">
        {{-- backgroud image --}}
        <div class="uk-background-cover uk-background-muted uk-height-medium uk-panel uk-flex uk-flex-center uk-flex-middle" style="background-image: url('/images/user-cover/{{ $user->coverImage }}');">
            {{-- user profile image --}}
                <div uk-lightbox>
                    <a href="{{ $user->avatar }}"><img  class="uk-position-bottom uk-border-circle uk-padding-small" style="z-index: 100;" width="150" height="150" src=
                      {{ strpos($user->avatar, "http",0) ===0 ? $user->avatar : '/images/user-profile/'.$user->avatar   }} ></a>
                </div>
                <div class="">
                <p class="uk-heading-primary uk-overlay-default"><a href="{{'/profile/'. $user->username}}" class="uk-link-reset"> {{ $user->name }} </a></p>
                </div>

                <ul class="uk-breadcrumb uk-position-bottom-right uk-text-meta uk-margin-small-right" style="color:#ffffff; z-index: 100;">
                    <li>{{ $posts->total() }} Stories</li>
                    <li>{{ $total_view }} Views</li>
                    <li>{{ $total_likes }} Likes</li>
                </ul>
                <p class="uk-position-bottom uk-overlay uk-overlay-primary">
                </p>
        </div>

        <div class="uk-margin-xlarge-right@m uk-margin-xlarge-left@m" uk-grid>
          <div class="uk-width-1-2@s">
            @if( $user->setting->show_social_links != null )

            <div class="uk-padding-small">
              <span class="uk-text-lead">Follow {{ $user->name }} : </span>
              @if($user->facebook != null)
              <a href="{{ $user->facebook }}" class="uk-icon-link uk-margin-small-right" uk-icon="icon: facebook ; ratio:1.3" title="Follow {{$user->name}} on facebook"></a>
              @endif
              @if($user->twitter != null)
              <a href="{{ $user->twitter }}" class="uk-icon-link uk-margin-small-right" uk-icon="icon: twitter; ratio:1.3" title="Follow {{$user->name}} on twitter"></a>
              @endif
              @if($user->google != null)
              <a href="{{ $user->google }}" class="uk-icon-link uk-margin-small-right" uk-icon="icon: google-plus; ratio:1.3" title="Follow {{$user->name}} on google-plus"></a>
              @endif
              @if($user->tumblr != null)
              <a href="{{ $user->tumblr }}" class="uk-icon-link uk-margin-small-right" uk-icon="icon: tumblr; ratio:1.3" title="Follow {{$user->name}} on tumblr"></a>
              @endif
              @if($user->youtube != null)
              <a href="{{ $user->youtube }}" class="uk-icon-link uk-margin-small-right" uk-icon="icon: youtube; ratio:1.3" title="Follow {{$user->name}} on youtube"></a>
              @endif
            </div>

            @endif

            <div class="uk-padding-small uk-padding-remove-top">
              @if($user->setting->show_email_id != null)
              <div class="uk-text-bold">Email : {{ $user->email }}</div>
              @endif
              <div class="uk-text-muted"> {!! $user->info !!} </div>
              {{-- <div class="uk-flex uk-flex-inline">
                <div class="uk-margin-small-right">Achievements : </div>
                @foreach( $badgeList as $badge )
                <div class="uk-icon uk-icon-image uk-margin-small-right" style="background-image: url({{'/images/badges/'.$badge}});" ></div>
                @endforeach
                
                <a href="#user-achievement" uk-toggle>See more..</a>
              </div> --}}
            </div>
            {{-- user Achievement modal --}}
            {{-- <div id="user-achievement" uk-modal>
                <div class="uk-modal-dialog uk-modal-body">
                    <button class="uk-modal-close-default" type="button" uk-close></button>

                    <h2 class="uk-modal-title">{{ $user->name }}'s Badges</h2>
                    <div class="uk-icon uk-icon-image uk-margin-small-right" style="background-image: url({{'/images/badges/badge.100.views.png'}});" ></div>
                    <div class="uk-icon uk-icon-image uk-margin-small-right" style="background-image: url({{'/images/badges/badge.turkey.png'}});" ></div>
                    <div class="uk-icon uk-icon-image uk-margin-small-right" style="background-image: url({{'/images/badges/badge.penguin.png'}});" ></div>
                    <div class="uk-icon uk-icon-image uk-margin-small-right" style="background-image: url({{'/images/badges/badge.flamingo.png'}});" ></div>
                    
                </div>
            </div> --}}

          </div>
        @if(Auth::id() == $user->id)
          <div class="uk-width-1-2@s">
            <div class="uk-flex uk-flex-right uk-padding-small">
              <a class="uk-button uk-button-default uk-button-small uk-margin-small-right" href="/profile/{{$user->username}}/edit"><span uk-icon="icon: pencil"></span> <span class="uk-text-small">Edit Profile</span></a>
              <a class="uk-button uk-button-default uk-button-small" href="/setting" ><span uk-icon="icon: settings"></span> Setting</a>
          </div>
          </div>
        @else
          <div class="uk-width-1-2@s">
            <div class="uk-flex uk-flex-right uk-padding-small">
              <a class="uk-button uk-button-secondary uk-button-small uk-margin-small-right" href="#"><span uk-icon="icon: user; ratio:0.7"></span> <span class="uk-text-small">Follow</span></a>
          </div>
          </div>
        @endif
        </div>

        <div class="uk-container uk-width-1-2@m uk-width-1-1 uk-padding-large">
            
                <div class="uk-text-lead uk-text-medium">Stories </div>

            @forelse($posts as $post)
                <hr>
                <div class="uk-card uk-card-default">
                  <div class="uk-card-header uk-padding-small">
                      <h1 class="uk-card-title uk-text-uppercase"><a class="uk-link-reset" href="{{ route('blog.single', $post->slug) }}" title="{{ $post->title }}">
                      {{ substr(strip_tags($post->title), 0 ,20) }} {{ strlen( strip_tags($post->title )) >30 ? '...' : '' }}</a> </h1>
                      <span class="uk-badge uk-text-center uk-align-right"><a class="uk-link-reset" href="{{'/categories/'.$post->category->name }}">{{$post->category->name}}</a></span>
                      <div class="uk-grid-small uk-flex-middle" uk-grid>
                          <div class="">
                              <img class="uk-border-circle uk-icon uk-icon-image" width="30" height="30" 
                              src="{{ strpos($post->user->avatar, "http",0) ===0 ? $post->user->avatar : '/images/user-profile/'.$post->user->avatar   }}">
                          </div>
                          <div class="uk-text-left">
                            <h3 class="uk-text-small uk-margin-remove-bottom"><a class="uk-link-reset" href="/profile/{{$post->user->username}}">{{$post->user->name}}</a></h3>
                              <p class="uk-text-meta uk-margin-remove-top"><time>{{$post->created_at->diffForHumans()}}</time></p>
                          </div>
                      </div>
                  </div>
                  <div class="uk-card-body">
                    @if($post->image !=null)
                    <div class="uk-background-blend-darken uk-background-primary uk-background-cover uk-height-small uk-panel uk-flex uk-flex-center uk-flex-middle" style="background-image: url( {{ $post->featured_image  }} );">
                    </div>
                    @endif
                      <p>{{ substr(strip_tags($post->body), 0 ,100) }} {{ strlen(strip_tags($post->body)) >250 ? '...' : '' }}<a href="{{ route('blog.single', $post->slug) }}">read more.</a></p>
                  </div>
                  <div class="uk-card-footer">
                    <div class="uk-grid-small uk-child-width-1-4" uk-grid>
                      <favorite :post= {{ $post->id }} :favorited= {{ $post->favorited() ? 'true' : 'false' }}
                        :likes={{ $post->likes }} :user = {{ Auth::check() ? 'true' : 'false' }} >
                      </favorite>

                      <div class="uk-child-width-auto">
                        <a href="{{ route('blog.single', $post->slug.'#comments') }}" uk-icon="icon: comments" title="Comment" uk-tooltip></a><span class="uk-text-meta uk-text-small"> {{ $post->comments()->count() }}</span> 
                      </div>

                      <div class="uk-child-width-auto">
                        <a uk-icon="icon: social" title="Share" uk-tooltip></a>
                        <div uk-dropdown="mode: click">
                            <ul class="uk-iconnav uk-padding-remove">
                                <li><a href="http://www.facebook.com/share.php?u={{route('blog.single', $post->slug)}}&title={{$post->slug}}" uk-icon="icon: facebook" title="Facebook" uk-tooltip></a></li>
                                <li><a href="http://twitter.com/home?status={{$post->slug}}+{{route('blog.single', $post->slug)}}" uk-icon="icon: twitter" title="Twiiter" uk-tooltip></a></li>
                                <li><a href="https://plus.google.com/share?url={{route('blog.single', $post->slug)}}" uk-icon="icon: google-plus" title="Google Plus" uk-tooltip></a></li>
                                <li><a href="#" uk-icon="icon: instagram" title="Instagram" uk-tooltip></a></li>
                            </ul>
                        </div>
                       </div>
                      <bookmark :post= {{ $post->id }} :bookmarked = {{ $post->bookmarked() ? 'true': 'false' }} :bookmarks ={{ $post->bookmarks }} :user = {{ Auth::check() ? 'true' : 'false' }}
                      ></bookmark>
                    </div>
                  </div>
                </div>

            @empty

                <p class="uk-text-large uk-padding-large">No Stories Yet...</p>

            @endforelse

            <div class="uk-flex uk-flex-center uk-margin">
              <div>{{$posts->links()}}</div>
            </div>
        </div>
    </div>


@endsection