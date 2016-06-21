<?php

use phpish\mysql;

class Attendee
{

    public static function register($bash_id, $form)
    {
        $mandatory_fields = ['participant_name' => 'Participant Name', 'email' => 'Email', 'org' => 'Organisation'];
        $errors = self::validate_form_contains_required_fields($form, $mandatory_fields);
        if (!empty($errors)) return ['status' => 'danger', 'msg' => $errors];
        $response = mysql\row("SELECT count(*) AS `count` FROM attendees WHERE bash_id ='%s' AND email='%s'", [$bash_id, $form['email']]);
        if (isset($response['count']) and $response['count'] > 0)
            return ['status' => 'danger', 'msg' => 'You have already registered for this bash!'];
        mysql\query("INSERT INTO attendees (bash_id, participant_name, email, org) VALUES ('%s', '%s', '%s', '%s')", [$bash_id, $form['participant_name'], $form['email'], $form['org']]);
        return ['status' => 'success', 'msg' => 'Thank you for registering. Details will be emailed to you shortly. See you at the bash!'];
    }

    public static function fetch_attendees_for($bash_id)
    {
        return mysql\rows("SELECT participant_name, org FROM attendees WHERE bash_id ='%s' ORDER BY `time` ASC", [$bash_id]);
    }

    public static function fetch_attendees()
    {
        $all_attendees = mysql\rows("SELECT bash_id, participant_name, org FROM attendees ORDER BY `time` ASC");
        $grouped_attendees = [];
        foreach ($all_attendees as $attendee) {
            if (!array_key_exists($attendee['bash_id'], $grouped_attendees)) $grouped_attendees[$attendee['bash_id']] = [];
            $grouped_attendees[$attendee['bash_id']][] = $attendee;
        }
        return $grouped_attendees;
    }

    private static function validate_form_contains_required_fields($form, $required_fields)
    {
        $errors = '';
        foreach ($required_fields as $required_field => $field_name) {
            $actual_value = trim($form[$required_field]);
            if (empty($actual_value))
                $errors .= $field_name . " cannot be blank.<br>";
        }
        return $errors;
    }
}