<?php
    /**
     * Project: Form Processor Pro
     * File: float_fields.action.php
     * 
     * @version 5.0
     * @copyright MitriDAT <info@mitridat.com>
     * @author Rosty Kerei <rosty.kerei@gmail.com>
     * @link http://www.email-form.com/
     * @package FPP5
     */

    /**
     * Float numbers validator
     * 
     * @package FPP5
     */
    class float_fields_action extends Validator {
        function execute(){
        	global $lang;
        	
            $fields = $this->getUnmatchFields('/^[\-]?[0-9]+(\.{1}[0-9]+){0,1}$/');
            
            foreach ($fields as $field){
                $this->fieldError($field['name'], $lang->getValue('form_err_float', $field['label']));
            }
        }
    }
?>