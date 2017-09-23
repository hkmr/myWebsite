<script src="{{ asset('js/app.js') }}"></script>
<script type="text/javascript" src="/js/jquery.js"></script>
<script type="text/javascript" src="/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/js/semantic.min.js"></script>
<script type="text/javascript" src="/js/wow.min.js"></script>
<script type="text/javascript" src="/js/page-loader-min.js"></script> 
<script type="text/javascript" src="/js/notify.js"></script> 
<script type="text/javascript" src="/js/readingTime.js"></script> 
{{-- navbar plugin --}}
<script type="text/javascript" src="/js/paradeiser.min.js"></script> 
{{-- <script type="text/javascript" src="/js/flowtype.js"></script>  --}}

{{-- infinite scroll plugin --}}
<script type="text/javascript" src="/js/jquery.jscroll.js"></script> 

{{-- dynamic typing plugin --}}
<script src="https://cdn.jsdelivr.net/jquery.typeit/4.4.0/typeit.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.30/js/uikit-icons.min.js"></script>

<!-- javascript plugin for responsive grid layout -->
    {{-- <script src="/js/masonry.pkgd.min.js"></script> --}}
    {{-- <script src="/js/imagesloaded.pkgd.min.js"></script> --}}


<script type="text/javascript">


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
$('article').readingTime();

/*
###############################################
*/

$('ul.pagination').hide();
    $(function() {
        $('.infinite-scroll').jscroll({
            autoTrigger: true,
            loadingHtml: '<center><div uk-spinner></div></center>',
            padding: 0,
            nextSelector: '.pagination li.active + li a',
            contentSelector: 'div.infinite-scroll',
            callback: function() {
                $('ul.pagination').remove();
            }
        });
    });

/* ###########################################
 */

// typing style jquery intialization
$('#type-it').typeIt({
  breakLines:false,
  loop:true,
});


/* ###########################################
 */
// enabling to open the overflow menu as the pure css link
        // would toggle a scroll and therefore hide the menu
        document.getElementById("paradeiser-dropdown").addEventListener("click", function(event){
            // stopping the scroll
            event.preventDefault();
            // toggling the class
            document.getElementById("paradeiser-more").classList.toggle("open");
        });
        // OPTIONAL: enables closing the overflow by clicking the grey background.
        // be sure to add the ID "greybox" to the last <li> within the .paradeiser_children
        document.getElementById("greybox").addEventListener("click", function(event){
            document.getElementById("paradeiser-more").classList.toggle("open");
        });

</script>

{{-- enabling headroom --}}

@if (Auth::check() )
          <script type="text/javascript">
            var myElement = document.querySelector(".paradeiser");
            var headroom  = new Headroom(myElement, {
                tolerance : 5,
                onUnpin : function() {
                    document.getElementById("paradeiser-more").classList.remove("open");
                }
            });
            headroom.init();
          </script>
@else

          <script type="text/javascript">
            var myElement = document.querySelector(".paradeiser");
            var headroom  = new Headroom(myElement, {
                tolerance : 5
            });
            headroom.init();
          </script>
 @endif