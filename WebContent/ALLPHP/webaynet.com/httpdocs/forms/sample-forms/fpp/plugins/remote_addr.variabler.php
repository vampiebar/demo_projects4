<?php
    /**
     * Project: Form Processor Pro
     * File: remote_addr.variabler.php
     * 
     * @version 5.0
     * @copyright MitriDAT <info@mitridat.com>
     * @author Rosty Kerei <rosty.kerei@gmail.com>
     * @link http://www.email-form.com/
     * @package Parser
     */
    
    /**
     * %REMOTE_ADDR variabler
     *
     * @return string
     */
    function remote_addr_variabler(){
        return $_SERVER['REMOTE_ADDR'];
    }
?>