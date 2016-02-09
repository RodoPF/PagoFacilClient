<?php

abstract class Base_Sender{
	public $params;
	public $type;
	protected $host;
	protected $result;
	
	protected function prepare_params(){
		return http_build_query($this->params);
	}
	
	protected function send_post(){
		$conn = curl_init();
		curl_setopt($conn, CURLOPT_URL, $this->host);
		curl_setopt($conn, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($conn, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($conn, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($conn, CURLOPT_POST, TRUE);
		curl_setopt($conn, CURLOPT_POSTFIELDS, $this->prepare_params());
		curl_setopt($conn, CURLOPT_VERBOSE, true);
		$result = curl_exec($conn);
		curl_close($conn);
		
		return $result;
	}
	
	protected function send_get(){
		$conn = curl_init();
		curl_setopt($conn, CURLOPT_URL, $this->host.'?'.$this->prepare_params());
		curl_setopt($conn, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($conn, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($conn, CURLOPT_RETURNTRANSFER, TRUE);
		$result = curl_exec($conn);
		curl_close($conn);
		return $result;
	}
	
	protected function send_put(){
		$conn = curl_init();
		curl_setopt($conn, CURLOPT_URL, $this->host);
		curl_setopt($conn, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($conn, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($conn, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($conn, CURLOPT_CUSTOMREQUEST, 'PUT');
		curl_setopt($conn, CURLOPT_POSTFIELDS, $this->prepare_params());
		$result = curl_exec($conn);
		curl_close($conn);
		return $result;
	}
	
	public function send(){
		$this->result = call_user_func(array($this, 'send_'.$this->type));
	}
	
	public function getResult(){
		$result = '<pre>';
		$result.= print_r($this->result, TRUE);
		$result.= '</pre>';
		return $result;
	}
}

class Rest_XML_Sender extends Base_Sender {
	protected $host = 'https://pagofacil.local/public/Wsrtransaccion/';
	protected function prepare_params(){
		$params = array(
			'method'=>'transaccion',
			'data'=>$this->params
		);
		return http_build_query($params);
	}
	public function getResult(){
		$result = '<xmp>';
		$result.= print_r($this->result, TRUE);
		$result.= '</xmp>';
		return $result;
	}
}

class Rest_Json_Sender extends Base_Sender {
	protected $host = 'https://pagofacil.local/public/Wsrtransaccion/index/format/json';
	protected function prepare_params(){
		$params = array(
			'method'=>'transaccion',
			'data'=>$this->params
		);
		return http_build_query($params);
	}
}

class Soap_Sender extends Base_Sender {
	protected $wsdl = 'https://pagofacil.local/public/Wsstransaccion/?wsdl';
	
	protected function send_soap(){
		
		$client = new SoapClient($this->wsdl, array('trace'=>1));
		$result = $client->transaccion($this->params);
		print_r($client->__getLastRequest());
		return $result;
	}
	
	public function send(){
		$this->result = $this->send_soap();
	}
	
}

class Form_Sender extends Base_Sender {
	protected $host = 'https://pagofacil.local/public/Payform';
}

class Cash_Sender extends Base_Sender{
	protected $host = 'https://pagofacil.local/public/cash/charge';
}

class Cash_Getter extends Base_Sender {
	protected $host = 'https://pagofacil.local/public/cash/charges';
}
