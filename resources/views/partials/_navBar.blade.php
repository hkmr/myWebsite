
  <div style="box-shadow: 0px 1px 5px #888888;" uk-sticky="sel-target: .uk-navbar-container; cls-active: uk-navbar-sticky; bottom: #transparent-sticky-navbar">
      <div class="uk-navbar uk-section uk-section-default" uk-grid>

        <div class=" uk-width-1-4 uk-flex uk-flex-left">
          <span class="uk-margin-small-left uk-padding-small uk-text-large" style="font-family: 'Josefin Sans', cursive; font-size:30px;"><a href="/" class="uk-link-reset uk-logo">Twebox</a></span>
        </div>

        <div class="uk-width-3-4 uk-flex uk-flex-right">
          <ul class="uk-subnav uk-subnav-pill uk-margin-medium-right uk-padding-small" uk-margin>
              
              <li><a href="#modal-full" title="Search" uk-toggle><span uk-icon="icon:search;ratio:1.3"></span></a></li>
              <!-- search full screen  -->
                <div id="modal-full" class="uk-modal-full uk-modal" uk-modal>
                    <div class="uk-modal-dialog uk-flex uk-flex-center uk-flex-middle" uk-height-viewport>
                        <button class="uk-modal-close-full" type="button" uk-close></button>

                        {!! Form::open(['url' =>'search', 'method' => 'POST', 'class' => 'uk-search uk-search-large']) !!}

                            {{ Form::search('keywords', null , ['class' => 'uk-search-input uk-text-center uk-inline' , 'placeholder' => 'Search...', 'autofocus' => 'autofocus']) }}

                            {{ Form::submit('Submit', ['style' =>'display:none']) }}

                        {!! Form::close() !!}
                    </div>
                </div>

              @if(!$agent->isMobile() || $agent->isTablet())
              <li><a href="{{ route('posts.create') }}" title="Write New Story"><span uk-icon="icon:pencil;ratio:1.3"></span></a></li>
              @endif
              
              @if(Auth::check())

              <notification :notification="{{ auth()->user()->notifications }}" :userid="{{auth()->id()}}"></notification>

              <li>
                  <a title="{{Auth::user()->name}}"><img src="{{ strpos(Auth::user()->avatar, "http",0) ===0 ? Auth::user()->avatar : '/images/user-profile/'.Auth::user()->avatar }}" class="ui avatar image" style="width:32px; height:32px;"></img > </a>
                  <div uk-dropdown="mode: click; pos: top-right;">
                      <ul class="uk-nav uk-dropdown-nav">
                          <li class="uk-nav-header">{{ Auth::user()->name }}</li>
                          <li class="uk-nav-divider"></li>
                          <li class="uk-margin-small"><a href="{{ route('profile.show', ['id' => Auth::user()->username]) }}" title="Your Profile"><span uk-icon="icon:user"></span> Profile</a></li>
                          <li class="uk-margin-small"><a href="{{ route('posts.create') }}" title="Write New Story"><span uk-icon="icon:pencil;"></span> Write Story</a></li>
                          <li class="uk-margin-small"><a href="{{ route('posts.index') }}" title="Stories written by you"><span uk-icon="icon:list"></span> My Stories</a></li>
                          <li class="uk-margin-small"><a href="{{ url('my_bookmarked') }}" title="All Bookmarked Stories"><span uk-icon="icon:bookmark"></span> Bookmarks</a></li>
                          <li class="uk-margin-small"><a href="{{ url('my_favorites') }}" title="Stories You likes"><span uk-icon="icon:heart"></span> Likes</a></li>
                          <li class="uk-margin-small"><a href="{{ url('followed') }}" title="Categories Followed"><span uk-icon="icon:thumbnails"></span> Interest</a></li>
                          <li class="uk-margin-small"><a href="{{url('setting')}}" title="User Setting"><span uk-icon="icon:settings"></span> Setting</a></li>
                          <li class="uk-nav-divider"></li>
                          <li class="uk-margin-small"><a href="{{route('logout')}}"><span uk-icon="icon:sign-out"></span> Logout</a></li>
                      </ul>
                  </div>
              </li>
              @else
              <li>
                <a class="uk-text-large" href="{{ route('login') }}"><span uk-icon="icon:sign-in"></span>Login</a>
              </li>
              @endif
          </ul>
        </div>

      </div>
    </div>

    {{-- Feedback section --}}
  <div id="mySidenav" class="sidenav">
    <a uk-icon="icon: question; ratio:1.7" title="Feedback" id="myBtn" uk-tooltip></a>
  </div>

  <!-- The Modal -->
<div id="feedback-modal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h1>Submit your suggestion</h1>
    </div>
    <div class="modal-body">
      {!! Form::open([ 'route' => 'feedback.store', 'method' => 'POST' ]) !!}
          <div class="form-group">
          {{ Form::text('username', null, ['class' => 'form-control', 'required'=>'required','placeholder'=>'user name *']) }}<br>
          </div>
          <div class="form-group">
          {{ Form::text('email', null, ['class' => 'form-control', 'required'=>'required','placeholder'=>'email address *']) }}<br>
          </div>
          <div class="form-group">
          {{ Form::textarea('message', null, ['class' => 'form-control', 'required'=>'required','placeholder'=>'your suggestion here... *']) }}<br>
          </div>
          <div class="form-group">
          {{ Form::submit('Submit', ['class' => 'btn btn-submit']) }}
          </div>

        {!! Form::close() !!}
    </div>
  </div>

</div>
