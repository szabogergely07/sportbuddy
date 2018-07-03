<?= HTML_START ?>
            
                
                    
                    <!-- Modal Close Button -->
                    
                    <form method="post" class="single-form" action="/sportbuddy/createuser">
                        <input type="hidden" name="submit" value="submit">

                        <div class="col-xs-12 text-center">
                            <h2 class="section-heading p-b-30">Register</h2>
                        </div>
                        
                        <div class="form-group has-error has-feedback">
                        
                        <div class="col-xs-12 fields">
                            <!-- First Name -->
                            <input name="first_name" class="form-control" type="text" placeholder="First Name*" value="" required="" id="inputWarning1">
                        
                           
                        </div>
                        </div>
                        <div class="col-xs-12 fields">
                            <!-- Last Name -->
                            <input name="last_name" class="contact-last-name form-control " type="text" placeholder="Last Name*" value="" required="">
                            
                        </div>
                        <div class="col-xs-12">
                            <!-- Email -->
                            <input name="email" class="contact-email form-control" type="email" placeholder="Email*" value="" required="">
                            
                        </div>
                        <div class="col-xs-12">
                            <!-- Subject -->
                            <input name="password" class="contact-password form-control " type="pass" placeholder="Password">
                            
                        </div>
                        <div class="col-xs-12">
                            <!-- Subject -->
                            <input name="password2" class="contact-cmp-password form-control" type="pass" placeholder="Confirm Password">
                        </div>
                        <div class="col-xs-12">
                            <!-- Email -->
                            <input name="birthday" type="" class="contact-first-name form-control " placeholder="Birthday*" value="" required="">
                            
                        </div>
                        
                        <!-- Subject Button -->
                        <div class="btn-form text-center col-xs-4">
                            <button class="btn btn-fill">Sign Up</button>
                        </div>
                    </form>

               
       <?= HTML_END ?>