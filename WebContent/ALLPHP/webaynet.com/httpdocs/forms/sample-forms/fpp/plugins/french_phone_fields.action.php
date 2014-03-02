<?php
    /**
     * Project: Form Processor Pro
     * File: french_phone_fields.action.php
     * 
     * @version 5.0
     * @copyright MitriDAT <info@mitridat.com>
     * @author Rosty Kerei <rosty.kerei@gmail.com>
     * @link http://www.email-form.com/
     * @package Actions
     * @subpackage Validators
     */

    /**
     * French phone validation
     * 
     * @package FPP5
     */
    class french_phone_fields_action extends Validator {
        function execute(){
        	global $lang;
        	
            $fields = $this->getUnmatchFields('/^0[1-6]{1}(([0-9]{2}){4})|((\s[0-9]{2}){4})|((-[0-9]{2}){4})$/');
            
            foreach ($fields as $field){
                $this->fieldError($field['name'], $lang->getValue('form_err_french_phone', $field['label']));
            }
        }
    }
?>