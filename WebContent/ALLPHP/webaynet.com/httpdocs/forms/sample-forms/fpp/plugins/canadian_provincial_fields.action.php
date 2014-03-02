<?php
    /**
     * Project: Form Processor Pro
     * File: canadian_provincial_fields.action.php
     * 
     * @version 5.0
     * @copyright MitriDAT <info@mitridat.com>
     * @author Rosty Kerei <rosty.kerei@gmail.com>
     * @link http://www.email-form.com/
     * @package Actions
     * @subpackage Validators
     */

    /**
     * Matches Canadian provincial codes.
     * 
     * @package FPP5
     */
    class canadian_provincial_fields_action extends Validator {
        function execute(){
        	global $lang;
        	
            $fields = $this->getUnmatchFields('/^(N[BLSTU]|[AMN]B|[BQ]C|ON|PE|SK)$/');
            
            foreach ($fields as $field){
                $this->fieldError($field['name'], $lang->getValue('form_err_canadian_provincial', $field['label']));
            }
        }
    }
?>