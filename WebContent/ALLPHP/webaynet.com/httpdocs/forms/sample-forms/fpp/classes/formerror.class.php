<?php
    /**
     * Project: Form Processor Pro
     * File: formerror.class.php
     * 
     * @version 5.0
     * @copyright MitriDAT <info@mitridat.com>
     * @author Rosty Kerei <rosty.kerei@gmail.com>
     * @author Sergey bidnyi <sergey.bidnyi@gmail.com>
     * @link http://www.email-form.com/
     * @package FPP5
     * @subpackage Core
     */

    /**
     * FormError class. Holds form errors,
     * highlights error fields
     *  
     * @package FPP5
     */
    class FormError{
        
        /**
         * Errors pool
         *
         * @var array
         */
        var $errors = array();
        
        /**
         * Page template
         * 
         * @var string
         */
        var $template = '';
        
        /**
         * Output content
         * 
         * @var string
         */
        var $output = '';
        
        /**
         * Request data
         * 
         * @var array
         */
        var $request = array();
        
        /**
         * Error fileds highlight CSS style
         *
         * @var string
         */
        var $errFieldStyle = 'background-color: #FECDCD; border: solid 1px #FF0000;';
        
        /**
         * Error block begin HTML
         * 
         * @var string
         */
        var $errBlockBegin = '<table><tr><td align="left"><ol>';
        
        /**
         * Error block end HTML
         * 
         * @var string
         */
        var $errBlockEnd = '</ol></td></tr></table>';
        
        /**
         * Error message begin HTML
         * 
         * @var string
         */
        var $errMsgBegin = '<li style="color: #FF0000">';
        
        /**
         * Error message end HTML
         * 
         * @var string
         */
        var $errMsgEnd = '</li>';
        
        /**
         * Adds an error to the pool
         *
         * @param array $err
         * @return boolean
         */
        function errorPush($err){
            return $this->errors[] = $err;
        }
        
		/**
		 * Clear errors pool
		 *
		 * @return boolean
		 */
        function clearErrors(){
        	return $this->errors = array();
        }        	
        
        /**
         * Adds a field error to the pool
         *
         * @param string $field Field name
         * @param string $msg Error message
         * @return boolean
         */
        function fieldError($field, $msg){
            return $this->errorPush(array($field, $msg));
        }
        
        /**
         * Returns is error status
         * When errors number > 0
         *
         * @return boolean
         */
        function isError(){
            return (count($this->errors) > 0);
        }
        
        /**
         * Returns error pool
         *
         * @return array
         */
        function getErrors(){
            return $this->errors;
        }
        
        /**
         * Request data setter
         *
         * @param array
         * @return boolean
         */
        function setRequest($request_data){
            return $this->request = $request_data;
        }
                
        /**
         * Error fields style setter
         * 
         * @param string CSS
         * @return boolean
         */
        function setErrFieldStyle($errFieldStyle){
            return $this->errFieldStyle = $errFieldStyle;
        }

        /**
         * Error block begin setter
         * 
         * @param string HTML
         * @return boolean
         */
        function setErrBlockBegin($errBlockBegin){
            return $this->errBlockBegin = $errBlockBegin;
        }
        
        /**
         * Error block end setter
         * 
         * @param string HTML
         * @return boolean
         */
        function setErrBlockEnd($errBlockEnd){
            return $this->errBlockEnd = $errBlockEnd;
        }
        
        /**
         * Error message begin setter
         * 
         * @param string HTML
         * @return boolean
         */
        function setErrMsgBegin($errMsgBegin){
            return $this->errMsgBegin = $errMsgBegin;
        }
        
        /**
         * Error message end setter
         * 
         * @param string HTML
         * @return boolean
         */
        function setErrMsgEnd($errMsgEnd){
            return $this->errMsgEnd = $errMsgEnd;
        }
        
        /**
         * Template content setter
         * 
         * @param string
         * @return boolean
         */
        function setTemplate($content){
            $this->template = $content;
        }
        
        /**
         * Output getter
         * 
         * @return string
         */
        function getOutput(){
            return $this->output;
        }
        
        /**
         * Parses error page
         * 
         * @return boolean
         */
        function parse(){
            $output = $this->highlightFields($this->template);
            $output = $this->insertErrorMsg($output);
            $this->output = $output;
        }
        
        function highlightFields($pageContent){
            foreach ($this->request as $element_name => $element_value){
                $element_value = htmlspecialchars($element_value, ENT_QUOTES);
                preg_match_all('/<input.*?name\s*=\s*[\'"]?'.preg_quote($element_name).'([\'"]{1}.*?\/?>|\s*\/?>)/Ui', $pageContent, $match);
                
                if (count($match[0]) > 0){
                    $last_element = $match[0][count($match[0])-1];
                    if (preg_match('/type\s*=\s*[\'"]?text[\'"]?/i', $last_element)){
                        $changed_element = $last_element;
                        
                        if ($this->isErrorField($element_name)){
                            if (preg_match('/style\s*=/i', $changed_element)){
                            	$changed_element = preg_replace('/(style\s*=\s*[\'"]{1})(.*)([\'"]{1})/Ui', '$1$2 '.$this->preg_escape($this->errFieldStyle).'"$3', $changed_element, 1);
                            }
                            else{
                                $changed_element = preg_replace('/\/?>/', ' style="'.$this->preg_escape($this->errFieldStyle).'"$0', $changed_element);
                            }
                        }
                        
                        if (preg_match('/value\s*=/i', $changed_element)){
                            $changed_element = preg_replace('/value\s*=\s*[\'"]?[^\s>"]*[\'"]?/i', 'value="'.$this->preg_escape($element_value, '/').'"', $changed_element, 1);
                        }
                        else{
                            $changed_element = preg_replace('/\/?>/', ' value="'.$this->preg_escape($element_value).'"$0', $changed_element, 1);
                        }
                                                
                        $pageContent = str_replace($last_element, $changed_element, $pageContent);
                        continue;
                    }
                    
                    if (preg_match('/type\s*=\s*[\'"]?file[\'"]?/i', $last_element)){
                        $changed_element = $last_element;
                        if ($this->isErrorField($element_name)){
                            
                            if (preg_match('/style\s*=/i', $changed_element)){
                            	$changed_element = preg_replace('/(style\s*=\s*[\'"]{1})(.*)([\'"]{1})/Ui', '$1$2'.$this->preg_escape($this->errFieldStyle).'"$3', $changed_element, 1);
                            	
                            }
                            else{
                                $changed_element = preg_replace('/\/?>/', ' style="'.$this->preg_escape($this->errFieldStyle).'"$0', $changed_element);
                            }
                        }
                        $pageContent = str_replace($last_element, $changed_element, $pageContent);
                        continue;
                    }
                                        
                    if (preg_match('/type\s*=\s*[\'"]?radio[\'"]?/iU', $last_element)&&!empty($element_value)){
                        foreach ($match[0] as $radio_button){
                        	//print_r(array($radio_button, $element_name, $element_value));
                            if (preg_match('/value\s*=\s*[\'"]?' . preg_quote($element_value) . '[\'"]?/iU', $radio_button)){
                                $changed_element = preg_replace('/\s+checked/i', '', $radio_button, 1);
                                $changed_element = preg_replace('/\/?>/', ' checked$0', $radio_button, 1);
                            }
                            else{
                                $changed_element = preg_replace('/\s+checked/i', '', $radio_button, 1);
                            }
                            
                            $pageContent = str_replace($radio_button, $changed_element, $pageContent);
                        }
                        continue;
                    }
                    
                    
                    if (preg_match('/type\s*=\s*[\'"]?checkbox[\'"]?/Ui', $last_element)){
                    	//print_r(array($rb, $element_name, $element_value));
                        if (preg_match('/value\s*=\s*["\']' . preg_quote($element_value) . '["\']/iU', $last_element)){
                            $changed_element = preg_replace('/\s+checked/i', '', $last_element, 1);
                            $changed_element = preg_replace('/\/?>/', ' checked$0', $last_element, 1);
                        }
                        else{
                            $changed_element = preg_replace('/\s+checked/i', '', $last_element, 1);
                        }
                            
                        $empty_field = '<input type="hidden" value="" name="'.$element_name.'">';
                        $pageContent = str_replace($last_element, $empty_field.$changed_element, $pageContent);
                        
                        continue;
                    }
                    
                    if (preg_match('/type\s*=\s*"?submit|button|image|hidden"?/Ui', $last_element)){
                        continue;
                    }
                }
                
                preg_match_all('/\<textarea[^'."\n".']+name\s*=\s*[\'"]?'.preg_quote($element_name).'([\'"]{1}.*?\/?>|\s*\/?>)\s*(.*?)\s*\<\/textarea\>/sUi', $pageContent, $match);
                if (count($match[0]) > 0){
                    $textarea = $match[0][count($match[0])-1];
                    $changed_element = $textarea;
                    
                    if ($this->isErrorField($element_name)){
                        if (preg_match('/style\s*=/i', $changed_element)){
                            $changed_element = preg_replace('/(style\s*=\s*[\'"]{1})(.*)([\'"]{1})/Ui', '$1$2'.$this->preg_escape($this->errFieldStyle).'"$3', $changed_element, 1);
                        }
                        else{
                            $changed_element = preg_replace('/\<textarea/', '$0 style="'.$this->preg_escape($this->errFieldStyle).'"', $changed_element, 1);
                        }
                    }
                    
                    $changed_element = preg_replace('/(\<textarea[^'."\n".']*\>)(.*?)(\<\/textarea\>)/i', '$1'.$this->preg_escape($element_value).'$3', $changed_element);
                    
                    $pageContent = str_replace($textarea, $changed_element, $pageContent);
                    continue;
                }
                
                /**
                 * @todo multiple select fields...
                 * @todo options with NO value
                 */

                preg_match_all('/<select[^\'."\\n".\']+name\\s*=\\s*[\\\'"]?'.preg_quote($element_name).'[\\\'"]?.*?>\\s*(.*?)\\s*\\<\/select>/si', $pageContent, $match);
                if (count($match[0]) > 0) {	
			$select = $match[0][count($match[0])-1];
			$changed_element = $select;
			if (!$element_value == '') {				

		               	#$changed_element = preg_replace('/(\<option.*?)(\s+(selected|selected="selected"))(.*?\>)/i', '$1 $3', $select, 1);
				$changed_element = str_replace('selected', ' ', $select); #delete 'selected' from options
				$changed_element = str_replace('selected="selected"', ' ', $changed_element);	#delete 'selected="selected"' from options		 
                	
	                	if(preg_match('/(\<option.*?value\s*=\s*[\'"]?'.preg_quote($element_value).'[\'"]?)(.*?\>)/Ui', $changed_element)){
	                		$changed_element = preg_replace('/(\<option.*?value\s*=\s*[\'"]?'.preg_quote($element_value).'[\'"]?)(.*?\>)/i', '$1 selected="selected" $2', $changed_element);
	                	}
	                	else{
	                		$changed_element = preg_replace('/(\<option.*?)(>)('.preg_quote($element_value).')(<)/Ui', '$1 selected="selected" $2$3$4', $changed_element); 
	                	}
			}                
			
			
			if ($this->isErrorField($element_name)){
                        	if (preg_match('/style\s*=/i', $changed_element)){
	                         	$changed_element = preg_replace('/(style\s*=\s*[\'"]{1})(.*)([\'"]{1})/Ui', '$1$2'.$this->preg_escape($this->errFieldStyle).'"$3', $changed_element, 1);
	                        }
	                        else{
	                            $changed_element = preg_replace('/\<select/', '$0 style="'.$this->preg_escape($this->errFieldStyle).'"', $changed_element, 1);
	                        }
	                }	
			
                	$pageContent = str_replace($select, $changed_element, $pageContent);
                	continue;
                }
            }
            
            return $pageContent;
        }
        
        function preg_escape($str){
            $str = str_replace('\\', '\\\\', $str);
            return str_replace('$', '\$', $str);
        }
        
        function isErrorField($field_name){
            foreach ($this->errors as $errField){
                if ($errField[0] == $field_name) {
                	return true;
                }
            }
            
            return false;
        }
        
        function insertErrorMsg($pageContent){
            $errMsg = $this->errBlockBegin;
            
            foreach ($this->errors as $err){
                if (!empty($err[1])) {
                    $errMsg .= $this->errMsgBegin . htmlspecialchars_ent_quotes($err[1]) . $this->errMsgEnd;
                }
            }
            $errMsg .= $this->errBlockEnd;
            
            return preg_replace('/\<\!--\s*\FPP_ERROR\\s*--\>/', $errMsg, $pageContent, 1);
        }        
    }
?>