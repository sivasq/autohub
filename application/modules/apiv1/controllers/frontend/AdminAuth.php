<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminAuth extends Auth_Controller
{

	public function __construct()
	{
		parent:: __construct();
		$this->load->model('Admin_model');
	}

	public function index()
	{
		$this->load->view('admin/login');
	}

	public function forgot_password()
	{
		$this->load->view('admin/forgot_password');
	}

	public function password_reset_link()
	{
		$email = $this->input->post("email");

		$this->db->where('admin_email', $email);
		$email_exist = $this->db->get('admin_user');

		if ($email_exist->num_rows() > 0) {

			// Create tokens
			$selector = bin2hex(random_bytes(8));
			$token = random_bytes(32);

			$url = sprintf('%sindex.php/admin/auth/fp/validate_reset?%s', base_url(), http_build_query([
				'selector' => $selector,
				'validator' => bin2hex($token)
			]));

			// Token expiration
			$expires = new DateTime('NOW');
			$expires->add(new DateInterval('PT01H')); // 1 hour

			// Delete any existing tokens for this user
			$this->db->delete('password_reset', array('email' => $email));

			// Insert reset token into database
			$insert = $this->db->insert('password_reset',
				array(
					'email' => $email,
					'selector' => $selector,
					'token' => hash('sha256', $token),
					'expires' => $expires->format('U'),
				)
			);

			// Send the email
			// Recipient
			$to = $email;

			// Subject
			$subject = 'Your password reset link';

			// Message
			$message = '<p>We recieved a password reset request. The link to reset your password is below. ';
			$message .= 'If you did not make this request, you can ignore this email</p>';
			$message .= '<p>Here is your password reset link:</br>';
			$message .= sprintf('<a href="%s">%s</a></p>', $url, $url);
			$message .= '<p>Thanks!</p>';

			// Send email
			$this->sendEmail($message, $to, $subject);

			$response['status'] = true;
			$response['email'] = $email;
		} else {
			$response['status'] = false;
		}

		echo json_encode($response);
	}

	public function email_confirm()
	{
		$data['email'] = filter_input(INPUT_GET, 'mail');
		$this->load->view('admin/email_confirm', $data);
	}

	public function validate_reset()
	{
		// Check for tokens
		$data['selector'] = filter_input(INPUT_GET, 'selector');
		$data['validator'] = filter_input(INPUT_GET, 'validator');

		$this->db->where("selector='" . $data['selector'] . "' AND expires >=  'time()'");
		$results = $this->db->get('password_reset')->num_rows();

		if ($results > 0) {
			$this->load->view('admin/change_password', $data);
		} else {
			$this->load->view('admin/link_expired');
		}
	}

	public function reset_process()
	{
		$selector = $this->input->post("selector");
		$validator = $this->input->post("validator");
		$password = $this->input->post("password");

		// Get tokens
		$this->db->where("selector='" . $selector . "' AND expires >=  'time()'");
		$results = $this->db->get('password_reset')->row();

		if (empty($results)) {
//			return array('status' => 0, 'message' => 'There was an error processing your request. Error Code: 002');
			$response['status'] = false;
		}

		$auth_token = $results;
		$calc = hash('sha256', hex2bin($validator));

		// Validate tokens
		if (hash_equals($calc, $auth_token->token)) {

			$this->db->where('admin_email', $auth_token->email);
			$user = $this->db->get('admin_user')->row();

			if (false === $user) {
//				return array('status' => 0, 'message' => 'There was an error processing your request. Error Code: 003');
			}

			// Update password
			$this->db->where('admin_id', $user->admin_id);
			$this->db->update('admin_user', array('admin_password' => $password));
//			'password' => password_hash($password, PASSWORD_DEFAULT),

//			 Delete any existing password reset for this user
			$this->db->delete('password_reset', array('email' => $user->admin_email));

				// New password. New session.
			$this->session->sess_destroy();
			$response['status'] = true;
		}

		echo json_encode($response);
	}

	public function login_auth()
	{
		$response = array();
		$query = $this->admin_model->login_auth();

		if ($query->num_rows() > 0) {
			$userData = $query->row();
			$this->session->set_userdata('admin_user_id', $userData->admin_id);
			$this->session->set_userdata('first_name', $userData->admin_fname);
			$this->session->set_userdata('last_name', $userData->admin_lname);
			$this->session->set_userdata('username', $userData->admin_fname.' '.$userData->admin_lname);
			$this->session->set_userdata('profile_img', $userData->image);
			$this->session->set_userdata('admin_email', $userData->admin_email);
			$this->session->set_userdata('admin_phone', $userData->admin_phone);

			$response['status'] = true;

		} else {
			$response['status'] = false;
		}

		echo json_encode($response);
	}


	public function logout()
	{
		$this->session->sess_destroy();
		redirect('admin/auth');
	}
}