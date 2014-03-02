<?php
    /**
     * Project: Form Processor Pro
     * File: http_user_agent.variabler.php
     * 
     * @version 5.0
     * @copyright MitriDAT <info@mitridat.com>
     * @author Sergey Bidnyi <sergey.bidnyi@gmail.com>
     * @link http://www.email-form.com/
     * @package Parser
     */
    
    /**
     * %HTTP_USER_AGENT variabler
     *
     * @return string
     */
    function http_user_agent_variabler(){
        return $_SERVER['HTTP_USER_AGENT'];
    }
?>