<!DOCTYPE html>
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
        <link rel="stylesheet" href="/sportbuddy/templates/css/style.css">
        <link rel="stylesheet" href="/sportbuddy/templates/css/responsive.css">
        
        <style>
            body {
                background-color: #cccccc;
            }

            #sign-up-form {
                width: 40%;
            }
            .fields {
                display: block;
            }

            table {
                font-family: arial, sans-serif;
                border-collapse: collapse;
                width: 100%;
            }

            td, th {
                border: 1px solid #dddddd;
                text-align: left;
                padding: 8px;
            }

            tr:nth-child(even) {
                background-color: #dddddd;
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

                        <a class="okayNav-header__logo navbar-brand" href="/sportbuddy">
                            <img src="/sportbuddy/app/images/sport-white.png" alt="" class="logo-1 img-responsive">
                            <img src="/sportbuddy/app/images/sport-dark.png" alt="" class="logo-2 img-responsive">
                        </a>

                    </div> <!-- End: .col-xs-3 -->
                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-6">

                        <nav role="navigation" class="okayNav pull-right" id="js-navbar-menu">
                            <ul id="navbar-nav" class="navbar-nav">
                                <li><button class="btn-nav" onclick="location.href='users';" href="users">Users</button></li>
                                <li><a class="btn-nav" href="events">Events</a></li>
                                <li><a class="btn-nav" href="#reviews">Login</a></li>
                                <li><a class="btn-nav" href="register">Register</a></li>
                                <li><a class="btn-nav btn-border" href="#">Logout</a></li>
                            </ul>
                        </nav>

                    </div> <!-- End: .col-xs-9 -->
                </div> <!-- End: .row -->
            </div> <!-- End: .container -->
        </header><!-- /header -->
        <!-- End: Navbar Area
        ==================================== -->




<div class="section-separator">

        <h2>Events</h2>


        <table>
          <tr>
            <th>Event Name</th>
            <th>Description</th>
            <th>Date</th>
            <th>Start Time</th>
            <th>Size</th>
            <th>Created by</th>
          </tr>
        <?php foreach ($events as $unit) { ?>
          <tr>
            <td><?= $unit['name'] ?></td>
            <td><?= $unit['description'] ?></td>
            <td><?= $unit['date'] ?></td>
            <td><?= $unit['start'] ?></td>
            <td><?= $unit['size'] ?></td>
            <td><?= $unit['first_name'] ?></td>
          </tr>
        <?php } ?>
        </table>

</div>











        <!-- ================================== -->

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