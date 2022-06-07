<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Login Controller Class
 * 
 * Handles login page
 */
class Login extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		
		// Load libraries
		$this->load->library("form_validation");
		$this->load->library("session");

		// Load admins model
		$this->load->model("admins");
	}
	
	// --------------------------------------------------------------------

	/**
	 * Display login page
	 */
	public function index()
	{
		$this->load->view("login");
	}

	// --------------------------------------------------------------------

	/**
	 * Authenticate user credential and authorize admin privileges if
	 * the credential exists on the database
	 */
	public function login()
	{
		// Check if the credential is valid
		$this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
		
		$post_email = $this->input->post('form-email');
		$post_password = $this->input->post('form-password');
		$data = array(
			"email"		=> $post_email,
			"password"	=> $post_password
		);
		$valid_login = $this->admins->check_credentials($data);
		
		if ($valid_login)
		{
			// Add user data in session
			$session_data = array(
				'email' => $post_email
			);
			$this->session->set_userdata('logged_in', $session_data);
			redirect(base_url("admin"));
		}
		else
		{
			// Redirect to login page and display error message
			$this->session->set_flashdata('invalid_login', TRUE);
			redirect(base_url("login"));
		}
	}
}
