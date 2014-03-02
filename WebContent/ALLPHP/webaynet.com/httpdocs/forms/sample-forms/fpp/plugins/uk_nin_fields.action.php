<?php
    /**
     * Project: Form Processor Pro
     * File: uk_nin_fields.action.php
     * 
     * @version 5.0
     * @copyright MitriDAT <info@mitridat.com>
     * @author Rosty Kerei <rosty.kerei@gmail.com>
     * @link http://www.email-form.com/
     * @package Actions
     * @subpackage Validators
     */

    /**
     * UK National Insurance Number (NINo) validation. The following modifications have been made: The first letter may not be D, F, I, Q, U or Z; the second letter may not be D, F, I, O, Q, U or Z; the final letter is optional.
     * 
     * @package FPP5
     */
    class uk_nin_fields_action extends Validator {
        function execute(){
        	global $lang;
        	
            $fields = $this->getUnmatchFields('/^[A-CEGHJ-PR-TW-Z]{1}[A-CEGHJ-NPR-TW-Z]{1}[0-9]{6}[A-DFM]{0,1}$/');
            
            foreach ($fields as $field){
                $this->fieldError($field['name'], $lang->getValue('form_err_uk_nin', $field['label']));
            }
        }
    }
?>