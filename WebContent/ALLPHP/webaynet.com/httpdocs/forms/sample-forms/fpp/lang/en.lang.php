<?php
    /**
     * Project: Form Processor Pro
     * File: en.language.class.php
     * 
     * @version 5.0
     * @copyright MitriDAT <info@mitridat.com>
     * @author Rosty Kerei <rosty.kerei@gmail.com>
	 * @author Sergey Bidnyi <sergey.bidnyi@gmail.com>
     * @link http://www.email-form.com/
     * @package FPP5
     * @subpackage Core
     */

    /**
     * English language file
     */
    
    //Configuration
    $l['conf_script_title']                             = 'FPP Initial Configuration Script';
    $l['successful']                                    = 'Successful!';
    $l['failed']                                        = 'Failed!';
    $l['skipped']                                       = 'Skipped!';
    $l['ffp_login_invalid_pw']                          = 'Incorrect password. Please retype!';
    //Configuration >> Change password
    $l['file_permissions']                              = 'File Permissions';
    $l['shoud_be_wrtbl']                                = 'Files and folders below should have writable permissions. You can find them in Form Processor Pro folder.';
    $l['checking_file_permissions']                     = 'Checking File Permissions';
    $l['set_correct_permissions']                       = 'Please set correct permissions, otherwise FPP will not work correctly.';
    //Configuration >> Email Server Settings
    $l['email_server_settings']                         = 'Email Server Settings';
    $l['fields_cant_be_blank']                          = 'Fields: %s can\'t be blank';
    $l['fpp_mail_settings_saved']                       = 'Email server settings saved';
    $l['fpp_mail_test_use_auth']                        = 'use authentication';
    $l['ffp_mail_test_subject']                         = 'FPP Mail Server Test Successful';
    $l['fpp_mail_test_msg']                             = 'Test';
    $l['ffp_mail_test_complete_message']                = 'Test message has been sent. Please check your mail box! If you don\'t receive test message, please check Spam folder.';
    $l['cpy_smtp_def']                                  = 'Copy';
    $l['test_mail_button'] = 'Test!';
    //Configuration >> Database Settings
    $l['database_settings']                             ='Database Settings';
    $l['fpp_db_setting_saved']                          = 'Database settings saved!';
    $l['fpp_test_mysql_ok']                             = 'MySQL Server Test Successful';
    $l['fpp_test_mssql_ok']                             = 'Microsoft SQL Server Test Successful';
    $l['fpp_test_pgsql_ok']                             = 'Postgree SQL Server Test Successful';        
    $l['psw_save_btn'] = 'Save';
    $l['status']                                        = 'Overall Status';
    $l['status_complete_title']                         = 'Congratulations!';
    $l['status_uncomplete_title']                       = 'Configuration not completed!';
    $l['status_complete_msg']                           = 'FPP configured properly and you can start working with it! Thank you!';
    $l['status_uncomplete_msg']                         = 'Please perform required configurations; otherwise FPP will not work correctly.';
    //Configuration >> Change password
    $l['change_password']                               = 'Change password';
    $l['pw_has_been_changed']                           = 'Password has been changed!';
    $l['old_pw_is_wrong']                               = 'Old password is wrong';
    $l['pw_less_than_8']                                = 'Password can\'t be less than 8 symbols. Please retype';
    $l['chg_psw_page_txt']                              = 'You have to change password for this wizard to avoid unauthorized access to your FPP settings. Please type new password for this wizard below. Password stored in config.php file.';
    $l['def_value_unavailable']                         = 'Default %s value isn\'t available';
    $l['first_time_password']                         = 'If this is a first time you run this script, use "admin" (without quotation marks) for password.';
    
    // default page
    
    $l['default_page_title']				= 'Form Mail: Email Form Processor Pro Script v5';
    $l['default_page_content']				= '<h1><a href="http://www.web-site-scripts.com/"> Form Mail: Email Form Processor Pro Script v5</a></h1>If you see this message then Form Processor Pro correctly installed on your web server and your permissions on attachments and tmp directories are correct.<br /><br />The latest version of Form Processor Pro script and documentation available from <a href="http://www.web-site-scripts.com/">Web-Site-Scripts.com</a>.';
    $l['default_page_footer']				= '<a href="http://www.web-site-scripts.com/">Form Mail: Email Form Processor Pro</a><br />&copy;2000-2008 <a href="http://www.web-site-scripts.com/">Web-Site-Scripts.com</a>';
  
   // config
    $l['err_dir_not_writable']				= 'Directory "%s" is not writable. Permission denied or disk full';
    $l['err_form_not_described']			= 'Form "%s" is not described in the configuration file';
    $l['err_config_file_not_found']			= 'Configuration file "%s" is not found';
    
    // file
    $l['err_file_does_not_exist']  		        = 'File "%s" does not exist';
    $l['err_file_is_not_readable']			= 'File "%s" is not readable';
    $l['err_file_is_not_writable']			= 'File "%s" is not writable';
    
    // parser
    $l['err_unknown_modifier']							= 'Unknown modifier: %s';
    $l['err_unknown_variabler']							= 'Unknown variabler: %s';
    
    // auth_email
    $l['err_could_connect_smtp']						= 'Could not connect to SMTP: %s, port: %s';
    $l['err_failed_to_introduce_smtp']					        = 'Failed to introduce to SMTP: %s, port: %s';
    $l['err_failed_init_auth_smtp']						= 'Failed to initiate authentication. SMTP: %s, port: %s';
    $l['err_failed_provide_login_password']				        = 'Failed to provide username for authentication. SMTP: %s, port: %s';
    $l['err_failed_auth_smtp']							= 'Failed to Authenticate. SMTP: %s, port: %s';
    $l['err_failed_mail_from_smtp']						= 'MAIL FROM failed. SMTP: %s, port: %s';
    $l['err_failed_rcpt_smtp']							= 'RCPT TO failed. SMTP: %s, port: %s';
    $l['err_failed_data_smtp']							= 'DATA failed. SMTP: %s, port: %s';
    $l['err_failed_body_smtp']							= 'Message Body Failed. SMTP: %s, port: %s';
    $l['err_failed_quit_smtp']							= 'QUIT Failed. SMTP: %s, port: %s';
    
    // captcha
    $l['err_gd2_extestion']				                = 'CAPTCHA feature requires PHP extension "GD2" to be installed';
    
    // email
    $l['err_failed_mail_send']				            = 'Could not send mail via SMTP: %s, port: %s';
    $l['err_not_entered_email']                                     = 'Email address is not entered';
    $l['err_email_incorrect']                                       = 'Incorrect email address. Please retype!';
    $l['pwd_email_sent']                                            = 'New password was sent to your email';

    // zip
    $l['err_zip_extestion']				                = 'PHP extension "Zlib" is required to perform zip compression.';
    $l['err_zip_write_denied']							= 'Could not open "%s" for writing. Permission denied or disk full';
    
    // mssql
    $l['err_mssql_extestion']				            = '"MSSQL" PHP extension is not available';
    $l['err_mssql_host_not_set']			            = 'Microsoft SQL host is not set';
    $l['err_mssql_couldnot_connect']			        = 'Could not connect to Microsoft SQL server: %s';
    $l['err_mssql_couldnot_select_db']			        = 'Could not select Microsoft SQL database: %s';
    $l['err_mssql_query_error']				            = 'Microsoft SQL query error: %s';
    
    // mysql
    $l['err_mysql_extestion']				            = '"MySQL" PHP extension is not available';
    $l['err_mysql_host_not_set']			            = 'MySQL host is not set';
    $l['err_mysql_couldnot_connect']			        = 'Could not connect to MySQL server: %s';
    $l['err_mysql_couldnot_select_db']			        = 'Could not select MySQL database: %s';
    $l['err_mysql_query_error']				            = 'MySQL query error: %s';    
    
    // odbc
    $l['err_odbc_extestion']				            = '"ODBC" PHP extension is not available';
    $l['err_odbc_dsn_not_set']				            = 'ODBC DSN is not set';
    $l['err_odbc_couldnot_connect']			            = 'Could not connect to ODBC server: %s';
    $l['err_odbc_query_error']				            = 'ODBC query error: %s';
    
    // paypal
    $l['err_paypal_params_count']			            = 'PayPal checkout error: At least 3 parameters required for "paypal_checkout", %s given.';
    
    //linkpoint
    $l['err_linkpoint_checkout_params_count']           = 'LinkPoint checkout error: At least 5 parameters required for "linkpoint_checkout", %s given.';
    $l['err_linkpoint_checkout_couldnt_process']        = 'Could not process your credit card. Error occured. %s';
    
    // pgsql
    $l['err_pgsql_extestion']				            = '"pgsql" PHP extension is not available';
    $l['err_pgsql_host_not_set']			            = 'PostgreSQL host is not set';
    $l['err_pgsql_couldnot_connect']	        		= 'Could not connect to PostgreSQL server: %s';
    $l['err_pgsql_query_error']			            	= 'PostgreSQL query error: %s';    
    
    // same_fields
    $l['err_same_fields_params_count']          		= 'The "same_fields" validator expects at least 2 fields, %s given';
    $l['err_unique_submits_params_count']	           	= 'The "unique_submits" validator expects at least 2 fields, %s given';

    // tco_checkout
    $l['err_tco_params_count']				            = '2Checout error: At least 2 parameters required for "tco_checkout", %s given.';
	
    // mysql
    $l['err_sqlite_extestion']				            = '"sqlite" PHP extension is not available';
    $l['err_sqlite_file_not_set']			            = 'SQLite file is not set';
    $l['err_sqlite_file_not_open']			            = 'Counld not open SQLite file: %s';
    $l['err_sqlite_error']			                    = 'SQLite error: %s';    

    // file uploading
    $l['err_upload_size_exceed']			            = 'Could not upload "%s" file. It\'s too big';
    $l['err_upload_error']				                = 'Could not upload "%s" file.';
    
    // validators
    $l['form_err_australian_phone']						= 'Field "%s" is not correct Australian phone number';
    $l['form_err_belgium_postcode']						= 'Field "%s" is not correct Postcode for Belgium';
    $l['form_err_canadian_provincial']					= 'Field "%s" is not correct Canadian provincial code';
    $l['form_err_canadian_zip']							= 'Field "%s" is not correct Canadian postal code';
    $l['form_err_credit_card']							= 'Field "%s" is not correct Credit Card number';
    $l['form_err_denied_addr']							= 'You are not allowed to submit this form';
    $l['form_err_denied_ip']							= 'You are not allowed to submit this form';
    $l['form_err_dutch_postcode']						= 'Field "%s" is not correct Dutch postcode';
    $l['form_err_email']								= 'Field "%s" is not correct email address';
    $l['form_err_float']								= 'Field "%s" is not correct float number';
    $l['form_err_france_postcode']						= 'Field "%s" is not correct French postcode';
    $l['form_err_french_phone']							= 'Field "%s" is not correct French phone';
    $l['form_err_german_postcode']						= 'Field "%s" is not correct German postcode';
    $l['form_err_icd9_code']							= 'Field "%s" is not correct IC9 code';
    $l['form_err_image_file']							= 'File "%s" is not correct image file';
    $l['form_err_int']									= 'Field "%s" is not correct integer number';
    $l['form_err_ip']									= 'Field "%s" is not correct IP address';
    $l['form_err_ipv6']									= 'Field "%s" is not correct IPv6 address';
    $l['form_err_isbn']									= 'Field "%s" is not correct ISBN number';
    $l['form_err_italian_codice_fiscale']				= 'Field "%s" is not correct Italian fiscal code (codice fiscale)';
    $l['form_err_italian_postcode']						= 'Field "%s" is not correct Italian postcode';
    $l['form_err_mac_address']							= 'Field "%s" is not correct MAC address';
    $l['form_err_msoffice_file']						= 'File "%s" is not correct Microsoft Office file';
    $l['form_err_netherlands_postcode']					= 'Field "%s" is not correct Netherlands postcode';
    $l['form_err_required']								= 'Field "%s" is required to be filled';
    $l['form_err_roman_num']							= 'Field "%s" is not correct Roman numeral';
    $l['form_err_same_fields_dont_match']				= 'Fields %s do not match';
    $l['form_err_spanish_postcode']						= 'Field "%s" is not correct Spanish postcode';
    $l['form_err_ssn']									= 'Field "%s" is not correct Social Security number';
    $l['form_err_swedish_phone']						= 'Field "%s" is not correct Swedish phone number';
    $l['form_err_swedish_zip']							= 'Field "%s" is not correct Swedish zipcode';
    $l['form_err_uk_bsc']								= 'Field "%s" is not correct UK Bank Sort code';
    $l['form_err_uk_driver_license']					= 'Field "%s" is not correct UK Drivers License number';
    $l['form_err_uk_nin']								= 'Field "%s" is not correct UK National Insurance Number';
    $l['form_err_uk_postcode']							= 'Field "%s" is not correct UK postcode';
    $l['form_err_us_phone']								= 'Field "%s" is not correct U.S. phone number';
    $l['form_err_us_state']								= 'Field "%s" is not correct United States state';
    $l['form_err_vin']									= 'Field "%s" is not correct Vehicle Identification Number';
    $l['form_err_word']									= 'Field "%s" is not correct word';
    $l['form_err_zip']									= 'Field "%s" is not correct zip code';
    $l['form_err_file']									= 'File "%s" is not correct zip file';
    $l['form_err_date']									= 'Field "%s" is not correct date';
    $l['form_err_expired']								= 'This form expired and do not accept submits anymore.';
    $l['form_err_expired_time_format']                  = 'Time format is not valid in expire_date validator';
    $l['form_err_time']									= 'Field "%s" is not correct time';
    $l['form_err_domain']								= 'Field "%s" is not correct domain name';
    $l['form_err_percentage']							= 'Field "%s" is not correct percentage value';
    $l['form_err_month']							    = 'Field "%s" is not correct month';
    $l['form_err_weekday']							    = 'Field "%s" is not correct weekday';
    $l['form_err_year']							        = 'Field "%s" is not correct year';
    $l['form_err_monthday']							    = 'Field "%s" is not correct day of month';
    $l['form_err_vat_num']							    = 'Field "%s" is not correct European VAT number';
    $l['form_err_url']							        = 'Field "%s" is not correct URL';
    $l['form_err_filter_file']							= 'Field "%s" is not correct (%s) file';    
?>