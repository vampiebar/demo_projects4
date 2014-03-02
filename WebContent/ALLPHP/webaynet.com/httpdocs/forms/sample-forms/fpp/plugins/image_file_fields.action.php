<?php
    /**
     * Project: Form Processor Pro
     * File: image_file_fields.action.php
     * 
     * @version 5.0
     * @copyright MitriDAT <info@mitridat.com>
     * @author Rosty Kerei <rosty.kerei@gmail.com>
     * @link http://www.email-form.com/
     * @package FPP5
     */

    /**
     * Image files extension validator
     * 
     * @package FPP5
     */
    class image_file_fields_action extends Validator {
        function execute(){
        	global $lang;
        	
            $fields = $this->getUnmatchFields('/\.(bmp|gif|jpeg|jpg|png|tiff|tif|ico)$/i');
            
            foreach ($fields as $field){
                $this->fieldError($field['name'], $lang->getValue('form_err_image_file', $field['label']));
            }
        }
    }
?>