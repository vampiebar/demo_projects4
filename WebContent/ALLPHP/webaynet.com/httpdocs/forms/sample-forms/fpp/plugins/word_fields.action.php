<?php
    /**
     * Project: Form Processor Pro
     * File: word_fields.action.php
     * 
     * @version 5.0
     * @copyright MitriDAT <info@mitridat.com>
     * @author Rosty Kerei <rosty.kerei@gmail.com>
     * @link http://www.email-form.com/
     * @package FPP5
     */

    /**
     * Words validator
     * 
     * @package FPP5
     */
    class word_fields_action extends Validator {
        function execute(){
        	global $lang;
        	
            $fields = $this->getUnmatchFields('/^[a-z]+$/i');
            
            foreach ($fields as $field){
                $this->fieldError($field['name'], $lang->getValue('form_err_word', $field['label']));
            }
        }
    }
?>