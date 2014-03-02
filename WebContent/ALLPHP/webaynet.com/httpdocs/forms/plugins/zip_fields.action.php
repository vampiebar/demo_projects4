<?php
    /**
     * Project: Form Processor Pro
     * File: zip_fields.action.php
     * 
     * @version 5.0
     * @copyright MitriDAT <info@mitridat.com>
     * @author Rosty Kerei <rosty.kerei@gmail.com>
     * @link http://www.email-form.com/
     * @package Actions
     * @subpackage Validators
     */

    /**
     * US Zip codes validator
     * 
     * @package FPP5
     */
    class zip_fields_action extends Validator {
        function execute(){
        	global $lang;
        	
            $fields = $this->getUnmatchFields('/^\d{5}(\s*-\s*\d{4})?$/');
            
            foreach ($fields as $field){
                $this->fieldError($field['name'], $lang->getValue('form_err_zip', $field['label']));
            }
        }
    }
?>