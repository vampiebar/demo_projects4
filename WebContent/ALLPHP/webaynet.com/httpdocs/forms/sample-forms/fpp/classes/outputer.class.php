<?php
    /**
     * Project: Form Processor Pro
     * File: outputer.class.php
     * 
     * @version 5.0
     * @copyright MitriDAT <info@mitridat.com>
     * @author Rosty Kerei <rosty.kerei@gmail.com>
     * @link http://www.email-form.com/
     * @package Actions
     */
    
    /**
     * Outputer class. Realized common outputers logic
     * 
     * @package FPP5
     * @abstract
     */
    class Outputer extends Action {
        
        /**
         * Response instance
         * 
         * @var object
         */
        var $response;

        /**
         * Outputer class constructor. Overwrites action type
         * to set itself as an outputer 
         *
         * @return boolean
         */
    	function Outputer(){
    		global $response;
    		
    	    $this->response = $response;
    	    $this->setType(ACTION_TYPE_OUTPUTER);
    	    return true;
    	}
    	
    	/**
    	 * Does contents output
    	 *
    	 * @param string $content
    	 * @return void
    	 */
    	function output($content, $isError = false){
    	    if ($isError){
    	    	$request = $this->getRequestData();
    	    	$this->response->setOuputOffset($request['fpp_output']);
    	    }
    	    
            $this->response->setContent($content);
            $this->response->printOut();
    	}
    	
    	function redirect($url){
            if (function_exists('ob_start')){
            	ob_start();
            	ob_clean();
            }
            
            header('Location: ' . $url);
            exit();
    	}
    	
		/**
		 * Shows default page
     	 *
     	 * @return void
     	 */
    	function showDefaultPage(){
    		global $lang;
    		
    		$content  = '';
    		$content .= '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"'."\n";
   			$content .= '"http://www.w3.org/TR/html4/loose.dtd">'."\n";
    		$content .= '<html>';
			$content .= '<head>';
			$content .= '<title>' . $lang->getValue('default_page_title') . '</title>';
			$content .= '</head>';
			$content .= '<body bgcolor="#FFFFFF" text="#000000" link="navy" vlink="navy" alink="red" style="font-family: verdana, arial, sans-serif; font-size: 8;">';
			$content .= '<center><table border="0" cellpadding="0" cellspacing="0" width="600" style="font-family: verdana, arial, sans-serif; font-size: 12;">';
  			$content .= '<tr><td>';
        	$content .= '<p align="center">' . $lang->getValue('default_page_content') . '</p>';
        	$content .= '<p align="center">' . $lang->getValue('default_page_footer') . '</td>';
  			$content .= '</tr>';
			$content .= '</table>';
			$content .= '</center>';
			$content .= '</body>';
			$content .= '</html>';
    	
    		$this->output($content);
    	}    	
    }
?>