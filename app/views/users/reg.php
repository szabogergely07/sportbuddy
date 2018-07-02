<?php

require 'vendor/autoload.php';
require 'vendor/helper.php';

//require_once('../../functions.php');


use myclass\Val;
//use vendor\rb;

$error = [];
$error['name'] = "It cannot be empty!";
$error['email'] = "";
$error['date'] = "Date is not valid";
$error['password'] = "Password must be at least 6 characters";

$invalid = "is-invalid";

extract($_REQUEST, EXTR_PREFIX_ALL, "f");

@$first_name = $f_first_name;
@$last_name = $f_last_name;
@$email = $f_email;
@$birthday = $f_birthday;


if (isset($f_submit)) {
    
    if( Val::valName($f_first_name) && Val::valName($f_last_name) && Val::valEmailValid($f_email) && Val::valEmailExist($f_email) && Val::valName($f_password) && Val::valDate($f_birthday) ) {


            $f_password = password_hash($f_password, PASSWORD_BCRYPT);
            // R::exec("INSERT INTO user (first_name, last_name, email, password, birthday) VALUES ('$f_first_name', '$f_last_name', '$f_email', '$f_password', '$f_birthday');");
            $db = new \mysqli('localhost', 'root', '', 'mydb');
            $sql = $db->query("INSERT INTO user (first_name, last_name, email, password, birthday) VALUES ('$f_first_name', '$f_last_name', '$f_email', '$f_password', '$f_birthday');");
            $db->close();   
            header('Location: index.php');

    } elseif( !Val::valEmailValid($f_email) ) {
        $error['email'] = "Email is not valid!";
    } elseif( !Val::valEmailExist($f_email) ) {
        $error['email'] = "Email exists already!";
    }
} else {
    $error = null;
    $invalid = null;
}

