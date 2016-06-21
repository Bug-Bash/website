<?php
include_once __DIR__ . "/attendee.php";
include_once __DIR__ . "/helper.php";

use phpish\mysql;

class BugBash
{
    public static function all()
    {
        $upcoming_bashes = self::upcoming_bashes('*');
        $past_bashes = self::past_bashes('*');
        $default = [
            'id'               => "add",
            'title'            => "Propose a Bug Bash",
            'description'      => "Please get in touch with info@bugbash.in if you want to have your project tested",
            'project_link'     => "/add",
            'project_logo_url' => "/images/projects/your_project.png",
            'contact_details'  => '{"1":{"name":"Your Name", "email":"unknown@example.com"}}',
            'start_time'       => "Pick a date and time",
            'end_time'=> '',
            'location'         => "Physical or Virtual location",
            'location_url'     => "#",
        ];
        return [
            'upcoming' => $upcoming_bashes,
            'default'  => $default,
            'past'     => $past_bashes,
            'attendees' => Attendee::fetch_attendees(),
        ];
    }

    public static function listing()
    {
        $upcoming_bashes = self::upcoming_bashes('id, title');
        $past_bashes = self::past_bashes('id, title');

        return [
            'upcoming' => self::convert_to_associative_map($upcoming_bashes, 'id', 'title'),
            'past'     => self::convert_to_associative_map($past_bashes, 'id', 'title'),
        ];
    }

    public static function invalid_id($bash_id)
    {
        $counts = mysql\row("select count(*) as count from bash where id='%s'", [$bash_id]);
        return $counts['count']==0;
    }

    public static function fetch_info($bash_id)
    {
        $bash = mysql\row("select * from bash where id='%s'", [$bash_id]);
        if(empty($bash)) return [];
        $bash['attendees'] = Attendee::fetch_attendees_for($bash_id);
        return $bash;
    }

    public static function add($form)
    {
        $mandatory_fields = [
            'session_title'        => 'Title',
            'session_description'  => 'Description',
            'session_project_link'  => 'Project Link',
            'session_project_logo_url'  => 'Project Logo URL',
            'session_contact_details'  => 'Contact Details',
            'session_location'     => 'Venue',
            'session_location_url' => 'Venue URL',
            'session_start_time'   => 'Start Time',
            'session_end_time'   => 'End Time'
        ];
        $errors = Helper::validate_form_contains_required_fields($form, $mandatory_fields);
        if (!empty($errors)) return ['status' => 'danger', 'msg' => $errors];

        $bugbash_id = Helper::generate_id($form['session_title']);

        $response = mysql\row("select count(*) as `count` from bash where `id`='%s'", [$bugbash_id]);
        if (isset($response['count']) and $response['count'] > 0)
            return ['status' => 'danger', 'msg' => 'Another Bug Bash with the same title "' . $form['session_title'] . '" is already registered!'];

        if (mysql\query("INSERT INTO bash (`id`, title, description, project_link, project_logo_url, contact_details, start_time, end_time, location, location_url, pictures, video) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')", [$bugbash_id, $form['session_title'], $form['session_description'], $form['session_project_link'], $form['session_project_logo_url'], $form['session_contact_details'], $form['session_start_time'], $form['session_end_time'], $form['session_location'], $form['session_location_url'], $form['session_pictures'], $form['session_video']]))
            return ['status' => 'success', 'msg' => 'Thank you for adding a new Bug Bash. We will shortly review the details and make it live!'];

        return ['status' => 'danger', 'msg' => "Could not save your bug bash details. There was an error in the provided data. Please try again."];
    }

    private static function upcoming_bashes($columns)
    {
        return mysql\rows("select $columns from bash where end_time > NOW() and approved='Y' order by `end_time` ASC");
    }

    private static function past_bashes($columns)
    {
        return mysql\rows("select $columns from bash where end_time <= NOW() and approved='Y' order by `end_time` DESC");
    }

    private static function convert_to_associative_map($my_array, $key, $value)
    {
        $result = [];
        foreach ($my_array as $each_array) {
            $result[$each_array[$key]] = $each_array[$value];
        }
        return $result;
    }
}