<?php
    /**
     * Project: Form Processor Pro
     * File: uk_bsc_fields.action.php
     * 
     * @version 5.0
     * @copyright MitriDAT <info@mitridat.com>
     * @author Rosty Kerei <rosty.kerei@gmail.com>
     * @link http://www.email-form.com/
     * @package Actions
     * @subpackage Validators
     */

    /**
     * Validates a UK Bank Sort code
     * 
     * @package FPP5
     */
    class uk_bsc_fields_action extends Validator {
        function execute(){
        	global $lang;
        	
            $fields = $this->getUnmatchFields('/^[0-9]{2}[-][0-9]{2}[-][0-9]{2}$/');
            
            foreach ($fields as $field){
                $this->fieldError($field['name'], $lang->getValue('form_err_uk_bsc', $field['label']));
            }
        }
    }
?>