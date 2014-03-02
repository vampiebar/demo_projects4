<?php
    /**
     * Project: Form Processor Pro
     * File: int_fields.action.php
     * 
     * @version 5.0
     * @copyright MitriDAT <info@mitridat.com>
     * @author Rosty Kerei <rosty.kerei@gmail.com>
     * @link http://www.email-form.com/
     * @package FPP5
     */

    /**
     * Integer numbers valudator
     * 
     * @package FPP5
     */
    class int_fields_action extends Validator {
        function execute(){
        	global $lang;
        	
            $fields = $this->getUnmatchFields('/^[\-]?[0-9]+$/');
            
            foreach ($fields as $field){
                $this->fieldError($field['name'], $lang->getValue('form_err_int', $field['label']));
            }
        }
    }
?>