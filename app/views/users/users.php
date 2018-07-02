<!DOCTYPE html>
<html>
<head>
<style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
</style>
</head>
<body>
<a href="/sportbuddy"><h2>Home</h2></a>
<a href="register"><h2>Register</h2></a>
<a href="events"><h2>Events</h2></a>


<h2>Users</h2>

<table>
  <tr>
    <th>FirstName</th>
    <th>LastName</th>
    <th>Email</th>
    <th>Birthday</th>
    <th>Event</th>
  </tr>
<?php foreach ($names as $unit) { ?>
  <tr>
    <td><?= $unit['first_name'] ?></td>
    <td><?= $unit['last_name'] ?></td>
    <td><?= $unit['email'] ?></td>
    <td><?= $unit['birthday'] ?></td>
    <td><a class="btn" href="user/<?= $unit['id'] ?>">Read</a></td>
  </tr>
<?php } ?>
</table>

</body>
</html>