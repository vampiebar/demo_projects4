<?php
/* Settings file for Hesk 2.2 */
/*** Please read the README.HTM file for more information on these settings ***/

/* General settings */
$hesk_settings['site_title']='WEBAYNET YAZILIM';
$hesk_settings['site_url']='http://www.webaynet.com/';
$hesk_settings['support_mail']='destek@webaynet.com';
$hesk_settings['webmaster_mail']='bulentseker@gmail.com';
$hesk_settings['noreply_mail']='no-reply@webaynet.com';

/* Language settings */
$hesk_settings['can_sel_lang']=1;
$hesk_settings['language']='Turkish';
$hesk_settings['languages']=array(
'English' => array('folder'=>'en'),
'Turkish' => array('folder'=>'tr'),
);

/* Help desk settings */
$hesk_settings['hesk_url']='http://www.webaynet.com/helpdesk';
$hesk_settings['hesk_title']='WEBAYNET YAZILIM DESTEK SISTEMI';
$hesk_settings['server_path']='C:\\Inetpub\\vhosts\\webaynet.com\\httpdocs\\helpdesk';
$hesk_settings['max_listings']=10;
$hesk_settings['print_font_size']=12;
$hesk_settings['debug_mode']=0;
$hesk_settings['secimg_use']=1;
$hesk_settings['secimg_sum']='Q54DAB82UW';
$hesk_settings['question_use']=0;
$hesk_settings['question_ask']='Type <i>4GU7J</i> here to fight SPAM:';
$hesk_settings['question_ans']='4GU7J';
$hesk_settings['list_users']=0;
$hesk_settings['autologin']=1;
$hesk_settings['autoclose']=5;
$hesk_settings['custopen']=1;
$hesk_settings['rating']=1;
$hesk_settings['diff_hours']=0;
$hesk_settings['diff_minutes']=0;
$hesk_settings['daylight']=0;
$hesk_settings['timeformat']='d-m-Y H:i:s';
$hesk_settings['alink']=0;
$hesk_settings['cust_urgency']=1;

/* Knowledgebase settings */
$hesk_settings['kb_enable']=1;
$hesk_settings['kb_search']=2;
$hesk_settings['kb_search_limit']=10;
$hesk_settings['kb_recommendanswers']=1;
$hesk_settings['kb_rating']=1;
$hesk_settings['kb_substrart']=300;
$hesk_settings['kb_cols']=2;
$hesk_settings['kb_numshow']=6;
$hesk_settings['kb_popart']=6;
$hesk_settings['kb_latest']=6;
$hesk_settings['kb_index_popart']=5;
$hesk_settings['kb_index_latest']=5;

/* Database settings */
$hesk_settings['db_host']='localhost';
$hesk_settings['db_name']='helpdesk';
$hesk_settings['db_user']='helpdesk';
$hesk_settings['db_pass']='125100';
$hesk_settings['db_pfix']='';

/* File attachments */
$hesk_settings['attachments']=array (
    'use' =>  1,
    'max_number'  =>  2,
    'max_size'    =>  3024, // kb
    'allowed_types'   =>  array('.gif','.jpg','.png','.zip','.rar','.csv','.doc','.docx','.txt','.pdf')
);

/* Custom fields */
$hesk_settings['custom_fields']=array (
'custom1'=>array('use'=>1,'place'=>0,'type'=>'text','req'=>0,'name'=>'�r�n Aktivasyon Kodunuz (Varsa)','maxlen'=>255,'value'=>''),
'custom2'=>array('use'=>0,'place'=>0,'type'=>'text','req'=>0,'name'=>'Custom field 2','maxlen'=>255,'value'=>''),
'custom3'=>array('use'=>0,'place'=>0,'type'=>'text','req'=>0,'name'=>'Custom field 3','maxlen'=>255,'value'=>''),
'custom4'=>array('use'=>0,'place'=>0,'type'=>'text','req'=>0,'name'=>'Custom field 4','maxlen'=>255,'value'=>''),
'custom5'=>array('use'=>0,'place'=>0,'type'=>'text','req'=>0,'name'=>'Custom field 5','maxlen'=>255,'value'=>''),
'custom6'=>array('use'=>0,'place'=>0,'type'=>'text','req'=>0,'name'=>'Custom field 6','maxlen'=>255,'value'=>''),
'custom7'=>array('use'=>0,'place'=>0,'type'=>'text','req'=>0,'name'=>'Custom field 7','maxlen'=>255,'value'=>''),
'custom8'=>array('use'=>0,'place'=>0,'type'=>'text','req'=>0,'name'=>'Custom field 8','maxlen'=>255,'value'=>''),
'custom9'=>array('use'=>0,'place'=>0,'type'=>'text','req'=>0,'name'=>'Custom field 9','maxlen'=>255,'value'=>''),
'custom10'=>array('use'=>0,'place'=>0,'type'=>'text','req'=>0,'name'=>'Custom field 10','maxlen'=>255,'value'=>''),
'custom11'=>array('use'=>0,'place'=>0,'type'=>'text','req'=>0,'name'=>'Custom field 11','maxlen'=>255,'value'=>''),
'custom12'=>array('use'=>0,'place'=>0,'type'=>'text','req'=>0,'name'=>'Custom field 12','maxlen'=>255,'value'=>''),
'custom13'=>array('use'=>0,'place'=>0,'type'=>'text','req'=>0,'name'=>'Custom field 13','maxlen'=>255,'value'=>''),
'custom14'=>array('use'=>0,'place'=>0,'type'=>'text','req'=>0,'name'=>'Custom field 14','maxlen'=>255,'value'=>''),
'custom15'=>array('use'=>0,'place'=>0,'type'=>'text','req'=>0,'name'=>'Custom field 15','maxlen'=>255,'value'=>''),
'custom16'=>array('use'=>0,'place'=>0,'type'=>'text','req'=>0,'name'=>'Custom field 16','maxlen'=>255,'value'=>''),
'custom17'=>array('use'=>0,'place'=>0,'type'=>'text','req'=>0,'name'=>'Custom field 17','maxlen'=>255,'value'=>''),
'custom18'=>array('use'=>0,'place'=>0,'type'=>'text','req'=>0,'name'=>'Custom field 18','maxlen'=>255,'value'=>''),
'custom19'=>array('use'=>0,'place'=>0,'type'=>'text','req'=>0,'name'=>'Custom field 19','maxlen'=>255,'value'=>''),
'custom20'=>array('use'=>0,'place'=>0,'type'=>'text','req'=>0,'name'=>'Custom field 20','maxlen'=>255,'value'=>'')
);

#############################
#     DO NOT EDIT BELOW     #
#############################
$hesk_settings['hesk_version']='2.2';
if ($hesk_settings['debug_mode'])
{
    error_reporting(E_ALL ^ E_NOTICE);
}
else
{
    ini_set('display_errors', 0);
    ini_set('log_errors', 1);
}
if (!defined('IN_SCRIPT')) {die('Invalid attempt!');}
?>