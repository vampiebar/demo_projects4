<?php
    /**
     * Project: Form Processor Pro
     * File: index.php
     *
     * @version 5.0
     * @since 2008-02-25 16:20
     * @copyright MitriDAT <info@mitridat.com>
     * @author Rosty Kerei <rosty.kerei@gmail.com>
     * @author Sergey Bidnyi <sergey.bidnyi@gmail.com>
     * @link http://www.email-form.com/
     * @package FPP5
     * @subpackage Core
     */

    /**
     * Right and left delimeters for template entities
     */
    
    define('RIGHT_DELIMETER', '#}');
    define('LEFT_DELIMETER', '{#');
    
    /**
     * Path definitions
     */
    define('PLUGINS_DIR',    './plugins/');
    define('CLASSES_DIR',    './classes/');
    define('CONFIG_FILE',    './config.php');
    define('ATTACHMENT_DIR', './attachments/');
    define('LANGUAGE_DIR',	 './lang/');
    define('TMP_DIR',	 	 './tmp/');
    
    /**
     * Default language definition
     */
    define('DEFAULT_LANG',	 'en');
    
    /**
     * Loading common classes
     */
    require_once(PLUGINS_DIR . 'common.php');
    require_once(CLASSES_DIR . 'error.class.php');
    require_once(CLASSES_DIR . 'file.class.php');
    require_once(CLASSES_DIR . 'config.class.php');
    require_once(CLASSES_DIR . 'lang.class.php');
    require_once(CLASSES_DIR . 'request.class.php');
    require_once(CLASSES_DIR . 'response.class.php');
    require_once(CLASSES_DIR . 'action.class.php');
    require_once(CLASSES_DIR . 'validator.class.php');
    require_once(CLASSES_DIR . 'executor.class.php');
    require_once(CLASSES_DIR . 'outputer.class.php');
    require_once(CLASSES_DIR . 'parser.class.php');
    require_once(CLASSES_DIR . 'formerror.class.php');

    /**
     * Main classes construction
     */
    $lang		= new Lang();
    $config		= new Config();
    $formError	= new FormError();
    $request	= new Request();
    $response	= new Response();

    
    /**
     * Checking writable dirs
     */
    if (!is_writable(ATTACHMENT_DIR)){
    	$e = new Error($lang->getValue('err_dir_not_writable', ATTACHMENT_DIR));
    }
	if (!is_writable(TMP_DIR)){
    	$e = new Error($lang->getValue('err_dir_not_writable', TMP_DIR));
    }
        
	/**
     * Loading configuration
     */
    
    if ($config->isPartAvailable($request->getFormName())){
    	$config->setPartName($request->getFormName());
    }
    else{
		if ($config->getSetting('language')){
    		$lang->Lang($config->getSetting('language'));
		}
    
    	if ($request->getFormName() == ''){
			$outputer = new Outputer();
			$outputer->showDefaultPage();
    	}
    	
        $e = new Error($lang->getValue('err_form_not_described', $request->getFormName()));
    }

	if ($config->getSetting('language')){
		$lang->Lang($config->getSetting('language'));
	}
	
    /**
     * Sorting actions
     */
    $actions = $config->getActionsList();
    
    $validators = array();
    $executors = array();
    $outputers = array();
    
    foreach ($actions as $action_data){
        $action = Action::Factory($action_data['name']);
        $action->setArgument($action_data['value']);
        
        switch ($action->getType()){
            case ACTION_TYPE_VALIDATOR:
                $validators[] = $action;
                break;
            case ACTION_TYPE_EXECUTOR:
                $executors[] = $action;
                break;
            case ACTION_TYPE_OUTPUTER:
                $outputers[] = $action;
                break;
        }
    }

    /*session_start();
    if (count($outputers) == $request->getOutputOffset()+1){ #if last page        
        if ($_SESSION['endscript_' .  $request->getFormName()] == 'true') { #if end key for current form is set
            unset($_SESSION['endscript_' .  $request->getFormName()]); #destroy key
            header('Location: ' . $outputers[0]->argument); #redirect to first from page
            exit; #exit ;-)
        }
    }
    if ($request->getOutputOffset() == 1) {
    	unset($_SESSION['endscript_' .  $request->getFormName()]); #destroy key
    }*/


	/**
	 * Step-back process
	 */
	if ($request->isBackStep()){
		if (isset($outputers[$request->getOutputOffset()])){
        	/**
         	 * Sets request data
         	 */
        	#$formError->setRequest($request->data);
		#<add data from page where 'back' button was pressed
		$next_page_vars = $request->array_unfold($_REQUEST);
		unset($next_page_vars['fpp_back']);		
		$request->data = array_merge($request->data, $next_page_vars);		
		#>
		$formError->setRequest($request->data);
        	$formError->clearErrors();

        	/**
         	 * Sets template content
         	 */
        	$template_file = new File($outputers[$request->getOutputOffset()-1]->getParsedArgument());
        
        	$parser = new Parser();
        	$parser->setTemplate($template_file->getContent());
        	$parser->assignVarList($request->data);
        	$parser->parse();
        
        	$formError->setTemplate($parser->getOutput());

        	/**
         	* Parse error page
         	*/
        	$formError->parse();

			$outputers[$request->getOutputOffset()]->output($formError->getOutput(), true);
    	}
    	else{
			$outputer = new Outputer();
			$outputer->showDefaultPage();
    	}
	}
	
    /**
     * Executing validators
     */
    foreach ($validators as $validator){
        $validator->execute();
    }
    
    /**
     * Form error processing
     */
    
    if ($formError->isError()){
        /**
         * Appling configuration settings
         */
        if ($config->getSetting('error_field_style'))   $formError->setErrFieldStyle($config->getSetting('error_field_style'));
        if ($config->getSetting('error_block_begin'))   $formError->setErrBlockBegin($config->getSetting('error_block_begin'));
        if ($config->getSetting('error_block_end'))     $formError->setErrBlockEnd($config->getSetting('error_block_end'));
        if ($config->getSetting('error_msg_begin'))     $formError->setErrMsgBegin($config->getSetting('error_msg_begin'));
        if ($config->getSetting('error_msg_end'))       $formError->setErrMsgEnd($config->getSetting('error_msg_end'));
        
        /**
         * Sets request data
         */
        $formError->setRequest($request->data);
        
        /**
         * Sets template content
         */
        $template_file = new File($outputers[$request->getOutputOffset()-1]->getParsedArgument());
        
        $parser = new Parser();
        $parser->setTemplate($template_file->getContent());
        $parser->assignVarList($request->data);
        $parser->parse();
        
        $formError->setTemplate($parser->getOutput());
        
        /**
         * Parse error page
         */
        $formError->parse();
        
        /**
         * Outputs error page
         */
        $outputers[$request->getOutputOffset()-1]->output($formError->getOutput(), true);
    }
    
    /**
     * Running executors
     */
    if (count($outputers) == $request->getOutputOffset()+1) {
        session_start();
        #$_SESSION['endscript_' .  $request->getFormName()] = 'true'; #add end key for current form in session
    	foreach ($executors as $executor){
    	    $executor->execute();
    	}
    }

    /**
     * Outputing
     */
     # do not forget to fix output offset after formError
    if (isset($outputers[$request->getOutputOffset()])){
    	#var_dump($request->getOutputOffset());
        #$outputers[$request->getOutputOffset()]->execute();
	if (count($outputers)-1 > $request->getOutputOffset()) {
		$formError->setRequest($request->data);
	        $formError->clearErrors();
		/**
	         * Sets template content
	         */
	        $template_file = new File($outputers[$request->getOutputOffset()]->getParsedArgument());
	        
	        $parser = new Parser();
	        $parser->setTemplate($template_file->getContent());
		$request->data['fpp_output'] = $request->getOutputOffset() + 1;  #insert in fpp_data offset of next page
        	$parser->assignVarList($request->data);
	        $parser->parse();
	        
	        $formError->setTemplate($parser->getOutput());

	        /**
	         * Parse error page
	         */
	        $formError->parse();		
		$outputers[$request->getOutputOffset()-1]->output($formError->getOutput(), true); #page is set to next, so we us -1 to execute current page
	} else {
		$outputers[$request->getOutputOffset()]->execute();	
	}
	
    }
    else{
		$outputer = new Outputer();
		$outputer->showDefaultPage();
    }
?>