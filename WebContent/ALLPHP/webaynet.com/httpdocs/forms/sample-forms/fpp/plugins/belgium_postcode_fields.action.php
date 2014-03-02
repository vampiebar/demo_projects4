<?php
    /**
     * Project: Form Processor Pro
     * File: belgium_postcode_fields.action.php
     * 
     * @version 5.0
     * @copyright MitriDAT <info@mitridat.com>
     * @author Rosty Kerei <rosty.kerei@gmail.com>
     * @link http://www.email-form.com/
     * @package Actions
     * @subpackage Validators
     */

    /**
     * Postcode for Belgium
     * 
     * @package FPP5
     */
    class belgium_postcode_fields_action extends Validator {
        function execute(){
        	global $lang;
        	
            $fields = $this->getUnmatchFields('/^[1-9]{1}[0-9]{3}$/');
            
            foreach ($fields as $field){
                $this->fieldError($field['name'], $lang->getValue('form_err_belgium_postcode', $field['label']));
            }
        }
    }
?>