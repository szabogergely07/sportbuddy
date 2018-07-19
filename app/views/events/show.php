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
    <table>
      <tr>
        <th>Joined users</th>
      </tr>
        <?php foreach ($joined_users as $users) { ?>
      <tr>
        <td><?= $users['first_name'].' '.$users['last_name'] ?></td>
      </tr>
      <?php } ?>
    </table>


  <?php 
    if(!isset($button)) { 
      echo '';
    } elseif (empty($button)) {
      echo           
      '<form method="post" action="/sportbuddy/join-event/'.$event->eventId.'">
      <input type="hidden" name="submit" value="submit">
      <button class="btn" href="">Join</button>
      </form>';
    } else {
      echo
      '<form method="delete" action="/sportbuddy/leave-event/'.$event->eventId.'">
      <input type="hidden" name="submit" value="submit">
      <input type="hidden" name="_method" value="DELETE">
      <button class="btn" href="">Leave</button>
      </form>';
    }
  ?>

        <div class="form-actions">
          <a class="btn" href="/sportbuddy/events">Back</a>
       </div>
     
      
    </div>
</div>
 
    </div> <!-- /container -->
 
<?= $HTML_END ?>