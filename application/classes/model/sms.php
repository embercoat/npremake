<?php defined('SYSPATH') OR die('No Direct Script Access');

Class Model_sms extends Model
{
	private $body = '';
	private $recipients = array();
	private $flash = false;
	private $multisms = false;
	private $senddate = false;
	private $config = array();
	private $subject = '';

	public function __construct($subject = NULL){
		$this->config = Kohana::config('sms')->as_array();
		if(is_null($subject) && isset($this->config['sender'])){
		    $subject = $this->config['sender'];
		}
		$this->subject = $subject;
		return $this;
	}

	public function body($body = NULL){
		if($body !== NULL)
			$this->body = $body;
		return $this;
	}

	public function flash($tf = NULL){
		if($tf !== NULL)
			$this->flash = $tf;
		return $this;
	}

	public function multisms($tf = NULL){
		if($tf !== NULL)
			$this->flash = $tf;
		return $this;
	}

	public function senddate($senddate = NULL){
		if($senddate !== NULL)
			$this->senddate = $senddate;
		return $this;
	}
	public function get_sender(){
		return $this->subject;
	}
	public function add_recipient($number){
		if(is_array($number)){
			$this->recipients = array_merge($this->recipients, $number);
		} else {
			$this->recipients[] = $number;
		}
		$this->recipients = array_unique($this->recipients);

		return $this;
	}

	private function compile_recipients(){
		foreach($this->recipients as &$r){
			$new = preg_replace("/[^0-9]/", "", $r);
			if($new[0] == 0)
				$new = '46'.substr($new, 1);
			$r = $new;
		}
		return implode(',', $this->recipients);

	}
	public function generate_signature(){
		return md5($this->config['account'].$this->compile_recipients().$this->body.$this->config['password']);
	}

	public function send(){
		$url =
			$this->config['url']
				.'?account='.$this->config['account']
				.'&signature='.$this->generate_signature()
				.'&receivers='.$this->compile_recipients()
				.'&sender='.$this->get_sender()
				.'&message='.urlencode($this->body);
		if(isset($this->config['callback']))
		    $url .= '&callback'.$this->config['callback'];

		file_get_contents($url);
	}
}
