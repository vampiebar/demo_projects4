<?php
    /**
     * Project: Form Processor Pro
     * File: italian_codice_fiscale_fields.action.php
     * 
     * @version 5.0
     * @copyright MitriDAT <info@mitridat.com>
     * @author Rosty Kerei <rosty.kerei@gmail.com>
     * @link http://www.email-form.com/
     * @package Actions
     * @subpackage Validators
     */

    /**
     * Checks italian fiscal code (codice fiscale) with OMOCODIA control
     * 
     * @package FPP5
     */
    class italian_codice_fiscale_fields_action extends Validator {
        function execute(){
        	global $lang;
        	
            $fields = $this->getUnmatchFields('/^[A-Za-z]{6}[0-9LMNPQRSTUV]{2}[A-Za-z]{1}[0-9LMNPQRSTUV]{2}[A-Za-z]{1}[0-9LMNPQRSTUV]{3}[A -Za-z]{1}$/');
            
            foreach ($fields as $field){
                $this->fieldError($field['name'], $lang->getValue('form_err_italian_codice_fiscale', $field['label']));
            }
        }
    }
?>