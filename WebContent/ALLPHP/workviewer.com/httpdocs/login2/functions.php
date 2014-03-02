<?php 
function nekadar($dt,$precision=2)
{
	$times=array(	365*24*60*60	=> "yıl",
					30*24*60*60		=> "ay",
					7*24*60*60		=> "hafta",
					24*60*60		=> "gün",
					60*60			=> "saat",
					60				=> "dakika",
					1				=> "saniye");
	
	$passed=$dt;
	
	if($passed<5)
	{
		$output='5 saniyeden az kaldı';
	}
	else
	{
		$output=array();
		$exit=0;
		
		foreach($times as $period=>$name)
		{
			if($exit>=$precision || ($exit>0 && $period<60)) break;
			
			$result = floor($passed/$period);
			if($result>0)
			{
				$output[]=$result.' '.$name.($result==1?'':'');
				$passed-=$result*$period;
				$exit++;
			}
			else if($exit>0) $exit++;
		}
				
		$output=implode(' ',$output).' kaldı';
	}
	
	return $output;
}
function nekadaronce($dt,$precision=2)
{
	$times=array(	365*24*60*60	=> "yıl",
					30*24*60*60		=> "ay",
					7*24*60*60		=> "hafta",
					24*60*60		=> "gün",
					60*60			=> "saat",
					60				=> "dakika",
					1				=> "saniye");
	
	$passed=$dt;
	
	if($passed<5)
	{
		$output='5 saniyeden daha kısa bir zaman önce';
	}
	else
	{
		$output=array();
		$exit=0;
		
		foreach($times as $period=>$name)
		{
			if($exit>=$precision || ($exit>0 && $period<60)) break;
			
			$result = floor($passed/$period);
			if($result>0)
			{
				$output[]=$result.' '.$name.($result==1?'':'');
				$passed-=$result*$period;
				$exit++;
			}
			else if($exit>0) $exit++;
		}
				
		$output=implode(' ',$output).' önce';
	}
	
	return $output;
}
function toplamzaman($dt,$precision=3)
{
	$times=array(	365*24*60*60	=> "yıl",
					30*24*60*60		=> "ay",
					7*24*60*60		=> "hafta",
					24*60*60		=> "gün",
					60*60			=> "saat",
					60				=> "dakika",
					1				=> "saniye");
	
		$passed=$dt;
		$output=array();
		$exit=0;
		
		foreach($times as $period=>$name)
		{
			if($exit>=$precision) break;
			
			$result = floor($passed/$period);
			if($result>0)
			{
				$output[]=$result.' '.$name.($result==1?'':'');
				$passed-=$result*$period;
				$exit++;
			}
			else if($exit>0) $exit++;
		}
				
		$output=implode(' ',$output).'';
	
	return $output;
}
?>