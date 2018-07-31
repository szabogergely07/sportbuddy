<?= $HTML_START ?>

	<?= isset($notice) ?
		'<div class="alert alert-success" role="alert">'
	  		 .$notice.
		'</div>' : ''
	?>
	
 <!-- Start: Header Section
        ================================ -->
<section class="header-section-1 background-dark header-js" id="header" >
    
        <div class="container">
            <div class="row">

                <div style="margin-top: 40px;" class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">
                    <div class="part-inner text-center">

                        <!--  Header SubTitle Goes here -->
                        <h1 class="title">Don't have a SportBuddy yet?</h1> 

                        <div class="detail">
                            <p>We will help you to find one and stay fit!</p>
                        </div>

                        <!-- Button Area -->
                        <div class="btn-form">
                            <a href="/sportbuddy/login" id="homeButton" class="btn btn-border">Login</a>
                            <a href="/sportbuddy/register" id="homeButton" class="btn btn-border">Register</a>
                        </div>

                    </div>
                </div> <!-- End: .part-1 -->

            </div> <!-- End: .row -->
        </div> <!-- End: .container -->
    
</section>
        <!-- End: Header Section
        ================================ -->






<?= $HTML_END ?>