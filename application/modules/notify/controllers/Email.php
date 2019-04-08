<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Email extends MY_Controller {

	function __construct()
	{
		parent::__construct();
	}

	function sendEmail($to_email, $subject, $message)
  	{
    	$from_email = 'sqtesting2016@gmail.com';

        $this->load->library('email');
        
    	//configure email settings
    	$config['protocol'] = 'smtp';
    	$config['smtp_host'] = 'ssl://smtp.googlemail.com'; //smtp host name
    	$config['smtp_port'] = '465'; //smtp port number
    	$config['smtp_user'] = $from_email;
    	$config['smtp_pass'] = 'P@$$word@999'; // from_email password
    	$config['mailtype'] = 'html';
    	$config['charset'] = 'utf-8';
    	$config['wordwrap'] = TRUE;
    	$config['newline'] = "\r\n"; //use double quotes        

        $this->email->initialize($config);

    	//send mail
    	$this->email->from($from_email, 'MobiAdmin');
    	$this->email->to($to_email);

    	$this->email->subject($subject);
    	$this->email->message($message);

    	return $this->email->send();

        // if(!$this->email->send()){
        //     print_r($this->email->print_debugger());
        // }

  	}


    function sendEmail_demo($to_email, $subject, $message)
    {
        
        $email = $to_email;
        $message = $message;
        $subject = $subject;
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: MobiAdmin <admin@mobiAdmin.com>' . "\r\n";
        
        return mail($email, $subject, $message, $headers);

    }
}

?>