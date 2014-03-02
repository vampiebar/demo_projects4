<?php
    /**
     * Project: Form Processor Pro
     * File: autogen_email.action.php
     * 
     * @version 5.0
     * @copyright Web-Site-Scripts.com <info@web-site-scripts.com>
     * @author Sergey Bidnyi <sergey.bidnyi@gmail.com>
     * @link http://www.email-form.com/
     * @package Actions
     * @subpackage Executors
     */

    /**
     * Autogenerated emailer
     * 
     * @package FPP5
     */
	require_once(PLUGINS_DIR.'email.action.php');
	require_once(PLUGINS_DIR.'remote_addr.variabler.php');
	require_once(PLUGINS_DIR.'http_user_agent.variabler.php');

	class autogen_email_action extends email_action {
		function execute(){
			global $request;

			$email = $this->getParsedArgument();
			$email = str_replace("\n", "", $email);
			$email = str_replace("\r", "", $email);

			$fields = $this->getRequestData();
                        $fields = rm_bad_request_fields($fields);

                        $defaults = get_defaults();

			$cookie = array_keys($_COOKIE);
			$cookie = array_map('strtolower',$cookie);
			$denied_fields = array_merge($cookie, $defaults);

                        $fields_all = get_fields_names();

			$tpl = "\n";
			foreach ($fields as $field_name => $field_value){
				if(!in_array(strtolower($field_name), $denied_fields)){
                                    if (array_key_exists($field_name, $fields_all)) { #if label exists
                                        $tpl .= $fields_all[$field_name] . ': '. $field_value . "\n"; #show label
                                    } else {
                                        $tpl .= $field_name . ': '. $field_value . "\n"; #show field name
                                    }
				}
			}
			
					
			$tpl .= "IP address is " . remote_addr_variabler() . "\n";
			$tpl .= "User Agent: " . http_user_agent_variabler() . "\n";
						
			$this->setBody($tpl);
			$this->headers = 'From: ' . $email . "\n";
                        $this->headers .= 'Reply-To: '. $email ."\n";
                        $this->headers .= 'X-Mailer: Form Mail: eMail Form Processor Pro Script'."\n";
			$this->buildMessage();
			$this->send($email, $email, '[' . $request->getFormName() . '] Autogenerated email');
		}
	}
?>