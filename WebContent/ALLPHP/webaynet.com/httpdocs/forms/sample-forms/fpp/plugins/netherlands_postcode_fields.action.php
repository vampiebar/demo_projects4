<?php
    /**
     * Project: Form Processor Pro
     * File: netherlands_postcode_fields.action.php
     * 
     * @version 5.0
     * @copyright MitriDAT <info@mitridat.com>
     * @author Rosty Kerei <rosty.kerei@gmail.com>
     * @link http://www.email-form.com/
     * @package Actions
     * @subpackage Validators
     */

    /**
     * Postcode for the Netherlands
     * 
     * @package FPP5
     */
    class netherlands_postcode_fields_action extends Validator {
        function execute(){
        	global $lang;
        	
            $fields = $this->getUnmatchFields('/^[1-9]{1}[0-9]{3}\s?[A-Z]{2}$/');
            
            foreach ($fields as $field){
                $this->fieldError($field['name'], $lang->getValue('form_err_netherlands_postcode', $field['label']));
            }
        }
    }
?>