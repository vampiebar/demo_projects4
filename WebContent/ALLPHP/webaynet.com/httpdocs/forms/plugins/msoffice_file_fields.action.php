<?php
    /**
     * Project: Form Processor Pro
     * File: msoffice_file_fields.action.php
     * 
     * @version 5.0.1
     * + docx|xlsx
     * @copyright MitriDAT <info@mitridat.com>
     * @author Rosty Kerei <rosty.kerei@gmail.com>
     * @link http://www.email-form.com/
     * @package Actions
     * @subpackage Validators
     */

    /**
     * Microsoft Office files extension validator
     * 
     * @package FPP5
     */
    class msoffice_file_fields_action extends Validator {
        function execute(){
        	global $lang;
        	
            $fields = $this->getUnmatchFields('/\.(doc|docx|xlsx|xls|vsd|rtf|ppt|pps|mpp|xsn|xsf|xlt)$/i');
            
            foreach ($fields as $field){
                $this->fieldError($field['name'], $lang->getValue('form_err_msoffice_file', $field['label']));
            }
        }
    }
?>