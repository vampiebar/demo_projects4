<?php
    /**
     * Project: Form Processor Pro
     * 
     * @version 5.0
     * @copyright MitriDAT <info@mitridat.com>
     * @author Rosty Kerei <rosty.kerei@gmail.com>
     * @link http://www.email-form.com/
     */

    /**
     * Images display
     */
    if($_SERVER['QUERY_STRING'] == 'img_logo')	img_logo();
    if($_SERVER['QUERY_STRING'] == 'img_yes')	img_yes();
    if($_SERVER['QUERY_STRING'] == 'img_no')	img_no();
    if($_SERVER['QUERY_STRING'] == 'img_notreq')	img_notreq();
    
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
	 * CAPTCHA
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

H1 {
	color: #3263C6;
	font-size: 18px;
	margin: 0;
}
A{
    color: #3263C6;
}
</style>
<title>Form Processor Pro. Pre-installation requirements check-up script.</title>
</head>

<body>
	<table width="600" cellpadding="0" cellspacing="0" border="0" align="center" style="border: solid 1px #CECECE;">
		<tr>
			<td style="text-align: left;" colspan="4">
				<table width="100%" cellpadding="0" cellspacing="0" border="0">
					<tr><td width="177"><a href="http://www.email-form.com/" title="Form Processor Pro"><img src="<?php echo $_SERVER['PHP_SELF']; ?>?img_logo" alt="Form Processor Pro" border="0"></a></td>
					<td style="border-bottom: solid 1px #CECECE; vertical-align: middle;"><h1>Requirements check-up</h1></td>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="4" height="21" bgcolor="#E2E2E2" align="center">
				<a style="font-size: 11px; text-decoration: none; color: #666666;" href="http://www.email-form.com/" target="_blank">visit website</a>
			</td>
		</tr>
		
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
			<?php echo ini_get('upload_max_filesize'); ?>
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
</body>

</HTML>