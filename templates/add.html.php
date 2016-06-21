<div class='well bs-component'>
    <form id="theForm" class='form-horizontal' method='post' action='/add'>
        <fieldset>
            <legend>Add a Bug Bash</legend>
            <div class='form-group'>
                <label for='session_title' class='col-lg-2 control-label'>Title<sup>*</sup></label>
                <div class='col-lg-10'>
                    <input type='text' class='form-control' id='session_title' name='session_title' placeholder='Bug Bash Title (2-255 chars)' pattern='.{2,254}' required title='Enter a valid title, which is 2-254 chars'>
                </div>
            </div>
            <div class='form-group'>
                <label for='session_description' class='col-lg-2 control-label'>Description<sup>*</sup></label>
                <div class='col-lg-10'>
                    <textarea class="form-control" id='session_description' name='session_description' placeholder='Bug Bash Abstract' title='Enter a valid abstract'></textarea>
                </div>
            </div>
            <div class='form-group'>
                <label for='session_project_link' class='col-lg-2 control-label'>Project Link<sup>*</sup></label>
                <div class='col-lg-10'>
                    <input type="url" class="form-control" id='session_project_link' name='session_project_link' placeholder='Project Link' required title='Enter a valid Project Link'>
                </div>
            </div>
            <div class='form-group'>
                <label for='session_project_logo_url' class='col-lg-2 control-label'>Project Logo Link<sup>*</sup></label>
                <div class='col-lg-10'>
                    <input type="url" class="form-control" id='session_project_logo_url' name='session_project_logo_url' placeholder='Project Logo URL' required title='Enter a valid Project Logo URL'>
                </div>
            </div>
            <div class='form-group'>
                <label for='session_contact_details' class='col-lg-2 control-label'>Contact Details<sup>*</sup></label>
                <div class='col-lg-10'>
                    <input type="text" class="form-control" id='session_contact_details' name='session_contact_details' placeholder='Contact Person Name and Email' required title='Enter a valid Name and Email Address'>
                </div>
            </div>
            <div class='form-group'>
                <label for='session_location' class='col-lg-2 control-label'>Venue<sup>*</sup></label>
                <div class='col-lg-10'>
                    <input type='text' class='form-control' id='session_location' name='session_location' placeholder='Venue Name' pattern='.{2,254}' required title='Enter a valid venue name, which is 2-254 chars' value="Chancery Pavilion, #135, Residency Road, Bangalore">
                </div>
            </div>
            <div class='form-group'>
                <label for='session_location_url' class='col-lg-2 control-label'>Venue URL<sup>*</sup></label>
                <div class='col-lg-10'>
                    <input type='url' class='form-control' id='session_location_url' name='session_location_url' placeholder='Google Maps Link' required value="https://goo.gl/maps/ZskdrpEiGh22">
                </div>
            </div>
            <div class='form-group'>
                <label for='session_start_time' class='col-lg-2 control-label'>Start Time<sup>*</sup><br>(yyyy-MM-dd HH:mm:ss)</label>
                <div class='col-lg-10'>
                    <input type='datetime' class='form-control' id='session_start_time' name='session_start_time' placeholder='Session Start Date and Time in yyyy-MM-dd HH:mm:ss format' required value="2015-08-15 18:30:00">
                </div>
            </div>
            <div class='form-group'>
                <label for='session_end_time' class='col-lg-2 control-label'>End Time<sup>*</sup></label>
                <div class='col-lg-10'>
                    <input type='datetime' class='form-control' id='session_end_time' name='session_end_time' placeholder='Session Start Date and Time in yyyy-MM-dd HH:mm:ss format' required value="2015-08-16 18:30:00">
                </div>
            </div>
            <div class='form-group'>
                <label for='session_pictures' class='col-lg-2 control-label'>Link to Pictures</label>
                <div class='col-lg-10'>
                    <input type='url' class='form-control' id='session_pictures' name='session_pictures' placeholder='Links to the pictures from this Bug Bash'>
                </div>
            </div>
            <div class='form-group'>
                <label for='session_video' class='col-lg-2 control-label'>Link to Video</label>
                <div class='col-lg-10'>
                    <input type='url' class='form-control' id='session_video' name='session_video' placeholder='Links to the video'>
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

<?php include_once __DIR__ . "/inc/tinymce.php"?>