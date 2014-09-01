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
        $speaker_names = "<p><i class='fa fa-cogs solo'></i>";
        $names = array();
        foreach ($contact_person as $speaker) {
            $names[] = "&nbsp;<a href='mailto:" . $speaker->email . "?subject=Bug Bash - $title'>" . $speaker->name . "</a>";
        }
        $speaker_names .= join(", ", $names);
        $speaker_names .= "</p>";
        return $speaker_names;
    }

    function speaker_names($contact_person)
    {
        $speaker_names = array();
        foreach ($contact_person as $speaker) {
            $speaker_names[] = $speaker->name;
        }
        return join(", ", $speaker_names);
    }