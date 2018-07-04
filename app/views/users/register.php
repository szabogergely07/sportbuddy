<?= HTML_START ?>
            
                
                    
    <!-- Modal Close Button -->
<div id="signup-form">
    <form method="post" class="single-form" id="" action="/sportbuddy/createuser">
    <input type="hidden" name="submit" value="submit">

    <div class="col-xs-12 text-center">
        <h2 class="section-heading p-b-30">Register</h2>
    </div>


    <div class="form-group row has-error has-feedback">

        <div class="col-xs-12 col-md-4 col-md-offset-4 fields">
            <!-- First Name -->
            <input name="first_name" class="contact-first-name form-control" type="text" placeholder="First Name*" value="<?= isset($_POST['first_name']) ? $_POST['first_name'] : '' ?>" required="" id="inputWarning1">
        </div>
    </div>
    
    <div class="form-group row has-error has-feedback">
        <div class="col-xs-12 col-md-4 col-md-offset-4 fields">
            <!-- Last Name -->
            <input name="last_name" class="contact-last-name form-control " type="text" placeholder="Last Name*" value="<?= isset($_POST['last_name']) ? $_POST['last_name'] : '' ?>" required="">
            
        </div>
    </div>

    <div class="form-group row has-error has-feedback">
        <div class="col-xs-12 col-md-4 col-md-offset-4">
            <!-- Email -->
            <input name="email" class="contact-email form-control" type="email" placeholder="Email*" value="<?= isset($_POST['email']) ? $_POST['email'] : '' ?>" required="">
            <div class="<?= isset($data) ? 'invalid-feedback alert alert-danger' : 'valid-feedback' ?>">
                <?= isset($data) ? '<strong> '.$data['email'].'</strong>' : '' ?>
            </div>
        </div>
    </div>

    <div class="form-group row has-error has-feedback">
        <div class="col-xs-12 col-md-4 col-md-offset-4">
            <!-- Subject -->
            <input name="password" class="contact-password form-control " type="pass" placeholder="Password">
            <div class="<?= isset($data) ? 'invalid-feedback alert alert-danger' : 'valid-feedback' ?>">
                <?= isset($data) ? '<strong> '.$data['password'].'</strong>' : '' ?>
            </div>
        </div>
    </div>

    <div class="form-group row has-error has-feedback">
        <div class="col-xs-12 col-md-4 col-md-offset-4">
            <!-- Subject -->
            <input name="password2" class="contact-cmp-password form-control" type="pass" placeholder="Confirm Password">
        </div>
    </div>

    <div class="form-group row has-error has-feedback">
        <div class="col-xs-12 col-md-4 col-md-offset-4">
            <!-- Email -->
            <input name="birthday" type="date" class="contact-first-name form-control " placeholder="Birthday*" value="<?= isset($_POST['birthday']) ? $_POST['birthday'] : '' ?>" required="">
            <div class="<?= isset($data) ? 'invalid-feedback alert alert-danger' : 'valid-feedback' ?>">
                <?= isset($data) ? '<strong> '.$data['birthday'].'</strong>' : '' ?>
            </div>
        </div>
    </div>

    <!-- Subject Button -->
    <div class="form-group row">
        <div class="btn-form text-center col-xs-12 col-md-4 col-md-offset-4">
            <button class="btn btn-fill">Sign Up</button>
        </div>
    </div>
    </form>
</div>
               
<?= HTML_END ?>