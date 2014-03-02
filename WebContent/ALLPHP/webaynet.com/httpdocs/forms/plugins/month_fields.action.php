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
     * Month fields validator
     * 
     * @package FPP5
     */
    class month_fields_action extends Validator {
        function execute(){
        	global $lang;
        	
        	$months = array('1',
        	                '2',
        	                '3',
        	                '4',
        	                '5',
        	                '6',
        	                '7',
        	                '8',
        	                '9',
        	                '01',
        	                '02',
        	                '03',
        	                '04',
        	                '05',
        	                '06',
        	                '07',
        	                '08',
        	                '09',
        	                '10',
        	                '11',
        	                '12',
        	                'jan',
        	                'feb',
        	                'mar',
        	                'apr',
        	                'may',
        	                'jun',
        	                'jul',
        	                'aug',
        	                'sep',
        	                'oct',
        	                'nov',
        	                'dec',
        	                'january',
        	                'february',
        	                'march',
        	                'april',
        	                'may',
        	                'june',
        	                'july',
        	                'august',
        	                'september',
        	                'october',
        	                'november',
        	                'december',
        	);
        	
            $fields = $this->fetchFields();
            $request = $this->getRequestData();
            foreach ($fields as $field){
                if (isset($request[$field['name']])){
                    if (!in_array(strtolower($request[$field['name']]), $months)){
                        $this->fieldError($field['name'], $lang->getValue('form_err_month', $field['label']));
                	}
                }
            }
        }
    }
?>