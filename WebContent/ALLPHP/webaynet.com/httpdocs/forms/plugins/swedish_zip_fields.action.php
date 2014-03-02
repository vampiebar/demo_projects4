<?php
    /**
     * Project: Form Processor Pro
     * File: swedish_zip_fields.action.php
     * 
     * @version 5.0
     * @copyright MitriDAT <info@mitridat.com>
     * @author Rosty Kerei <rosty.kerei@gmail.com>
     * @link http://www.email-form.com/
     * @package Actions
     * @subpackage Validators
     */

    /**
     * Validates swedish zipcodes (postnr) with or without space between groups. With leading s- or not. Can be disconnected by removing ''(s-|S-){0,1}''.
     * 
     * @package FPP5
     */
    class swedish_zip_fields_action extends Validator {
        function execute(){
        	global $lang;
        	
            $fields = $this->getUnmatchFields('/^(s-|S-){0,1}[0-9]{3}\s?[0-9]{2}$/');
            
            foreach ($fields as $field){
                $this->fieldError($field['name'], $lang->getValue('form_err_swedish_zip', $field['label']));
            }
        }

    }
?>