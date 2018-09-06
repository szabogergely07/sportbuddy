                    
    <!-- Modal Close Button -->
<div id="signup-form">
    <form onsubmit="myFun()" method="post" class="single-form" id="" action="">
    <input type="hidden" name="csrf_token" value="<?= csrf_token(); ?>">
    <input type="hidden" name="submit" value="submit">

    <div class="form-group row has-error has-feedback">

        <div class="col-xs-12 col-md-4 col-md-offset-4 fields">
            <!-- First Name -->
            <input name="name" class="form-control" id="name" type="text" placeholder="Name*" value="<?= isset($_POST['name']) ? $_POST['name'] : '' ?>" id="inputWarning1">
            <div class="<?= isset($data['name']) ? 'invalid-feedback alert alert-danger' : 'valid-feedback' ?>">
                <?= isset($data['name']) ? '<strong> '.$data['name'].'</strong>' : '' ?>
            </div>
        </div>
    </div>
    
    <!-- Subject Button -->
    <div class="form-group row">
        <div class="btn-form text-center col-xs-12 col-md-4 col-md-offset-4">
            <button class="btn btn-fill">Create new location</button>
        </div>
    </div>
    </form>
</div>