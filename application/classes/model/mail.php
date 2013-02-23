<?php

class Model_mail extends Model {

    public $subject, $from, $body;
    public $to = '', $cc = array(), $bcc = array();
    public $headers = array(
            'Content-type' => 'text/html; charset=utf-8',
            );

    function add_header($header){
        $this->headers = array_merge($this->headers, $header);
        return $this;
    }
    function to($to){
        $this->to = $to;
        return $this;
    }

    function clear_to(){
        $this->to = array();
        return $this;
    }

    function add_cc($cc){
        if(!is_array($cc))
            $cc = array($cc);
        $this->cc = array_merge($this->cc, $cc);
        return $this;
    }

    function clear_cc(){
        $this->cc = array();
        return $this;
    }

    function add_bcc($bcc){
        if(!is_array($bcc))
            $bcc = array($bcc);
        $this->bcc = array_merge($this->bcc, $bcc);
        return $this;
    }

    function clear_bcc(){
        $this->cc = array();
        return $this;
    }

    function body($body){
        $this->body = $body;
        return $this;
    }
    function subject($subject){
        $this->subject = $subject;
        return $this;
    }
    function from($from){
        $this->add_header(array('From' => $from));
        return $this;
    }
    function compile_headers(){
    	$h_final= '';
    	foreach($this->headers as $key => $value){
    		$h_final .= $key.': '.$value."\r\n";
    	}
        return $h_final;
    }
    function send(){
        return mail($this->to, $this->subject, $this->body, $this->compile_headers());
    }
}

?>
