<?= HTML_START ?>

<h2>Users</h2>

<table>
  <tr>
    <th>FirstName</th>
    <th>LastName</th>
    <th>Email</th>
    <th>Birthday</th>
    <th></th>
  </tr>
<?php foreach ($names as $unit) { ?>
  <tr>
    <td><?= $unit['first_name'] ?></td>
    <td><?= $unit['last_name'] ?></td>
    <td><?= $unit['email'] ?></td>
    <td><?= $unit['birthday'] ?></td>
    <td>
      <a class="btn" href="user/<?= $unit['id'] ?>">Show</a>
      <a class="btn" href="user/update-index/<?= $unit['id'] ?>">Update</a>
      <a class="btn" href="user/delete/<?= $unit['id'] ?>">Delete</a>
    </td>
  </tr>
<?php } ?>
</table>

<?= HTML_END ?>