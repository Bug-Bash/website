<?php
    include_once __DIR__ . "/attendee.php";

    class BugBash
    {
        public static function all()
        {
            return array(
                'upcoming' => array(self::fetch_info('kiwix-at-seconf')),
                'default'  => array(
                    'id'            => "unknown",
                    'title'         => "Propose a Bug Bash",
                    'description'   => "Please get in touch with bugbash.in@gmail.com if you want to have your project tested",
                    'project_link'     => "#unknown",
                    'project_logo_url' => "/images/projects/your_project.png",
                    'contact_person'       => '{"1":{"name":"Your Name", "email":"unknown@example.com"}}',
                    'start_time'    => "Pick a date and time",
                    'location'      => "Physical or Virtual location",
                    'location_url'  => "#",
                ),
                'past' => array(),
            );
        }

        public static function invalid_id($bash_id)
        {
            $bashes = array('kiwix-at-seconf');
            return !in_array($bash_id, $bashes);
        }

        public static function fetch_info($bash_id)
        {
            return array(
                'id'            => "kiwix-at-seconf",
                'title'         => "Kiwix @ Selenium Conf 14",
                'description'   => "<p>Please visit <a href='https://github.com/Bug-Bash/selenium-kiwix' target='_blank'>https://github.com/Bug-Bash/selenium-kiwix</a> for details.</p>
<p>The aims of the Bug Bash extend beyond 'finding bugs', we are keen to encourage and foster collaborative work where we experiment with creating automated test suites for one or more of the kiwix applications. The conference has attracted several hundred passionate individuals; many have significant experience with the Selenium test automation framework. We also have several software testing gurus who are participating in the Bug Bash and available to collaborate with the test automation to enhance the potency of the automated tests.</p>
<p>Participants can work individually and in groups.</p>
<p>Kiwix is an open source offline reader for Web content. It's especially intended to make Wikipedia available offline. It runs on a large range of operating systems, on Android and on the three main Desktop operating systems: Microsoft Windows, Apple Mac OSX and GNU/Linux distributions. Its user interface supports more than 100 languages. Kiwix is used by several schools, universities and libraries all over the world for educational purpose.</p>
<p>More details about testing Kiwix: <a href='http://www.kiwix.org/wiki/Testing' target='_blank'>http://www.kiwix.org/wiki/Testing</a> </p>
<p>To enrich the overall experience, we have invited a few exploratory testing experts to the conference to help the participants of the Bug Bash find interesting bugs and learn some real-world exploratory testing techniques.</p>
<p>We are also pleased to inform you that Julian Harty, our closing keynote speaker and one of the core committers of the Kiwix project, will be present at the conference to guide the team. He, along with the Selenium Core Committee will select the winners.</p>
<h3>Suggested approaches include:</h3>
<ul>
<li>Implementing automated tests for one or more of the kiwix applications, incluing the kiwix web server (called kiwix-serve). These tests can be written using the framework of your choice. For instance here are some possible frameworks for the Android app: Appium, Selendroid, Calabash, Robotium, etc. For the web app, how about Selenium (given the title of the conference :) )</li>
<li>Reviewing and enhancing current open bugs from the sourceforge project <a href='http://sourceforge.net/p/kiwix/bugs/'>http://sourceforge.net/p/kiwix/bugs/</a> so they are easier to understand and fix</li>
<li>Providing translations, especially for incompletely translated locales <a href='http://sourceforge.net/p/kiwix/kiwix/ci/master/tree/android/res/'>http://sourceforge.net/p/kiwix/kiwix/ci/master/tree/android/res/</a>
</li>
</ul>
<h3>What would we like you to do?</h3>
<ul>
<li>If you want to work on automating tests: Fork this repository, work on your copy of the respository, and send us pull requests when you've got something to share.</li>
<li>Bonus points: online CI, for instance travis-ci.org integrates well with github projects.</li>
<li>If you want to report bugs, feature requests, quirks, etc. file them here <a href='https://github.com/Bug-Bash/selenium-kiwix/issues'>https://github.com/Bug-Bash/selenium-kiwix/issues</a> <em>Before you file</em> please check for known (reported) <a href='http://sourceforge.net/p/kiwix/bugs/' title='List of Kiwix bugs on SourceForge'>bugs</a>, read the <a href='http://sourceforge.net/p/kiwix/discussion/' title='Discussions on SourceForge for Kiwix'>discussions</a>, etc.</li>
</ul>
<h3>Prizes</h3>
<p>We could select:</p>
<ul>
<li>top 3 participants with the best test automation suite</li>
<li>we would also acknowledge the participants who have identified top 10 bugs (if any) in Kiwix.
</ul>
<h3>Process</h3>
<ol>
<li>Interested participants (teams/individuals) should register on this site to participate in the bug bash competition.</li>
<li>Julian would kick off the bug bash on Sep 5th at 10:15 AM (right after Simon's opening keynote)</li>
<li>Team can request help as per their needs from exploratory test experts and few core Se Committee members. Also teams could use the cloud infrastructure from BrowserStack and SauceLabs to setup and run their tests.</li>
<li>Teams have time till Sep 6th 11 AM to submit their test suite and bug reports. Please submit the link to your github repo where you have all the test suite. Integrating your tests with a CI server is an added advantage. For the bug reports, you are expected to share the links to actual accepted bug reports filed on Kiwix project site. (As the teams work, the Kiwix team will be reviewing and accepting bugs. If need be, they will also be happy to accept fixes.)</li>
<li>The panel will start their review of the test suite and bug reports at 11:00 AM on Sep 6th.</li>
<li>Right after Julian's closing keynote, the panel will announce the winners.</li>
</ol>",
                'project_link'     => "http://www.kiwix.org/wiki/Main_Page",
                'project_logo_url' => "/images/projects/kiwix.png",
                'contact_person'       => '{"1":{"name":"Julian Harty", "email":"julianharty@gmail.com"}, "2":{"name":"Naresh Jain", "email":"nashjain@gmail.com"}}',
                'start_time'    => "Friday, Sep 5th @ 10:15 AM",
                'location'      => "Selenium Conf 2014",
                'location_url'  => "http://seleniumconf.org#venue",
                'pictures'        => "#",
                'video'         => "#",
                'attendees'     => Attendee::fetch_attendees_for('kiwix-at-seconf')
            );
        }

        public static function listing()
        {
            return array(
                'upcoming'=>array('kiwix-at-seconf'=>'Kiwix @ Selenium Conf 14'),
                'past'=>array(),
            );
        }
    }