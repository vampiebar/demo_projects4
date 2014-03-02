<?php
#Additional functions
function rm_bad_request_fields($fields) #delete variables with [*]
{
        foreach ($fields as $key => $value) {
                if (preg_match('/\w+\[\w+\]/', $key)) { #if filed name (key name) is like name[1]
                        unset($fields[$key]); #delete it
                }
        }

        return $fields;
}


function get_fields_names() #get fields names. Return array: $fields_all[var_name] = var_label
{
        global $request;
        global $validators;

        foreach ($validators as $validator) { #extract variables from validators into arrays. Separate arrays for each valiadtor
                $fields_arr[] =  $validator->fetchFields();
        }
        $fields_all = array(); #all fields will be in $fields_all
        foreach ($fields_arr as $arr) { #merege all arrays in 1 array;
                foreach ($arr as $variable) {
                        $fields_all[$variable['name']] = $variable['label'];
                }
        }
        return $fields_all;
}


function get_defaults()
{
        global $validators;

        $defaults = array('submit', 'reset', 'fpp_form', 'fpp_output', 'fpp_back','fpp_data','fpp_files');
        foreach ($validators as $validator) {
                if ($validator->name() == 'captcha_field_action') {
                        $arr = $validator->fetchFields();
                        $defaults[] = $arr[0]['name'];
                        break;
                }
        }
        return $defaults;
}

?>