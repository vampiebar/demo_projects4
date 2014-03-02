<?php
    /**
     * Project: Form Processor Pro
     * File: file_filter_fields.action.php
     * 
     * @version 5.0
     * @copyright MitriDAT <info@mitridat.com>
     * @author Sergey Bidnyi <sergey.bidnyi@gmail.com>
     * @link http://www.email-form.com/
     * @package Actions
     * @subpackage Validators
     */

    /**
     * Files extension validator
     * 
     * @package FPP5
     */
    class file_filter_fields_action extends Validator {
        function execute(){
        	global $lang, $config, $request;
        	
        	/**
        	 *  extensions in such format: txt|doc|rtf
        	 */
        
        	$filter = $config->getSetting('allowed_files');
        	
        	$parser = new Parser();
            $parser->setTemplate($filter);
            $parser->assignVarList($request->data);
            $parser->parse();
        	$filter = $parser->getOutput();
        	
        	$fields = $this->getUnmatchFields('/\.('. $filter .')$/i');
        	
        	// no fields: allowed_files is empty
        	$filter = ($filter=='')? $fields = array() : $filter;
        	        	
            foreach ($fields as $field){
                $this->fieldError($field['name'], $lang->getValue('form_err_filter_file', $field['label'], $filter));
            }
        	 
        	
        }
    }
?>