<?= $HTML_START ?>
                   
    <!-- Modal Close Button -->
<div id="signup-form">
    <form method="post" class="single-form" id="" action="/sportbuddy/event/update/<?= $event->eventId ?>">
    <input type="hidden" name="submit" value="submit">
    <input type="hidden" name="_method" value="PATCH">
    <input type="hidden" id="lat" name="lat" value="">
    <input type="hidden" id="lng" name="lng" value="">

    <div class="col-xs-12 text-center">
        <h2 class="section-heading p-b-30">Update <?= $event->name ?></h2>
    </div>

    <div class="form-group row has-error has-feedback">
        <label for="" class="text-right col-xs-4 col-md-2 col-md-offset-2 control-label">Name</label>
        <div class="col-xs-8 col-md-4 fields">
            <!-- First Name -->
            <input name="name" class="form-control" type="text" placeholder="Name*" value="<?= isset($_POST['name']) ? $_POST['name'] : $event->name ?>" id="inputWarning1">
            <div class="<?= isset($data['name']) ? 'invalid-feedback alert alert-danger' : 'valid-feedback' ?>">
                <?= isset($data['name']) ? '<strong> '.$data['name'].'</strong>' : '' ?>
            </div>
        </div>
    </div>
    
    <div class="form-group row has-error has-feedback">
        <label for="" class="text-right col-xs-4 col-md-2 col-md-offset-2 control-label">Description</label>
        <div class="col-xs-8 col-md-4 fields">
            <!-- Last Name -->
            <textarea name="description" class="form-control " rows="5" placeholder="Description"><?= isset($_POST['description']) ? $_POST['description'] : $event->description ?>
            </textarea>
        </div>
    </div>

    <div class="form-group row has-error has-feedback">
        <label for="" class="text-right col-xs-4 col-md-2 col-md-offset-2 control-label">Date</label>
        <div class="col-xs-8 col-md-4 fields">
           
            <input name="date" class="form-control" type="date" placeholder="Date" value="<?= isset($_POST['date']) ? $_POST['date'] : $event->date ?>">
            <div class="<?= isset($data['date']) ? 'invalid-feedback alert alert-danger' : 'valid-feedback' ?>">
                <?= isset($data['date']) ? '<strong> '.$data['date'].'</strong>' : '' ?>
            </div>
        </div>
    </div>

    <div class="form-group row has-error has-feedback">
        <label for="" class="text-right col-xs-4 col-md-2 col-md-offset-2 control-label">Time start</label>
        <div class="col-xs-8 col-md-4 fields">
            <!-- Email -->
            <input name="start" class="form-control" type="time" placeholder="Start time: hh:mm" value="<?= isset($_POST['start']) ? $_POST['start'] : $event->start ?>">
            <div class="<?= isset($data['start']) ? 'invalid-feedback alert alert-danger' : 'valid-feedback' ?>">
                <?= isset($data['start']) ? '<strong> '.$data['start'].'</strong>' : '' ?>
            </div>
        </div>
    </div>

    <div class="form-group row has-error has-feedback">
        <label for="" class="text-right col-xs-4 col-md-2 col-md-offset-2 control-label">Time end</label>
        <div class="col-xs-8 col-md-4 fields">
            
            <input name="end" class="form-control" type="time" placeholder="End time: hh:mm" value="<?= isset($_POST['end']) ? $_POST['end'] : $event->end ?>">
            <div class="<?= isset($data['end']) ? 'invalid-feedback alert alert-danger' : 'valid-feedback' ?>">
                <?= isset($data['end']) ? '<strong> '.$data['end'].'</strong>' : '' ?>
            </div>
        </div>
    </div>

    <div class="form-group row has-error has-feedback">
        <label for="" class="text-right col-xs-4 col-md-2 col-md-offset-2 control-label">Members</label>
        <div class="col-xs-8 col-md-4 fields">
            
            <input name="size" type="number" min="2" max="40" class="form-control " placeholder="Size" value="<?= isset($_POST['size']) ? $_POST['size'] : $event->size ?>">
            <div class="<?= isset($data['size']) ? 'invalid-feedback alert alert-danger' : 'valid-feedback' ?>">
                <?= isset($data['size']) ? '<strong> '.$data['size'].'</strong>' : '' ?>
            </div>
        </div>
    </div>

    <div class="form-group row has-error has-feedback">
        <label for="" class="text-right col-xs-4 col-md-2 col-md-offset-2 control-label">Location</label>
        <div class="col-xs-8 col-md-4 fields">
           
            <input class="form-control" value="<?= isset($_POST['location']) ? $_POST['location'] : $event->location ?>" name="location" id="autocomplete" placeholder="Start typing an address.." onFocus="geolocate()" type="text">

            <div class="<?= isset($data['location']) ? 'invalid-feedback alert alert-danger' : 'valid-feedback' ?>">
                <?= isset($data['location']) ? '<strong> '.$data['location'].'</strong>' : '' ?>
            </div>
        </div>
    </div>

    <div class="form-group row has-error has-feedback">
        <label for="" class="text-right col-xs-4 col-md-2 col-md-offset-2 control-label">Category</label>
        <div class="col-xs-8 col-md-4 fields">
           
            <select name="category" class="form-control">
                <option value="<?= isset($_POST['category']) ? $_POST['category'] : $event->category_id ?>"><?= isset($_POST['category']) ? $_POST['category'] : $event->category_id ?></option>
                <?php foreach($categories as $category) { ?>
                <option value="<?= $category['name'] ?>"><?= $category['name'] ?></option>
                <?php } ?>
            </select>
            <div class="<?= isset($data['category']) ? 'invalid-feedback alert alert-danger' : 'valid-feedback' ?>">
                <?= isset($data['category']) ? '<strong> '.$data['category'].'</strong>' : '' ?>
            </div>
        </div>
    </div>

    <div class="form-group row has-error has-feedback">
        <label for="" class="text-right col-xs-4 col-md-2 col-md-offset-2 control-label">Level</label>
        <div class="col-xs-8 col-md-4 fields">
           
            <select name="level" class="form-control">
                <option value="1"><?= isset($_POST['level']) ? eventLevel($_POST['level']) : eventLevel($event->level) ?></option>
                <?php foreach($eventLevels as $eventLevel) {
                    foreach ($eventLevel as $key => $value) { ?>
                <option value="<?= $key ?>"><?= $value ?>
                </option>
                <?php } ?>
                <?php } ?>
            </select>
            <div class="<?= isset($data['level']) ? 'invalid-feedback alert alert-danger' : 'valid-feedback' ?>">
                <?= isset($data['level']) ? '<strong> '.$data['level'].'</strong>' : '' ?>
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
               
<?= $HTML_END ?>