?><!DOCTYPE html>
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en-US"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en-US"> <![endif]-->
<!--[if gt IE 8]><!-->
<html lang="en">
    <head>     
  
        <!-- TITLE OF SITE --> 
        <title>Treetoper - App Landing Page Template</title>
  
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
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

        <!-- Image Slider -->
        <link rel="stylesheet" href="css/plagin-css/plagin.css">

        <!-- FONT ICONS -->
        <link rel="stylesheet" href="icons/toicons/css/styles.css">

        <!--   COUSTOM CSS link  -->
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/responsive.css">


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
                            <img src="images/logo.png" alt="" class="logo-1 img-responsive">
                            <img src="images/logo-dark.png" alt="" class="logo-2 img-responsive">
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




        <!-- Start: Sign In Form
        ================================== -->
        <div id="sign-in-form" class="sign-form modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    
                    <!-- Modal Close Button -->
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    
                    <form method="post" class="single-form" action="<?PHP echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                        <input type="hidden" name="submit" value="submit">

                        <div class="col-xs-12 text-center">
                            <h2 class="section-heading p-b-30">Sign In</h2>
                        </div>

                        <div class="col-xs-12">
                            <!-- Email -->
                            <input name="email" class="contact-email form-control" type="email" placeholder="Email*" required="">
                        </div>
                        <div class="col-xs-12">
                            <!-- Subject -->
                            <input name="password" class="contact-password form-control" type="pass" placeholder="Password">
                        </div>

                        <div class="col-xs-12">
                            <div class="checkbox">
                                <input type="checkbox" id="remember-me">
                                <label for="remember-me">Remember me</label>
                            </div>
                        </div>
                        
                        <!-- Subject Button -->
                        <div class="btn-form text-center col-xs-12">
                            <button class="btn btn-fill">Sign In</button>
                        </div>
                    </form>

                </div><!-- End: .modal-content -->
            </div><!-- End: .modal-dialog -->
        </div><!-- End: .modal -->
        <!-- End: Sign In Form
        ================================== -->




        <!-- Start: Sign Out Form
        ================================== -->
        <div id="sign-up-form" class="sign-form modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content p-t-30 p-b-30">
                    
                    <!-- Modal Close Button -->
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    
                    <form method="post" class="single-form" action="<?PHP echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                        <input type="hidden" name="submit" value="submit">

                        <div class="col-xs-12 text-center">
                            <h2 class="section-heading p-b-30">Sign Up</h2>
                        </div>

                        <div class="col-xs-12">
                            <!-- First Name -->
                            <input name="first_name" class="contact-first-name form-control <?= Val::valName($first_name) ? '' : $invalid ?>" type="text" placeholder="First Name*" value="<?= @$last_name ?>" required="">
                            <div class="<?= Val::valName($first_name) ? 'valid-feedback' : 'invalid-feedback' ?>">
                                    <?= @Val::valName($first_name) ? '' : $error['name'] ?>
            
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <!-- Last Name -->
                            <input name="last_name" class="contact-last-name form-control <?= Val::valName($last_name) ? '' : $invalid ?>" type="text" placeholder="Last Name*" value="<?= @$last_name ?>"required="">
                            <div class="<?= Val::valName($last_name) ? 'valid-feedback' : 'invalid-feedback' ?>">
                                    <?= @Val::valName($last_name) ? '' : $error['name'] ?>
            
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <!-- Email -->
                            <input name="email" class="contact-email form-control <?= is_null($error['email']) ? '' : $invalid ?>" type="email" placeholder="Email*" value="<?= $email ?>" required="">
                            <div class="<?= is_null($error['email']) ? 'valid-feedback' : 'invalid-feedback' ?>">
                                    <?= $error['email'] ?>
            
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <!-- Subject -->
                            <input name="password" class="contact-password form-control <?= Val::valPassword($password) ? '' : $invalid ?>" type="pass" placeholder="Password">
                            <div class="<?= Val::valPassword($password) ? 'valid-feedback' : 'invalid-feedback' ?>">
                                    <?= @Val::valPassword($password) ? '' : $error['password'] ?>
            
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <!-- Subject -->
                            <input name="password" class="contact-cmp-password form-control" type="pass" placeholder="Confirm Password">
                        </div>
                        <div class="col-xs-12">
                            <!-- Email -->
                            <input name="birthday" class="contact-first-name form-control <?= Val::valDate($birthday) ? '' : $invalid ?>" placeholder="Birthday*" value="<?= $birthday ?>" required="">
                            <div class="<?= Val::valDate($birthday) ? 'valid-feedback' : 'invalid-feedback' ?>">
                                    <?= @Val::valDate($birthday) ? '' : $error['date'] ?>
            
                            </div>
                        </div>
                        
                        <!-- Subject Button -->
                        <div class="btn-form text-center col-xs-12">
                            <button class="btn btn-fill">Sign Up</button>
                        </div>
                    </form>

                </div><!-- End: .modal-content -->
            </div><!-- End: .modal-dialog -->
        </div><!-- End: .modal -->
        <!-- End: Sign Out Form
        ================================== -->



        
        <!-- Start: Header Section
        ================================ -->
        <section class="header-section-1 bg-image-1 header-js" id="header" >
            <div class="overlay-color">
                <div class="container">
                    <div class="row section-separator">

                        <div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1">
                            <div class="part-inner text-center">

                                <!--  Header SubTitle Goes here -->
                                <h1 class="title">Landing page for your startup or your service.</h1> 

                                <div class="detail">
                                    <p>Use this template to promote and describe the benefits of your product.</p>
                                </div>

                                <!-- Button Area -->
                                <div class="btn-form btn-scroll">
                                    <a href="#" class="btn btn-border">Get started</a>
                                </div>

                            </div>
                        </div> <!-- End: .part-1 -->

                    </div> <!-- End: .row -->
                </div> <!-- End: .container -->
            </div> <!-- End: .overlay-color -->
        </section>
        <!-- End: Header Section
        ================================ -->




        <!-- Start: Features Section 1
        ====================================== -->
        <section class="features-section-1 relative background-semi-dark" >
            <div class="container">
                <div class="row section-separator">

                    <div class="each-features col-sm-6">
                        <div class="inner text-center bg-cover light-text" style="background-image: url(images/background-2.jpg);">
                            <div class="overlay-color">
                                
                                <div class="group">
                                    <h4 class="title">ABOUT ARCHER</h4>
                                    <div class="detail">
                                        <p>Consectetur adipiscing elit. Donec aliquet quis, cursus interdum orci cras ullamcorper tellus a massa ornare, luctus at augue id tincidunt. Proin nulla risus, pharetra id aliquet quis, cursus interdum orci cras ullamcorper tellus a massa ornare, non ornare arcu cursus.</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="each-features col-sm-6">
                        <div class="inner text-center bg-cover light-text" style="background-image: url(images/background-3.jpg);">
                            <div class="overlay-color">
                                
                                <div class="group">
                                    <h4 class="title">OUR MISSION</h4>
                                    <div class="detail">
                                        <p>Consectetur adipiscing elit. Donec aliquet quis, cursus interdum orci cras ullamcorper tellus a massa ornare, luctus at augue id tincidunt. Proin nulla risus, pharetra id aliquet quis, cursus interdum orci cras ullamcorper tellus a massa ornare, non ornare arcu cursus.</p>
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

