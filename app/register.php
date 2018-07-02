<?php
namespace app;
use myclass\Val;

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
