<?php
    $bash = $data['bash_info'];
    $attendees = $bash['attendees'];
    $contact_person = json_decode($bash['contact_person']);
?>

    <div>
        <div class="row">
            <div class="col-lg-6">
                <h3 style="margin-bottom: 30px; text-align: center"><?php echo $bash['title']?></h3>
                <div>
                    <div class="well">
                        <?php echo project_image($bash['project_link'], $bash['project_logo_url']) ?>
                        <div class='clearfix'>
                            <p><i class='fa fa-clock-o solo'></i>&nbsp;<?php echo $bash['start_time']?></p>
                            <p><i class='fa fa-location-arrow solo'></i>&nbsp;Location: <a href='<?php echo $bash['location_url']?>' target='_blank'><?php echo $bash['location']?></a></p>
                            <?php echo contact_person_name_with_links($contact_person, $bash['title']) ?>
                            <p>
                                <a href='<?php echo $bash['pictures']?>'><i class='fa fa-picture-o solo'></i> Pictures</a>&nbsp;&nbsp;
                                <a href='<?php echo $bash['video']?>'><i class='fa fa-video-camera solo'></i> Video</a>&nbsp;&nbsp;
                                <a href='<?php echo $bash['project_link']?>' target='_blank'><i class='fa fa-link solo'></i></a>
                            </p>
                            <p>
                                <a href="#attendees"><span class='badge' style='background: #FFBB66; color: #000000'><?php echo count($attendees)?> Participants</span></a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class='well bs-component'>
                    <form class='form-horizontal' method='post' action='/<?php echo $bash['id'] ?>/register'>
                        <fieldset>
                            <legend>Registration</legend>
                            <div class='form-group'>
                                <label for='participant_name' class='col-lg-2 control-label'>Name<sup>*</sup></label>
                                <div class='col-lg-10'>
                                    <input type='text' class='form-control' id='participant_name' name='participant_name' placeholder='Your Name (2-100 chars)' pattern='.{2,100}' required title='Enter a valid name, which is 2-100 chars'>
                                </div>
                            </div>
                            <div class='form-group'>
                                <label for='email' class='col-lg-2 control-label'>Email<sup>*</sup></label>
                                <div class='col-lg-10'>
                                    <input type='email' class='form-control' id='email' name='email' placeholder='Email Address' pattern='.{5,100}' required title='Enter a valid email address'>
                                </div>
                            </div>
                            <div class='form-group'>
                                <label for='org' class='col-lg-2 control-label'>Organisation<sup>*</sup></label>
                                <div class='col-lg-10'>
                                    <input type='text' class='form-control' id='org' name='org' placeholder='Name of your Organisation (2-100 chars)' pattern='.{2,100}' required title='Enter a valid org name, which is 2-100 chars'>
                                </div>
                            </div>
                            <div class='form-group'>
                                <div class='col-lg-10 col-lg-offset-2'>
                                    <button class='btn btn-default' data-dismiss='modal'>Cancel</button>
                                    <button type='submit' class='btn btn-primary'>Submit</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <p class="lead"><?php echo $bash['description']?></p>
            </div>
        </div>
        <a name="attendees"></a>
        <div class="row">
            <h3>Registered Participants</h3>
            <div class="col-lg-6">
                <?php echo attendee_table($attendees) ?>
            </div>
        </div>
    </div>


