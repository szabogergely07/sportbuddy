<?php

namespace users;

require '../../../vendor/autoload.php';
require '../../../vendor/helper.php';

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
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Register</title>
	

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
	<style>
		.form-inline label {
			justify-content: right;
		}
	</style>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Bootstrap core JS -->
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>

</head>
<body>
	<a href="../../index.php"><h2>Home</h2></a>
	<a href="users.php"><h2>Users</h2></a>
	<a href="../events/events.php"><h2>Events</h2></a>	


<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h2>Register</h2></div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="<?PHP echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" novalidate>
                     <input type="hidden" name="submit" value="submit">   

                        <div class="form-group form-inline">
                            <label for="firstName" class="col-md-3 control-label">First Name</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control <?= Val::valName($first_name) ? '' : $invalid ?>" id="firstName" name="first_name" value="<?= @$first_name ?>">
								<div class="<?= Val::valName($first_name) ? 'valid-feedback' : 'invalid-feedback' ?>">
          							<?= @Val::valName($first_name) ? '' : $error['name'] ?>
			
        						</div>
                                
                            </div>
                        </div>

                         <div class="form-group form-inline">
                            <label for="lastName" class="col-md-3 control-label">Last Name</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control <?= Val::valName($last_name) ? '' : $invalid ?>" id="lastName" name="last_name" value="<?= @$last_name ?>">
								<div class="<?= Val::valName($last_name) ? 'valid-feedback' : 'invalid-feedback' ?>">
          							<?= @Val::valName($last_name) ? '' : $error['name'] ?>
			
        						</div>
                                
                            </div>
                        </div>

                        <div class="form-group form-inline">
                            <label class="col-md-3 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control <?= is_null($error['email']) ? '' : $invalid ?>" id="" name="email" value="<?= $email ?>">
								<div class="<?= is_null($error['email']) ? 'valid-feedback' : 'invalid-feedback' ?>">
          							<?= $error['email'] ?>
			
        						</div>
                               
                            </div>
                        </div>

                        <div class="form-group form-inline">
                            <label class="col-md-3 control-label">Password</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control <?= Val::valPassword($password) ? '' : $invalid ?>" id="" name="password">
								<div class="<?= Val::valPassword($password) ? 'valid-feedback' : 'invalid-feedback' ?>">
          							<?= @Val::valPassword($password) ? '' : $error['password'] ?>
			
        						</div>
                                
                            </div>
                        </div>

                       <!--  <div class="form-group form-inline">
                            <label class="col-md-3 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password_confirmation">

                                
                            </div>
                        </div> -->


                       <div class="form-group form-inline">
                            <label class="col-md-3 control-label">Birthday</label>

                            <div class="col-md-6">
                                <input type="date" class="form-control <?= Val::valDate($birthday) ? '' : $invalid ?>" name="birthday" value="<?= @$birthday ?>">
								<div class="<?= Val::valDate($birthday) ? 'valid-feedback' : 'invalid-feedback' ?>">
          							<?= @Val::valDate($birthday) ? '' : $error['date'] ?>
			
        						</div>
                                
                            </div>
                        </div>

                   

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-user"></i>Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


</body>
</html>

