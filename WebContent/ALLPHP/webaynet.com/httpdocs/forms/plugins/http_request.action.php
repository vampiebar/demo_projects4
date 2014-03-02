<?php
    /**
     * Project: Form Processor Pro
     * File: http_request.action.php
     * 
     * @version 5.0
     * @copyright MitriDAT <info@mitridat.com>
     * @author Rosty Kerei <rosty.kerei@gmail.com>
     * @link http://www.email-form.com/
     * @package Actions
     * @subpackage Executors
     */

    /**
     * HTTP Request executor
     * 
     * @package FPP5
     */
    class http_request_action extends Executor {
        function execute(){
            $url = $this->getParsedArgument('urlencode');
            
            $fp = @fopen($url, 'r');
            fclose($fp);
        }
    }
?>