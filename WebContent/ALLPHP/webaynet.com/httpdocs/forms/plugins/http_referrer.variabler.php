<?php
    /**
     * Project: Form Processor Pro
     * File: http_referrer.variabler.php
     * 
     * @version 5.0
     * @copyright MitriDAT <info@mitridat.com>
     * @author Sergey Bidnyi <sergey.bidnyi@gmail.com>
     * @link http://www.email-form.com/
     * @package Parser
     */
    
    /**
     * %HTTP_REFERRER variabler
     *
     * @return string
     */
    function http_referrer_variabler(){
        return $_SERVER['HTTP_REFERRER'];
    }
?>