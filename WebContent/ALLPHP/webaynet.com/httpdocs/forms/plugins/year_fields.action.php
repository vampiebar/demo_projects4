<?php
    /**
     * Project: Form Processor Pro
     * File: year_fields.action.php
     * 
     * @version 5.0
     * @copyright MitriDAT <info@mitridat.com>
     * @author Rosty Kerei <rosty.kerei@gmail.com>
     * @link http://www.email-form.com/
     * @package Actions
     * @subpackage Validators
     */

    /**
     * Year validator
     * 
     * @package FPP5
     */
    class year_fields_action extends Validator {
        function execute(){
        	global $lang;
        	
            $fields = $this->getUnmatchFields('/^(([0-9]{2})|([0-9]{4}))$/');
            
            foreach ($fields as $field){
                $this->fieldError($field['name'], $lang->getValue('form_err_year', $field['label']));
            }
        }

    }
?>