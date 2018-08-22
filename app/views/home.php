<?= $HTML_START ?>

	
 <!-- Start: Header Section
        ================================ -->
<section class="header-section-1 background-dark header-js" id="header" style="background-image: url(http://www.pietropaganini.it/web/wp-content/uploads/2017/01/geo-sports-banner-cropped-size21-1120x413.png); opacity: 0.6" >

	<?= isset($notice) ?
		'<div class="alert alert-success" role="alert">'
	  		 .$notice.
		'</div>' : ''
	?>
    
        <div class="container">
            <div class="row">

                <div style="margin-top: 40px;" class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">
                    <div class="part-inner text-center">

                        <!--  Header SubTitle Goes here -->
                        <h1 style="color: black" class="title"><strong>Don't have a SportBuddy yet?</strong></h1> 

                        <div class="detail">
                            <h2 style="color: black">We will help you to find one and stay fit!</h2>
                        </div>

                        <!-- Button Area -->
                        <div class="btn-form">
                            <a style="" href="/sportbuddy/login" id="homeButton" class="btn btn-border">Login</a>
                            <a style="" href="/sportbuddy/register" id="homeButton" class="btn btn-border">Register</a>
                        </div>

                    </div>
                </div> <!-- End: .part-1 -->

            </div> <!-- End: .row -->
        </div> <!-- End: .container -->
    
</section>
        <!-- End: Header Section
        ================================ -->






<?= $HTML_END ?>