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
                        <h1 class="title">What would you like to do?</h1>
                    </div>
                </div> <!-- End: .part-1 -->

            </div> <!-- End: .row -->
        </div> <!-- End: .container -->
    
</section>
        <!-- End: Header Section
        ================================ -->




<!-- Start: Features Section 1
        ====================================== -->
        <section class="features-section-1 relative background-dark" >
            <div class="container">
                <div class="row section-separator">

                    <div style="cursor: pointer;" onclick="location.href='/sportbuddy/create-event/';" class="each-features col-sm-6 hvr-pulse-grow">
                        <div class="inner text-center bg-cover light-text" style="background-image: url(images/background-2.jpg);">
                            <div class="">
                                
                                <div style=" background-color: #660000;" class="group">
                                    <h4 class="title">Create new event</h4>
                                    <div class="detail">
                                        <p></p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div style="cursor: pointer;" onclick="location.href='/sportbuddy/events/';" class="each-features col-sm-6 hvr-pulse-grow">
                        <div class="inner text-center bg-cover light-text" style="background-image: url(images/background-3.jpg);">
                            <div class="">
                                
                                <div style=" background-color: #1a0000;" class="group">
                                    <h4 class="title">Search for an event</h4>
                                    <div class="detail">
                                        <p></p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    
                </div> <!-- End: .row -->
            </div> <!-- End: .container -->
        </section>
        <!-- End: Features Section 1
        ======================================-->





<?= $HTML_END ?>