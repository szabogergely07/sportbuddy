<?= $ADMIN_START ?>

    <div class="container">
     
<div class="span10 offset1">
    
    <div class="row">
        <h2><?= $user->first_name ?></h2>
    </div>
     
    <div class="form-horizontal" >
      <div class="control-group">
        <label class="control-label">Name</label>
        <div class="controls">
            <label class="checkbox">
                <?= $user->first_name. " " .$user->last_name ?>
            </label>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label">Email Address</label>
        <div class="controls">
            <label class="checkbox">
                <?= $user->email ?>
            </label>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label">Birthday</label>
        <div class="controls">
            <label class="checkbox">
                <?= $user->birthday ?>
            </label>
        </div>
      </div>
    
        <div class="form-actions">
          <a class="btn" href="/sportbuddy/users">Back</a>
       </div>
     
      
    </div>
</div>
 
    </div> <!-- /container -->
 
<?= $ADMIN_END ?>