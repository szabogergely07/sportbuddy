<?= HTML_START ?>
            
                
                    
    <!-- Modal Close Button -->
<div id="signup-form">
    <form method="post" class="single-form" id="" action="/sportbuddy/events/store">
    <input type="hidden" name="submit" value="submit">

    <div class="col-xs-12 text-center">
        <h2 class="section-heading p-b-30">Create New Event</h2>
    </div>


    <div class="form-group row has-error has-feedback">

        <div class="col-xs-12 col-md-4 col-md-offset-4 fields">
            <!-- First Name -->
            <input name="name" class="form-control" type="text" placeholder="Name*" value="<?= isset($_POST['name']) ? $_POST['name'] : '' ?>" required="" id="inputWarning1">
        </div>
    </div>
    
    <div class="form-group row has-error has-feedback">
        <div class="col-xs-12 col-md-4 col-md-offset-4 fields">
            <!-- Last Name -->
            <textarea name="description" class="form-control " rows="5" placeholder="Description" value="<?= isset($_POST['description']) ? $_POST['description'] : '' ?>" required=""></textarea>
            
        </div>
    </div>

    <div class="form-group row has-error has-feedback">
        <div class="col-xs-12 col-md-4 col-md-offset-4">
           
            <input name="date" class="form-control" type="" placeholder="Date" value="<?= isset($_POST['date']) ? $_POST['date'] : '' ?>" required="">
            <div class="<?= isset($data['date']) ? 'invalid-feedback alert alert-danger' : 'valid-feedback' ?>">
                <?= isset($data['date']) ? '<strong> '.$data['date'].'</strong>' : '' ?>
            </div>
        </div>
    </div>

    <div class="form-group row has-error has-feedback">
        <div class="col-xs-12 col-md-4 col-md-offset-4">
            <!-- Email -->
            <input name="start" class="form-control" type="" placeholder="Start" value="<?= isset($_POST['start']) ? $_POST['start'] : '' ?>" required="">
            <div class="<?= isset($data['start']) ? 'invalid-feedback alert alert-danger' : 'valid-feedback' ?>">
                <?= isset($data['start']) ? '<strong> '.$data['start'].'</strong>' : '' ?>
            </div>
        </div>
    </div>

    <div class="form-group row has-error has-feedback">
        <div class="col-xs-12 col-md-4 col-md-offset-4">
            
            <input name="end" class="form-control" type="" placeholder="End" value="<?= isset($_POST['end']) ? $_POST['end'] : '' ?>" required="">
            <div class="<?= isset($data['end']) ? 'invalid-feedback alert alert-danger' : 'valid-feedback' ?>">
                <?= isset($data['end']) ? '<strong> '.$data['end'].'</strong>' : '' ?>
            </div>
        </div>
    </div>

    <div class="form-group row has-error has-feedback">
        <div class="col-xs-12 col-md-4 col-md-offset-4">
            
            <input name="size" type="number" min="2" max="40" class="form-control " placeholder="Size" value="<?= isset($_POST['size']) ? $_POST['size'] : '' ?>" required="">
            <div class="<?= isset($data['size']) ? 'invalid-feedback alert alert-danger' : 'valid-feedback' ?>">
                <?= isset($data['size']) ? '<strong> '.$data['size'].'</strong>' : '' ?>
            </div>
        </div>
    </div>

    <div class="form-group row has-error has-feedback">
        <div class="col-xs-12 col-md-4 col-md-offset-4">
           
            <select name="location" class="form-control">
                <option value="1"><?= isset($_POST['location']) ? $_POST['location'] : 'Select location' ?></option>
                <option>1</option>
            </select>
            <div class="<?= isset($data['location']) ? 'invalid-feedback alert alert-danger' : 'valid-feedback' ?>">
                <?= isset($data['location']) ? '<strong> '.$data['location'].'</strong>' : '' ?>
            </div>
        </div>
    </div>

    <div class="form-group row has-error has-feedback">
        <div class="col-xs-12 col-md-4 col-md-offset-4">
           
            <select name="category" class="form-control">
                <option value="1"><?= isset($_POST['category']) ? $_POST['category'] : 'Select category' ?></option>
                <option>1</option>
            </select>
            <div class="<?= isset($data['category']) ? 'invalid-feedback alert alert-danger' : 'valid-feedback' ?>">
                <?= isset($data['category']) ? '<strong> '.$data['category'].'</strong>' : '' ?>
            </div>
        </div>
    </div>

    <div class="form-group row has-error has-feedback">
        <div class="col-xs-12 col-md-4 col-md-offset-4">
           
            <select name="level" class="form-control">
                <option value="1"><?= isset($_POST['level']) ? $_POST['level'] : 'Select level' ?></option>
                <option>1</option>
            </select>
            <div class="<?= isset($data['level']) ? 'invalid-feedback alert alert-danger' : 'valid-feedback' ?>">
                <?= isset($data['level']) ? '<strong> '.$data['level'].'</strong>' : '' ?>
            </div>
        </div>
    </div>

    <div class="form-group row has-error has-feedback">
        <div class="col-xs-12 col-md-4 col-md-offset-4">
            
            <input name="user" class="form-control" type="" placeholder="user_id" value="" required="">
            
        </div>
    </div>

    <!-- Subject Button -->
    <div class="form-group row">
        <div class="btn-form text-center col-xs-12 col-md-4 col-md-offset-4">
            <button class="btn btn-fill">Create</button>
        </div>
    </div>
    </form>
</div>
               
<?= HTML_END ?>