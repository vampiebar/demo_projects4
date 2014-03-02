<?php
    /**
     * Project: Form Processor Pro
     * File: expire_date.action.php
     * 
     * @version 5.0
     * @copyright MitriDAT <info@mitridat.com>
     * @author Rosty Kerei <rosty.kerei@gmail.com>
     * @link http://www.email-form.com/
     * @package Actions
     * @subpackage Validators
     */

    /**
     * expire_date validation
     */
    
    class expire_date_action extends Validator {
        function execute(){
        	global $lang;
        	
            $arg = $this->getParsedArgument();
            
            $exp_date = strtotime($arg);
            
            if (($exp_date === -1) || ($exp_date === false)){
            	$e = new Error($lang->getValue('form_err_expired_time_format'));
            }

            if ($exp_date > time()){
            	$this->fieldError('', $lang->getValue('form_err_expired'));
			}
        }
    }
?>