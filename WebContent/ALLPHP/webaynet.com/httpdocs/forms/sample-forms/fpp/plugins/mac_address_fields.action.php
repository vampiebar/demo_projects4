<?php
    /**
     * Project: Form Processor Pro
     * File: mac_address_fields.action.php
     * 
     * @version 5.0
     * @copyright MitriDAT <info@mitridat.com>
     * @author Rosty Kerei <rosty.kerei@gmail.com>
     * @link http://www.email-form.com/
     * @package Actions
     * @subpackage Validators
     */

    /**
     * Deisgned to verify a MAC address with hex values seperated by a colon.
     * 
     * @package FPP5
     */
    class mac_address_fields_action extends Validator {
        function execute(){
        	global $lang;
        	
            $fields = $this->getUnmatchFields('/((\d|([a-f]|[A-F])){2}:){5}(\d|([a-f]|[A-F])){2}/');
            
            foreach ($fields as $field){
                $this->fieldError($field['name'], $lang->getValue('form_err_mac_address', $field['label']));
            }
        }
    }
?>