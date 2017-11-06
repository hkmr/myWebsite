
@extends('main')

@section('title' , 'Contact')

@section('description', 'contact tweBox')

@section('content')

    <div class="uk-section uk-padding-large">
        
      <div class="uk-flex uk-flex-center">
        <div class="uk-width-3-5@m">
          <h1 class="uk-text-lead">Mail us...</h1>
          <p class="uk-text-meta">For any queries please write us , or put your put in "mailtwebox@gmail.com"</p>

          <form action=" {{ url('contact') }} " method="POST">
              {{ csrf_field() }}
          <div class="uk-margin">
              <input type="email" id="email" name="email" class="uk-input" placeholder="example@example.com">
          </div>

          <div class="uk-margin">
              <input type="text" id="subject" name="subject" class="uk-input" placeholder="Subject">
          </div>

          <div class="uk-margin">
              <!-- <label name="message">Message :</label> -->
              <textarea placeholder="Write Your message here..." id="message" name="message" rows='5' class="uk-textarea" placeholder="Write your message here..."  ></textarea>
          </div>

              <input type="submit" name="submit" value="Send Message" class="uk-button uk-button-primary">
          </form>

          <hr class="uk-divider-icon">

        </div>  
      </div>    
        

    </div>

@endsection