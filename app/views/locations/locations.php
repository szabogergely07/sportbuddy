<?= $ADMIN_START ?>

<?= isset($success) ?
    '<div class="alert alert-'.$notice.' fade in">
    <a href="#" class="close" data-dismiss="alert">&times;</a>
         '. $success . '
    </div>' : ''
?>

                    
    <!-- Modal Close Button -->
<div id="signup-form">
    <form method="post" class="single-form" id="" action="/sportbuddy/store-location">
    <input type="hidden" name="csrf_token" value="<?= csrf_token(); ?>">
    <input type="hidden" name="submit" value="submit">

    <div class="form-group row has-error has-feedback">

        <div class="col-xs-12 col-md-4 col-md-offset-4 fields">
            <!-- First Name -->
            <input name="name" class="form-control" type="text" placeholder="Name*" value="<?= isset($_POST['name']) && isset($data['name']) ? $_POST['name'] : '' ?>" id="inputWarning1">
            <div class="<?= isset($data['name']) ? 'invalid-feedback alert alert-danger' : 'valid-feedback' ?>">
                <?= isset($data['name']) ? '<strong> '.$data['name'].'</strong>' : '' ?>
            </div>
        </div>
    </div>
    
    <!-- Subject Button -->
    <div class="form-group row">
        <div class="btn-form text-center col-xs-12 col-md-4 col-md-offset-4">
            <button class="btn btn-fill">Create new location</button>
        </div>
    </div>
    </form>
</div>



        <h2>Locations</h2>


        <table>
          <tr>
            <th>Location Name</th>
            <th></th>
            <th></th>
           
          </tr>
        <?php foreach ($result as $unit) { ?>
          <tr>
            <td><?= $unit['name'] ?></td>
           
            
            <td>
              <form method="delete" action="/sportbuddy/delete-location/<?= $unit['locationId'] ?>" >
              <input type="hidden" name="submit" value="submit">
              <input type="hidden" name="_method" value="DELETE">
              <button class="btn" href="">Delete</button>
              </form>
            </td>
            <td>
              <a class="btn" href="/sportbuddy/locations/update-index/<?= $unit['locationId'] ?>">Update</a>
            </td>

          </tr>
        <?php } ?>
        </table>


</div>






<?= $ADMIN_END ?>