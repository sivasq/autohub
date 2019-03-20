<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';
require APPPATH . 'libraries/JsonMapper.php';

class MY_Controller extends REST_Controller
{
    public $httpRequest;

    public function __construct()
    {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Access-Control-Allow-Origin");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

        $method = $_SERVER['REQUEST_METHOD'];

        if ($method == "OPTIONS") {
            die();
        }

        parent:: __construct();

        $this->load->library('session');
	    $this->load->library('email');
        $this->load->helper(array('form', 'url', 'date', 'utils'));
        $headers=array();
        foreach (getallheaders() as $name => $value) {
            $headers[$name] = $value;
        }
        $this->session->set_userdata('userdata', $headers);

        $this->httpRequest =  json_decode(file_get_contents('php://input'));
    }

    public function check_input_body($data_var)
    {
        if ($data = ($data_var !== null) ? $data_var : 'NULL')
        {
            return $data;
        }
    }

    public function response($data = NULL, $http_code = NULL, $continue = FALSE)
    {       
        if(!isset($data['error']))
        {
            // var_dump($data); die;
            if(isAssoc($data))
                parent::response($data, 403);

            $response_data = array();
            $response_data["status"] = isset($data[0]) ? $data[0] : null;
            $response_data["message"] = isset($data[2]) ? $data[2] : null;
            $response_data["data"] = isset($data[3]) ? $data[3] : null;

            $http_code = (isset($response_data[1])?$response_data[1]:$http_code);

            parent::response($response_data, $http_code, $continue); // TODO: Change the autogenerated stub
        }else{
            parent::response($data, $http_code, $continue); // TODO: Change the autogenerated stub
        }
    }

    /**
     * @param $path
     * @return mixed
     */
    public function get_path_variable($path)
    {
        $data = $this->uri->uri_to_assoc();
       // echo json_encode($data);die;
        $code = $data[$path];
        return $code;
    }

    /**
     * @param $variable
     */
    public function validateVariable($variable)
    {
        if (!isset($variable)) {
            $this->response(NULL, 400);
        }
    }

	/**
	 * @param $message,$email,$subject
	 */
	public function sendEmail1($message, $email, $subject)
	{
		$config = array(
			'protocol' => 'smtp',
			'smtp_host' => 'smtp.sendgrid.net',
			'smtp_user' => 'Emeka2018',
			'smtp_pass' => '@Emmy2018',
			'smtp_port' => 587,
			'mailtype' => 'html',
			'crlf' => "\r\n",
			'newline' => "\r\n"
		);

		$this->email->initialize($config);
		$this->email->set_newline("<br>");
		$this->email->from('auto.sales@autolane360.com'); // change it to yours
		$this->email->to($email);
		$this->email->subject($subject);
		$this->email->message($message);

		$this->email->send();

//		if($this->email->send())
//		{
//			return $this->email->print_debugger();
//		}else{
//			return $this->email->print_debugger();
//		}
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
		$config['wordwrap'] = TRUE;
		$config['newline'] = "\r\n"; //use double quotes

		$this->email->initialize($config);

		//send mail
		$this->email->from($from_email, 'Autohubb');
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