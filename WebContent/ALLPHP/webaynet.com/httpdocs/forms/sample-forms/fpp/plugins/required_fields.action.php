<?php
    /**
     * Project: Form Processor Pro
     * File: required_fields.action.php
     * 
     * @version 5.0
     * @copyright MitriDAT <info@mitridat.com>
     * @author Rosty Kerei <rosty.kerei@gmail.com>
     * @link http://www.email-form.com/
     * @package Actions
     * @subpackage Validators
     */

    /**
     * Required fields validating class.
     * 
     * @package FPP5
     */
    class required_fields_action extends Validator {
        function execute(){
        	global $lang;
        	
            $fields = $this->getUnmatchFields('/.+/', true);
            
            foreach ($fields as $field){
                $this->fieldError($field['name'], $lang->getValue('form_err_required', $field['label']));
            }
        }
    }
?>