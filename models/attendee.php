<?php

    use phpish\mysql;

class Attendee {

    public static function register($bash_id, $form)
    {
        $mandatory_fields = array('participant_name'=>'Participant Name', 'email'=>'Email', 'org'=>'Organisation');
        $errors = self::validate_form_contains_required_fields($form, $mandatory_fields);
        if (!empty($errors)) return array('status' => 'danger', 'msg' => $errors);
        $response = mysql\row("select count(*) as `count` from attendees where bash_id ='%s' and email='%s'", array($bash_id, $form['email']));
        if(isset($response['count']) and $response['count']>0)
            return array('status'=>'danger', 'msg'=>'You have already registered for this bash!');
        mysql\query("INSERT INTO attendees (bash_id, participant_name, email, org) VALUES ('%s', '%s', '%s', '%s')", array($bash_id, $form['participant_name'], $form['email'], $form['org']));
        return array('status'=>'success', 'msg'=>'Thank you for registering. Details will be emailed to you shortly. See you at the bash!');
    }

    public static function fetch_attendees_for($bash_id) {
        return mysql\rows("select participant_name, org from attendees where bash_id ='%s' order by `time` asc", array($bash_id));
    }

    private static function validate_form_contains_required_fields($form, $required_fields)
    {
        $errors = '';
        foreach ($required_fields as $required_field => $field_name) {
            $actual_value = trim($form[$required_field]);
            if (empty($actual_value)) {
                $errors .= $field_name . " cannot be blank.<br>";
            }
        }
        return $errors;
    }
}