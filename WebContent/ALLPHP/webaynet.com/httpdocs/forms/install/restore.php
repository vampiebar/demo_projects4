<?php
    /**
     * Project: Form Processor Pro
     *
     * @version 5.0
     * @copyright MitriDAT <info@mitridat.com>
     * @author Rosty Kerei <rosty.kerei@gmail.com>
     * @link http://www.email-form.com/
     * @package Configurator
     */

    error_reporting(2039);

    /**
     * Images display
     */
    if($_SERVER['QUERY_STRING'] == 'img_logo')	img_logo();
    if($_SERVER['QUERY_STRING'] == 'img_yes')	img_yes();
    if($_SERVER['QUERY_STRING'] == 'img_no')	img_no();
    if($_SERVER['QUERY_STRING'] == 'img_skip')	img_skip();

    $language = 'en';

    /**
     * Path definitions
     */
    define('CLASSES_DIR',    '../classes/');
    define('CONFIG_FILE',    '../config.php');
    define('LANGUAGE_DIR',	 '../lang/');
    define('ATTACHMENT_DIR', '../attachments/');
    define('TMP_DIR',	 	 '../tmp/');

    /**
     * Default language definition
     */
    define('DEFAULT_LANG',	 'en');

    /**
     * Loading common classes
     */
    require_once(CLASSES_DIR . 'error.class.php');
    require_once(CLASSES_DIR . 'file.class.php');
    require_once(CLASSES_DIR . 'config.class.php');
    require_once(CLASSES_DIR . 'lang.class.php');

    /**
     * Main classes construction
     */
	$lang		= new Lang();

    class wConfig extends Config {
    	function wConfig(){
    		parent::Config();
    	    foreach ($this->data['.'] as $var){
    	    	$this->settings[$var['name']] = $var['value'];
            }
    	}

    	function setSetting($name, $value){
    		global $lang;
    		$value = trim($value);
            $config_file = new File(CONFIG_FILE);

            if (file_exists(CONFIG_FILE)){

            	$content = $config_file->getContent();

            	if(preg_match('/('.preg_quote($name).')\s*=\s?(.*?)\s*\n/',$content)){
            		//parameter exist

            		$content = preg_replace('/('.preg_quote($name).')\s*=\s?(.*?)\s*\n/', "\n".'$1 = '. $value."\n", $content );
            	} else {
            		//parameter non_exist
            		$content = preg_replace('/(\?>\s*\n)([\w\W]*)/', '$1'.$name.' = '. $value."\n".'$2', $content );
            	}

               	$fp = fopen(CONFIG_FILE, 'w+');
               	flock($fp,LOCK_EX);
               	fwrite($fp, $content);
                flush($fp, LOCK_EX);
                fclose($fp);


                return true;
            }
            else {
                $e = new Error($lang->getValue('err_config_file_not_found', CONFIG_FILE));
                return false;
            }
    	}
    }

    class tEmail {

	var $to;
	var $from;
	var $subject;
	var $msg;
	var $smtp;
	var $port;
	var $login;
	var $passw;
	var $sendmail_from;

	function send(){
        global $lang;
        $smpt = ini_get('smtp');
        $port = intval(ini_get('smtp_port'));
        if ($this->smtp){ @ini_set('SMTP', $this->smtp); }

        if ($this->port){ @ini_set('smtp_port', $this->port); }

        if ($this->sendmail_from){ @ini_set('sendmail_from', 'test@mitridat.com');
        }
        $cp = fsockopen (ini_get('SMTP'), intval(ini_get('smtp_port')));
        if (!$cp){
            return $lang->getValue('err_could_connect_smtp', ini_get('SMTP'), ini_get('smtp_port'));
        }
        if (!@mail($this->to, $this->subject, $this->msg, 'From: '.$this->from."\n")){
        	if ($smtp){ @ini_set('SMTP', $smtp); }
            if ($port){ @ini_set('smtp_port', $port); }
            return $lang->getValue('err_failed_mail_send', ini_get('SMTP'), ini_get('smtp_port'));
        }
        @ini_set('SMTP', $smtp);
        @ini_set('smtp_port', $port);
        return -1;
	}

	function asend(){
       	global $lang;

		$to = $this->to;
		$from = $this->from;
		$subject = $this->subject;

        if ($this->smtp){
           	@ini_set('SMTP', $this->smtp);
        }

        if ($this->port){
            	@ini_set('smtp_port', $this->port);
        }

        if (preg_match("/From:.*?[A-Za-z0-9\._%-]+\@[A-Za-z0-9\._%-]+.*/", $this->headers, $froms)){
             preg_match("/[A-Za-z0-9\._%-]+\@[A-Za-z0-9\._%-]+/", $froms[0], $fromarr);
             $from = $fromarr[0];
            }

        // Open an SMTP connection
        $cp = fsockopen (ini_get('SMTP'), intval(ini_get('smtp_port')));
        if (!$cp){
            return $lang->getValue('err_could_connect_smtp', ini_get('SMTP'), ini_get('smtp_port'));
        }

        $res = fgets($cp,256);
          if(substr($res,0,3) != "220"){
             return $lang->getValue('err_could_connect_smtp', ini_get('SMTP'), ini_get('smtp_port'));
        }

        // Say hello...
        fputs($cp, "HELO ".ini_get('SMTP')."\r\n");
        $res = fgets($cp,256);
        if(substr($res,0,3) != "250"){
           	return $lang->getValue('err_failed_to_introduce_smtp', ini_get('SMTP'), ini_get('smtp_port'));
        }

        // perform authentication
        fputs($cp, "auth login\r\n");
        $res = fgets($cp,256);
        if(substr($res,0,3) != "334"){
            return $lang->getValue('err_failed_init_auth_smtp', ini_get('SMTP'), ini_get('smtp_port'));
        }

        fputs($cp, base64_encode($this->login)."\r\n");
        $res = fgets($cp,256);
        if(substr($res,0,3) != "334"){
          	return $lang->getValue('err_failed_provide_login_password', ini_get('SMTP'), ini_get('smtp_port'));
        }

        fputs($cp, base64_encode($this->passw)."\r\n");
        $res = fgets($cp,256);
        if(substr($res,0,3) != "235"){
          	return $lang->getValue('err_failed_auth_smtp', ini_get('SMTP'), ini_get('smtp_port'));
        }

        // Mail from...
         fputs($cp, "MAIL FROM: <".$this->from.">\n");
         $res = fgets($cp,256);
         if(substr($res,0,3) != "250"){
            return $lang->getValue('err_failed_mail_from_smtp', ini_get('SMTP'), ini_get('smtp_port'));
         }

         // Rcpt to...
         fputs($cp, "RCPT TO: <$to>\r\n");
         $res=fgets($cp,256);
         if(substr($res,0,3) != "250"){
           	return $lang->getValue('err_failed_rcpt_smtp', ini_get('SMTP'), ini_get('smtp_port'));
         }

         // Data...
         fputs($cp, "DATA\r\n");
         $res=fgets($cp,256);
         if(substr($res,0,3) != "354"){
			return $lang->getValue('err_failed_data_smtp', ini_get('SMTP'), ini_get('smtp_port'));
         }

         // Send To:, From:, Subject:, other headers, blank line, message, and finish
         // with a period on its own line (for end of message)
         fputs($cp, "To: $to\r\nFrom: $from\r\nSubject: $subject\n\n".$this->msg."\n.\n");
         $res=fgets($cp,256);
         if(substr($res,0,3) != "250"){
          	return $lang->getValue('err_failed_body_smtp', ini_get('SMTP'), ini_get('smtp_port'));
         }

         // ...And time to quit...
         fputs($cp,"QUIT\r\n");
         $res=fgets($cp,256);
         if(substr($res,0,3) != "221"){
           	return $lang->getValue('err_failed_quit_smtp', ini_get('SMTP'), ini_get('smtp_port'));
         }
         return -1;
	}

}


    /**
     *  Load settings
     */

    $config		= new wConfig();

    if (trim($_POST['email_address']) == $config->getSetting('email_address')) {
        $email = trim($_POST['email_address']);
        $symbol_pwd = createPassword(8);
        $new_pwd = md5($symbol_pwd);
        $config->setSetting('fpp_key', $new_pwd);

        	if(preg_match('/^(?:(?#local-part)(?#quoted)"[^\"]*"|(?#non-quoted)[a-z0-9&+_-](?:\.?[a-z0-9&+_-]+)*)@(?:(?#domain)(?#domain-name)[a-z0-9](?:[a-z0-9-]*[a-z0-9])*(?:\.[a-z0-9](?:[a-z0-9-]*[a-z0-9])*)*|(?#ip)(\[)?(?:[01]?\d?\d|2[0-4]\d|25[0-5])(?:\.(?:[01]?\d?\d|2[0-4]\d|25[0-5])){3}(?(1)\]|))$/i', $email)&&$email!=''){
            	$em = new tEmail();
            	$em->smtp = $config->getSetting('smtp_server');
        	    $em->port = $config->getSetting('smtp_port');
            	$em->login = $config->getSetting('smtp_login');
            	$em->passw = $config->getSetting('smtp_password');
            	$em->to = $email;
            	$em->from = $email;
            	$em->subject = $lang->getValue('ffp_mail_test_subject');
            	$em->msg = 'New password: ' . $symbol_pwd;

            	$res = ($_POST['useauth']!='a')?$em->send():$em->asend();
            	if($res== -1){
            		$_SESSION['email_sent'] = 1;
            	} else {
            		$_SESSION['email_sent'] = $res;
            	}
        	} else {
            		$_SESSION['email_sent'] = $lang->getValue('form_err_email', 'Your email');
        	}
                unset($_POST['email_address']);
                restore_page();

    } else {
        restore_page();
    }
    exit;


