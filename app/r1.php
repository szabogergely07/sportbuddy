<?php



// use myclass\Val;
// //use vendor\rb;

// $error = [];
// $error['name'] = "It cannot be empty!";
// $error['email'] = "";
// $error['date'] = "Date is not valid";
// $error['password'] = "Password must be at least 6 characters";

// $invalid = "is-invalid";

// extract($_REQUEST, EXTR_PREFIX_ALL, "f");

// @$first_name = $f_first_name;
// @$last_name = $f_last_name;
// @$email = $f_email;
// @$birthday = $f_birthday;


// if (isset($f_submit)) {
    
//     if( Val::valName($f_first_name) && Val::valName($f_last_name) && Val::valEmailValid($f_email) && Val::valEmailExist($f_email) && Val::valName($f_password) && Val::valDate($f_birthday) ) {


//             $f_password = password_hash($f_password, PASSWORD_BCRYPT);
//             // R::exec("INSERT INTO user (first_name, last_name, email, password, birthday) VALUES ('$f_first_name', '$f_last_name', '$f_email', '$f_password', '$f_birthday');");
//             $db = new \mysqli('localhost', 'root', '', 'mydb');
//             $sql = $db->query("INSERT INTO user (first_name, last_name, email, password, birthday) VALUES ('$f_first_name', '$f_last_name', '$f_email', '$f_password', '$f_birthday');");
//             $db->close();   
        
//             //header('Location: index.php');

//     } elseif( !Val::valEmailValid($f_email) ) {
//         $error['email'] = "Email is not valid!";
//     } elseif( !Val::valEmailExist($f_email) ) {
//         $error['email'] = "Email exists already!";
//     }
// } else {
//     $error = null;
//     $invalid = null;
// }

?><!DOCTYPE html>
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en-US"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en-US"> <![endif]-->
<!--[if gt IE 8]><!-->
<html lang="en">
    <head>     
  
        <!-- TITLE OF SITE --> 
        <title>SportBuddy</title>
  
        <!-- Meta -->
        <meta charset="utf-8">
        <meta name="description" content="StartUp Landing Page Template" />
        <meta name="keywords" content="Treetoper, startup, landing page, gradient background, image background, video background, template, responsive, bootstrap" />
        <meta name="developer" content="TemplateOcean">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

        <!-- FAV AND TOUCH ICONS   -->
        <link rel="icon" href="images/favicon.ico">
        <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
        <link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">

        <!-- GOOGLE FONTS -->
        <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>

        <!-- BOOTSTRAP CSS -->
        <link rel="stylesheet" href="/sportbuddy/templates/bootstrap/css/bootstrap.min.css">

        <!-- Image Slider -->
        <link rel="stylesheet" href="/sportbuddy/templates/css/plagin-css/plagin.css">

        <!-- FONT ICONS -->
        <link rel="stylesheet" href="/sportbuddy/templates/icons/toicons/css/styles.css">

        <!--   COUSTOM CSS link  -->
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/responsive.css">
        
        <style>
            body {
                background-color: grey;
            }

            #sign-up-form {
                width: 40%;
            }
            .fields {
                display: block;
            }
        </style>

        <!--[if lt IE 9]>
            <script src="js/plagin-js/html5shiv.js"></script>
            <script src="js/plagin-js/respond.min.js"></script>
        <![endif]-->

    </head>
    <body class="">

        <!-- Start: Navbar Area
        ============================= -->
        <header id="header" class="okayNav-header navbar-fixed-top main-navbar-top">
            <div class="container">
                <div class="row">
                    
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">

                        <a class="okayNav-header__logo navbar-brand" href="#">
                            <img src="/sportbuddy/app/images/sport-white.png" alt="" class="logo-1 img-responsive">
                            <img src="/sportbuddy/app/images/sport-dark.png" alt="" class="logo-2 img-responsive">
                        </a>

                    </div> <!-- End: .col-xs-3 -->
                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-6">

                        <nav role="navigation" class="okayNav pull-right" id="js-navbar-menu">
                            <ul id="navbar-nav" class="navbar-nav">
                                <li><a class="btn-nav" href="#features">Features</a></li>
                                <li><a class="btn-nav" href="#pricing">Pricing</a></li>
                                <li><a class="btn-nav" href="#reviews">Reviews</a></li>
                                <li><a class="btn-nav" href="#" data-toggle="modal" data-target="#sign-in-form">Sign In</a></li>
                                <li><a class="btn-nav btn-border" href="#" data-toggle="modal" data-target="#sign-up-form">Sign Up</a></li>
                            </ul>
                        </nav>

                    </div> <!-- End: .col-xs-9 -->
                </div> <!-- End: .row -->
            </div> <!-- End: .container -->
        </header><!-- /header -->
        <!-- End: Navbar Area
        ============================= -->


<section id="header" class="header-section-1">
<div id="sign-up-form" class="sign-form section-separator">
            
                
                    
                    <!-- Modal Close Button -->
                    
                    <form method="post" class="single-form" action="/sportbuddy/createuser">
                        <input type="hidden" name="submit" value="submit">

                        <div class="col-xs-12 text-center">
                            <h2 class="section-heading p-b-30">Register</h2>
                        </div>
                        
                        <div class="form-group has-error has-feedback">
                        
                        <div class="col-xs-12 fields">
                            <!-- First Name -->
                            <input name="first_name" class="form-control" type="text" placeholder="First Name*" value="" required="" id="inputWarning1">
                        
                           
                        </div>
                        </div>
                        <div class="col-xs-12 fields">
                            <!-- Last Name -->
                            <input name="last_name" class="contact-last-name form-control " type="text" placeholder="Last Name*" value="" required="">
                            
                        </div>
                        <div class="col-xs-12">
                            <!-- Email -->
                            <input name="email" class="contact-email form-control" type="email" placeholder="Email*" value="" required="">
                            
                        </div>
                        <div class="col-xs-12">
                            <!-- Subject -->
                            <input name="password" class="contact-password form-control " type="pass" placeholder="Password">
                            
                        </div>
                        <div class="col-xs-12">
                            <!-- Subject -->
                            <input name="password2" class="contact-cmp-password form-control" type="pass" placeholder="Confirm Password">
                        </div>
                        <div class="col-xs-12">
                            <!-- Email -->
                            <input name="birthday" type="" class="contact-first-name form-control " placeholder="Birthday*" value="" required="">
                            
                        </div>
                        
                        <!-- Subject Button -->
                        <div class="btn-form text-center col-xs-4">
                            <button class="btn btn-fill">Sign Up</button>
                        </div>
                    </form>

               
        </div>
</section>
        <!-- End: .modal -->
        <!-- End: Sign Out Form


        ================================== -->

         <!-- SCRIPTS 
        ========================================-->
        <script src="/sportbuddy/templates/js/plagin-js/jquery-1.11.3.js"></script>
        <script src="/sportbuddy/templates/bootstrap/js/bootstrap.min.js"></script>
        <script src="/sportbuddy/templates/js/plagin-js/plagin.js"></script>

        <!-- Custom Script 
        ==========================================-->
        <script src="/sportbuddy/templates/js/custom-scripts.js"></script>


    </body>

</html>