<?= $HTML_START ?>

	
 <!-- Start: Header Section
        ================================ -->
<section style="background-color: white;" class="header-section-1 background-dark header-js" id="header" >

    <div style="background-image: url(http://www.pietropaganini.it/web/wp-content/uploads/2017/01/geo-sports-banner-cropped-size21-1120x413.png);" >

	<?= isset($notice) ?
		'<div class="alert alert-success" role="alert">'
	  		 .$notice.
		'</div>' : ''
	?>
    
        <div class="container">
            <div class="row">

                <div style="margin-top: 40px;" class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">
                    <div class="part-inner text-center">
                        <div id="readable">
                            <!--  Header SubTitle Goes here -->
                            <h1 style="color: black" class="title"><strong id="">Don't have a SportBuddy yet?</strong></h1> 

                            <div class="detail">
                                <h2 style="color: black">We will help you to find one and stay fit!</h2>
                            </div>
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
    </div>
</section>
        <!-- End: Header Section
        ================================ -->


<!-- <div class="container col-xs-12">
    <div class="row">
        <div class="col-md-4">
            <h3 style="color: white">Front End</h3>
            <p style="color: white">HTML, CSS, JavaScript<br>
            Bibliothequen: Bootstrap</p>
        </div>
        <div class="col-md-4">
            <h3 style="color: white">Back End</h3>
            <p style="color: white">PHP 7, MySQL<br>
            Bibliothequen: Composer Autoloader, SimpleRouter, SendGrid</p>
        </div>
        <div class="col-md-4">
            <h3 style="color: white">Tools</h3>
            <p style="color: white">XAMPP, PhpMyAdmin, MySQLWorkbench, GitHub, Hostinger</p>
        </div>

    </div>
</div>
<hr>
<hr> -->


<?= $HTML_END ?>