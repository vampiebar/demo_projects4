<?php 
class uyekayit extends CI_Controller{
	public function index(){
		$data["title"] = "Üye Kayıt";
		$this->load->view("uyekayit_view",$data);
		}
	public function kontrol(){
		if($_POST){
			echo "ok";
			}else{
				die("Giriş Yasak");
				}
		}
	}
?>
