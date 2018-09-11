<?= $HTML_START ?>


<!-- Start: Features Section 9
        ====================================== -->
<section class="features-section-9 relative background-dark" id="pricing">

  <?= isset($success) ?
    '<div class="alert alert-success fade in">
    <a href="#" class="close" data-dismiss="alert">&times;</a>
         '. $success . '
    </div>' : ''
  ?>
      
    <div class="container">
        <div class="row section-separator text-center">
            
           


            <div class="clearfix"></div>

            <div class="pricing-table col-xs-12">
                <div class="row">
                     
<div style="margin-top: 15px;" class="each-table col-md-4 show-event">
  <div style="border-radius: 10px; box-shadow: inset 0 0 10px #000000;" class="inner text-center background-light">

      <h4 class="title"><?= $event->name ?></h4>

      <div class="category"><?= $event->category_id ?></div>

      <ul style="text-align: left;" class="nav rule-list">
          <li><strong>Date:</strong> <?= $event->date ?></li>
          <li><strong>Start:</strong> <?= $event->start ?></li>
          <li><strong>Size:</strong> <?= $event->size ?></li>
          <li><strong>Level:</strong> <?= eventLevel($event->level) ?></li>
          <li><strong>Location:</strong> <?= $event->location_idlocation ?></li>
          <li><strong>Organizer:</strong> <?= $event->first_name.' '.$event->last_name ?></li>
          <li><strong>Event created:</strong> <?= time_ago(strtotime($event->created)) ?></li>
      </ul>

      <div class="btn-form">
            
        <?php if(!isset($_SESSION['user_id'])) {
                        echo '';
            } elseif (($_SESSION['user_id'] == $event->created_by) || ($_SESSION['admin'] == 2)) {
              echo
              '<form style="display:inline!important;" method="delete" action="/sportbuddy/delete-event/'.$event->eventId.'/'.str_replace(' ', '_', $event->event_name).'">
              <input type="hidden" name="submit" value="submit">
              <input type="hidden" name="_method" value="DELETE">
              <button class="btn btn-primary btn-sm" href="">Delete</button>
              </form>
            
              <a class="btn btn-primary btn-sm" href="/sportbuddy/event/update-index/'.$event->eventId.'">Update</a>';
            } else {
              '';
            }
            ?>
                            </div>

                        </div> <!-- End: .table-single -->
                    </div> <!-- End: .each-table -->
                    
     <div style="margin-top: 15px;" class="each-table col-md-4">
  <div style="border-radius: 10px; box-shadow: inset 0 0 10px #000000;" class="inner text-center background-light">

      <h4 class="title">Description</h4>

      <div style="text-align: left;" class="detail"><p><?= $event->description ?></p></div>

      <h4 class="title">Joined users</h4>

 <?php foreach ($joined_users as $users) { ?>

      <div class="detail"><?= '<p>'.$users['first_name'].' '.$users['last_name'].'</p>' ?></div>
 <?php } ?>
  
 <div class="btn-form">
<?php 
    if(!isset($button)) { 
      echo '';
    } elseif (empty($button)) {
      echo           
      '<form method="post" action="/sportbuddy/join-event/'.$event->eventId.'">
      <input type="hidden" name="submit" value="submit">
      <button class="btn btn-primary btn-sm" href="">Join</button>
      </form>';
    } else {
      echo
      '<form method="delete" action="/sportbuddy/leave-event/'.$event->eventId.'">
      <input type="hidden" name="submit" value="submit">
      <input type="hidden" name="_method" value="DELETE">
      <button class="btn btn-primary btn-sm" href="">Leave</button>
      </form>';
    }
  ?>
</div>

      
                        </div> <!-- End: .table-single -->

                    </div> <!-- End: .each-table -->
             
<div style="margin-top: 15px;" class="each-table col-md-4">
  <div style="border-radius: 10px; box-shadow: inset 0 0 10px #000000;" class="inner text-center background-light">
    
    <div style="width: 300px; height: 300px;" id="map"></div>


    </div>
  </div>




                </div> <!-- End: .row -->
            </div> <!-- End: .pricing-table -->

        </div> <!-- End: .row -->
    </div> <!-- End: .container -->





<!-- NEW COMMENT -->
<?php
  if(isset($_SESSION['user_id'])) {
  echo

        '<div class="row text-center">
            
            <!-- Start: Section Header -->
            <div class="section-header">
                
                <h3 style="color: #e6e6e6;" class="section-heading">NEW COMMENT</h3>

            </div>
            <!-- End: Section Header -->

            <div class="clearfix"></div>

            <div class="pricing-table col-xs-12">
                <div class="row">
    <div style="margin-top: 15px; margin-bottom: 30px;" class="each-table col-md-4 col-md-offset-4">
  <div style="border-radius: 10px; box-shadow: inset 0 0 10px #000000;" class="inner text-center background-light">        


  <div id="signup-form">
    <form method="post" class="single-form" id="" action="/sportbuddy/store-comment/'.$event->eventId .'">
    <input type="hidden" name="csrf_token" value="'.csrf_token() .'">
    <input type="hidden" name="submit" value="submit">

    <div class="form-group row has-feedback">
        
            <!-- First Name -->
            <textarea name="comment" id="" class="form-control" rows="4" placeholder="Your comment">'.(isset($_POST['name']) ? $_POST['name'] : '').'</textarea>
            <div class="'.(isset($data['name']) ? 'invalid-feedback alert alert-danger' : 'valid-feedback' ).'">
                '. (isset($data['name']) ? $data['name'] : '' ).'
            </div>
        
    </div>
     <!-- Subject Button -->
    <div class="form-group row">
        <div class="btn-form text-center">
            <button class="btn btn-fill">Create</button>
        </div>
    </div>
  </form>
</div>

</div>
</div>
</div>
</div>
</div>';
}
?>



<!-- COMMENTS -->

        <div class="row text-center">
            
            <!-- Start: Section Header -->
            <div class="section-header">
                
                <h3 style="color: #e6e6e6;" class="section-heading">COMMENTS</h3>

            </div>
            <!-- End: Section Header -->

            <div class="clearfix"></div>

            <div class="pricing-table col-xs-12">
                <div class="row">
                     

<?php foreach ($comments as $comment) { ?>

<div style="margin-top: 15px;" class="each-table col-md-8 col-md-offset-2">
  <div style="border-radius: 10px; box-shadow: inset 0 0 10px #000000;" class="inner text-center background-light">

    <div style="text-align: left;" class="detail">
      <p><strong>Created by: <?= $comment['first_name'].' '.$comment['last_name'].', '.time_ago(strtotime($comment['created'])) ?></strong></p>
      <p><?= $comment['body'] ?></p>
    </div>

    <div class="btn-form">
       <?php if(!isset($_SESSION['user_id'])) {
                    echo '';
            } elseif (($_SESSION['user_id'] == $comment['userId']) || ($_SESSION['admin'] == 2)) {
              echo
            '
              <form method="delete" action="/sportbuddy/delete-comment/'.$comment['commentId'].'/'.$event->eventId.'">
              <input type="hidden" name="submit" value="submit">
              <input type="hidden" name="_method" value="DELETE">
              <button class="btn btn-primary btn-sm" href="">Delete</button>
              </form>
            ';
            } else {
              echo '';
            }
        ?>


    </div>

 
</div>
</div>
<?php } ?>

</div>
</div>
</div>


</section>

        <!-- End: Features Section 9 
        ======================================-->










<?= $HTML_END ?>