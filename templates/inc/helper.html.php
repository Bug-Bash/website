<?php
function bash_link($bash_id, $title)
{
    return "<li><a href='/$bash_id'>$title</a></li>";
}

function desc_window($bash_id, $title, $desc)
{
    return "<div class='modal fade' id='{$bash_id}_desc_modal' tabindex='-1' role='dialog' aria-labelledby='{$bash_id}_desc_label' aria-hidden='true'>
                  <div class='modal-dialog'>
                    <div class='modal-content'>
                      <div class='modal-header'>
                        <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                        <h4 class='modal-title' id='myModalLabel'>{$title}</h4>
                      </div>
                      <div class='modal-body'>$desc</div>
                    </div>
                  </div>
                </div>";
}

function bash_badge($bash, $attendees, $present)
{
    $contact_person = json_decode($bash['contact_details']);
    $project_link = $bash['project_link'];
    $project_logo_url = $bash['project_logo_url'];
    $time_range = time_range($bash);
    $badge = "<div><a name='{$bash['id']}'></a>"
        . project_image($project_link, $project_logo_url) . "<div class='clearfix'>
                <p><a href='/{$bash['id']}'>{$bash['title']}</a></p>
                <p><i class='fa fa-clock-o solo'></i>&nbsp;$time_range</p>
                <p><i class='fa fa-location-arrow solo'></i>&nbsp;Location: <a href='{$bash['location_url']}' target='_blank'>{$bash['location']}</a></p>"
        . contact_person_name_with_links($contact_person, $bash['title']);
    if ($bash['id'] != 'add') {
        $badge .= "<p><i class='fa fa-user solo'></i>&nbsp;Bashers: <a href='#' data-toggle='modal' data-target='#".$bash['id']."_attendees_modal'><span class='badge' style='background: #FFBB66; color: #000000'>". count($attendees) ." Participants</span></a></p>";
        $badge .= "<p>";
        $badge .= "<a href='{$bash['pictures']}'><i class='fa fa-picture-o solo'></i> Pictures</a>&nbsp;&nbsp;";
        $badge .= "<a href='{$bash['video']}'><i class='fa fa-video-camera solo'></i> Video</a>&nbsp;&nbsp;";
        $badge .= "<a href='{$bash['project_link']}' target='_blank'><i class='fa fa-link solo'></i></a>&nbsp;&nbsp;";
        $badge .= "<p>";
        if ($present)
            $badge .= "<p style='text-align: center; margin-bottom: -5px'><a class='btn btn-primary btn-xs' href='/{$bash['id']}'>Participate</a></p>";
        $badge .= attendees_window($bash['id'], $bash['title'], $attendees);
    }
    return $badge . "</div></div>";
}

function attendees_window($bash_id, $title, $attendees)
{
    $modal = "<div class='modal fade' id='{$bash_id}_attendees_modal' tabindex='-1' role='dialog' aria-labelledby='{$bash_id}_label' aria-hidden='true'>
                  <div class='modal-dialog'>
                    <div class='modal-content'>
                      <div class='modal-header'>
                        <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                        <h4 class='modal-title' id='myModalLabel'>Attendees for {$title}</h4>
                      </div>
                      <div class='modal-body'>";
    $modal .= attendee_table($attendees);
    $modal .= "</div>
                    </div>
                  </div>
                </div>";
    return $modal;
}

function attendee_table($attendees)
{
    $table = "<div class='bs-component'>
              <table class='table table-striped table-hover'>
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Org. Name</th>
                  </tr>
                </thead>
                <tbody>";
    if (count($attendees) == 0)
        $table .= "<tr><td colspan='3' style='text-align: center'>Be the first to register...</td></tr>";
    else {
        $attendee_count = 0;
        foreach ($attendees as $attendee) {
            $attendee_count++;
            $participant_name = htmlspecialchars($attendee['participant_name']);
            $org = htmlspecialchars($attendee['org']);
            $table .= "<tr><td>$attendee_count</td><td>$participant_name</td><td>$org</td></tr>";
        }
    }
    $table .= "</tbody>
              </table>
            </div>";
    return $table;
}

function project_image($project_link, $project_logo_url)
{
    return "<span style='float: left; margin-right: 20px;'>
              <a href='$project_link' target='_blank'><img src='$project_logo_url'></a>
            </span>";
}

function contact_person_name_with_links($contact_person, $title)
{
    $speaker_names = "<p><i class='fa fa-microphone solo'></i>";
    $names = [];
    foreach ($contact_person as $speaker) {
        $names[] = "&nbsp;&nbsp;<a href='mailto:" . $speaker->email . "?subject=Bug Bash - $title'>" . $speaker->name . "</a>";
    }
    $speaker_names .= join(", ", $names);
    $speaker_names .= "</p>";
    return $speaker_names;
}

function speaker_names($contact_person)
{
    $speaker_names = [];
    foreach ($contact_person as $speaker) {
        $speaker_names[] = $speaker->name;
    }
    return join(", ", $speaker_names);
}

function time_range($bash)
{
    $time_range = $bash['start_time'];
    if (!empty($bash['end_time'])) {
        $time_range = date('D jS M g:i A', strtotime($bash['start_time'])) . ' - ' . date("D jS M 'y g:i A", strtotime($bash['end_time']));
    }
    return $time_range;
}