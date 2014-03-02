<?php
    /**
     * Project: Form Processor Pro
     * File: action.class.php
     * 
     * @version 5.0
     * @copyright MitriDAT <info@mitridat.com>
     * @author Rosty Kerei <rosty.kerei@gmail.com>
     * @link http://www.email-form.com/
     * @package FPP5
     * @subpackage Core
     */
    
    /**
     * Action type constants
     */
    define('ACTION_TYPE_UNDEFINED', 0);
    define('ACTION_TYPE_VALIDATOR', 1);
    define('ACTION_TYPE_EXECUTOR',  2);
    define('ACTION_TYPE_OUTPUTER',  3);
    
    /**
     * Action class. This is an abstract class and it should be
     * inheriter by another action-type class. Realizes common
     * actions logic.
     *  
     * @package FPP5
     * @abstract
     */
    class Action {
        
        /**
         * Type of action
         * <ul>
         *  <li>0 = ACTION_TYPE_UNDEFINED = undefined</li>
         *  <li>1 = ACTION_TYPE_VALIDATOR = validator</li>
         *  <li>2 = ACTION_TYPE_EXECUTOR = executor</li>
         *  <li>3 = ACTION_TYPE_OUTPUTER = outputer</li>
         * </ul>
         * 
         * @var integer
         */
        var $type = ACTION_TYPE_UNDEFINED;

        /**
         * Action argument (gotten from form config)
         *
         * @var string
         */
        var $argument = '';
        /**
         * Action class name getter
         *
         * @return class name
         */
        function name()
        {
                return get_class($this);
        }


        /**
         * Action class constructor
         *
         * @return exception
         * @throws E_USER_NOTICE
         * @abstract
         */
    	function Action() {
    		user_error('Cannot instantiate abstract class');
    		exit();
    	}

    	/**
    	 * The parameterized factory method
    	 *
    	 * @param string $action Action class name
    	 * @return object
    	 */
        function Factory($action){
            require_once(PLUGINS_DIR . $action . '.action.php');

            $actionClass = $action . '_action';
            return new $actionClass;
        }

        /**
         * Action type getter
         *
         * @return integer Type of action
         * @see Action::type
         */
        function getType(){
            return $this->type;
        }

        /**
         * Action type setter
         *
         * @param interer Type of action
         * @return boolean
         * @see Action::type
         */
        function setType($type){
            return $this->type = $type;
        }

        /**
         * Action argument getter
         *
         * @return string Action's argument
         * @see Action::argument
         */
        function getArgument(){
            return $this->argument;
        }

        /**
         * Action argument setter
         *
         * @param string Action's argument
         * @return boolean
         * @see Action::argument
         */
        function setArgument($argument){
            return $this->argument = $argument;
        }

        /**
         * Returns parsed argument
         *
         * @param string Parser callback function
         * @see Parser::callBackFunc
         * @return string
         */
        function getParsedArgument($callBackFunc = ''){
            $parser = new Parser();
            $parser->callbackFunc = $callBackFunc;
            $parser->setTemplate($this->getArgument());
            $parser->assignVarList($this->getRequestData());
            $parser->parse();

            return $parser->getOutput();
        }

        /**
         * Checks if action file is available
         *
         * @param string Action name
         * @return boolean
         * @static
         */
        function isAvailable($action_name){
            return file_exists(PLUGINS_DIR . $action_name . '.action.php');
        }

        /**
         * Abstract execution function
         *
         * @return void
         * @throws E_USER_NOTICE
         * @abstract
         */
        function execute(){
            user_error('Method execute should be overwritten');
            exit();
        }

        /**
         * Returns request data
         *
         * @return array
         */
        function getRequestData(){
            global $request;

            return $request->data;
        }

        /**
         * Returns configuration setting
         *
         * @param string Setting name
         * @return string
         */
        function getSetting($name){
            global $config;

            return $config->getSetting($name);
        }
    }
?>