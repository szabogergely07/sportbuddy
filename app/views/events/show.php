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
        <th>Comment body</th>
        <th>Created by</th>
        <th>Date</th>
      </tr>
    <?php foreach ($comments as $comment) { ?>
      <tr>
        <td><?= $comment['body'] ?></td>
        <td><?= $comment['first_name'].' '.$comment['last_name'] ?></td>
        <td><?= $comment['created_at'] ?></td>
      </tr>
    <?php } ?>
    </table>

  <div id="signup-form">
    <form method="post" class="single-form" id="" action="/sportbuddy/store-comment/<?= $event->eventId ?>">
    <input type="hidden" name="csrf_token" value="<?= csrf_token(); ?>">
    <input type="hidden" name="submit" value="submit">

    <div class="col-xs-12">
        <h2 class="section-heading p-b-30">Create new comment</h2>
    </div>

    <div class="form-group row has-error has-feedback">
        <div class="col-xs-8 col-md-4 fields">
            <!-- First Name -->
            <textarea name="comment" id="" class="form-control" rows="4" placeholder="Your comment"><?= isset($_POST['name']) ? $_POST['name'] : '' ?></textarea>
            <div class="<?= isset($data['name']) ? 'invalid-feedback alert alert-danger' : 'valid-feedback' ?>">
                <?= isset($data['name']) ? '<strong> '.$data['name'].'</strong>' : '' ?>
            </div>
        </div>
    </div>
     <!-- Subject Button -->
    <div class="form-group row">
        <div class="btn-form text-center col-xs-12 col-md-4 ">
            <button class="btn btn-fill">Create</button>
        </div>
    </div>
  </form>
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