<?php
    /**
     * Project: Form Processor Pro
     * File: date.variabler.php
     * 
     * @version 5.0
     * @copyright MitriDAT <info@mitridat.com>
     * @author Rosty Kerei <rosty.kerei@gmail.com>
     * @link http://www.email-form.com/
     * @package Parser
     */
    
    /**
     * %DATE variabler
     *
     * @return string
     */
    function date_variabler(){
    	global $config;
    	
    	$f = $config->getSetting('date_format') ? $config->getSetting('date_format') : 'r';
        return date($f);
    }
?>