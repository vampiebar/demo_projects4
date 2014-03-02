<?php
    /**
     * Project: Form Processor Pro
     * File: validator.class.php
     * 
     * @version 5.0
     * @copyright MitriDAT <info@mitridat.com>
     * @author Rosty Kerei <rosty.kerei@gmail.com>
     * @link http://www.email-form.com/
     * @package Actions
     */
    
    /**
     * Vaildator class. Realized common validators logic
     * 
     * @package FPP5
     * @abstract
     */
    class Validator extends Action {

        /**
         * Validator class constructor. Overwrites action type
         * to set itself as a validator 
         *
         * @return boolean
         */
    	function Validator(){
    	    return $this->setType(ACTION_TYPE_VALIDATOR);
    	}
    	
        /**
         * Parses argument and return the
         * list of appropriate fields
         *
         * @return unknown
         */
    	function fetchFields(){
    	
            $args = explode(',', $this->getArgument());
            $args = array_map('trim', $args);
            
            foreach ($args as $arg){
                preg_match('/(.+){1}\s*\((.+)\)/', $arg, $match);
                if (isset($match[1])){
                	$fields[] = array('name' => trim($match[1]), 'label' => trim($match[2]));
                }
                else{
                    $fields[] = array('name' => trim($arg), 'label' => trim($arg));
                }
            }
            
            return $fields;   
        }
        
        /**
         * Returns the list of fields
         * that do not match $regex pattern
         * 
         * @param string
         * @param boolean Flag to determinate a need of empty fields matching
         * @return array
         */
        function getUnmatchFields($regex, $processEmpty = false){
            $result = array();
            $fields = $this->fetchFields();
            $request = $this->getRequestData();
            
            foreach ($fields as $field){
                if (isset($request[$field['name']])){
                    
                    if (!$processEmpty && $request[$field['name']] == '') {
                    	continue;
                    }
                    
                	if (!preg_match($regex, $request[$field['name']])){
                        $result[] = $field;
                	}
                }
            }
            
            return $result;
        }
        
        /**
         * Puts error to the field
         *
         * @param string $field_name
         * @param string $msg
         * @return boolean
         */
        function fieldError($field_name, $msg = ''){
        	global $formError;
        	
            return $formError->fieldError($field_name, $msg);
        }
    }
?>