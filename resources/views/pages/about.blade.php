
@extends('main')

@section('title' , 'About')

@section('description', 'about tweBox')

@section('content')

    <div class="uk-flex uk-flex-center">
        <div class="uk-padding-large ">
        <h1 class="uk-heading-primary">About us</h1>
        <hr>
    </div>
    </div>

    <section id="services">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 text-center padding wow fadeIn" data-wow-duration="1000ms" data-wow-delay="300ms">
                    <div class="single-service">
                        <div class="wow scaleIn" data-wow-duration="500ms" data-wow-delay="300ms">
                            <!-- create icon-->
                            <img class="icon icons8-Create-New" width="100" height="100" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkCAYAAABw4pVUAAAEHUlEQVR4Xu3d/7XNQBAH8HkV0AElUAE6oAI6cFRACVSAClABKkAFqAAVcL7vZJ/cvN0kO9m5mcx+c87762XnJvPJ/kpu9l4IN1cZuHB1NDwYIYizi4AgBHGWAZvDuS8ij0XkoYjcHD7ik4i8F5FXcx/JGtIWBMl/JyIAKW0/ROSRiHzN7UCQdiDA+Cgid1aE/C0iD3IoBFmRvRW71GCkcKgpd0UEOFcbQVZke2EXDUYK+UxEXhJkO8I0wpuhE6+N/Hna37CG1KawvL8W5cSAIO1AEEmDQpCNBhhFYWhbGrrWoPwZzVMuD4s1pE4HGBjaoiMvDl0rasqHYfLIUVadw+XeY4xUHCgYumIIq+noMRfBDJ4glSA5DIR4KyJPZmLNNV/XRlhsstapaDFS9BzKt2G4ezIpJMgyyFaMHEoRgyDzIK0wxiiIiRuP12pG2omjrDzKVozbhY4+jc6Kl0IOBIKvRQRBo2+5TnkrBnKH5yDZu7lLCc2BfCfG1UOllL+l0VTaDxhp1DU3T6mqIX+XFAP836pmTIfAP2sv7lwNiQ5yLgzcFkHzn30yWLqo14BE7/hb9BnTmqHCKA17pzUkMogrjN5B3GH0DOISo1cQtxg9grjG6A3EPUZPIIfA6AXkMBg9gBwKIzrI4TAigxwSIyrIOTFwDwvPzJtt0W4unhsDzz+a3uuLBLIHRqmVUdeYKCB7YRAkc+mdEwMfb/p44ug15NwYBJlpjPfAIEgBZC8MgjjoM6aHwD5klJE9a0Y6DIIMmfCAwSbLGQZBCm8uITGar3emZkf9vane5yFemqlxx95tH+IRo9smyytGlyCeMboD8Y7RFcgRMLoBOQpGFyBHwugC5Nd0AZYdJ31rHr2GnoegdnyZZGGvGfgajPA1BF+jwTc3xhsWc1l6L2/8tmuL2yFrMcKDYL3Bp5NsLL1OvCdGeBAsTXQvc3mWUPbGCA8y9wr2FMUDRmgQLN2BVSPmtoSCZq3Zq8c1HUZm37CjLKwHgrULNduW5xmazxuXCQvyQkSeK7KzJ0boJqvUoc8Z7Y0RGiQ3Q/eOERZkqUNHTcDkcPqnaOGaFwnZh4w79JR8NGEJILfsavPMKgOGBMGyRVjuDgCek58zCwmivDhdFCOIC4b/B0EQgpxmoOlLjc6Sqzkc1hBN1gzLEMQwuZrQBNFkzbAMQQyTqwlNEE3WDMsQxDC5mtAE0WTNsAxBDJOrCU0QTdYMyxDEMLma0ATRZM2wDEEMk6sJTRBN1gzLEMQwuZrQBNFkzbAMQQyTqwlNEE3WDMvsDmJ4biFCN32iumbNxRBZMzwJcxC8AnDD8AQiha7+ncKlky/99CqWz761VLjz/wMD76yc/ED91pw0rW5bD4blG69bzoRuzwBryPYcNo1AkKbp3B7sH3ffuHQkWuV+AAAAAElFTkSuQmCC">
                        </div>
                        <h2>creating is the essence of life</h2>
                        <p>Create your ideas and something about yourself is cool . </p>
                    </div>
                </div>
                <div class="col-sm-4 text-center padding wow fadeIn" data-wow-duration="1000ms" data-wow-delay="600ms">
                    <div class="single-service">
                        <div class="wow scaleIn" data-wow-duration="500ms" data-wow-delay="600ms">
                            <!-- read icon -->
                            <img class="icon icons8-Reading" width="100" height="100" src="data:image/png;base64,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">
                        </div>
                        <h2>Reading for awareness</h2>
                        <p>Welcome to twebox, a place where everyone has a story to share and the best ones are delivered right to you.</p>
                    </div>
                </div>
                <div class="col-sm-4 text-center padding wow fadeIn" data-wow-duration="1000ms" data-wow-delay="900ms">
                    <div class="single-service">
                        <div class="wow scaleIn" data-wow-duration="500ms" data-wow-delay="900ms">
                            <!-- share icon -->
                            <img class="icon icons8-Share" width="100" height="100" src="data:image/png;base64,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">
                        </div>
                        <h2>Share for care</h2>
                        <p>Share twebox with your friends and family , to let them help in reading more and sharing their ideas.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/#services-->

@endsection
