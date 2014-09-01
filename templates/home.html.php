<?php
    function bash_badge($bash)
    {
        $contact_person = json_decode($bash['contact_person']);
        $project_link = $bash['project_link'];
        $project_logo_url = $bash['project_logo_url'];
        $badge = "<div><a name='{$bash['id']}'></a>"
            . project_image($project_link, $project_logo_url) . "<div class='clearfix'>
                <p><a href='/{$bash['id']}'>{$bash['title']}</a></p>
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
            $badge .= "<p style='text-align: center; margin-bottom: -5px'><a class='btn btn-primary btn-xs' href='/{$bash['id']}'>I'm interested...</a></p>";
            $badge .= modal_window($bash['id'], $bash['title'], $attendees);
        }
        return $badge . "</div></div>";
    }

    function modal_window($bash_id, $title, $attendees)
    {
        $modal = "<div class='modal fade' id='{$bash_id}_modal' tabindex='-1' role='dialog' aria-labelledby='{$bash_id}_label' aria-hidden='true'>
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

    function display_bashes($bashes)
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
            echo bash_badge($bash);
            echo '</div></div>';
            if ($count % 2 == 0) echo '</div>';
        }
        if ($count % 2 == 1) echo '</div>';
    }
?>


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
                    <?php echo bash_badge(current($data['upcoming'])) ?>
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
            $upcoming_bashes = $data['upcoming'];
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
            display_bashes($data['past']);
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

