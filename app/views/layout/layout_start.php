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

         <!-- Admin -->
        <link rel="stylesheet" href="/sportbuddy/templates/css/admin/blog-post.css">
        <link rel="stylesheet" href="/sportbuddy/templates/css/admin/blog-styles.css">
        <link rel="stylesheet" href="/sportbuddy/templates/css/admin/font-awesome.css">
        <link rel="stylesheet" href="/sportbuddy/templates/css/admin/metisMenu.css">
        <link rel="stylesheet" href="/sportbuddy/templates/css/admin/sb-admin-2.css">
        <link rel="stylesheet" href="/sportbuddy/templates/css/admin/bootstrap.css">
        <link rel="stylesheet" href="/sportbuddy/templates/css/admin/bootstrap.min.css">

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
                background-color: #330000;
            }

            #signup-form {
                width: 100%;
                margin: auto;
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

            .alert {
                padding: 1px;
                padding-left: 5px;
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
                            <img src="/sportbuddy/templates/images/sport-white.png" alt="" class="logo-1 img-responsive">
                            <img src="/sportbuddy/templates/images/sport-dark.png" alt="" class="logo-2 img-responsive">
                        </a>

                    </div> <!-- End: .col-xs-3 -->
                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-6">

                        <nav role="navigation" class="okayNav pull-right" id="js-navbar-menu">
                            <ul id="navbar-nav" class="navbar-nav">
                                <?php
                                if( isset($_SESSION['user_id']) ){
                                    echo
                                "<li><button class='btn-nav' onclick='location.href=\"/sportbuddy/user/update-index/".$_SESSION['user_id']."\";'>Hello ".$_SESSION['user_name']."</button>
                                </li>";
                                }
                                ?>

                                <?php
                                if( isset($_SESSION['user_id']) ){
                                    echo
                                "<li><button class='btn-nav' onclick='location.href=\"/sportbuddy/my-events\";'>My events</button>
                                </li>";
                                }
                                ?>
                                 <?php
                                if( isset($_SESSION['user_id']) ){
                                    echo
                                "<li><button class='btn-nav' onclick='location.href=\"/sportbuddy/joined-events\";'>Joined events</button>
                                </li>";
                                }
                                ?>
                                <?= isset($_SESSION['admin']) && $_SESSION['admin'] == 2 ?
                                '<li><button class="btn-nav" onclick="location.href=\'/sportbuddy/admin\';">Admin</button>
                                </li>' : ''
                                ?>

                                <li><button class="btn-nav" onclick="location.href='/sportbuddy/events';">Events</button></li>

                                <?php
                                if( !isset($_SESSION['user_id']) ){
                                    echo
                                "<li><button class='btn-nav btn-border' onclick='location.href=\"/sportbuddy/login\";'>Login</button>
                                </li>";
                                }
                                ?>

                                <?php
                                if( !isset($_SESSION['user_id']) ){
                                    echo
                                "<li><button class='btn-nav' onclick='location.href=\"/sportbuddy/register\";'>Register</button>
                                </li>";
                                }
                                ?>

                                <?php
                                if( isset($_SESSION['user_id']) ){
                                    echo
                                "<li><button class='btn-nav btn-border' onclick='location.href=\"/sportbuddy/logout\";'>Logout</button>
                                </li>";
                                }
                                ?>
                            </ul>
                        </nav>

                    </div> <!-- End: .col-xs-9 -->
                </div> <!-- End: .row -->
            </div> <!-- End: .container -->
        </header><!-- /header -->
        <!-- End: Navbar Area
        ==================================== -->

<div class="section-separator">













