<?php
    /**
     * Project: Form Processor Pro
     * File: weekday_fields.action.php
     * 
     * @version 5.0
     * @copyright MitriDAT <info@mitridat.com>
     * @author Rosty Kerei <rosty.kerei@gmail.com>
     * @link http://www.email-form.com/
     * @package FPP5
     */

    /**
     * Weekday fields validator
     * 
     * @package FPP5
     */
    class weekday_fields_action extends Validator {
        function execute(){
        	global $lang;
        	
        	$days = array('1',
        	                '2',
        	                '3',
        	                '4',
        	                '5',
        	                '6',
        	                '7',
        	                '01',
        	                '02',
        	                '03',
        	                '04',
        	                '05',
        	                '06',
        	                '07',
        	                'mon',
        	                'tue',
        	                'wed',
        	                'thu',
        	                'fri',
        	                'sat',
        	                'sun',
        	                'monday',
        	                'tuesday',
        	                'wednesday',
        	                'thursday',
        	                'friday',
        	                'saturday',
        	                'sunday',
        	);
        	
            $fields = $this->fetchFields();
            $request = $this->getRequestData();
            foreach ($fields as $field){
                if (isset($request[$field['name']])){
                    if (!in_array(strtolower($request[$field['name']]), $days)){
                        $this->fieldError($field['name'], $lang->getValue('form_err_weekday', $field['label']));
                	}
                }
            }
        }
    }
?>