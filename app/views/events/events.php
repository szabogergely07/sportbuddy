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
<a href="users"><h2>Users</h2></a>
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