<?php
    /**
     * Project: Form Processor Pro
     * File: german_postcode_fields.action.php
     * 
     * @version 5.0
     * @copyright MitriDAT <info@mitridat.com>
     * @author Rosty Kerei <rosty.kerei@gmail.com>
     * @link http://www.email-form.com/
     * @package Actions
     * @subpackage Validators
     */

    /**
     * Checks valid german postal codes (PLZ or Postleitzahlen).
     * 
     * @package FPP5
     */
    class german_postcode_fields_action extends Validator {
        function execute(){
        	global $lang;
        	
            $fields = $this->getUnmatchFields('/\b((?:0[1-46-9]\d{3})|(?:[1-357-9]\d{4})|(?:[4][0-24-9]\d{3})|(?:[6][013-9]\d{3}))\b/');
            
            foreach ($fields as $field){
                $this->fieldError($field['name'], $lang->getValue('form_err_german_postcode', $field['label']));
            }
        }
    }
?>