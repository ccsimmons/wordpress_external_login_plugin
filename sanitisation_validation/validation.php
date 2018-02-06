<?php

function exlog_validate($value, $field_data) {
    $exlog_error_title = "Validation Error in field " . $field_data['field_name'] . ".<br> - ";

    if ($field_data['field_slug'] == "exlog_unspecified_role") {
        if (!(array_key_exists($value, exlog_get_wp_role_types()))) {
            add_settings_error(
                $field_data['field_slug'],           // setting title
                $field_data['field_slug'] . '_error',            // error ID
                $exlog_error_title . "Use the dropdown. Don't add your own values!",   // error message
                'error'                        // type of message
            );

            return get_option($field_data["field_slug"]);
        }
    } elseif ($field_data['field_slug'] == "exlog_roles_custom_fields") {
            $decoded_value = exlog_decode_json_data($value);
            if (is_array($decoded_value)) {
                foreach ($decoded_value as &$role) {
                    $role['external_role_value'] = trim(strip_tags($role['external_role_value']));
                }
            }
            return json_encode($decoded_value);
    };

    //    If no data passed in form keep the current.
    //    This is important to stop data being deleted when using wpconfig settings
    if ($value == NULL) {
        return get_option($field_data["field_slug"]);
    }

    return strip_tags($value);
}
