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
     * Multi-language support class
     *  
     * @package FPP5
     */
    class Lang{
    	/**
    	 * Language ID
    	 * 
    	 * @var string
    	 */
		var $id = 'en';
		
		/**
		 * Charset
		 *
		 * @var string
		 */
		var $charset = 'ISO-8859-1';
		
		var $data = array();
		/**
		 * Constructor
		 *
		 * @param string $id
		 * @return Lang
		 */
		function Lang($id = DEFAULT_LANG){
			$this->id = strtolower($id);
			
			$lang_file = new File(LANGUAGE_DIR . $this->id . '.lang.php');
			
			if (!$lang_file->fileExists() || !$lang_file->fileReadable()){
				$e = new Error('Language file is not exists or not readable: ' . LANGUAGE_DIR . $this->id . '.lang.php');
			}
			
			$l = array();
			
			include(LANGUAGE_DIR . $this->id . '.lang.php');
			
			$this->data = array();
			$this->data = $l;
		}
		
		/**
		 * Returns parsed language value
		 *
		 * @param mixed
		 * @return string
		 */
		function getValue(){
			
			if (func_num_args() < 1){
				return '';
			}
			
			$id = strtolower(func_get_arg(0));
			
			$this->data[$id] = isset($this->data[$id]) ? $this->data[$id] : $id;
			
			$exec = '$result = sprintf($this->data[$id], ';
			for ($i=1; $i < func_num_args(); $i++){
				$exec .= "'" . addcslashes(func_get_arg($i), "'\\") . "', ";
			}
			
			$result = '';
			$exec	= substr($exec, 0, -2) . ');';
			
			eval($exec);
			
			return $result;
		}
    }
?>