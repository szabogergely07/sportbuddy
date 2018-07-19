<?= $HTML_START ?>

<?= isset($success) ?
    '<div class="alert alert-'.$notice.' fade in">
    <a href="#" class="close" data-dismiss="alert">&times;</a>
         '. $success . '
    </div>' : ''
?>


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
      <a class="btn" href="/sportbuddy/user/<?= $unit['userId'] ?>">Show</a>
      <a class="btn" href="/sportbuddy/user/update-index/<?= $unit['userId'] ?>">Update</a>
      
      <form method="delete" action="/sportbuddy/user/delete/<?= $unit['userId'] ?>">
      <input type="hidden" name="submit" value="submit">
      <input type="hidden" name="_method" value="DELETE">
      <button class="btn" href="">Delete</button>
      </form>
    </td>
  </tr>
<?php } ?>
</table>

<?= $HTML_END ?>