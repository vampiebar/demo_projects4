<?php
    /**
     * Project: Form Processor Pro
     * File: date_fields.action.php
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
    class date_fields_action extends Validator {
        function execute(){
            global $lang;

            $fields = $this->fetchFields();
            $request = $this->getRequestData();
            #31 31 9999 | 31 31 99
            $regex = '#(^([0]?[1-9]|[1|2][0-9]|[3][0|1])[./-|[:blank:]]([0]?[1-9]|[1|2][0-9]|[3][0|1])[./-|[:blank:]]([0-9]{4}|[0-9]{2})$)';
            #09 March 2005 | 29 Feb2004 | 31 December 9999
            $regex .= '|(^((31(?!\ (Feb(ruary)?|Apr(il)?|June?|(Sep(?=\b|t)t?|Nov)(ember)?)))|((30|29)(?!\ Feb(ruary)?))|(29(?=\ Feb(ruary)?\ (((1[6-9]|[2-9]\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00)))))|(0?[1-9])|1\d|2[0-8])\ (Jan(uary)?|Feb(ruary)?|Ma(r(ch)?|y)|Apr(il)?|Ju((ly?)|(ne?))|Aug(ust)?|Oct(ober)?|(Sep(?=\b|t)t?|Nov|Dec)(ember)?)\ ((1[6-9]|[2-9]\d)\d{2})$)#';

            $fields = $this->getUnmatchFields($regex);

            foreach ($fields as $field){
                $this->fieldError($field['name'], $lang->getValue('form_err_url', $field['label']));
            }
        }
    }
?>