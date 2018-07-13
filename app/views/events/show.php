<?= $HTML_START ?>

    <div class="container">
     
<div class="span10 offset1">
    
    <div class="row">
        <h2><?= $event->name ?></h2>
    </div>
     
    <div class="form-horizontal" >
      <div class="control-group">
        <label class="control-label">Name</label>
        <div class="controls">
            <label class="checkbox">
                <?= $event->name ?>
            </label>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label">Description</label>
        <div class="controls">
            <label class="checkbox">
                <?= $event->description ?>
            </label>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label">Date</label>
        <div class="controls">
            <label class="checkbox">
                <?= $event->date ?>
            </label>
        </div>
      </div>
    
        <div class="form-actions">
          <a class="btn" href="/sportbuddy/events">Back</a>
       </div>
     
      
    </div>
</div>
 
    </div> <!-- /container -->
 
<?= $HTML_END ?>