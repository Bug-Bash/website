<?php
    function project_image($project_link, $project_logo_url)
    {
        return "<span style='float: left; margin-right: 15px;'>
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

    function bash_badge($bash, $future_bashes = TRUE)
    {
        $contact_person = json_decode($bash['contact_person']);
        $project_link = $bash['project_link'];
        $project_logo_url = $bash['project_logo_url'];
        $badge = "<div><a name='{$bash['id']}'></a>"
            . project_image($project_link, $project_logo_url) . "<div class='clearfix'>
                <p><a data-toggle='modal' data-target='#{$bash['id']}_desc_modal'>{$bash['title']}&nbsp;<i class='fa fa-external-link solo'></i></a></p>
                <p><i class='fa fa-clock-o solo'></i>&nbsp;{$bash['start_time']}</p>
                <p><i class='fa fa-location-arrow solo'></i>&nbsp;Location: <a href='{$bash['location_url']}' target='_blank'>{$bash['location']}</a></p>"
            . contact_person_name_with_links($contact_person, $bash['title']);
        if ($bash['id'] != 'unknown') {
            $attendees = $bash['attendees'];
            $badge .= "<p>";
            $badge .= "<a href='{$bash['pictures']}'><i class='fa fa-picture-o solo'></i> Pictures</a>&nbsp;&nbsp;";
            $badge .= "<a href='{$bash['video']}'><i class='fa fa-video-camera solo'></i> Video</a>&nbsp;&nbsp;";
            $badge .= "<a href='{$bash['project_link']}' target='_blank'><i class='fa fa-link solo'></i></a>&nbsp;&nbsp;
            <a href='#' data-toggle='modal' data-target='#{$bash['id']}_modal'><span class='badge' style='background: #FFBB66; color: #000000'>" . count($attendees) . " Participants</span></a>
            </p>";
            if ($future_bashes) {
                $badge .= "<p style='text-align: center; margin-bottom: -5px'><button class='btn btn-primary btn-xs' data-toggle='modal' data-target='#{$bash['id']}_modal'>Join the Bash!</button></p>";
                $badge .= modal_window($bash['id'], $bash['title'], $attendees);
            }
        }
        $badge .= desc_window($bash['id'], $bash['title'], $bash['description']);
        return $badge . "</div></div>";
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

    function modal_window($bash_id, $title, $attendees)
    {
        $modal = "<div class='modal fade' id='{$bash_id}_modal' tabindex='-1' role='dialog' aria-labelledby='{$bash_id}_label' aria-hidden='true'>
                  <div class='modal-dialog'>
                    <div class='modal-content'>
                      <div class='modal-header'>
                        <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                        <h4 class='modal-title' id='myModalLabel'>Register for {$title}</h4>
                      </div>
                      <div class='modal-body'>";
        $modal .= registration_form($bash_id);
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

    function registration_form($bash_id)
    {
        return "<div class='well bs-component'>
              <form class='form-horizontal' method='post' action='/register'>
                <fieldset>
                  <legend>Registration</legend>
                  <input type='hidden' name='bash_id' value='$bash_id'>
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
            </div>";
    }

    function display_bashes($bashes, $future_bashes = TRUE)
    {
        if(empty($bashes)){
            echo '<h4>Coming soon...</h4>';
            return;
        }
        $count = 0;
        foreach ($bashes as $bash) {
            $count++;
            if ($count % 2 == 1) echo '<div class="row" style="margin-top: 40px">';
            echo '<div class="col-lg-6"><div class="well">';
            echo bash_badge($bash, $future_bashes);
            echo '</div></div>';
            if ($count % 2 == 0) echo '</div>';
        }
        if ($count % 2 == 1) echo '</div>';
    }

    function bash_link($bash)
    {
        return "<li><a href='#{$bash['id']}'>{$bash['title']}</a></li>";
    }

    $upcoming_bashes = $data['upcoming'];
?>

<div class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a href="/" class="navbar-brand">Bug Bash</a>
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="navbar-collapse collapse" id="navbar-main">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="upcoming-bash">Upcoming Bashes <span class="caret"></span></a>
                    <ul class="dropdown-menu" aria-labelledby="themes">
                        <?php foreach ($upcoming_bashes as $bash) {
                            echo bash_link($bash);
                        }?>
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="past-bash">Past Bashes <span class="caret"></span></a>
                    <ul class="dropdown-menu" aria-labelledby="themes">
                        <?php foreach ($data['past'] as $bash) {
                            echo bash_link($bash);
                        }?>
                    </ul>
                </li>
                <li>
                    <a href="#about_us">About Us</a>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li><a href="https://www.google.com/calendar/embed?src=bugbash.in%40gmail.com&ctz=Asia/Calcutta" target="_blank"><i class="fa fa-calendar solo"></i></a></li>
                <li><a href="https://plus.google.com/103867024485148277333/about" target="_blank"><i class="fa fa-google-plus solo"></i></a></li>
                <li><a href="https://www.facebook.com/bugbash.in" target="_blank"><i class="fa fa-facebook solo"></i></a></li>
                <li><a href="https://github.com/bugbash/" target="_blank"><i class="fa fa-github solo"></i></a></li>
                <li><a href="https://twitter.com/bugbash_in" target="_blank"><i class="fa fa-twitter solo"></i>&nbsp;@bugbash_in</a></li>
                <li><a href="mailto:bugbash.in@gmail.com?subject=BugBash"><i class="fa fa-envelope solo"></i>&nbsp;Contact Us</a></li>
            </ul>
        </div>
    </div>
</div>


<div class="container">
    <div class="page-header" id="banner">
        <div class="row">
            <div class="col-lg-6">
                <h3>Given enough minds, all bugs are shallow!</h3>
                <p class="lead">Bug Bash is a platform for testers to showcase their testing skills and to discover open-source projects that need automation and exploratory testing.</p>
                <p class="lead">Let's pound-on-these-products, as a community to find bugs and show-off our automation skills.</p>
            </div>
            <div class="col-lg-6" style="padding: 0 15px;">
                <div class="well sponsor">
                    <h4 style="margin-top: 0; text-align: center">Next Bash!</h4>
                    <?php reset($upcoming_bashes);
                        echo bash_badge(current($upcoming_bashes)) ?>
                </div>
            </div>
        </div>
    </div>

    <div style="margin-top: -30px">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-header">
                    <h2 id="type">Upcoming Bashes</h2>
                </div>
            </div>
        </div>

        <!-- Headings -->
        <?php
            reset($upcoming_bashes);
            array_shift($upcoming_bashes);
            $upcoming_bashes[] = $data['default'];
            display_bashes($upcoming_bashes);
        ?>
    </div>

    <div style="margin-top: -30px">
        <div class="row">
            <div class="col-lg-12">
                <div class="page-header">
                    <h2 id="type">Past Bashes</h2>
                </div>
            </div>
        </div>

        <!-- Headings -->
        <?php
            display_bashes($data['past'], FALSE);
        ?>
    </div>

    <div style="margin-top: 30px">
        <a name="about_us"></a>

        <div class="row">
            <div class="col-lg-12">
                <div class="page-header">
                    <h2>About Us</h2>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="lead">
                    <p>As part of the <a href="http://seleneiumconf.org">Selenium Conf 2014</a> organising committee, <a href="http://nareshjain.com">Naresh Jain</a> was planning to host a bug bash at the conference. The idea was to get the conference participants to help a non-profit organisation by creating a nice test
                        automation suite for them. And we wanted to reward people, who found the most bugs plus those who created the best test suite. During discussions with <a href="http://blog.bettersoftwaretesting.com/author/admin/" target="_blank">Julian Harty</a>, he suggested we consider the
                        <a href="http://www.kiwix.org/wiki/Main_Page" target="_blank">Kiwix project</a> and also involve some exploratory testing experts. When we proposed this to the Kiwix project, they really liked the idea. Thus began the first bug bash of this nature.</p>

                    <p style="font-weight: bold; font-style: italic">So we organize a bug bash and everyone is happy, but should it stop here?</p>

                    <p>In the past, when Naresh had tried to hire good quality testers. he always found it hard to do enough online background check for testers. If you think about it, designers have platforms like <a href="https://dribbble.com/" target="_blank">dribble</a> to showcase their work. Developers, have are platforms like <a href="http://www.topcoder.com/" target="_blank">TopCoder</a> or <a href="http://www.codechef.com/" target="_blank">CodeChef</a> where they can showcase their skills. However for testers, there is nothing like this. To some extent, platforms like <a href="http://stackoverflow.com" target="_blank">StackOverflow</a> and <a href="https://github.com" target="_blank">GitHub</a> can give you a sense of the tester's skills, but it does not really have a profile/other necessary info in one place.</p>

                    <p>In the near future, Bug Bash aspires to fill this void by creating a one-stop destination to see the complete profile of a tester. It will also help organisations find a thriving community of testers to test their products.</p>

                    <p>Please email <a href="mailto:bugbash.in@gmail.com?subject=Bug Bash">Naresh</a>, if:</p>
                    <ul>
                        <li>you are interested in nominating your open source project for a bug bash or</li>
                        <li>your company is interested in hosting a bug bash or</li>
                        <li>you have ideas or suggestions to improve these bug bashes</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    <footer>
        <div class="row">
            <div class="col-lg-12">

                <ul class="list-unstyled">
                    <li class="pull-right"><a href="#top">Back to top</a></li>
                </ul>
                <p>Made by <a href="http://nareshjain.com" rel="nofollow">Naresh Jain</a> and released under <a href="https://creativecommons.org/licenses/by-nc/3.0/" target="_blank">CC BY-NC 3.0</a> . Powered by <a href="https://github.com/phpish" target="_blank">PHPish</a>.</p>

                <p>Theme by <a href="http://thomaspark.me" rel="nofollow">Thomas Park</a>, based on <a href="http://getbootstrap.com" rel="nofollow">Bootstrap</a>. Icons from <a href="http://fortawesome.github.io/Font-Awesome/" rel="nofollow">Font Awesome</a>. Web fonts from <a
                        href="http://www.google.com/webfonts" rel="nofollow">Google</a>.</p>

            </div>
        </div>

    </footer>

</div>

