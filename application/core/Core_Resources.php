<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Core_Resources extends CI_Controller {

	private $UPLOAD_PATH = './assets/upload/';
	private $ACTUAL_EMAIL = '';
	private $DUMMY_EMAIL = 'jianchris2k14@gmail.com';
	private $DUMMY_PASSWORD = '725jicdp';

	private $OZEKI_USER = "admin";
	private $OZEKI_PWORD = "ozeki";
	private $OZEKI_URL = "http://127.0.0.1:9501/api?";
	
	public function __construct() {
		parent::__construct();
	}

	protected function upload($file_name, $upload_name){
		$this->load->library('upload', [
			'file_name' => $file_name,
			'overwrite' => true,
			'upload_path' => $this->UPLOAD_PATH,
			'allowed_types' => 'gif|jpg|png|jpeg|pdf|doc|docx|xls|xlsx|ppt|pptx',
			'max_size' => '2048'
		]);
		if($this->upload->do_upload($upload_name)){
			return $this->upload->data();
		}else{
			return $this->upload->display_errors();
		}
	}
	
	protected function email($values){
		$this->load->library('email', [
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_port' => 465,
			'smtp_user' => $this->DUMMY_EMAIL,
			'smtp_pass' => $this->DUMMY_PASSWORD
		]);
		$this->email->set_newline("\r\n");
		$this->email->to(empty($values['email_to']) ? $this->ACTUAL_EMAIL:$values['email_to']);
		$this->email->from($this->DUMMY_EMAIL, $values['fullname']);
		$this->email->subject($values['subject']);
		$this->email->message($values['message']);
		if(!empty($values['email_reply']))
			$this->email->reply_to($values['email_reply'], $values['fullname']);
		if(!empty($values['header']))
			$this->email->set_header('Header', $values['header']);
		if(!empty($values['attachment']))
			$this->email->attach($values['attachment']);
		if($this->email->send()){
			return true;
		}else{
			return false;
		}
	}

	protected function ozeki_send($phone, $msg, $debug = false){
		$url = 'username='.$this->OZEKI_USER;
		$url .= '&password='.$this->OZEKI_PWORD;
		$url .= '&action=sendmessage';
		$url .= '&messagetype=SMS:TEXT';
		$url .= '&recipient='.urlencode($phone);
		$url .= '&messagedata='.urlencode($msg);
		$urltouse = $this->OZEKI_URL.$url;
		if ($debug) { 
			echo "Request: <br> $urltouse <br>"; 
		}
		$response = $this->ozeki_http($urltouse);
		if ($debug) {
			echo "Response: <br><pre> ".str_replace(array("<", ">"), array("&lt;", "&gt;"), $response)." </pre><br>"; 
		}
		return $response;
	}

	private function ozeki_http($url){
		$pattern = "/http...([0-9a-zA-Z-.]*).([0-9]*).(.*)/";
		preg_match($pattern, $url, $args);
		$in = "";
		$fp = fsockopen("$args[1]", $args[2], $errno, $errstr, 30);
		if (!$fp) {
		   return "$errstr ($errno)";
		} else {
		    $out = "GET /$args[3] HTTP/1.1\r\n";
		    $out .= "Host: $args[1]:$args[2]\r\n";
		    $out .= "User-agent: Ozeki PHP client\r\n";
		    $out .= "Accept: */*\r\n";
		    $out .= "Connection: Close\r\n\r\n";
		    fwrite($fp, $out);
		    while (!feof($fp)) {
		       $in .= fgets($fp, 128);
		    }
		}
		fclose($fp);
		return $in;
	}

}
