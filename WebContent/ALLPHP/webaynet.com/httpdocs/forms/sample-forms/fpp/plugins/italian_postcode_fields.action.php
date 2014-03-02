<?php
    /**
     * Project: Form Processor Pro
     * File: italian_postcode_fields.action.php
     * 
     * @version 5.0
     * @copyright MitriDAT <info@mitridat.com>
     * @author Rosty Kerei <rosty.kerei@gmail.com>
     * @link http://www.email-form.com/
     * @package Actions
     * @subpackage Validators
     */

    /**
     * Postcode check for Italy (including possible Vatican/Italy indications)
     * 
     * @package FPP5
     */
    class italian_postcode_fields_action extends Validator {
        function execute(){
        	global $lang;
        	
            $fields = $this->getUnmatchFields('/^(V-|I-)?[0-9]{4}$/');
            
            foreach ($fields as $field){
                $this->fieldError($field['name'], $lang->getValue('form_err_italian_postcode', $field['label']));
            }
        }
    }
?>