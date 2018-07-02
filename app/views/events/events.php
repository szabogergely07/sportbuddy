<?php
require_once('../../config.php');


$events = R::getAll("SELECT name, description, date, start, size, first_name FROM event 
    JOIN user_has_event ON user_has_event.event_id = event.id
    JOIN user ON user.id = user_has_event.user_id;");

?><!DOCTYPE html>
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

<a href="../../index.php"><h2>Home</h2></a>
<a href="../users/register.php"><h2>Register</h2></a>
<a href="../users/users.php"><h2>Users</h2></a>
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

</body>
</html>