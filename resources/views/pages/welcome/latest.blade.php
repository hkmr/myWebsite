<div class="uk-container">
  {{-- Latest Stories Section --}}

<h1 class="uk-heading-divider uk-margin-top-small">Latest Stories <span class="uk-text-small"><a href="/blog"> Show more...</a></span></h1>
<div class="uk-grid-large uk-text-center uk-grid-match uk-padding-large@s uk-child-width-1-3@m" uk-grid>
 
 @foreach ($posts as $post)
    
        <div>
         <div class="uk-card uk-card-default">
          <div class="uk-card-header uk-padding-small">
              <h1 class="uk-card-title uk-text-uppercase"><a class="uk-link-reset" href="{{ route('blog.single', $post->slug) }}" title="{{ $post->title }}" uk-tooltip> {{ substr(strip_tags($post->title), 0 ,20) }} {{ strlen( strip_tags($post->title )) >30 ? '...' : '' }} </a> </h1>
              <span class="uk-badge uk-text-center uk-align-right"><a class="uk-link-reset" href="{{'/categories/'.$post->category->id }}">{{ $post->category->name }}</a></span>
              <div class="uk-grid-small uk-flex-middle" uk-grid>
                  <div class="">
                      <img class="uk-border-circle uk-icon uk-icon-image" width="30" height="30" src="../images/user-profile/1494097628.jpg">
                  </div>
                  <div class="uk-text-left">
                    <h3 class="uk-text-small uk-margin-remove-bottom"><a class="uk-link-reset" href="{{ '/profile/'. $post->user_id }}">{{ $post->user->name }}</a></h3>
                      <p class="uk-text-meta uk-margin-remove-top"><time>{{ $post->created_at->format('d.m.y') }}</time></p>
                  </div>
                  <div >
                      <p class="uk-text-right"><a uk-icon="icon: clock; ratio: 0.6"></a><span class="uk-text-meta uk-text-small"> 3min</span></p>
                  </div>
              </div>
          </div>
          <div class="uk-card-body">
            <div class=" uk-background-primary uk-background-cover uk-height-small uk-panel uk-flex uk-flex-center uk-flex-middle" style="background-image: url({{$post->featured_image}});">

            </div>
              <p>{{ substr(strip_tags($post->body), 0 ,100) }} {{ strlen(strip_tags($post->body)) >250 ? '...' : '' }}<a href="{{ route('blog.single', $post->slug) }}">read more.</a></p>
          </div>
          <div class="uk-card-footer">
            <div class="uk-grid-small uk-child-width-1-4" uk-grid>
              <favorite :post= {{ $post->id }} :favorited= {{ $post->favorited() ? 'true' : 'false' }}
                :likes={{ $post->likes }} >
              </favorite>
              <div class="uk-child-width-auto">
                <a href="{{ route('blog.single', $post->slug.'#comments') }}">
                    <span uk-icon="icon: comments" title="Comment" uk-tooltip></span>
                  <span class="uk-text-meta uk-text-small"> {{ $post->comments()->count() }}</span> 
                </a>
              </div>
              <div class="uk-child-width-auto">
                <a uk-icon="icon: social" title="Share" uk-tooltip></a>
                <div uk-dropdown="mode: click">
                    <ul class="uk-iconnav uk-padding-remove">
                        <li><a href="#" uk-icon="icon: facebook" title="Facebook" uk-tooltip></a></li>
                        <li><a href="#" uk-icon="icon: twitter" title="Twiiter" uk-tooltip></a></li>
                        <li><a href="#" uk-icon="icon: google-plus" title="Google Plus" uk-tooltip></a></li>
                        <li><a href="#" uk-icon="icon: instagram" title="Instagram" uk-tooltip></a></li>
                    </ul>
                </div>
               </div>
              <bookmark :post= {{ $post->id }} :bookmarked = {{ $post->bookmarked() ? 'true': 'false' }} :bookmarks ={{ $post->bookmarks }}
              ></bookmark> 
            </div>
          </div>
        </div>
     </div>

 @endforeach
 
</div>
</div>