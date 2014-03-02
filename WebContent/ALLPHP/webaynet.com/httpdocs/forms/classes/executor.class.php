<?php
    /**
     * Project: Form Processor Pro
     * File: executor.class.php
     * 
     * @version 5.0
     * @copyright MitriDAT <info@mitridat.com>
     * @author Rosty Kerei <rosty.kerei@gmail.com>
     * @link http://www.email-form.com/
     * @package Actions
     */
    
    /**
     * Executor class. Realized common executors logic
     * 
     * @package FPP5
     * @abstract
     */
    class Executor extends Action {

        /**
         * Executor class constructor. Overwrites action type
         * to set itself as an executor 
         *
         * @return boolean
         */
    	function Executor(){
    	    return $this->setType(ACTION_TYPE_EXECUTOR);
    	}
    }
?>