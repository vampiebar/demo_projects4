<?php
    /**
     * Project: Form Processor Pro
     * File: config.class.php
     * 
     * @version 5.0
     * @copyright MitriDAT <info@mitridat.com>
     * @author Rosty Kerei <rosty.kerei@gmail.com>
     * @link http://www.email-form.com/
     * @package FPP5
     * @subpackage Core
     */

    /**
     * Configuration class
     * 
     * @static
     * @package FPP5
     */
    class Config{
        /**
         * Whole configuration data grabbed
         * from configuration file
         * 
         * @var array
         */
        var $data = array('.' => array());
        
        /**
         * Name of the active part
         * 
         * @var string
         */
        var $part_name = '.';
        
        /**
         * Settings pool
         * 
         * @var array
         */
        var $settings;
        
        /**
         * Actions pool
         * 
         * @var array
         */
        var $actions;
        
        /**
         * Congfig constructor. Reads all the data
         * from configuration file
         * 
         * @return boolean
         */
        function Config(){
        	global $lang;
        	
            if (file_exists(CONFIG_FILE)){
                $config_file = new File(CONFIG_FILE);
            	$content = $config_file->getContentArr();
            	
            	$root = '.';
            	
                foreach ($content as $line){
                    $line = trim($line);
                
                    if (preg_match('/^\[([\w-]+)\]$/', $line, $match)){
                        $root = $match[1];
                        $this->data[strtolower($root)] = array();
                        continue;
                    }
                
                    if (preg_match('/^(\w+)\s*=\s*(.*?)\s*$/', $line, $match)){
                	   $this->data[$root][] = array('name'  => strtolower($match[1]),
                	                                'value' => $match[2]);
                    }
                }
                
                return true;
            }
            else {
                $e = new Error($lang->getValue('err_config_file_not_found', CONFIG_FILE));
                return false;
            }
        }
        
        /**
         * Checks is config part available
         * 
         * @param string $part_name
         * @return boolean
         */
        function isPartAvailable($part_name){
            return isset($this->data[$part_name]);
        }

        
        /**
         * Part name getter
         *
         * @return string
         */
        function getPartName(){
            return $this->part_name;
        }
        
        /**
         * Part name setter
         *
         * @param string $part_name
         * @return boolean
         */
        function setPartName($part_name){
            $this->part_name = $part_name;
            
            $this->settings = array();
            $this->actions = array();
            
            /**
             * Fetching settings from common part
             */
            foreach ($this->data['.'] as $var){
                $this->settings[$var['name']] = $var['value'];
            }
            
            /**
             * Parsing part data
             */
            if ($this->isPartAvailable($this->part_name)){
            	foreach ($this->data[$this->part_name] as $var){
            	    
            	    if (Action::isAvailable($var['name'])) {
            	    	$this->actions[] = $var;
            	    }
            	    else{
            	        $this->settings[$var['name']] = $var['value'];
            	    }
            	}            	
            }
        }
        
        /**
         * Returns settings value
         * 
         * @param string $name
         * @return mixed (string | boolean)
         */
        function getSetting($name){
            return isset($this->settings[$name]) ? $this->settings[$name] : false;
        }
        
        /**
         * Returns actions list
         * 
         * @return array
         */
        function getActionsList(){
            return $this->actions;
        }
    }
?>