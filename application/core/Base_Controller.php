<?php

/**
 * Created by PhpStorm.
 * User: Sivaraj
 * Date: 28-03-2019 028
 * Time: 12:34
 */
class Base_Controller extends MX_Controller
{

	/**
	 * Base_Controller constructor.
	 */
	public function __construct()
	{
		parent::__construct();

		$this->load->library('session');
		$this->load->library('cloudinarylib');
		$this->load->library('form_validation');
		$this->load->helper(array('form', 'url', 'date', 'custom'));
		$this->load->database();
		$this->load->model('admin_model');
	}

	public function sendEmail($message, $to_email, $subject)
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
		$config['wordwrap'] = true;
		$config['newline'] = "\r\n"; //use double quotes

		$this->email->initialize($config);

		//send mail
		$this->email->from($from_email, 'Autohub');
		$this->email->to($to_email);

		$this->email->subject($subject);
		$this->email->message($message);

		$this->email->send();

//		 if(!$this->email->send()){
//		     return $this->email->print_debugger();
//		 }else{
//			 return $this->email->print_debugger();
//		 }

	}
}