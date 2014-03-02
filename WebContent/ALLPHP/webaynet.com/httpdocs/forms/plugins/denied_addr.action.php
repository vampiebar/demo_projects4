<?php
    /**
     * Project: Form Processor Pro
     * File: denied_addr.action.php
     * 
     * @version 5.0
     * @copyright MitriDAT <info@mitridat.com>
     * @author Rosty Kerei <rosty.kerei@gmail.com>
     * @link http://www.email-form.com/
     * @package Actions
     * @subpackage Validators
     */

    /**
     * User's host address validation
     */
    
    class denied_addr_action extends Validator {
        function execute(){
        	global $lang;
        	
            $arg = $this->getArgument();
            $ips = explode(',', $arg);
            $ips = array_map('trim', $ips);
            
            foreach ($ips as $ip_mask){
                $ip_pattern = str_replace('.', '\\.', $ip_mask);
                $ip_pattern = '/' . str_replace('*', '(.*)', $ip_pattern) . '/';
                
                if (preg_match($ip_pattern, gethostbyaddr($_SERVER['REMOTE_ADDR']))){
                	$this->fieldError('', $lang->getValue('form_err_denied_addr'));
                }
            }
        }
    }
?>