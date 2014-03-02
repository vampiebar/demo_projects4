<?php
    /**
     * Project: Form Processor Pro
     * File: redirect.action.php
     * 
     * @version 5.0
     * @copyright MitriDAT <info@mitridat.com>
     * @author Rosty Kerei <rosty.kerei@gmail.com>
     * @link http://www.email-form.com/
     * @package Actions
     * @subpackage Outputers
     */

    /**
     * Redirect outputer
     * 
     * @package FPP5
     */
    class redirect_action extends Outputer {
        function execute(){
            $this->redirect($this->getParsedArgument('urlencode'));
        }
    }
?>