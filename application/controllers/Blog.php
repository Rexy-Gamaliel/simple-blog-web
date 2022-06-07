<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Blog Controller Class
 * 
 * Displays article and comments on a blog
 * The blog can be accessed by anoyone
 * Everyone can add a comment after inserting name, comment, and CAPTCHA
 */
class Blog extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		// Load libraries
		$this->load->library("form_validation");
		$this->load->library("session");
		
		// Load comments model
		$this->load->model("comments");
	}

	// --------------------------------------------------------------------

	/**
	 * Check if user is logged in and is authorized to access admin page
	 */
	public function index()
	{
		// Load comments from model
		$data["comments"] = $this->comments->get_comments();
		
		// Load CAPTCHA
		$captcha = $this->_create_captcha();
		$this->session->set_userdata("captcha", $captcha["word"]);
		$data["captcha_img"] = $captcha["image"];
		
		$this->load->view("blog", $data);
	}

	// --------------------------------------------------------------------

	/**
	 * Submit a comment to Comment controller
	 * 
	 * Post parameters:
	 * @param	string	form-name	new comment's name
	 * @param	string	form-text	new comment's text
	 */
	public function submit_comment() {
		// Check if inputs and CAPTCHA are valid
		$valid_input	= $this->_check_comment_input();
		$valid_captcha	= $this->_check_captcha();

		$name		= $this->input->post('form-name');
		$comment	= $this->input->post('form-comment');

		if ($valid_input && $valid_captcha)
		{
			// Redirect to Comment controller
			$data = array(
				"name"		=> $name,
				"text"		=> $comment
			);
            $this->session->set_flashdata("submit_comment_data", $data);
            redirect(base_url('comment/submit_comment'));
		}
        else
		{
			if ($valid_captcha)
			{
				// Display error messages
                $this->session->set_flashdata('previous_name', $name);
                $this->session->set_flashdata('previous_comment', $comment);
            }
            redirect(base_url('blog'));
        }
	}

	// --------------------------------------------------------------------

	/**
	 * Check if inputs for new comment are valid
	 * TRUE if both inputs are valid, FALSE otherwise
	 */
	private function _check_comment_input() {
		$post_name		= $this->input->post('form-name');
		$post_comment	= $this->input->post('form-comment');
		
		$invalid_name = ($post_name == '') || (strlen($post_name) > 30);
		$this->session->set_flashdata('invalid_name', $invalid_name);
		
		$invalid_comment = $post_comment == '';
		$this->session->set_flashdata('invalid_comment', $invalid_comment);

		return !($invalid_name || $invalid_comment);
	}

	// --------------------------------------------------------------------

	/**
	 * Generate a new CAPTCHA
	 * Generated CAPTCHA will be exported to assets/images/captcha
	 */
	private function _create_captcha() {
        $vals = array(
            "img_path"      => "./assets/images/captcha/",
            "img_url"       => base_url("assets/images/captcha/"),
			"word_length"	=> 4
        );
        $captcha = create_captcha($vals);
        return $captcha;
	}

	// --------------------------------------------------------------------

	/**
	 * Check if user's CAPTCHA input is valid
	 */
	private function _check_captcha() {
        $post_code  = $this->input->post('form-captcha');
        $captcha    = $this->session->userdata('captcha');
        
        if ($post_code && ($post_code == $captcha)) {
            $this->session->set_flashdata('invalid_captcha', FALSE);
			return TRUE;
		}
		else {
            $this->session->set_flashdata('invalid_captcha', TRUE);
			return FALSE;
		}
	}
}