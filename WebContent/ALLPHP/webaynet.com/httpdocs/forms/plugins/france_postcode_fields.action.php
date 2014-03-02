<?php
    /**
     * Project: Form Processor Pro
     * File: france_postcode_fields.action.php
     * 
     * @version 5.0
     * @copyright MitriDAT <info@mitridat.com>
     * @author Rosty Kerei <rosty.kerei@gmail.com>
     * @link http://www.email-form.com/
     * @package Actions
     * @subpackage Validators
     */

    /**
     * Postcode check for France (including colonies)
     * 
     * @package FPP5
     */
    class france_postcode_fields_action extends Validator {
        function execute(){
        	global $lang;
        	
            $fields = $this->getUnmatchFields('/^(F-)?((2[A|B])|[0-9]{2})[0-9]{3}$/');
            
            foreach ($fields as $field){
                $this->fieldError($field['name'], $lang->getValue('form_err_france_postcode', $field['label']));
            }
        }
    }
?>