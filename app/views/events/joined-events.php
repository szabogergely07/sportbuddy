<?= $HTML_START ?>

<?= isset($success) ?
    '<div class="alert alert-'.$notice.' fade in">
    <a href="#" class="close" data-dismiss="alert">&times;</a>
         '. $success . '
    </div>' : ''
?>



<!-- Start: Features Section 9
        ====================================== -->
<section class="features-section-9 relative background-dark" id="pricing">
    <div class="container">
        <div class="row section-separator text-center">
            
            <!-- Start: Section Header -->
            <div class="section-header">
                
                <h1 style="color: #e6e6e6;" class="section-heading">Your joined events</h1>

            </div>
            <!-- End: Section Header -->


<?= isset($_SESSION['user_id']) ?
'<div class="container section-header">
    <button class= "btn btn-fill" onClick="javascript: window.location=\'/sportbuddy/create-event\'">Create New Event</button>
</div>' : ''
?>





            <div class="clearfix"></div>

            <div class="pricing-table col-xs-12">
                <div class="row">
          
          <?php foreach ($events as $unit) { ?>           
                    <div style="margin-top: 15px;" class="each-table col-md-4 all-events">
                        <div onclick="location.href='/sportbuddy/event/<?= $unit['eventId'] ?>';" style="border-radius: 10px; cursor: pointer; box-shadow: inset 0 0 10px #000000;" class="inner text-center background-light">

                            <h4 class="title"><?= $unit['event_name'] ?></h4>

                            <div class="category"><?= $unit['category_id'] ?></div>

                            <ul style="text-align: left;" class="nav rule-list">
                                <li><strong>Date:</strong> <?= $unit['date'] ?></li>
                                <li><strong>Start:</strong> <?= $unit['start'] ?></li>
                                <li><strong>Size:</strong> <?= $unit['size'] ?></li>
                                <li><strong>Level:</strong> <?= eventLevel($unit['level']) ?></li>
                                <li><strong>Location:</strong> <?= $unit['location'] ?></li>
                                <li><strong>Organizer:</strong> <?= $unit['first_name'].' '.$unit['last_name'] ?></li>
                                <li><strong>Event created:</strong> <?= time_ago(strtotime($unit['created'])) ?></li>
                            </ul>

                            <div class="btn-form">
                                
        <?php if(!isset($_SESSION['user_id'])) {
                        echo '';
            } elseif (($_SESSION['user_id'] == $unit['created_by']) || ($_SESSION['admin'] == 2)) {
              echo
              '<form style="display:inline!important;" method="delete" action="/sportbuddy/delete-event/'.$unit['eventId'].'/'.str_replace(' ', '_', $unit['event_name']).'">
              <input type="hidden" name="submit" value="submit">
              <input type="hidden" name="_method" value="DELETE">
              <button class="btn btn-primary btn-sm" href="">Delete</button>
              </form>
            
              <a class="btn btn-primary btn-sm" href="/sportbuddy/event/update-index/'.$unit['eventId'].'">Update</a>';
            } else {
              '';
            }
            ?>
                            </div>

                        </div> <!-- End: .table-single -->
                    </div> <!-- End: .each-table -->
<?php } ?>
                    
                </div> <!-- End: .row -->
            </div> <!-- End: .pricing-table -->

        </div> <!-- End: .row -->
    </div> <!-- End: .container -->
</section>

        <!-- End: Features Section 9 
        ======================================-->

<?= $HTML_END ?>