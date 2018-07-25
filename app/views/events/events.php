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
            <td><a class="btn" href="/sportbuddy/events/<?= $unit['eventId'] ?>">Show</a></td>
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
              <a class="btn" href="/sportbuddy/events/update-index/'.$unit['eventId'].'">Update</a>
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