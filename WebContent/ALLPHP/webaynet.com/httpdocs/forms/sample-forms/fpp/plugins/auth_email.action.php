<?php
    /**
     * Project: Form Processor Pro
     * File: auth_email.action.php
     * 
     * @version 5.0
     * @copyright MitriDAT <info@mitridat.com>
     * @author Rosty Kerei <rosty.kerei@gmail.com>
     * @link http://www.email-form.com/
     * @package Actions
     * @subpackage Executors
     */

    require_once('email.action.php');
    
    class auth_email_action extends email_action {
        function send($to, $from, $subject = '') 
        {
        	global $lang;
        	
            if ($this->getSetting('smtp_server')){
            	@ini_set('SMTP', $this->getSetting('smtp_server'));
            }
            
            if ($this->getSetting('smtp_port')){
            	@ini_set('smtp_port', $this->getSetting('smtp_port'));
            }
            
            if (preg_match("/From:.*?[A-Za-z0-9\._%-]+\@[A-Za-z0-9\._%-]+.*/", $this->headers, $froms)){
                preg_match("/[A-Za-z0-9\._%-]+\@[A-Za-z0-9\._%-]+/", $froms[0], $fromarr);
                $from = $fromarr[0];
            }

            // Open an SMTP connection
            $cp = fsockopen (ini_get('SMTP'), intval(ini_get('smtp_port')));
            if (!$cp){
                $e = new Error($lang->getValue('err_could_connect_smtp', ini_get('SMTP'), ini_get('smtp_port')));
            }

            $res = fgets($cp,256);
            if(substr($res,0,3) != "220"){
                $e = new Error($lang->getValue('err_could_connect_smtp', ini_get('SMTP'), ini_get('smtp_port')));
            }

            // Say hello...
            fputs($cp, "HELO ".ini_get('SMTP')."\r\n");
            $res = fgets($cp,256);
            if(substr($res,0,3) != "250"){
            	$e = new Error($lang->getValue('err_failed_to_introduce_smtp', ini_get('SMTP'), ini_get('smtp_port')));
            }
 
            // perform authentication
            fputs($cp, "auth login\r\n");
            $res = fgets($cp,256);
            if(substr($res,0,3) != "334"){
            	$e = new Error($lang->getValue('err_failed_init_auth_smtp', ini_get('SMTP'), ini_get('smtp_port')));
            }
 
            fputs($cp, base64_encode($this->getSetting('smtp_login'))."\r\n");
            $res = fgets($cp,256);
            if(substr($res,0,3) != "334"){
            	$e = new Error($lang->getValue('err_failed_provide_login_password', ini_get('SMTP'), ini_get('smtp_port')));
            }
 
            fputs($cp, base64_encode($this->getSetting('smtp_password'))."\r\n");
            $res = fgets($cp,256);
            if(substr($res,0,3) != "235"){
            	$e = new Error($lang->getValue('err_failed_auth_smtp', ini_get('SMTP'), ini_get('smtp_port')));
            }

            // Mail from...
            fputs($cp, "MAIL FROM: <$from>\r\n");
            $res = fgets($cp,256);
            if(substr($res,0,3) != "250"){
            	$e = new Error($lang->getValue('err_failed_mail_from_smtp', ini_get('SMTP'), ini_get('smtp_port')));
            }

            // Rcpt to...
            fputs($cp, "RCPT TO: <$to>\r\n");
            $res=fgets($cp,256);
            if(substr($res,0,3) != "250"){
            	$e = new Error($lang->getValue('err_failed_rcpt_smtp', ini_get('SMTP'), ini_get('smtp_port')));
            }

            // Data...
            fputs($cp, "DATA\r\n");
            $res=fgets($cp,256);
            if(substr($res,0,3) != "354"){
				$e = new Error($lang->getValue('err_failed_data_smtp', ini_get('SMTP'), ini_get('smtp_port')));
            }

            // Send To:, From:, Subject:, other headers, blank line, message, and finish
            // with a period on its own line (for end of message)
            fputs($cp, "To: $to\r\nFrom: $from\r\nSubject: $subject\r\n".$this->headers."\r\n\r\n".$this->mime."\r\n.\r\n");
            $res=fgets($cp,256);
            if(substr($res,0,3) != "250"){
            	$e = new Error($lang->getValue('err_failed_body_smtp', ini_get('SMTP'), ini_get('smtp_port')));
            }

            // ...And time to quit...
            fputs($cp,"QUIT\r\n");
            $res=fgets($cp,256);
            if(substr($res,0,3) != "221"){
            	$e = new Error($lang->getValue('err_failed_quit_smtp', ini_get('SMTP'), ini_get('smtp_port')));
            }
            
            return true;            
        }
    }
?>