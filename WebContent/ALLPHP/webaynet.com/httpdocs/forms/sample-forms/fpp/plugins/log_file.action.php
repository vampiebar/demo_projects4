<?php
    /**
     * Project: Form Processor Pro
     * File: log_file.action.php
     * 
     * @version 5.0
     * @copyright MitriDAT <info@mitridat.com>
     * @author Rosty Kerei <rosty.kerei@gmail.com>
     * @link http://www.email-form.com/
     * @package Actions
     * @subpackage Executors
     */

    /**
     * Log file executor
     * 
     * @package FPP5
     */
    class log_file_action extends Executor {
        function execute(){
        	global $lang;
        	
        	$tpl_file = new File($this->getParsedArgument());
        	$tpl = $tpl_file->getContentArr();
            
        	$log_file = trim($tpl[0]);
        	
        	if (!is_writable($log_file)){
        		$e = new Error($lang->getValue('err_file_is_not_writable', $log_file));
        	}
        	
        	$template = '';
        	
        	if (isset($tpl[1])) {
        		for ($i=1; $i<count($tpl); $i++){
        		    $template .= $tpl[$i];
        		}
        	}
        	
            $parser = new Parser();
            $parser->callbackFunc = '';
            $parser->assignVarList($this->getRequestData());
            $parser->setTemplate($template);
            $parser->parse();
            
            $fp = fopen($log_file, 'a+');
            fwrite($fp, $parser->getOutput());
            fclose($fp);
        }
    }
?>