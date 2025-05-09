<?php

if (!function_exists("validation")) {
    function validation(array $attributes, array $trans = null, $http_header = 'redirect', $back = null)
    {
        $validations = [];  // email, mobile, address names from request
        $values = [];   // email, mobile, address values from request 
        // start loop to extract attributes 
        foreach ($attributes as $attribute => $rules) {
            $value = request($attribute);
            $values[$attribute] = $value;

            $attribute_validate = [];
            $final_attr = isset($trans[$attribute]) ? $trans[$attribute] : $attribute;
            foreach (explode('|', $rules) as $rule) {
                if ($rule == 'email' && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $attribute_validate[] = str_replace(':attribute', $final_attr, trans('validation.email'));
                } elseif ($rule == 'required' && (is_null($value) || empty($value) || (isset($value['tmp_name']) && empty($value['tmp_name'])))) {
                    $attribute_validate[] = str_replace(':attribute', $final_attr, trans('validation.required'));
                } elseif ($rule == 'integer' && !filter_var((int) $value, FILTER_VALIDATE_INT)) {
                    $attribute_validate[] = str_replace(':attribute', $final_attr, trans('validation.integer'));
                } elseif ($rule == 'string' && !is_string($value)) {
                    $attribute_validate[] = str_replace(':attribute', $final_attr, trans('validation.string'));
                } elseif ($rule == 'numeric' && !is_numeric($value)) {
                    $attribute_validate[] = str_replace(':attribute', $final_attr, trans('validation.numeric'));
                } elseif ($rule == 'image' && isset($value['tmp_name']) && !empty($value['tmp_name']) && getimagesize($value['tmp_name']) === false) {
                    $attribute_validate[] = str_replace(':attribute', $final_attr, trans('validation.image'));
                } elseif (preg_match('/^in/i', $rule)) { // |in:admin,user
                    $ex_rule = explode(':', $rule);
                    if (isset($ex_rule[1])) {
                        $ex_in = explode(',', $ex_rule[1]);
                        if (!empty($ex_in) && is_array($ex_in) && !in_array($value, $ex_in)) {
                            $attribute_validate[] = str_replace(':attribute', $final_attr, trans('validation.in'));
                        }
                    }
                } elseif (preg_match('/^unique:/i', $rule)) {
                    $ex_rule = explode(':', $rule); // unique:users,email,1`
                    if (count($ex_rule) > 1 && isset($ex_rule[1])) {
                        $get_unique_info = explode(',', $ex_rule[1]);
                        $table = $get_unique_info[0];
                        $column = isset($get_unique_info[1]) ? $get_unique_info[1] : $attribute;

                        if (isset($get_unique_info[2]) && !empty($get_unique_info[2])) {
                            $scap_id = ' and id!= ' . $get_unique_info[2];
                        } else {
                            $scap_id = '';
                        }


                        $check_unique = db_first($table, "where $column = '$value' $scap_id");
                        if (isset($check_unique) && !empty($check_unique)) {
                            $attribute_validate[] = str_replace(':attribute', $final_attr, trans('validation.unique'));
                        }

                    }
                }
            }
            if (!empty($attribute_validate) and is_array($attribute_validate) and count($attribute_validate) > 0) {
                $validations[$attribute] = $attribute_validate;
            }

        }

        if (count($validations) > 0) {
            if ($http_header == 'redirect') {
                // end loop to extract attributes 
                session('errors', json_encode($validations));
                session('old', json_encode($values));
                if (!is_null($back)) {
                    redirect($back);
                } else {
                    // redirect('/');
                    back();
                }
            } elseif ($http_header == 'api') {
                return json_encode($validations, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            }
        } else {
            return $values;
        }
    }
}

if (!function_exists('any_errors')) {
    function any_errors($offset = null)
    {
        $array = json_decode(session('errors'), true);
        if (isset($array[$offset]) && !is_null($offset)) {
            $text = $array[$offset];
            return is_array($text) ? $text : [];
        } elseif (!empty($array) && count($array) > 0) {
            return $array;
        } else {
            return [];
        }
    }
}

if (!function_exists('all_errors')) {
    function all_errors(): array
    {
        $all_errors = [];
        foreach (any_errors() as $errors) {
            foreach ($errors as $error) {
                $all_errors[] = $error;
            }
        }
        return $all_errors;
    }
}

if (!function_exists('get_error')) {
    function get_error($offset)
    {
        $count_error = 0;
        $error = '<ul>';
        foreach (any_errors($offset) as $error_string) {
            if (is_string($error_string)) {
                $error .= '<li>' . $error_string . '</li>';
                $count_error++;
            }
        }
        $error .= '</ul>';
        // return $count_error > 0 ? $error : null;
        return !empty(any_errors($offset)) ? $error : null;
    }
}
if (!function_exists('end_errors')) {
    function end_errors()
    {
        session_flash('errors');
    }
}

if (!function_exists('old')) {
    function old($request)
    {
        $old_values = json_decode(session('old'), associative: true);

        if (is_array($old_values) && !empty($old_values) && in_array($request, array_keys($old_values))) {
            return $old_values[$request];
        } else {
            return '';
        }
    }
}


