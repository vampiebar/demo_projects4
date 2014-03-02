<?php
    /**
     * Project: Form Processor Pro
     * File: unique_submits.action.php
     * 
     * @version 5.0
     * @copyright MitriDAT <info@mitridat.com>
     * @author Rosty Kerei <rosty.kerei@gmail.com>
     * @author Sergey Bidnyi <sergey.bidnyi@gmail.com>
     * @link http://www.email-form.com/
     * @package Actions
     * @subpackage Validators
     */

    /**
     * Unique IP submits validation
     */
    
    class unique_submits_action extends Validator {
        function execute(){
        	global $lang;
        	global $request;
        	global $outputers;
        	global $formError;
        	if (count($outputers) != $request->getOutputOffset()+1) {
        		return true;
        	}
        	//if exist another errors this one isn't checked.
        	if($formError->isError()) {
        		return true;
        	}
        	
            $args = $this->getParsedArgument();
            $args = explode(',', $args);
            $args = array_map('trim', $args);
            
            if (count($args) < 2) {
            	$e = new Error($lang->getValue('err_unique_submits_params_count', count($fields)));
            }

            // date convert
            
            $num     = intval(substr($args[1], 0, -1));
            $pattern = substr($args[1], -1);
            
            switch (strtoupper($pattern)){
            	case 'Y':
            		$period = 31536000 * $num;
            		break;
            	case 'M':
            		$period = 2678400 * $num;
            		break;
            	case 'W':
            		$period = 604800 * $num;
            		break;
            	case 'D':
            		$period = 86400 * $num;
            		break;
            	case 'H':
            		$period = 3600 * $num;
            		break;
            	case 'I':
            		$period = 60 * $num;
            		break;
            	default:
            		$period = $num;
            		break;
            }
            
            if (file_exists(TMP_DIR . '__unique_submits.dat')){
            	$log = implode('', file(TMP_DIR . '__unique_submits.dat'));
            	$log = unserialize($log);
            }
            else {
            	$log = array($request->getFormName() => array());
            }
            
            $ipHash = md5(@$_SERVER['REMOTE_ADDR'].@$_SERVER['HTTP_X_FORWARDED_FOR'].@$_SERVER['HTTP_CLIENT_IP'].@$_SERVER['HTTP_VIA']);
            $formLog = $log[$request->getFormName()];
            $ipLog = isset($formLog[$ipHash]) ? $formLog[$ipHash] : array();
            
            $lastTime = time() - $period;
            $periodCounts = 0;
            
            for ($i=0, $j=count($ipLog); $i<$j; $i++){
            	if ($ipLog[$i] >= $lastTime){
            		$periodCounts++;	
            	}
            }
            
            if ($periodCounts >= $args[0]){
            	$this->fieldError('', $lang->getValue('form_err_denied_addr'));
			}
			else{
				$ipLog[] = time();
				$formLog[$ipHash] = $ipLog;
				$log[$request->getFormName()] = $formLog;
				$log = serialize($log);
				$fp = fopen(TMP_DIR . '__unique_submits.dat', 'w+');
				fwrite($fp, $log, strlen($log));
				fclose($fp);
			}
        }
    }
?>