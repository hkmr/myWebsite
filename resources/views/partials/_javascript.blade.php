<script src="{{ asset('js/app.js') }}"></script>
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/js/semantic.min.js"></script>
<script type="text/javascript" src="/js/wow.min.js"></script>
<script type="text/javascript" src="/js/page-loader-min.js"></script> 
<script type="text/javascript" src="/js/notify.js"></script> 
<script type="text/javascript" src="/js/readingTime.js"></script> 

{{-- infinite scroll plugin --}}
{{-- <script type="text/javascript" src="/js/jquery.jscroll.js"></script>  --}}

{{-- dynamic typing plugin --}}
<script src="https://cdn.jsdelivr.net/jquery.typeit/4.4.0/typeit.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.30/js/uikit-icons.min.js"></script>


@yield('scripts')

<script type="text/javascript">

// Modal scripting
// Get the modal
var modal = document.getElementById('feedback-modal');
// Get the button that opens the modal
var btn = document.getElementById("myBtn");
// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];
// When the user clicks the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
}
// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}


// script for login page
$(".email-signup").hide();
$("#signup-box-link").click(function(){
  $(".email-login").fadeOut(100);
  $(".email-signup").delay(100).fadeIn(100);
  $("#login-box-link").removeClass("active");
  $("#signup-box-link").addClass("active");
});
$("#login-box-link").click(function(){
  $(".email-login").delay(100).fadeIn(100);;
  $(".email-signup").fadeOut(100);
  $("#login-box-link").addClass("active");
  $("#signup-box-link").removeClass("active");
});

/* ###########################################
 */

// reading time initialize
$('p').readingTime();

/* ###########################################
 */

// typing style jquery intialization
$('#type-it').typeIt({
  breakLines:false,
  loop:true,
});

</script>