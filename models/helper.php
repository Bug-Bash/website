<?php

class Helper
{
    public static function validate_form_contains_required_fields($form, $required_fields)
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

    public static function generate_id($word)
    {
        $word = trim(preg_replace('/[\s\W_]+/', '-', $word));
        $word = trim(preg_replace('/[^a-zA-Z0-9\s_&\\-]+/', '', $word));
        $word = strtolower(trim($word, "-"));
        return strtolower($word);
    }
}