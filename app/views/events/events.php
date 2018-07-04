<?= HTML_START ?>

        <h2>Events</h2>


        <table>
          <tr>
            <th>Event Name</th>
            <th>Description</th>
            <th>Date</th>
            <th>Start Time</th>
            <th>Size</th>
            <th>Created by</th>
          </tr>
        <?php foreach ($events as $unit) { ?>
          <tr>
            <td><?= $unit['name'] ?></td>
            <td><?= $unit['description'] ?></td>
            <td><?= $unit['date'] ?></td>
            <td><?= $unit['start'] ?></td>
            <td><?= $unit['size'] ?></td>
            <td><?= $unit['first_name'] ?></td>
          </tr>
        <?php } ?>
        </table>

</div>






<?= HTML_END ?>