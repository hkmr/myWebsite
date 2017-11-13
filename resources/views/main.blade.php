<!-- 
  #########################
  WELCOME TO TWEBOX.COM 
  ########################
 -->
<!DOCTYPE html>
<html lang="en">

  <head>
    @include('partials._head')
  </head>

  <body>

      <div id="app">

        @include('partials._navBar')  
    
          @yield('content')
     
      </div>
      
        @include('partials._footer')
        

      @include('partials._javascript')

      @include('partials._messages')
    

  </body>


</html>