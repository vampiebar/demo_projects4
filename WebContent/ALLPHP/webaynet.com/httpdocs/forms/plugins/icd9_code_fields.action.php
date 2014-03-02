<?php
    /**
     * Project: Form Processor Pro
     * File: icd9_code_fields.action.php
     * 
     * @version 5.0
     * @copyright MitriDAT <info@mitridat.com>
     * @author Rosty Kerei <rosty.kerei@gmail.com>
     * @link http://www.email-form.com/
     * @package Actions
     * @subpackage Validators
     */

    /**
     * ICD9 code pattern
     * 
     * @package FPP5
     */
    class icd9_code_fields_action extends Validator {
        function execute(){
        	global $lang;
        	
            $fields = $this->getUnmatchFields('/^\d{3,3}\.\d{0,2}$|^E\d{3,3}\.\d{0,2}$/');
            
            foreach ($fields as $field){
                $this->fieldError($field['name'], $lang->getValue('form_err_icd9_code', $field['label']));
            }
        }
    }
?>