<?php
    /**
     * Project: Form Processor Pro
     * File: month_fields.action.php
     * 
     * @version 5.0
     * @copyright MitriDAT <info@mitridat.com>
     * @author Rosty Kerei <rosty.kerei@gmail.com>
     * @link http://www.email-form.com/
     * @package FPP5
     */

    /**
     * Day of month fields validator
     * 
     * @package FPP5
     */
    class monthday_fields_action extends Validator {
        function execute(){
        	global $lang;
            $fields = $this->fetchFields();
            $request = $this->getRequestData();
            foreach ($fields as $field){
                if (isset($request[$field['name']])){
                    if (($request[$field['name']] < 1) || ($request[$field['name']] >31)){
                        $this->fieldError($field['name'], $lang->getValue('form_err_monthday', $field['label']));
                	}
                }
            }
        }
    }
?>