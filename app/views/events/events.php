<?= $HTML_START ?>

<?= isset($success) ?
    '<div class="alert alert-'.$notice.' fade in">
    <a href="#" class="close" data-dismiss="alert">&times;</a>
         '. $success . '
    </div>' : ''
?>

<?= isset($_SESSION['user_id']) ?
'<div class="container">
    <button onClick="javascript: window.location=\'/sportbuddy/create-event\'">Create New Event</button>
</div>' : ''
?>

        <h2>Events</h2>

<!-- Search fields -->
<div id="signup-form">
    <form method="post" class="single-form form-inline" id="" action="/sportbuddy/events/search">
    <input type="hidden" name="submit" value="submit">

<!--     <div class="col-xs-12 text-center">
        <h2 class="section-heading p-b-30">Create New Event</h2>
    </div> -->

    
    <div class="form-group row has-error has-feedback">
        <div class="col-xs-2">
           
            <select name="location" class="form-control">
                
                <option value="<?= isset($_POST['location']) ? $_POST['location'] : 'All' ?>"><?= isset($_POST['location']) ? $_POST['location'] : 'All' ?></option>
                <option value="All">All</option>
                <?php foreach($locations as $location) { ?>
                <option value="<?= $location['name'] ?>"><?= $location['name'] ?></option>
                <?php } ?>
            </select>
        </div>
    </div>

    <div class="form-group row has-error has-feedback">
        <div class="col-xs-2">
            <select name="category" class="form-control">
                
                <option value="<?= isset($_POST['category']) ? $_POST['category'] : 'All' ?>"><?= isset($_POST['category']) ? $_POST['category'] : 'All' ?></option>
                <option value="All">All</option>
               <?php foreach($categories as $category) { ?>
                <option value="<?= $category['name'] ?>"><?= $category['name'] ?></option>
                <?php } ?>
            </select>
        </div>
    </div>

    <div class="form-group row has-error has-feedback">
        <div class="col-xs-2">
            <select name="level" class="form-control">
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
        <div class="btn-form text-center col-xs-2">
            <button class="btn btn-fill">Filter</button>
        </div>
    </div>
    </form>
</div>

<br>

        <table>
          <tr>
            <th>Event Name</th>
            <th>Description</th>
            <th>Date</th>
            <th>Start Time</th>
            <th>Size</th>
            <th>Created by</th>
            <th>Category</th>
            <th>Location</th>
            <th>Level</th>
            <th>Created</th>
            <th></th>
            <th></th>
            <th></th>
          </tr>
        <?php foreach ($events as $unit) { ?>
          <tr>
            <td><?= $unit['event_name'] ?></td>
            <td><?= $unit['description'] ?></td>
            <td><?= $unit['date'] ?></td>
            <td><?= $unit['start'] ?></td>
            <td><?= $unit['size'] ?></td>
            <td><?= $unit['first_name'].' '.$unit['last_name'] ?></td>
            <td><?= $unit['category_id']?></td>
            <td><?= $unit['location_idlocation']?></td>
            <td><?= eventLevel($unit['level']) ?></td>
            <td><?= time_ago(strtotime($unit['created'])) ?></td>
            <td><a class="btn" href="/sportbuddy/event/<?= $unit['eventId'] ?>">Show</a></td>
            <?php if(!isset($_SESSION['user_id'])) {
                    echo '';
            } elseif (($_SESSION['user_id'] == $unit['created_by']) || ($_SESSION['admin'] == 2)) {
              echo
            '<td>
              <form method="delete" action="/sportbuddy/delete-event/'.$unit['eventId'].'/'.str_replace(' ', '_', $unit['name']).'">
              <input type="hidden" name="submit" value="submit">
              <input type="hidden" name="_method" value="DELETE">
              <button class="btn" href="">Delete</button>
              </form>
            </td>
            <td>
              <a class="btn" href="/sportbuddy/event/update-index/'.$unit['eventId'].'">Update</a>
            </td>';
            } else {
              '';
            }
            ?>
          </tr>
        <?php } ?>
        </table>


</div>






<?= $HTML_END ?>