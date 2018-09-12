<!-- Search fields -->
<div id="signup-form">
    <form method="post" class="single-form form-inline" id="" action="/sportbuddy/events/search">
    <input type="hidden" name="submit" value="submit">

    
    <div class="form-group row has-error has-feedback">
        <div class="col-xs-12 col-md-2">
           
            <select style="margin-bottom: 0px;" name="location" class="form-control">
                
                <option value="<?= isset($_POST['location']) ? $_POST['location'] : 'All' ?>"><?= isset($_POST['location']) ? $_POST['location'] : 'All' ?></option>
                <option value="All">All</option>
                <?php foreach($locations as $location) { ?>
                <option value="<?= $location['name'] ?>"><?= $location['name'] ?></option>
                <?php } ?>
            </select>
        </div>
    </div>

    <div class="form-group row has-error has-feedback">
        <div class="col-xs-12 col-md-2">
            <select style="margin-bottom: 0px;" name="category" class="form-control">
                
                <option value="<?= isset($_POST['category']) ? $_POST['category'] : 'All' ?>"><?= isset($_POST['category']) ? $_POST['category'] : 'All' ?></option>
                <option value="All">All</option>
               <?php foreach($categories as $category) { ?>
                <option value="<?= $category['name'] ?>"><?= $category['name'] ?></option>
                <?php } ?>
            </select>
        </div>
    </div>

    <div class="form-group row has-error has-feedback">
        <div class="col-xs-12 col-md-2">
            <select style="margin-bottom: 0px;" name="level" class="form-control">
                 <option value="1">All</option> 
                <option value="1"><?= isset($_POST['level']) ? eventLevel($_POST['level']) : 'Not defined' ?></option>
               
                <?php foreach($eventLevels as $eventLevel) {
                    foreach ($eventLevel as $key => $value) { ?>
                <option value="<?= $key ?>"><?= $value ?>
                </option>
                <?php } ?>
                <?php } ?>
            </select>
        </div>
    </div>

    <!-- Subject Button -->
    <div class="form-group row">
        <div class="btn-form text-center col-xs-12 col-md-6">
            <button style="padding: 10px 30px 10px;" class="btn btn-primary btn-sm">Filter</button>
        </div>
    </div>
    </form>
</div>