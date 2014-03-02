<?php
    /**
     * Project: Form Processor Pro
     * File: formfile_cvs.variabler.php
     * 
     * @version 5.0
     * @copyright MitriDAT <info@mitridat.com>
     * @author Rosty Kerei <rosty.kerei@gmail.com>
     * @link http://www.email-form.com/
     * @package Parser
     */
    
    /**
     * %FORMFILE_CVS variabler
     *
     * @return string
     */
    function formfile_csv_variabler(){
    	global $request;

        $csv = '';

        $defaults = get_defaults();
	$cookie = array_keys($_COOKIE);
	$cookie = array_map('strtolower',$cookie);
	$denied_fields = array_merge($cookie, $defaults);

        $fields = rm_bad_request_fields($request->data);

        foreach ($fields as $key=>$value){
                if (!in_array(strtolower($key), $denied_fields)) {
            	        $csv .= '"'.$value.'";';
                }
        }

        $csv = @substr($csv, 0, -1);
        $filename = TMP_DIR.$request->getFormName().date('mdyHis').'_'.rand(10, 99).'.csv';
        $fp = fopen($filename, 'w+');
        fwrite($fp, $csv);
        fclose($fp);
        
        return $filename;
    }
?>