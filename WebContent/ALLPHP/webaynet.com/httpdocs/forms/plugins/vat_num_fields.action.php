<?php
    /**
     * Project: Form Processor Pro
     * File: vat_num_fields.action.php
     * 
     * @version 5.0
     * @copyright MitriDAT <info@mitridat.com>
     * @author Rosty Kerei <rosty.kerei@gmail.com>
     * @link http://www.email-form.com/
     * @package Actions
     * @subpackage Validators
     */

    /**
     * European VAT-numbers validator
     * 
     * @package FPP5
     */
    class vat_num_fields_action extends Validator {
        function execute(){
        	global $lang;
        	
            $fields = $this->getUnmatchFields('/^[A-Z]{2}\-?[0-9]{6,}$/i');
            
            foreach ($fields as $field){
                $this->fieldError($field['name'], $lang->getValue('form_err_vat_num', $field['label']));
            }
        }

    }
?>