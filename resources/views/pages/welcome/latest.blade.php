<div class="uk-container">
  {{-- Latest Stories Section --}}

<h1 class="uk-heading-divider uk-margin-top-small">Latest Stories <span class="uk-text-small"><a href="/blogs"> Show more...</a></span></h1>
<div class="uk-grid-large uk-text-center uk-grid-match uk-padding-large@s uk-child-width-1-3@m" uk-grid>
 
 @forelse ($posts as $post)
    
        <div>
         <div class="uk-card uk-card-default">
          <div class="uk-card-header uk-padding-small">
              <h1 class="uk-card-title uk-text-uppercase"><a class="uk-link-reset" href="{{ route('blog.single', $post->slug) }}" title="{{ $post->title }}"> {{ substr(strip_tags($post->title), 0 ,20) }} {{ strlen( strip_tags($post->title )) >30 ? '...' : '' }} </a> </h1>
              <span class="uk-badge uk-text-center uk-align-right"><a class="uk-link-reset" href="{{'/categories/'.$post->category->name }}">{{ $post->category->name }}</a></span>
              <div class="uk-grid-small uk-flex-middle" uk-grid>
                  <div class="">
                      <img class="uk-border-circle uk-icon uk-icon-image" width="30" height="30" src="{{ strpos($post->user->avatar, "http",0) ===0 ? $post->user->avatar : '/images/user-profile/'.$post->user->avatar   }} ">
                  </div>
                  <div class="uk-text-left">
                    <h3 class="uk-text-small uk-margin-remove-bottom"><a class="uk-link-reset" href="{{ '/profile/'. $post->user->username }}">{{ $post->user->name }}</a></h3>
                      <p class="uk-text-meta uk-margin-remove-top"><time>{{ $post->created_at->format('d.m.y') }}</time></p>
                  </div>
              </div>
          </div>
          <div class="uk-card-body">
            @if($post->image !=null)
            <div class=" uk-background-primary uk-background-cover uk-height-small uk-panel uk-flex uk-flex-center uk-flex-middle" style="background-image: url({{'/images/blog/'.$post->image}});">
            </div>
            @endif
              <p>{{ substr(strip_tags($post->body), 0 ,100) }} {{ strlen(strip_tags($post->body)) >250 ? '...' : '' }}<a href="{{ route('blog.single', $post->slug) }}">read more.</a></p>
          </div>
          <div class="uk-card-footer">
            <div class="uk-grid-small uk-child-width-1-4" uk-grid>
              @if(Auth::check())
                <favorite :post= {{ $post->id }} :favorited= {{ $post->favorited() ? 'true' : 'false' }}
                  :likes={{ $post->likes }} :user = {{ Auth::check() ? 'true' : 'false' }} >
                </favorite>
              @else
              <div class="uk-child-width-auto" >
                  <a class="uk-link-reset" href="{{ route('login') }}" >
                      <span uk-icon="icon: heart" title="Like"></span>
                      <span class="uk-text-meta uk-text-small"> {{$post->likes}} </span>
                  </a>
              </div>
              @endif
              
              <div class="uk-child-width-auto">
                <a href="{{ route('blog.single', $post->slug.'#comments') }}">
                    <span uk-icon="icon: comments" title="Comment"></span>
                  <span class="uk-text-meta uk-text-small"> {{ $post->comments()->count() }}</span> 
                </a>
              </div>
              <div class="uk-child-width-auto">
                <a uk-icon="icon: social" title="Share"></a>
                <div uk-dropdown="mode: click">
                    <ul class="uk-iconnav uk-padding-remove">
                        <li><a href="http://www.facebook.com/share.php?u={{route('blog.single', $post->slug)}}&title={{$post->slug}}" target="_blank" uk-icon="icon: facebook" title="Facebook"></a></li>
                        <li><a href="http://twitter.com/home?status={{$post->slug}}+{{route('blog.single', $post->slug)}}" target="_blank" uk-icon="icon: twitter" title="Twiiter"></a></li>
                        <li><a href="https://plus.google.com/share?url={{route('blog.single', $post->slug)}}" target="_blank" uk-icon="icon: google-plus" title="Google Plus"></a></li>
                        <li><a href="#" target="_blank" uk-icon="icon: instagram" title="Instagram"></a></li>
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
   <p class="uk-text-lead">Sorry no Stories...</p>
 </div>

 @endforelse
 
</div>
</div>

<hr class="uk-divider-icon">