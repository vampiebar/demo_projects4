<?php
    /**
     * Project: Form Processor Pro
     * File: time_fields.action.php
     * 
     * @version 5.0
     * @copyright MitriDAT <info@mitridat.com>
     * @author Rosty Kerei <rosty.kerei@gmail.com>
     * @link http://www.email-form.com/
     * @package FPP5
     */

    /**
     * Date fields validator
     * 
     * @package FPP5
     */
    class time_fields_action extends Validator {
        function execute(){
        	global $lang;
        	
            $fields = $this->fetchFields();
            $request = $this->getRequestData();

            # 1:01 AM | 23:52:01 | 03.24.36 AM
            $regex = '#(^((([0]?[1-9]|1[0-2])(:|\.)[0-5][0-9]((:|\.)[0-5][0-9])?( )?(AM|am|aM|Am|PM|pm|pM|Pm))|(([0]?[0-9]|1[0-9]|2[0-3])(:|\.)[0-5][0-9]((:|\.)[0-5][0-9])?))$)#';

            $fields = $this->getUnmatchFields($regex);

            foreach ($fields as $field){
                $this->fieldError($field['name'], $lang->getValue('form_err_url', $field['label']));
            }

        }
    }
?>