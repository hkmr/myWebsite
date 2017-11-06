@extends('main')

@section('title' , 'All Stories')

@section('description', 'best story , twebox stories')

@section('content')

<div class="uk-padding-large uk-container">

<div class="uk-child-width-1-3@m uk-grid-large uk-grid-match uk-text-center uk-padding-small" uk-grid>
    
    @forelse($posts as $post)

    <div>
        <div class="uk-card uk-card-default">
          <div class="uk-card-header uk-padding-small">
              <h1 class="uk-card-title uk-text-uppercase"><a class="uk-link-reset" href="{{ route('blog.single', $post->slug) }}">{{ substr(strip_tags($post->title), 0, 30 ) }} {{ strlen(strip_tags($post->title)) > 30 ? '...' : '' }} </a> </h1>
              <span class="uk-badge uk-text-center uk-align-right"><a class="uk-link-reset" href="{{'category/'.$post->category->name }}">{{ $post->category->name }}</a></span>
              <div class="uk-grid-small uk-flex-middle" uk-grid>
                  <div>
                      <img class="uk-border-circle uk-icon uk-icon-image" icon-ratio="1.5" src="{{ strpos($post->user->avatar, "http",0) ===0 ? $post->user->avatar : '/images/user-profile/'.$post->user->avatar   }}">
                  </div>
                  <div class="uk-text-left">
                    <h3 class="uk-text-small uk-margin-remove-bottom"><a class="uk-link-reset" href="{{ '/profile/'. $post->user->username }}">{{ $post->user->name }}</a></h3>
                      <p class="uk-text-meta uk-margin-remove-top"><time>{{ $post->created_at->diffForHumans() }}</time></p>
                  </div>
              </div>
          </div>
          <div class="uk-card-body">
            @if($post->image !=null)
            <div class="uk-background-blend-darken uk-background-primary uk-background-cover uk-height-small uk-panel uk-flex uk-flex-center uk-flex-middle" style="background-image: url({{'/images/blog/'.$post->image}} " alt="{{$post->name}});">
            </div>
            @endif
              <p class="word-count">{{ substr(strip_tags($post->body), 0, 200) }} {{ strlen(strip_tags($post->body)) >200 ? '...' : '' }}<a href="{{ route('blog.single', $post->slug) }}">read more.</a></p>
          </div>
          <div class="uk-card-footer">
            <div class="uk-grid-small uk-child-width-1-4" uk-grid>
              <keep-alive>
                <favorite :post= {{ $post->id }} :favorited= {{ $post->favorited() ? 'true' : 'false' }}
                :likes={{ $post->likes }} :user = {{ Auth::check() ? 'true' : 'false' }} >
              </favorite>
              </keep-alive>
              <div class="uk-child-width-auto">
                <a class="uk-link-reset" href="{{ route('blog.single', $post->slug.'#comments') }}">
                    <span uk-icon="icon: comments" title="Comment"></span>
                  <span class="uk-text-meta uk-text-small"> {{ $post->comments()->count() }}</span> 
                </a>
              </div>
              <div class="uk-child-width-auto">
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
              <bookmark :post= {{ $post->id }} :bookmarked = {{ $post->bookmarked() ? 'true': 'false' }} :bookmarks ={{ $post->bookmarks }} :user = {{ Auth::check() ? 'true' : 'false' }}
              ></bookmark> 
            </div>
          </div>
        </div>
    </div>

    @empty

      <div class="uk-flex uk-flex-center">
        <p class="uk-text-lead">Sorry no Stories ...</p>
      </div>
      
    @endforelse

</div>
  
    <div class="uk-flex uk-flex-center">
        {{ $posts->links() }}
    </div>

</div>


@endsection