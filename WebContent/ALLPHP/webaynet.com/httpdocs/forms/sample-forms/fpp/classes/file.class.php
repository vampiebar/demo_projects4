<?php
    /**
     * Project: Form Processor Pro
     * File: file.class.php
     * 
     * @version 5.0
     * @copyright MitriDAT <info@mitridat.com>
     * @author Rosty Kerei <rosty.kerei@gmail.com>
     * @link http://www.email-form.com/
     * @package FPP5
     * @subpackage Core
     */

    /**
     * File class
     *  
     * @package FPP5
     */
    class File{
        
        /**
         * File name/path
         * 
         * @var string
         */
        var $name = '';
        
        /**
         * File object constructor
         *
         * @param string $name
         * @return boolean
         */
        function File($name = ''){
            $this->setName($name);
        }
        
        /**
         * File name setter
         *
         * @param string $name
         */
        function setName($name){
            $this->name = $name;
        }
        
        /**
         * Returns file content
         *
         * @return string
         */
        function getContent(){
            $this->tryExists();
            $this->tryReadable();
            
            $file = file($this->name);
            $content = implode('', $file);
            
            return $content;
        }

        /**
         * Returns file content as array
         *
         * @return array
         */
        function getContentArr(){
            $this->tryExists();
            $this->tryReadable();
            
            $file = file($this->name);
           
            return $file;
        }
        
        /**
         * Tries if file exists
         *
         * @return boolean | ERROR
         */
        function tryExists(){
        	global $lang;
        	
            if ($this->fileExists()){
                return true;
            }
            else{
                $e = new Error($lang->getValue('err_file_does_not_exist', $this->name));
            }
        }
        
        /**
         * Tries if file is readable
         *
         * @return boolean | ERROR
         */
        function tryReadable(){
        	global $lang;
        	
            if ($this->fileReadable()){
                return true;
            }
            else{
                $e = new Error($lang->getValue('err_file_is_not_readable', $this->name));
            } 
        }
        
        /**
         * Checks if file exists
         *
         * @return boolean
         */
        function fileExists(){
            /**
             * @todo Avability to use HTTP/FTP
             */

            return file_exists($this->name);
        }
        
        /**
         * Chacks if file is readable
         *
         * @return boolean
         */
        function fileReadable(){
            /**
             * @todo Avability to use HTTP/FTP
             */

            return is_readable($this->name);            
        }        
    }
?>