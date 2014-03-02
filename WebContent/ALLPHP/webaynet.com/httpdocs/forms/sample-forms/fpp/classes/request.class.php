<?php
/**
     * Project: Form Processor Pro
     * File: request.class.php
     * 
     * @version 5.0
     * @copyright MitriDAT <info@mitridat.com>
     * @author Rosty Kerei <rosty.kerei@gmail.com>
     * @link http://www.email-form.com/
     * @package FPP5
     * @subpackage Core
     */

/**
     * Separator for multiplefield values
     */

define('MULTI_SEPARATOR', ', ');

/**
     * cleaning up $_REQUEST data
     * if magic_quotes is on
     */
if (get_magic_quotes_gpc()){
	$_REQUEST = array_map('stripslashes_deep', $_REQUEST);
}

/**
     * Returns a string or an array
     * with backslashes stripped off
     *
     * @param mixed $value
     * @return mixed
     */
function stripslashes_deep($value){
	$value = is_array($value) ? array_map('stripslashes_deep', $value) : stripslashes($value);
	return $value;
}

/**
     * Request class
     * 
     * @static
     * @package FPP5
     */
class Request{

	/**
         * Request data
         * 
         * @var array
         */
	var $data = array();

	/**
         * Attached files
         * 
         * @var array
         */
	var $files = array();

	/**
         * Was it backstep requested
         * 
         * @var boolean
         */
	var $backStep = false;

	/**
         * Request constructor
         *
         * @return boolean
         */
	function Request(){
		global $formError;
		global $lang;

		$this->data = array();

		if (isset($_REQUEST['fpp_data'])){
			$this->data = $this->decodeFormData($_REQUEST['fpp_data']);
			unset($_REQUEST['fpp_data']);
		}

		if (isset($this->data['fpp_files'])){
			$this->files = $this->data['fpp_files'];
			unset($this->data['fpp_files']);
		}

		/**
             * Back action holder
             */

		if (isset($_REQUEST['fpp_back'])){
			if (!isset($this->data['fpp_output'])){
				$this->data['fpp_output'] = 1;
			}
			else if (($this->data['fpp_output'] - 1) < 1) {
				$this->data['fpp_output'] = 1;
			}
			else{
				$this->data['fpp_output']--;
			}

			$this->backStep = true;

			return true;
		}

		/**
             * Files upload
             */
		$files_request = array();
		foreach ($_FILES as $field_name => $file_data){
			$files_request[$field_name] = $file_data['name'];

			if ($file_data['error'] == UPLOAD_ERR_OK || $file_data['error'] == UPLOAD_ERR_NO_FILE){
				if ($file_data['error'] == UPLOAD_ERR_OK){
					$fpp_file_sufix = '_' . date('mdyHis') . '_' . rand(10, 99);
					$file_real_name = $file_data['name'];
					$last_dot_pos = strrpos($file_real_name, '.');

					if ($last_dot_pos === false) {
						$fpp_file_name = $file_real_name . $fpp_file_sufix;
					}
					else{
						$fpp_file_name = substr($file_real_name, 0, $last_dot_pos) . $fpp_file_sufix . substr($file_real_name, $last_dot_pos);
					}

					move_uploaded_file($file_data['tmp_name'], ATTACHMENT_DIR . $fpp_file_name);
					$file_data['fpp_name'] = $fpp_file_name;
					$files_request[$field_name] = ATTACHMENT_DIR . $fpp_file_name;
				}

				$this->files[$field_name] = $file_data;
			}
			else{
				if ($file_data['error'] == UPLOAD_ERR_INI_SIZE || $file_data['error'] == UPLOAD_ERR_FORM_SIZE) {
					$formError->fieldError($field_name, $lang->getValue('err_upload_size_exceed', $file_data['name']));
				}
				else{
					$formError->fieldError($field_name, $lang->getValue('err_upload_error', $file_data['name']));
				}
			}
		}

		$this->data = array_merge($this->data, $this->array_unfold($_REQUEST), $files_request);
		if (!isset($this->data['fpp_output'])){
			$this->data['fpp_output'] = 1;
		}

	}

	/**
         * Converts multi-level arrays to one-level
         * by changins elements name as their described
         * on HTML form. Recursive function
         * For multiple value fields also creates a string with values
         * 
         * Example:
         *      Input:  array('f' => array('0' => 'A', '1' => 'B'))
         *      Output: array('f[0]' => 'A', 'f[1]' => 'B');
         * 
         * @param array $arr
         * @param array $fold_arr
         * @param string $parent
         * @return array
         */
	function array_unfold($arr, $fold_arr = array(), $parent = ''){
		foreach ($arr as $arr_key => $arr_val){
			if (is_array($arr[$arr_key])){
				if ($parent == ''){
					$fold_arr = array_merge($fold_arr, $this->array_unfold($arr[$arr_key], $fold_arr, $arr_key));
					$temp = $arr[$arr_key];
					foreach ($temp as $key => $item) {
						if (empty($item)) { unset($temp[$key]); }
					}
                    
					$fold_arr = array_merge($fold_arr, array( $arr_key => join(MULTI_SEPARATOR,$temp)) );
				}
				else{
					$fold_arr = array_merge($fold_arr, $this->array_unfold($arr[$arr_key], $fold_arr, $parent . '[' . $arr_key . ']'));

				}
			}
			else{
				if ($parent == ''){
					$fold_arr[$arr_key] = $arr_val;
				}
				else {
					$fold_arr[$parent . '[' . $arr_key . ']'] = $arr_val;
				}
			}
		}

		return $fold_arr;
	}

	/**
         * Form data decoder
         * 
         * @return array
         */
	function decodeFormData($form_data){
		return unserialize(base64_decode($form_data));
	}

	function getFormName(){
		return isset($this->data['fpp_form']) ? $this->data['fpp_form'] : '';
	}

	function getOutputOffset(){
		return isset($this->data['fpp_output']) ? $this->data['fpp_output'] : '';
	}

	/**
         * Returns form files list
         * 
         * @return array
         */
	function getFiles(){
		return $this->files;
	}

	/**
         * stepBack getter
         * 
         * @return boolean
         */
	function isBackStep(){
		return $this->backStep;
	}
}
?>