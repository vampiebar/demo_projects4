<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$veri["baslik"]="Merhaba";
		$veri["icerik"]="İlk Deneme";
		$veri["icerik_aciklama"]="Bu Codeigniter'ın ilk denemesidir.";
		if ($this->agent->is_mobile())
		{
			$veri["agent"] = $this->agent->mobile();
		}
		elseif ($this->agent->is_browser())
		{
			$veri["agent"] = $this->agent->browser().' '.$this->agent->version();
		}
		elseif ($this->agent->is_robot())
		{
			$veri["agent"] = $this->agent->robot();
		}
		else
		{
			$veri["agent"] = 'Unidentified User Agent';
		}
		$veri["platform"] = $this->agent->platform();
		$veri["ip"] = $_SERVER["REMOTE_ADDR"];
		//echo $this->agent->platform(); // Platform info (Windows, Linux, Mac, etc.)
		$this->load->view('welcome_message',$veri);
	}
}