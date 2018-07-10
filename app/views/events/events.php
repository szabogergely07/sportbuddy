<?= HTML_START ?>

<?= isset($success) ?
    '<div class="alert alert-'.$notice.' fade in">
    <a href="#" class="close" data-dismiss="alert">&times;</a>
         '. $success . '
    </div>' : ''
?>

<div class="container">
    <button>
        <a href="/sportbuddy/create-event">Create New Event</a>
    </button>
</div>
        <h2>Events</h2>


        <table>
          <tr>
            <th>Event Name</th>
            <th>Description</th>
            <th>Date</th>
            <th>Start Time</th>
            <th>Size</th>
            <th>Created by</th>
            <th></th>
          </tr>
        <?php foreach ($events as $unit) { ?>
          <tr>
            <td><?= $unit['name'] ?></td>
            <td><?= $unit['description'] ?></td>
            <td><?= $unit['date'] ?></td>
            <td><?= $unit['start'] ?></td>
            <td><?= $unit['size'] ?></td>
            <td><?= $unit['first_name'] ?></td>
            <td><a class="btn" href="/sportbuddy/events/<?= $unit['id'] ?>">Show</a></td>
          </tr>
        <?php } ?>
        </table>

</div>






<?= HTML_END ?>