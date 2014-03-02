<?php
    /**
     * Project: Form Processor Pro
     * File: zip_file_fields.action.php
     * 
     * @version 5.0
     * @copyright MitriDAT <info@mitridat.com>
     * @author Rosty Kerei <rosty.kerei@gmail.com>
     * @link http://www.email-form.com/
     * @package Actions
     * @subpackage Validators
     */

    /**
     * Zip files extension validator
     * 
     * @package FPP5
     */
    class zip_file_fields_action extends Validator {
        function execute(){
        	global $lang;
        	
            $fields = $this->getUnmatchFields('/\.zip$/i');
            
            foreach ($fields as $field){
                $this->fieldError($field['name'], $lang->getValue('form_err_zip_file', $field['label']));
            }
        }
    }
?>