<?= HTML_START ?>

    <div class="container">
     
<div class="span10 offset1">
    <?php foreach ($user as $unit) { ?>
    <div class="row">
        <h2><?= $unit['first_name'] ?></h2>
    </div>
     
    <div class="form-horizontal" >
      <div class="control-group">
        <label class="control-label">Name</label>
        <div class="controls">
            <label class="checkbox">
                <?= $unit['first_name'] . " " . $unit['last_name'] ?>
            </label>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label">Email Address</label>
        <div class="controls">
            <label class="checkbox">
                <?= $unit['email'] ?>
            </label>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label">Birthday</label>
        <div class="controls">
            <label class="checkbox">
                <?= $unit['birthday'] ?>
            </label>
        </div>
      </div>
      <?php } ?>
        <div class="form-actions">
          <a class="btn" href="/sportbuddy/users">Back</a>
       </div>
     
      
    </div>
</div>
 
    </div> <!-- /container -->
 
<?= HTML_END ?>