<?= $ADMIN_START ?>
                   
    <!-- Modal Close Button -->
<div id="signup-form">
    <form method="post" class="single-form" id="" action="/sportbuddy/categories/update/<?= $result->categoryId ?>">
    <input type="hidden" name="submit" value="submit">
    <input type="hidden" name="_method" value="PATCH">

    <div class="col-xs-12 text-center">
        <h2 class="section-heading p-b-30">Update <?= $result->name ?></h2>
    </div>

    <div class="form-group row has-error has-feedback">

        <div class="col-xs-12 col-md-4 col-md-offset-4 fields">
            <!-- First Name -->
            <input name="name" class="form-control" type="text" placeholder="Name*" value="<?= isset($_POST['name']) ? $_POST['name'] : $result->name ?>" id="inputWarning1">
            <div class="<?= isset($data['name']) ? 'invalid-feedback alert alert-danger' : 'valid-feedback' ?>">
                <?= isset($data['name']) ? '<strong> '.$data['name'].'</strong>' : '' ?>
            </div>
        </div>
    </div>
    
    <!-- Subject Button -->
    <div class="form-group row">
        <div class="btn-form text-center col-xs-12 col-md-4 col-md-offset-4">
            <button class="btn btn-fill">Update</button>
        </div>
    </div>
    </form>
</div>
               
<?= $ADMIN_END ?>