<?php
/* require the user as the parameter */
if(isset($_GET['user']) && intval($_GET['user'])) {

	/* soak in the passed variable or set our own */
	$number_of_posts = isset($_GET['num']) ? intval($_GET['num']) : 10; //10 is the default
	$format = strtolower($_GET['format']) == 'xml' ? 'xml' : 'json'; //xml is the default
	$user_id = intval($_GET['user']); //no default

	/* connect to the db */
	$connection = pg_connect("host='register.workviewer.com' port='6432' dbname='icaosctrl' user='postgres' password='secpa!74!'") or die ("Bağlanamadı");

	/* grab the posts from the db */
	$sql=pg_query("select * from registered_users where id='$user_id' order by install_type desc");

	/* create one master array of the records */
	$posts = array();
	if(pg_num_rows($sql)) {
		while($post = pg_fetch_assoc($sql)) {
			$posts[] = array('member'=>$post);
		}
	}
	/* output in necessary format */
	if($format == 'json') {
		header('Content-type: application/json; charset=UTF-8');
		header("access-control-allow-origin: *");
		echo json_encode($posts);
	}
	else {
		header('Content-type: text/xml; charset=ISO-8859-9');
		echo '<workviewer>';
		foreach($posts as $index => $post) {
			if(is_array($post)) {
				foreach($post as $key => $value) {
					echo '<',$key,'>';
					if(is_array($value)) {
						foreach($value as $tag => $val) {
							echo '<',$tag,'>',iconv("utf-8","iso-8859-9",$val),'</',$tag,'>';
						}
					}
					echo '</',$key,'>';
				}
			}
		}
		echo '</workviewer>';
	}
}else{
	echo "Not set";
	}
?>