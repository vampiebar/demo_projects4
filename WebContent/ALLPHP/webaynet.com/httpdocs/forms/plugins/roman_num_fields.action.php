<?php
    /**
     * Project: Form Processor Pro
     * File: roman_num_fields.action.php
     * 
     * @version 5.0
     * @copyright MitriDAT <info@mitridat.com>
     * @author Rosty Kerei <rosty.kerei@gmail.com>
     * @link http://www.email-form.com/
     * @package FPP5
     */

    /**
     * Roman numerals validation
     * 
     * @package FPP5
     */
    class roman_num_fields_action extends Validator {
        function execute(){
        	global $lang;
        	
            $fields = $this->getUnmatchFields('/^[IVXLCDM]+$/i');
            
            foreach ($fields as $field){
                $this->fieldError($field['name'], $lang->getValue('form_err_roman_num', $field['label']));
            }
        }
    }
?>