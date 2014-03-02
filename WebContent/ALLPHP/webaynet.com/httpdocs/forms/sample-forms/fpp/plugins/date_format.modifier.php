<?php
  function modifier_date_format($ts, $format){
  	return date($format, $ts);
  }
?>