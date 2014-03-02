<?php
    /**
     * Project: Form Processor Pro
     * File: same_fields.action.php
     * 
     * @version 5.0
     * @copyright MitriDAT <info@mitridat.com>
     * @author Rosty Kerei <rosty.kerei@gmail.com>
     * @link http://www.email-form.com/
     * @package Actions
     * @subpackage Validators
     */

    /**
     * Same fields validating class.
     */
    class same_fields_action extends Validator {
        function execute(){
        	global $lang;
        	
            $fields = $this->fetchFields();
            
            if (count($fields) < 2){
            	$e = new Error($lang->getValue('err_same_fields_params_count', count($fields)));
            }
            
            $request = $this->getRequestData();
            
            if (isset($request[$fields[0]['name']])){
            	
            	$error = false;
            	$err_fields_msg = '"'.$fields[0]['label'].'"';
            
            	for ($i=1; $i<count($fields); $i++){
            		if (isset($request[$fields[$i]['name']])){
            			
	                	if ($request[$fields[$i]['name']] != $request[$fields[0]['name']]){
                			$error = true;
	                	}
                
	                	$err_fields_msg .= ', "' . $fields[$i]['label'] . '"';
            		}
            	}
            
            	if ($error){
                	$this->fieldError($fields[0]['name'], $lang->getValue('form_err_same_fields_dont_match', $err_fields_msg));
            		for ($i=1; $i<count($fields); $i++){
            	    	$this->fieldError($fields[$i]['name']);
	            	}
            	}
            }
        }
    }
?>