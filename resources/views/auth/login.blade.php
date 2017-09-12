@extends('main')

@section('title', '| Login')

@section('content')

{{-- 
<section id="services">
        <div class="container">
            <div class="row">
                
            <div class="login-box">
                <div class="lb-header">
                  <a href="#" class="active" id="login-box-link">Login</a>
                  <a href="#" id="signup-box-link">Sign Up</a>
                </div>
                <p class="header-text">Login with</p>
                <div class="social-login">
                  <a href="/auth/facebook/" class="facebook">
                    <i class="fa fa-facebook-official fa-2x"></i>
                    <p>Facebook</p>
                  </a>
                  <a href="/auth/twitter/" class="twitter">
                    <i class="fa fa-twitter fa-2x"></i>
                    <p>Twitter</p>
                  </a>
                  <a href="/auth/google/" class="google">
                    <i class="fa fa-google-plus fa-lg"></i>
                    <p>Google</p>
                  </a>
                </div>
                 <div class="ui horizontal divider">
                    Or
                  </div>
                <!-- login form -->
                <form class="email-login form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}
                  <div class="u-form-group form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <input id="email" type="email"  placeholder="Email" name="email" value="{{ old('email') }}" required autofocus/>
                     @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                  </div>
                  <div class="u-form-group form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <input id="password" type="password"  name="password" placeholder="Password" required/>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                  </div>
                  <div class="checkbox u-form-group ">
                    <label>
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                    </label>
                  </div>
                  <div class="u-form-group">
                    <button type="submit">Log in</button>
                  </div>
                  <div class="u-form-group">
                    <a href="{{ route('password.request') }}" class="forgot-password">Forgot password?</a>
                  </div>
                </form>

                <!-- signup form -->
                <form class="email-signup" role="form" method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}
                  <div class="u-form-group form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <input id="name" type="text"  placeholder="Name" name="name" value="{{ old('name') }}" required/>

                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                  </div>

                  <div class="u-form-group form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <input id="email" type="email"  placeholder="Email" name="email" value="{{ old('email') }}" required/>

                     @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                  </div>

                  <div class="u-form-group form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <input id="password" type="password"  placeholder="Enter password" name="password" required/>

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                  </div>
                  <div class="u-form-group">
                    <input id="password-confirm" type="password" placeholder="Re-enter password" name="password_confirmation" required/>
                  </div>
                  <div class="u-form-group">
                    <button type="submit">Sign Up</button>
                  </div>
                </form>
              </div>

            </div>
        </div>
    </section> --}}

