<?php
    /**
     * Project: Form Processor Pro
     * File: parses.class.php
     * 
     * @version 5.0
     * @copyright MitriDAT <info@mitridat.com>
     * @author Rosty Kerei <rosty.kerei@gmail.com>
     * @link http://www.email-form.com/
     * @package FPP5
     * @subpackage Core
     */

    /**
     * Template parser
     * 
     * @package FPP5
     */
    class Parser{
        
        /**
         * Template content
         *
         * @var string
         */
		var $template = '';
		
		/**
		 * Parsing result
		 *
		 * @var string
		 */
		var $output = '';
		
		/**
		 * Initial variables list
		 *
		 * @var array
		 */
		var $_vars = array();
		
		/**
		 * Callback function name
		 * to process parsing variables
		 *
		 * @var string 
		 */
		var $callbackFunc = 'htmlspecialchars_ent_quotes';
		
		/**
		 * Template setter
		 *
		 * @param string $template
		 */
		function setTemplate($template){
			$this->template = $template;
			$this->output = $this->template;
		}

		/**
		 * Retuns parsed template
		 *
		 * @return string
		 */
        function getOutput(){
			return $this->output;
		}
		
		/**
		 * Assings a single variable
		 *
		 * @param string $name Variable name
		 * @param string $val Variable value
		 * @return boolean
		 */
		function assignVar($name, $val){
			return $this->_vars[$name] = $val;
		}
		
		/**
		 * Assigns variable list
		 *
		 * @param array $arr
		 * @return boolean
		 */
		function assignVarList($arr){
		    if (is_array($arr)){
		    	foreach ($arr as $name => $val){
		    	    $this->_vars[$name] = $val;
		    	}
		    	return true;
		    }
		    else{
		        return false;
		    }
		}
		
		/**
		 * Parser execution method
		 *
		 * @return boolean
		 */
		function parse(){
			/**
			 * Fetches all entries to be parsed
			 * if figure brackets {#...#}
			 */

			preg_match_all('/'.preg_quote(LEFT_DELIMETER).'(.*?)'.preg_quote(RIGHT_DELIMETER).'/', $this->output, $match);
			//preg_match_all('/'.\{'.(.*?)\}/', $this->output, $match);
			/**
			 * Parsing each entry
			 */
			foreach ($match[1] as $entry){
				$tags = $this->_quote_split(' ', $entry);
				$exec_tag = '';

				
				/**
				 * disable insecure functions
				 */
				
				//$old_dis_func = @ini_get('disabled_functions');
				//$new_dis_func = 'exec, system, popen,'.$old_dis_func;
				//@ini_set('disabled_functions', $new_dis_func);
				foreach ($tags as $tag){
					if (!preg_match('/^[A-Za-z_%]+/', $tag)){
						$exec_tag .= $tag;
						continue;
					}
					$exec_tag .= $this->_parse_tag($tag);
				}
				
				// restore default 'disabled_functions'
				//@ini_set('disabled_functions', $new_dis_func);
				
				$compiled_tag = '';
				
				if (!empty($exec_tag)){
					  //echo '$compiled_tag = '.$exec_tag.';';
					  @eval('$compiled_tag = '.$exec_tag.';');
				    
				}			
				
				$this->output = str_replace(LEFT_DELIMETER.$entry.RIGHT_DELIMETER, $compiled_tag, $this->output);
			}
		}
		
		/**
		 * Single tag parse
		 *
		 * @param string $tag
		 * @return string
		 */
		function _parse_tag($tag){
			$tag_arr = $this->_quote_split('|', $tag);

			/**
			 * if $tag is unkonow it is calulated directly
			 */
			
			if (!isset($this->_vars[$tag_arr[0]]) && (substr($tag_arr[0], 0, 1) != '%')){
				return $tag;
			}
					
			if (count($tag_arr) == 1){
                if (substr($tag_arr[0], 0, 1) == '%'){
			    	return '$this->_variabler(\'' . addcslashes($tag_arr[0], "'") . '\')';
			    }
			    else{
				    return (function_exists($this->callbackFunc)) ? 'call_user_func($this->callbackFunc, $this->_vars[\'' . $tag_arr[0] . '\'])' : '$this->_vars[\'' . $tag_arr[0] . '\']';
			    }
			}
			else{
				if (substr($tag_arr[0], 0, 1) == '%'){
			    	$exec_tag = '$this->_variabler(\'' . addcslashes($tag_arr[0], "'") . '\')';
			    }
			    else{
				    $exec_tag = (function_exists($this->callbackFunc)) ? 'call_user_func($this->callbackFunc, $this->_vars[\'' . $tag_arr[0] . '\'])' : '$this->_vars[\'' . $tag_arr[0] . '\']';
			    }
			    
				for ($i = 1; $i<count($tag_arr); $i++){
					$exec_tag = $this->_parse_mod($exec_tag, $tag_arr[$i]);
				}
				
				return $exec_tag;
			}
		}
		
		/**
		 * Modifiers parser
		 *
		 * @param string $arg
		 * @param string $mod
		 * @return string
		 */
		function _parse_mod($arg, $mod){
			global $lang;
			
			$mod_arr = $this->_quote_split(':', $mod);
			$mod_name = strtolower($mod_arr[0]);

			if (!function_exists('modifier_'.$mod_name)) {
				if (file_exists(PLUGINS_DIR . $mod_name . '.modifier.php') && is_readable(PLUGINS_DIR . $mod_name . '.modifier.php')){
					require_once(PLUGINS_DIR . $mod_name . '.modifier.php');
				}
				else{
					$e = new Error($lang->getValue('err_unknown_modifier', $mod_name));
				}
			}
			
			if (count($mod_arr) > 1){
				$result = 'modifier_'.$mod_name.'('.$arg.',';
				for ($i=1; $i<count($mod_arr); $i++){
					$mod_arg_start = substr($mod_arr[$i],0,1);
					$mod_arg_end = substr($mod_arr[$i],-1);
					
					if (($mod_arg_start != $mod_arg_start)||(($mod_arg_start != '\'')&&($mod_arg_start != '"'))){
						$mod_arr[$i] = '\'' . str_replace('\'', '\\\'', $mod_arr[$i]) . '\'';
					}
					
					$result .= $mod_arr[$i].',';
				}
				
				$result = rtrim($result, ',');
				$result .= ')';
			}
			else{
				$result = 'modifier_'.$mod_name.'('.$arg.')';
			}
			
			return $result;
		}
		
		/**
		 * Splits a string by $delimeter that not quoted
		 *
		 * @param string $delimeter
		 * @param string $str
		 * @return array
		 */
		function _quote_split($delimeter, $str){
			$match = explode($delimeter, $str);
			$result = array();
	
			for ($i = 0; $i < count($match); $i++){
				$db_quotes_count = $this->_db_quotes_count($match[$i]);	
				$si_quotes_count = $this->_si_quotes_count($match[$i]);	
	
				if ((($db_quotes_count == 0)||($db_quotes_count%2 == 0))&&(($si_quotes_count == 0)||($si_quotes_count%2 == 0))){
					$result[] = $match[$i];
					continue;
				}
				else if ($db_quotes_count%2 == 1){
					$con_match = $match[$i];
					for ($j = ($i+1); $j < count($match); $j++){
						$con_match .= $delimeter . $match[$j];
				
						$con_quotes_count = $this->_db_quotes_count($con_match);
						if ($con_quotes_count%2 == 0){
							$result[] = $con_match;
							$i = $j;
							break;
						}
					}
				}
				else if ($si_quotes_count%2 == 1){
					$con_match = $match[$i];
					for ($j = ($i+1); $j < count($match); $j++){
						$con_match .= $delimeter . $match[$j];
				
						$con_quotes_count = $this->_si_quotes_count($con_match);
						if ($con_quotes_count%2 == 0){
							$result[] = $con_match;
							$i = $j;
							break;
						}
					}
				}		
			}
	
			return $result;
		}

		/**
		 * Returns a number of double quotes
		 *
		 * @param string $str
		 * @return integer
		 */
		function _db_quotes_count($str){
			preg_match_all('/"/', $str, $match);
			$quotes = count($match[0]);
			preg_match_all('/\\\\"/', $str, $match);
			$escaped = count($match[0]);
	
			return $quotes - $escaped;
		}

		/**
		 * Returns a number of single quotes
		 *
		 * @param string $str
		 * @return integer
		 */
		function _si_quotes_count($str){
			preg_match_all('/\'/', $str, $match);
			$quotes = count($match[0]);
			preg_match_all('/\\\\\'/', $str, $match);
			$escaped = count($match[0]);
	
			return $quotes - $escaped;
		}
		
		/**
		 * Variablers parser
		 * 
		 * @param $name
		 * @return string
		 */
		function _variabler($var_name){
			global $lang;
			
		    $name = substr($var_name, 1);
		    
		    if (isset($_SERVER[$name])){
		    	return $_SERVER[$name];
		    }
		    
		    $name = strtolower($name);
		    
		    if (function_exists($name . '_variabler')){
		    	return call_user_func($name . '_variabler');
		    }
		    else{
                if (file_exists(PLUGINS_DIR . $name . '.variabler.php') && is_readable(PLUGINS_DIR . $name . '.variabler.php')){
					require_once(PLUGINS_DIR . $name . '.variabler.php');
					return call_user_func($name . '_variabler');
				}
				else{
					$e = new Error($lang->getValue('err_unknown_variabler', strtoupper($var_name)));
				}  
		    }
		}
    }
    

    
    /**
     *  Convert special characters to HTML entities 
     *
     * @param string $str
     * @return string
     */
    function htmlspecialchars_ent_quotes($str){
		return htmlspecialchars($str, ENT_QUOTES);	
	}
	
	/**
	 * Capitalizer. Built-in modifier
	 *
	 * @param string $string
	 * @param boolean $uc_digits
	 * @return string
	 */
	function modifier_capitalize($string, $uc_digits = 'false')
	{
		$uc_digits = (strtolower($uc_digits) == 'true');
		
    	modifier_capitalize_ucfirst(null, $uc_digits);
    	return preg_replace_callback('!\b\w+\b!', 'modifier_capitalize_ucfirst', $string);
	}

    /**
	 * Capitalizer. Built-in modifier
	 *
	 * @param string $string
	 * @param boolean $uc_digits
	 * @return string
	 */
	function modifier_capitalize_ucfirst($string, $uc_digits = null)
	{
	    static $_uc_digits = false;
    
    	if(isset($uc_digits)){
        	$_uc_digits = $uc_digits;
        	return;
    	}
    
	    if(!preg_match('!\d!',$string[0]) || $_uc_digits)
    	    return ucfirst($string[0]);
    	else
        	return $string[0];
	}
	
	/**
	 * Concatenator. Built-in modifier
	 *
	 * @param string
	 * @param string
	 * @return string
	 */
	function modifier_cat($string, $cat)
	{
    	return $string . $cat;
	}

	/**
	 * Chars counter. Built-in modifier
	 *
	 * @param string
	 * @param boolean
	 * @return integer
	 */	
	function modifier_count_characters($string, $include_spaces = 'false')
	{
		$include_spaces = (strtolower($include_spaces) == 'true');
		
    	if ($include_spaces) return(strlen($string));

    	return preg_match_all("/[^\s]/",$string, $match);
	}

    /**
	 * Paragraphs counter. Built-in modifier
	 *
	 * @param string
	 * @return integer
	 */
	function modifier_count_paragraphs($string)
	{
    	return count(preg_split('/[\r\n]+/', $string));
	}

    /**
	 * Sentences counter. Built-in modifier
	 *
	 * @param string
	 * @return integer
	 */
	function modifier_count_sentences($string)
	{
	    return preg_match_all('/[^\s]\.(?!\w)/', $string, $match);
	}

    /**
	 * Words counter. Built-in modifier
	 *
	 * @param string
	 * @return integer
	 */	
	function modifier_count_words($string)
	{
    	$split_array = preg_split('/\s+/',$string);
	    $word_count = preg_grep('/[a-zA-Z0-9\\x80-\\xff]/', $split_array);
	    return count($word_count);
	}

    /**
	 * Default modifier. Built-in modifier
	 *
	 * @param string
	 * @param string
	 * @return string
	 */	
	function modifier_default($string, $default = '')
	{
	    if (!isset($string) || $string === '')
	        return $default;
    	else
        	return $string;
	}

    /**
	 * Indent. Built-in modifier
	 *
	 * @param string
	 * @param integer
	 * @param string
	 * @return string
	 */	
	function modifier_indent($string,$chars=4,$char=" ")
	{
		$chars = intval($chars);
    	return preg_replace('!^!m',str_repeat($char,$chars),$string);
	}

    /**
	 * Lower. Built-in modifier
	 *
	 * @param string
	 * @return string
	 */	
	function modifier_lower($string)
	{
    	return strtolower($string);
	}
	
    /**
	 * Converts new lines to &lt;br&gt;. Built-in modifier
	 *
	 * @param string
	 * @return string
	 */	
	function modifier_nl2br($string)
	{
	if (!strpos($string, "\\n") === false || !strpos($string, "\\r") === false) {
		$string = str_replace("\\n", "\n", $string);
		$string = str_replace("\\r", "\r", $string);		
	}
    	return nl2br($string);
	}
	
    /**
	 * Preg-replace. Built-in modifier
	 *
	 * @param string
	 * @param string
	 * @param string
	 * @return string
	 */	
	function modifier_regex_replace($string, $search, $replace)
	{
    	if (preg_match('!\W(\w+)$!s', $search, $match) && (strpos($match[1], 'e') !== false)) {
        	$search = substr($search, 0, -strlen($match[1])) . str_replace('e', '', $match[1]);
    	}
    	return preg_replace($search, $replace, $string);
	}
	
    /**
	 * Replace. Built-in modifier
	 *
	 * @param string
	 * @param string
	 * @param string
	 * @return string
	 */	
	function modifier_replace($string, $search, $replace)
	{
    	return str_replace($search, $replace, $string);
	}
	
    /**
	 * Spacify. Built-in modifier
	 *
	 * @param string
	 * @param string
	 * @return string
	 */	
	function modifier_spacify($string, $spacify_char = ' ')
	{
    	return implode($spacify_char, preg_split('//', $string, -1, PREG_SPLIT_NO_EMPTY));
	}
	
    /**
	 * String format. Built-in modifier
	 *
	 * @param string
	 * @param string
	 * @return string
	 */	
	function modifier_string_format($string, $format)
	{
    	return sprintf($format, $string);
	}
	
    /**
	 * Strip. Built-in modifier
	 *
	 * @param string
	 * @return string
	 */	
	function modifier_strip($text, $replace = ' ')
	{
    	return preg_replace('!\s+!', $replace, $text);
	}
	
    /**
	 * Tags stripper. Built-in modifier
	 *
	 * @param string
	 * @param string
	 * @return string
	 */	
	function modifier_strip_tags($string, $replace_with_space = 'true')
	{
    	if ((strtolower($replace_with_space) == 'true'))
        	return preg_replace('!<[^>]*?>!', ' ', $string);
    	else
        	return strip_tags($string);
	}
	
    /**
	 * Truncate. Built-in modifier
	 *
	 * @param string
	 * @param integer
	 * @param string
	 * @param string
	 * @param string
	 * @return string
	 */	
	function modifier_truncate($string, $length = 80, $etc = '...', $break_words = 'false', $middle = 'false')
	{
		$length = intval($length);
		$break_words = (strtolower($break_words) == 'true');
		$middle = (strtolower($middle) == 'true');
		
    	if ($length == 0)
        	return '';

    	if (strlen($string) > $length) {
        	$length -= strlen($etc);
        	if (!$break_words && !$middle) {
            	$string = preg_replace('/\s+?(\S+)?$/', '', substr($string, 0, $length+1));
        	}
        	if(!$middle) {
            	return substr($string, 0, $length).$etc;
        	} else {
            	return substr($string, 0, $length/2) . $etc . substr($string, -$length/2);
        	}
    	} else {
        	return $string;
    	}
	}

    /**
	 * Upper. Built-in modifier
	 *
	 * @param string
	 * @return string
	 */	
	function modifier_upper($string)
	{
    	return strtoupper($string);
	}
	
    /**
	 * Wordwrapper. Built-in modifier
	 *
	 * @param string
	 * @return string
	 */	
	function modifier_wordwrap($string,$length=80,$break="\n",$cut='false')
	{
		$length = intval($length);
		$cut = (strtolower($cut) == 'true');
	    return wordwrap($string,$length,$break,$cut);
	}
	
	/**
	 * IfCond. If match field then $outputtrue else $outputfalse
	 * 
	 * @param boolean
	 * @return string
	 */
	
	function ifcond($cond, $outputtrue, $outputfalse){
		return $cond?sprintf('%s', $outputtrue):sprintf('%s', $outputfalse);
	}
	
    /**
     * Switch output for input value
     *
     * @param string $field  
     * @param string $cases
     * @param string $out
     * @param string $delimiter
     * @param string $default
     * @return string
     */
	
	function sw($field, $cases, $outs,  $default='',$delimiter = ',') {
        $c = explode($delimiter,$cases); 
        $o = explode($delimiter,$outs);
        
        $field = $_POST[$field];  
        
        $key = array_search($field, $c, false);
        #return ($key===null)?$default:sprintf("%s", $o[$key]);
        return ($key===false)?$default:sprintf("%s", $o[$key]);
    }
    
?>