function createPassword($length) {
	$chars = "234567890abcdefghijkmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
	$i = 0;
	$password = "";
	while ($i <= $length) {
		$password .= $chars{mt_rand(0,strlen($chars))};
		$i++;
	}
	return $password;
}


	function img_logo(){
		$logoimg  = 'R0lGODlhsQBKAOYAAP93AY2m2/TOrA5PyrrJ5+3t7U93ypOt3/euasbT7vz7++jt9vj4+CVaw/r6+tvb26i41uLi4jNkxvuPMNni';
		$logoimg .= '8/jl0pqVo2Vjje22ie3YxvikW+3y+9bc54Se0v7v4rjF3PnImBZNvpBmXvDw8GuGtfTr4wUpsmmN1HWW2feaR/yEHMXL2MrX7ev8';
		$logoimg .= '/y1gxZ+35Vd/z4GZxf//5PH2/chyMgtFu6axyGtUaDFSqPBwNb7N6rO/1QNN3CRh0v9oBfX+///38KxhN22Q1vf3922a5ff5/a7B';
		$logoimg .= '57KBYmOG0KPE9M/c8vRaAP/cvd/JueLo7unp6P59C+bm5k6J4/7+9v39/bimnxtSwf/69v///Pfx7M7T3fr8/hlc1fn7+87OzvT0';
		$logoimg .= '9P/9/MHS8sHQ7tB+QPn5+fX4+/v59vH1+NKNVLyLcf2QYD5tzJe87gI8uP/qpexoDvB1DP1tIEJmr9/o9/+rQRFc37XO8vb08vb2';
		$logoimg .= '9f24d3KSxXSG0/X19f7+/vb29v///yH5BAAAAAAALAAAAACxAEoAAAf/gH+Cg4SFhoRUDH6Li2RUh4IKQ4xDj5CXmJmam5ydnp+g';
		$logoimg .= 'kH0OjIsMlod9ZKUKfaGvsLGys7KSpUMKmLaNrrSvfVQKrX99xcSovsnKmKqlfrmXzYu4ycaaxcEOimSuwsVkp73L4+R/Cs4OmeeM';
		$logoimg .= 'DuKyVMiGxQoO4H58X89/VNT8X7juygl8p4gRN0xUVpmKB6uPAobAFICbxKfivVPmKpm7x8fPwYEgG65bqG7SImi0gLmKWG+IyYod';
		$logoimg .= 'Oabrw+Cgg5gdGQwLydNTIkooRZHilYxevYIcLZbig/FcrkQxOXpk2LPqnwoTAGjNYwaPwYCGfvqh1jAYPaQwozq7N1ORq5tq/y3q';
		$logoimg .= 'BGs1JFateAVkmRYU0i4GdJmxZEAx7dq1fDQq4EOGGJm0Si06qjvwigcggzxkxQsFioYKRJkpJHstIpnCSg+r9uiKwZdcDieavJd0';
		$logoimg .= 'LmVyeVRoEODhD5AUeCeAADEhRYaxVAvZYhpYkOmXalerTvxI0hB32ITJvpePTN/bs/ACmCAADAgoWjM4ObMhA4YCz5oPIjXkY6Fs';
		$logoimg .= 'hBfBlM6ftk19g1jjXERnuWQbeLSIpxUCuaVXBjEMjPDEVJoIQ4U4LE2kX2r9SdfRU2MFVMyIhIxo1k4IyiIeFClMsBkATUCjgCIf';
		$logoimg .= 'ejIYahx26CFzf9yUDjHYjbiSPCnS8qIGGUQggP8GWmnw40amNJedRAzUNIRhOmZJG2xjweaAAxZe2MuYzhFTJC1MaAXFe31s4YEK';
		$logoimg .= 'AEAxwiBiaXRINpPU58CFi0WnZX+MdRPoRjENUZOFApYopHxnQnKFmhjcMQgCWjUR4DqTyUMPou7wsyFkOIHaYY19GArbKpBRUhOY';
		$logoimg .= 'D9FFYqOcYMEkABrMKQgQ6E3w5E/2YbKADmUSI8yXX5JhLGEuuZQUqKn68U91X7SzDwN+0nbLqmBeCOsrHmiVQgGE5KEVuHS65B08';
		$logoimg .= 'CgjABCELvACDCx0IsoURMCghbIAjboquMPzSY+yxVW4JoT4O8SfqNFUai2Ki2xpyBZMqCFCICj5oUAj/fTvJ4EYJSqCwhgtWtBHC';
		$logoimg .= 'FoIsYIAJIRgRyUPwiOkNM0CiO4S0VDD2CE3VTscsWcAk1/AgFSz4BSFM+ODDE5AUwR4bBgSBwwADWGFFDSdYsgEMJrRhwhoUkAwO';
		$logoimg .= 'toSx2m+Y8Cxaz4WraHtOzoD6oZMgCR348yFAIODDBBUUokYceYhDRQkUhIFCAzWEMAAOQbjARQNSbxCWGCjAwEJ1ZBxl5TTWTmNg';
		$logoimg .= 'TZUrUpMf0vbItsGg93LOF3ygOLchTECxBAhFQLKAEmEcIEINbRQudQN1XBBED1YMcEIRXfhMCGzoMgDml/4WW6WyUuWjrSqjr5bY';
		$logoimg .= 'TqcDuPolGCyBQBaFbJDA/wtraJ31DU8PEEIIUg8ggghQU/CHE0VswMICUl43iEQ3L2riiRJxm+mu9KecQAMqX3AEo1bngRwgwBAU';
		$logoimg .= 'OIAQkHACFKBACBY4Agw2CIM1SKAHcgjCDaSwgS1w4A8HCAEMUPACI4hhDrELUOrGRA8xvUoUp7EEKaq3lI7sKRLO4kPotpcJASCg';
		$logoimg .= 'AhygAAWc0JzhtGADGwiDFO1QBRo84A8fWEAR1mAC3OWuAWtAwh4CYC9BkOEfT/lalThXD+aNbRXemREPGVER24wCHwAhYiaAMYUK';
		$logoimg .= 'eMAJC1hAAYbgBCd4YAqAe9ACnIAAELTgQYQAAR3McIA/UKAGVmiACxrQgBDUwP8EJoCB/BagBy1E4DWRYJZhqgU9HdURGqr4QgKN';
		$logoimg .= 'p0czbaEFPwgIFrAwhT9MoQuCOEMLKpCCCpCMEFOggwbm8IcXtMEF0Nwk4azwggX8gQUksMEDviCOoThDlfuRiisp5BDXCHGBeixG';
		$logoimg .= 'AEzQAAlwEAYBiGcADiAGI7iQZE/IAB0K0IIZHPMPMoCCG1qwhgFEE2Q1WEMCBLEDEqzgAQVACT/m+Kce5pF6aKzlJhyyzvVJbX3s';
		$logoimg .= 'A6kn2/CCP+xgB1PIwxh6sAYDWJAIRLAAFCDAA01C05NCkN8fYhCDB0RhBI1xzg4rmqVXws01X8CIRq/xByNgcpNQ5aRUQ4aEDZwh';
		$logoimg .= 'Biz/+EMSgiACHkBtfVALwhvqsLhpGuFBFCDBBx4wghH4QRySoGhFLfLDjOTjIUvthBHY5wIJ9PWgm8xkGFD4ATL8YA04eMMF6qDJ';
		$logoimg .= 'BvRgcQCgAVkTWsaG+nQVqBzEY+SqpYrw7CYZzWsnEsC4vkrgtKjdZAhKWoEqIO0ANeDBBeAgBy70IJq9A8AFeCCEGfzhqjGIQAEc';
		$logoimg .= 'wocFiOG4L8yclhZAgOZS4DAGPKosMxWLOSDXcY1SggtCYFrU+pVxBoAhGlLggTIU9LE0oEEP1gvNHtQhCD6AADA4oAdtzslTYhBp';
		$logoimg .= 'AEbAWUYQQKRC+CaF7DqoWaQQpCU9EwXWUIPuptYKLlAZ/wS0OYUX1ECTXJADFERQh9sCjwdrUAEdRpAEEpiSDxDqiA5C0AEIQGAF';
		$logoimg .= 'EyLqfyHwAAiweEMXBW0eaZHCCESgAyFYaIr6MAcDNNi73w0BCuanTQVskbsf7B0UFgu8AQihBW6AQho64FPAmCMffFgxBNraVqL6';
		$logoimg .= 'YcZuNYABYvw2CMkSMOjkRI8FweKggqcPV3umd6FpBQnMgQomHkIzLwzND/YgvS6oaSX/YIcxxKEJT9CIp+gh5o7EJAEEWARzF8CB';
		$logoimg .= 'BSSABRzI9Jmfe+YQQAA+atYCARYwB8cxlwPxUYIYBvHCQVjXcRuo9R9uLYgXboCZc/4Dizkw6zLymifFEIKeT/8LzU6qjAXa7MMC';
		$logoimg .= 'QPbXKEvgDUGAgR0EcQA9VEEF3zpVtIix4g58YNV+QML6JMDcEAghBAQwgAQ6aYA1rC/TMy7AXvVg4xOEQAcE6GQIAvAHIA98DhJY';
		$logoimg .= 'XyX3GoLwClwBB24AsEKAhAYcAOIhiMAGUniAALg7BGSIOLBCkuxnmjawBvgDKR8ATCBr0q/tle0SJPYDPXA5ChgAAAawYI6K9CK/';
		$logoimg .= 'IP1ACneghQYg4b9rCIAW5K0FGITgAx8IQQxG8F+QrkELUU+6FiRggB+HgAPujsAHhCABDgCZAx0U+9k/oIWBR8AALmBACBrQAS2M';
		$logoimg .= '4MDrE0IUPA4DCLQ9AG+PO8n/EAD/QsO8kxSYwg5WEAFpb7fQza5BHdjQIgLAQJsTKoEKVJCBUmX2D/mNgYu1QHaICsEFOwiBDYSr';
		$logoimg .= '5gh4nK1Sf8J/kRCDA0TgCSte/d+fMIeBmxpcEkBBFDYwcBSUvZlPV8ALQrCCLyy/7cIfAcY7YG7hppADBUhh858/+BTadJM1IHgJ';
		$logoimg .= 'gtCEdLj8oIRbQxh+IAMV5MALEL3HHUBAqywwhRD5hcATCjCC1vvB4zamf37Qeq/nBywWBTMWBQWAYvkne6aGYixmaukgUsPWACcA';
		$logoimg .= 'Bn+wBmuwAD2mAPnHYrbSYyOQQCiUcVTQgflHS75gBFITTSGwBkXQAhaAAX0zB4/XbFbg/26O0wdSkAY6lw/3MARAoAFrkjr4Z2pu';
		$logoimg .= 'NYBd93+mhoRK6Hoh8AAGGAMOCAEotg9oNmMMIGxABgFbGAInAAE78GJfwAINsGRfoIFz9oEdEIIZRwhztoamtoUhEXAQtkltID8s';
		$logoimg .= 'oH+ScgKEploW51tFZgNa0BlRIDACAAAqkDeEIGbw4Qcd0AARkG5rEICo1nUFGHsz1hiSMGPFdWNKEIEBYAYZeAIFQAEwQAC5AGRz';
		$logoimg .= 'slc29gElCHZtyG1vOAhztleweH10CBJh0Ema1AYExwdyEAVbKAadJE0vqATF8AEGwHgjUAFQoAKoIy1mwCQYQIpwg2aL8F8xsFct';
		$logoimg .= '5oQEGIVTWP8AYjYz+KCFVAB3RlBxDwBGBKAEB9AAEDA4ricGMCCPRgBkH9AAMKADXBcBIEiLEQCHb7gB/OiPXaeCtEABEtBgNSAB';
		$logoimg .= 'saNN4NIHysZJOXgCgrABGeRTd7AIwIEBiuEH5wEAGTAf+cYI8QiGD5B6p/aEmdiG+SdLCSRm7WAyISABHxABL9BJ9/NuEnAAUYAC';
		$logoimg .= 'N9lxcyd8LJBwBqAFTxCQJTiQtliL2tVwSolsDIlJbbBQI6AHUSAIKzZ37FNJW+AEl9cEINCRi3AH6FECjvEFW8AkGgA+OFMAbFUK';
		$logoimg .= 'culTfiCXSehjfvAED9ARETACfXAHEHVOf0AGEbCFixEBD3CYf3D/B1EQAWQABgUQAVEwNJNZmV9AmXNCBk9we7nwl4MwAk4ZmqNJ';
		$logoimg .= 'BlEQBU/wHeQgbQbQBm2AAkUAaBEgKUWAAm0wNRIwWEXAjPBXAiCQATghLikgDInRByOZAVewNmamHwDhALJkJ4UwCo2gkKIVDTNw';
		$logoimg .= 'Mg3ATB+wA1v5BwSAOxRnTXMQACSwmPlQARmQhHyQBXAiAIoADcAxAXiAFAXkETPiNtRiM5cgFqpZnZzQB0VwMgdABQtAAlGQC2dw';
		$logoimg .= 'MlawaBFgAasXY4vwBW7lQ/Q3AU+wi+ICAAKQI4DSEQcRVx8iH9LpNtTpn9EZoC5gTT1lKwRgAhKwbX/ABjMYf4jBHEAA/ycI4AeW';
		$logoimg .= '8CaKmIRFdT2uQAU7xBibIBa9YqKcsAEooDI6YANP4ArTZgCj1AGl1ATACV3U0AfiogIRYAa9sBlN8KNuIyNXkhissQm7oDpIqglF';
		$logoimg .= 'MAdlcAd68ACCNi8o4DgckE2DmQU+SkdCJAhmAI0AgACv4QqzogJ76iFn6hBDkA9fMglDFA2jUaJraos7UAIrMQeuAAExwHiPqFz6';
		$logoimg .= 'gRFU4AdZEJ8ZQDJ9IADoASMdelGPkVRpdBILtAtHOqmYoAQWEAFPIggkEAOmdKgCJm5DkCZQgAC5YB6pmgK+2kNtRhPTBVfToILS';
		$logoimg .= 'oD20iglloAfNhwplIAeM9wRmaT0fSh08Gv8xPfIiKnCI0OVDliAJd4UdCvGofmES1DWtkDBhBzoIKyAHXUaf0KUP/pALD8MZqaom';
		$logoimg .= 'UlijM7MS2aOankIa0eBN7iqvg1AGjEeHfRADJHB734Co0uKcXnYFGaoBRLgiYdpDYwo3rRqvJTIUSoUQJqGwDvuwTzA0ghABOwCa';
		$logoimg .= 'xOBNNeplCnAHFXAFgsCxWsF5ETABqQoFc0lHpQNEqDOriACvjDKiR9uyx5OrhWlnBTMdWcoAJaABIOBHd6EV78EHTaABE4ABA8sR';
		$logoimg .= 'F3U6uPAyomALLHsnK9ufUHsJyilgP+KcDnAFKQBucIIXGhBjI/CYj1hHlpAISWsMapsKCpGyQvH/FXHbCXO7FF4Wqkb4BxjwIt5y';
		$logoimg .= 'pSJbV+o6Q5diPLvQsMrxto3LCZL7q45BmIKQBQiwtwCQAqdkUcNwR2gUEMHgM9IAnTjECIo7upAwUd/0rbjrGw0SqBEQFdG1D626';
		$logoimg .= 'u84RDM0hq4yyC0/Lu71LQHQEqs6imkXAlw/wADFGVwa7qPERDQxzsoygptGpEF0ivdGQn6ywlrNKPYfxWXgkqe9KErpQCqCrvjRB';
		$logoimg .= 'G3UkKMELRHFhnyRbESb7CgnBDvJxn6YAt7zbDJZGMK6hmjgTKk+rruHrC7vQtiWCvtGrvgGCKj70FjxiCHPrWbFLCmhEv3vkTUq7';
		$logoimg .= 'P7fAwKM7pDi7CFQBexUP3GYzMl0XAg/KkMEMDL1n6sGEgMIA4hpSOx9JQU6nw7nCosLrq7tSwsHKq76gBbw1XKbXI1TzG53jCwvQ';
		$logoimg .= 'm79Om75CvD+kQi0SvDZMAUtnNEshIRYkKrezIUCw4gV0XMd2fMd4nMd6vMd83Md+/MeAHMiCPMiEjMeBAAA7';

		header('Content-type: image/gif;');
		echo base64_decode($logoimg);
		exit();
	}

	function img_yes(){
		$yesimg  = 'R0lGODlhEAAQAOZVAHLKYzGxF2XIQiuxEzGyFxGUDjCzFk68NjCwF/H58dDo0Or46hKUDyumKzWqNFy/VSyxFDqoOvL68iSoESqt';
		$yesimg .= 'FDirOOT05E28ND+zP0a7H0C4H9f31C6uFljFRanbqbvhuxKWChKTDReYFz2uPS6eLEK6IEa8KiqwE+j36CyyE7XgtTKyGfX89XXL';
		$yesimg .= 'ZEm6Ozq2HDCnL0qmSjGxGXHHYimxEyesEzSzGGjOY/D58DGxFe357RCTC7fjt/3+/Q+UCjOmMabZpiyzFRyTGj63H3jNZiuzFaXW';
		$yesimg .= 'pXHIYe/6763drajjoC2zFDOyGTOoM2bIZvP787HfsSqnKBGUDLvrtRuUGf///wAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA';
		$yesimg .= 'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA';
		$yesimg .= 'AAAAAAAAAAAAAAAAAAAAAAAAAAAAACH5BAEAAFUALAAAAAAQABAAAAd0gFWCg4SFhoeIhxYOPwqJgihRRCYkjwsNLTkGVIMbUz2D';
		$yesimg .= 'OjAAAUsMH4JKHQc3gkhNpBAFPIMuAhlBTjgVRzIpISqED0MlGhMiMysDUlCFLBhMLzYXCCc7SYdPIxwEFDQ+HokSETVFIECPVQkx';
		$yesimg .= 'Qkbp7/DxhoEAOw==';

		header('Content-type: image/gif;');
		echo base64_decode($yesimg);
		exit();
	}

	function img_no(){
		$noimg  = 'R0lGODlhEAAQAPeTAP9WJP9TIv9ZKP9eLv99S/9bKPU9DfJKGv1TIP9OHd05FPXb2+24uMwpI+E4MLsiHsExMP9XJrghGrYdF9Js';
		$noimg .= 'bP9YJf9ZJ9s9J/9rO+q9vdcuCeo9Fui8vOq2tvY+Dv9dLP9lMPXNzctEQ9SEhPnj4/jr6/jl5bdAQP9eLN03H84nG/9bKvvw8NF6';
		$noimg .= 'ev91Rf9wQequrudGK89ycvjT0+dOLs9jY7MTA8A5NvI9D9VsbLgnIeN0dPA7C/lRJPuCV/z4+NVAQNBwcP5KFv9NGuRTO/9nNch0';
		$noimg .= 'dL5BQds+Pvp8Uv9eLf98S/9RH/+AUP9aKf9PHMpFRfZEGPxSIMsqIPFLG/9qOOhEF/+BUOpGG/9vOvz39/9sOdIxELoxMNsyGPZB';
		$noimg .= 'ENZbW90uDbwaBM5oaMQfDf9tPLIRCf79/dcoCfHV1exubv9kNOMuD/hNGftqPf9aJu29vemZmf9SH+3Fxf9UItc2E8MVDvlCEfbP';
		$noimg .= 'z702NP9oNvlEE+yysvA8Cv+IV+2jo9cqGfv09PpFFM0mH96iou09Ev9tO7wxMOicnP+cavpiNvG4uPpGFt0wD/TDw/9PHcUyMd8/';
		$noimg .= 'Jf1KGf///wAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA';
		$noimg .= 'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA';
		$noimg .= 'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA';
		$noimg .= 'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA';
		$noimg .= 'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH5BAEAAJMALAAAAAAQABAAAAjMACcJHEiwYEFHYPAQRCSiwxmCaoj4QDJw';
		$noimg .= 'EaA3bCARdJDIT4w/k0KoAMFEQQ2CO5JcITAIToMqAA48YEFwxoUmLhTZKbMCARkGBoEseYFhi5IKdXIYnMQnkqE1AyxgOaTFIAko';
		$noimg .= 'NPQMEEBnw5FABeNMcVPkg4AACYYUymNiIIwUWVA4iSDliSRGgnBI4CAwg5cCAAJQMdNIyJ4vHvqcEAihh5xHVibMGRPmjgEeYggJ';
		$noimg .= 'lBGlDZcuCwRSQKPBRpCBJW7oGPGDYAsjaZbKJhgQADs=';

		header('Content-type: image/gif;');
		echo base64_decode($noimg);
		exit();
	}

	function img_skip(){
		$skip_img  ='R0lGODlhEAAQAHAAACH5BAEAAJQALAAAAAAQABAAh/////f/+PX/9/7//vv/+/b/9vz//Pf/9/n/+d3/39b/2e7/7tP/0/H/8df/';
		$skip_img .='1+r/6uH/4cniycvktszls8zlyc3n0c/pzdHlt8XnsbLptrLUuK3SsJvsm5nPmZesl4SwhHyyfJnOmbvKl8HJlZnKlI/HlZDFi5DJ';
		$skip_img .='ZpPLbpLFjnGhblycWF/BX0OVRCdeJyZdJiZeJsP3w67apqDJlpzPm4O1hWyka2/KaXHFW2+iRmydPV2SOT97OzaEOS6LLg9rDwJd';
		$skip_img .='Ar7zvqXcqJLIlYm9inamdWCXYVKlWVamRGSaK12QLEx9MDViMih2KhyKHAZwBgBkAJnMmZ3QnY7CjmqdamaZZmGUYjltPUN2L2aZ';
		$skip_img .='M0d6MzBiNDVlNRlmGQBmAJOhk3uke2egZ1+SX0h+SDFoMiZbJypOIzVHJC5UKRxRIAI2AglGCRNXEwU9BQAxAKKqoo2qjX6sfnuw';
		$skip_img .='e2mXaVd/VlGGUVNyVFlVXFZ1V0l+STFbMUJvQlODUztjOzBUMMX2xeb25ur26sP2w9f01+vy68TyxMzwzO3t7szwzcPxw+ft59Pv';
		$skip_img .='07/yv+Du4O/s7+n/6e3/7fX/9fT/9O//7wAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA';
		$skip_img .='AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA';
		$skip_img .='AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA';
		$skip_img .='AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA';
		$skip_img .='AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAizAAEIHEiwoMGDCBMSTKCA4AIGCwBABJCA';
		$skip_img .='QQQMGCIYMoQxgwYhHKJ4AAEiiogRKUqkOHHCRJUVLHzASAMjhpAZUYhUuYEjR5Yde3z4+AEkiJCcYFYcQZIkCxYuTZw88RIlZ5Wr';
		$skip_img .='XLA45cLlh5evHsC83MMlTZozaNK4WcPGjZs3cIrAqcKHD547eMb42cOnjx8GjxYESXCIgaFDixgcahRkwaFHBQAsiLgg8mTJERVq';
		$skip_img .='3sx5YEAAOw==';

		header('Content-type: image/gif;');
		echo base64_decode($skip_img);
		exit();
	}



	function restore_page(){
		global $lang;
		print_header($lang->getValue('conf_script_title'));
		print_restore_screen();
		print_footer();
		exit;
	}

	function print_restore_screen() {
		global $lang;
		$msg = isset($_POST['email_address'])?$lang->getValue('err_email_incorrect'):'';
                if (isset($_SESSION['email_sent'])) {
                        if ($_SESSION['email_sent'] == 1) {
                                $msg = '<font color="#008000">'.$lang->getValue('pwd_email_sent').'</font>';
                        } else {
                                $msg = $_SESSION['email_sent'];
                        }
                }
?>

	<table width="600" cellpadding="0" cellspacing="0" border="0" align="center" style="border: solid 1px #CECECE;">
		<tr>
			<td style="text-align: left;" colspan="4">
				<table width="100%" cellpadding="0" cellspacing="0" border="0">
					<tr><td width="177"><a href="http://www.email-form.com/" title="Form Processor Pro"><img src="<?=$_SERVER['PHP_SELF']; ?>?img_logo" alt="Form Processor Pro" border="0"></a></td>
					<td style="border-bottom: solid 1px #CECECE; vertical-align: middle;"><h1>Restore your password</h1></td>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="3" height="21" bgcolor="#E2E2E2" align="center" width="70%">
				<a style="font-size: 11px; text-decoration: none; color: #666666;" href="http://www.email-form.com/">visit website</a>
			</td>
			<td height="21" bgcolor="#E2E2E2" align="right" width="30%">
				<a style="font-size: 11px; text-decoration: none; color: #666666;" href="./">back</a>
			</td>

		</tr>
		</table><br />
		<p style="text-align: center; color: #ff0000;"><?=$msg ?></p>
		<form action="restore.php"	method="POST">
		<table width="300" cellpadding="0" cellspacing="0" border="0" align="center" style="border: solid 1px #CECECE;">
		<tr>
			<td  width="30%" height="40" class="tdd">
				<b>Email Address:</b>
			</td>
			<td width="20" class="tdd"></td>

			<td colspan="2" class="tdd" align="left"  width="70%">
				<input type="text" name="email_address" value="" />
			</td>
		</tr>
		<tr>
			<td colspan="4" height="40" class="tdd">
				<input type="submit" name="Send" value="Send" />
			</td>
		</tr>
	</table>
	</form>
	<br /><br />
	<table width="600" cellpadding="0" cellspacing="0" border="0" align="center" style="border: solid 1px #CECECE; background: #f4f4f4;">
    <tr>
      <td><p align="center">&copy; 2000-2008 <a href="http://www.email-form.com" target="_blank">Email-Form.com</a>
    All Rights reserved.<br>    Powered by <a href="http://www.web-site-scripts.com" target="_blank">Web-Site-Scripts.com</a></p>
      </td>
    </tr>
    </table>
<?php
	}


	function print_header($title) {
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">

<HTML>
<HEAD>
<style type="text/css">
BODY, TD {
	font-family: Tahoma, Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #666666;
}

TD {
	text-align: center;
}
.tdd{
	border-top: solid 1px #CECECE;
	border-right: solid 1px #CECECE;
}
.tdl{
	border-top: solid 1px #CECECE;
}
.tdh{
	border-top: solid 1px #CECECE;
	text-align: left;
	padding-left: 20px;
}
.tdf{
	border-top: solid 1px #CECECE;
	border-right: solid 1px #CECECE;
	padding-left: 40px;
	text-align: left;
}
.tdj {
    text-align: left;
}

H1 {
	color: #3263C6;
	font-size: 18px;
	margin: 0;
}
A{
    color: #3263C6;
    text-decoration: none;
}
LI {
    text-align: left;
}

input, SELECT{
	font-family: Tahoma, Verdana, Arial, Helvetica, sans-serif;
	border:1;
	margin:3px;
	padding:0px 3px;
	color: #666666;
}



</style>

<title><?=$title; ?></title>
</head>

<body>

<?
	}


	function print_footer(){
		echo '</body>'."\n".'</HTML>';
	}
?>