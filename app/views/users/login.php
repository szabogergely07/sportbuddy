<?= $HTML_START ?>

<!-- Start: Sign In Form
        ================================== -->
<div id="sign-in-form" class="sign-form" tabindex="" role="">
    
    <form method="post" class="single-form" action="/sportbuddy/loginuser">
        <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">

        <div class="col-xs-12 text-center">
            <h2 class="section-heading p-b-30">Sign In</h2>
        </div>

        <div class="form-group row has-error has-feedback">
            <div class="col-xs-12 col-md-4 col-md-offset-4">
                <!-- Email -->
                <input name="email" class="contact-email form-control" type="email" value="<?= isset($_POST['email']) ? $_POST['email'] : '' ?>" placeholder="Email*" required="">
                <div class="<?= isset($error) ? 'invalid-feedback alert alert-danger' : 'valid-feedback' ?>">
                <?= isset($error) ? '<strong> '.$error.'</strong>' : '' ?>
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-md-4 col-md-offset-4">
            <!-- Subject -->
            <input name="password" class="contact-password form-control" type="pass" placeholder="Password">
        </div>

        <div class="col-xs-12 col-md-4 col-md-offset-4">
            <div class="checkbox">
                <input type="checkbox" id="remember-me">
                <label for="remember-me">Remember me</label>
            </div>
        </div>
        
        <!-- Subject Button -->
        <div class="btn-form text-center col-xs-12 col-md-4 col-md-offset-4">
            <button class="btn btn-fill">Sign In</button>
        </div>
    </form>

       
</div><!-- End: .modal -->
        <!-- End: Sign In Form
        ================================== -->

<?= $HTML_END ?>