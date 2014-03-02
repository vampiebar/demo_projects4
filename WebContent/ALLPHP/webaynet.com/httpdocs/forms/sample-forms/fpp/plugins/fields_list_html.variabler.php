<?php
    /**
     * Project: Form Processor Pro
     * File: fields_list_html.variabler.php
     * 
     * @version 5.0
     * @copyright MitriDAT <info@mitridat.com>
     * @author Sergey Bidnyi <sergey.bidnyi@gmail.com>
     * @link http://www.email-form.com/
     * @package Parser
     */
    
    /**
     * %FIELDS_LIST_HTML variabler
     *
     * @return string
     */
    function fields_list_html_variabler(){
    	global $request;
    	
        $field_list = '';
 	$defaults = array('submit', 'reset', 'fpp_form', 'fpp_output', 'fpp_back','fpp_data','fpp_files');
	$cookie = array_keys($_COOKIE);
	$cookie = array_map('strtolower',$cookie);
	$denied_fields = array_merge($cookie, $defaults);
	
	$fields = $request->data;
        $fields = rm_bad_request_fields($fields);

        $fields_all = get_fields_names();
       
        foreach ($fields as $key=>$value){
            if (!in_array(strtolower($key), $denied_fields)) {
	    	if (array_key_exists($key, $fields_all)) {
                	$key = $fields_all[$key];
                 }
            	$field_list .= '<b>'.$key.'</b>: '.$value.'<br />'."\n";
            }
        }
        
        return $field_list;
    }
?>