{{-- ####################################################################################################### --}}


  <div class="uk-padding-large">
    
    <div uk-grid>
      
      <div class="uk-width-1-4@m"></div>

      <div class="uk-width-3-5@m">
        
        <div class="uk-card uk-card-default uk-card-body uk-width-2-3@m ">
    
            <ul uk-tab>
                <li><a ><p class="uk-text-lead uk-margin-large-left">Login</p></a></li>
                <li><a ><p class="uk-text-lead uk-margin-large-left">SignUp</p></a></li>
            </ul>

            <ul class="uk-switcher uk-margin">
              {{-- SingIn Form --}}
                <li class="uk-align-center uk-margin-medium-left">

                  <div class="uk-margin uk-align-center">
                    <p class="uk-inline uk-text-large uk-text-meta uk-text-middle">Login with : </p>
                    <a href="/auth/twitter/" class="uk-icon-button uk-margin-small-right uk-margin-medium-left" uk-icon="icon: twitter" title="Twitter" uk-tooltip></a>
                    <a href="/auth/facebook/" class="uk-icon-button  uk-margin-small-right" uk-icon="icon: facebook" title="Facebook" uk-tooltip></a>
                    <a href="/auth/google/" class="uk-icon-button" uk-icon="icon: google-plus" title="Google" uk-tooltip></a>
                  </div>
                  <hr class="uk-divider-icon">
                  <form role="form" method="POST" action="{{ route('login') }}">
                      {{ csrf_field() }}

                      <div class="uk-margin {{ $errors->has('email') ? ' has-error' : '' }}">
                          <div class="uk-inline">
                              <span class="uk-form-icon" uk-icon="icon: user"></span>
                              <input id="email" class="uk-input" type="email" name="email" value="{{ old('email') }}" placeholder="Email Id" required autofocus>

                              @if ($errors->has('email'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('email') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      <div class="uk-margin {{ $errors->has('password') ? ' has-error' : '' }}">
                          <div class="uk-inline">
                              <span class="uk-form-icon" uk-icon="icon: lock"></span>
                              <input class="uk-input" id="password" type="password"  name="password" placeholder="Password" required>

                              @if ($errors->has('password'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('password') }}</strong>
                                  </span>
                              @endif
                          </div>

                          <div class="uk-margin">
                            <label>
                              <input class="uk-checkbox" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                          </label>
                          </div>

                      </div>

                      <div class="uk-margin">
                        <div class="uk-inline">
                          <input type="submit" name="submit" class="uk-button uk-button-primary" value="Login">
                        </div>
                      </div>

                  </form>
                  <div class="uk-margin">
                    <a href="{{ route('password.request') }}" class="uk-link-reset">Forgot password?</a>
                  </div>
                </li>

                {{-- Singup Form --}}
                <li class="uk-align-center uk-margin-medium-left">

                  <div class="uk-margin uk-align-center">
                    <p class="uk-inline uk-text-large uk-text-meta uk-text-middle">Signup with : </p>
                    <a href="/auth/twitter/" class="uk-icon-button uk-margin-small-right uk-margin-medium-left" uk-icon="icon: twitter" title="Twitter" uk-tooltip></a>
                    <a href="/auth/facebook/" class="uk-icon-button  uk-margin-small-right" uk-icon="icon: facebook" title="Facebook" uk-tooltip></a>
                    <a href="/auth/google/" class="uk-icon-button" uk-icon="icon: google-plus" title="Google" uk-tooltip></a>
                  </div>
                  <hr class="uk-divider-icon">
                  {{-- signup form --}}
                  <form role="form" method="POST" action="{{ route('register') }}">

                    {{ csrf_field() }}

                      <div class="uk-margin">
                          <div class="uk-inline {{ $errors->has('name') ? ' has-error' : '' }}">
                              <span class="uk-form-icon" uk-icon="icon: user"></span>
                              <input class="uk-input" id="name" type="text"  placeholder="User Name" name="name" value="{{ old('name') }}" required>

                               @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                          </div>
                      </div>

                      <div class="uk-margin">
                          <div class="uk-inline {{ $errors->has('email') ? ' has-error' : '' }}">
                              <span class="uk-form-icon" uk-icon="icon: mail"></span>
                              <input class="uk-input" id="email" type="email"  placeholder="Email Id" name="email" value="{{ old('email') }}" required>

                               @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                          </div>
                      </div>

                      <div class="uk-margin">
                          <div class="uk-inline {{ $errors->has('password') ? ' has-error' : '' }}">
                              <span class="uk-form-icon" uk-icon="icon: lock"></span>
                              <input class="uk-input" id="password" type="password"  placeholder="Create password" name="password" required >

                              @if ($errors->has('password'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('password') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>

                      <div class="uk-margin">
                          <div class="uk-inline">
                              <span class="uk-form-icon" uk-icon="icon: lock"></span>
                              <input class="uk-input" id="password-confirm" type="password" placeholder="Confirm password" name="password_confirmation" required>
                          </div>
                      </div>


                      <div class="uk-margin">
                        <div class="uk-inline">
                          <input type="submit" name="submit" class="uk-button uk-button-primary" value="Create Account">
                        </div>
                      </div>

                  </form>

                </li>
            </ul>
            
          </div>     

      </div>

    </div>

  </div>



@endsection
