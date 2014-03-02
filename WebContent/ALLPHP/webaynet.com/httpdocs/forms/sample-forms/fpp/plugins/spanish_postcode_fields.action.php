<?php
    /**
     * Project: Form Processor Pro
     * File: spanish_postcode_fields.action.php
     * 
     * @version 5.0
     * @copyright MitriDAT <info@mitridat.com>
     * @author Rosty Kerei <rosty.kerei@gmail.com>
     * @link http://www.email-form.com/
     * @package Actions
     * @subpackage Validators
     */

    /**
     * Postcode check for Spain
     * 
     * @package FPP5
     */
    class spanish_postcode_fields_action extends Validator {
        function execute(){
        	global $lang;
        	
            $fields = $this->getUnmatchFields('/^([1-9]{2}|[0-9][1-9]|[1-9][0-9])[0-9]{3}$/');
            
            foreach ($fields as $field){
                $this->fieldError($field['name'], $lang->getValue('form_err_spanish_postcode', $field['label']));
            }
        }
    }
?>