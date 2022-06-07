<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Admin Controller Class
 * 
 * Handles use cases for admin: editing and deleting comments
 * An admin must be logged in to be authorized
 */
class Admin extends CI_Controller {

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
		if ($this->session->has_userdata('logged_in'))
		{
			// Load comments from model and display admin page
			$data["comments"] = $this->comments->get_comments();
			$this->load->view("admin", $data);
		}
		else
		{
			redirect(base_url("login"));
		}
	}

	// --------------------------------------------------------------------

	/**
	 * Edit a comment through Comment controller
	 * 
	 * Post parameters:
	 * @param	string	comment-id	
	 * @param	string	new-name	edited comment's name
	 * @param	string	new-text	edited comment's text
	 */
	public function edit_comment()
	{
		if ($this->session->has_userdata('logged_in'))
		{
			$comment_id = $this->input->post('comment-id'); 
			$comment_name = $this->input->post('new-name');
			$comment_text = $this->input->post('new-text');

			// Retrieve current loval time (GMT+7)
			$date_time = new DateTime("now", new DateTimeZone("Asia/Jakarta"));
			$date_time->setTimestamp(time());

			$data = array(
				"name"			=> $comment_name,
				"text"			=> $comment_text,
				"date_modified"	=> $date_time->format('Y-m-d H:i:s')
			);

			// Redirect to comment controller
            $this->session->set_flashdata("edit_comment_data", $data);
            $this->session->set_flashdata("edit_comment_id", $comment_id);
			redirect(base_url("comment/edit_comment"));
		}
		echo "You are not authorised";
	}

	// --------------------------------------------------------------------

	/**
	 * Delete a comment throught Comment controller
	 * 
	 * Post parameters:
	 * @param	string	comment-id	comment id to be deleted
	 */
	public function delete_comment()
	{
		if ($this->session->has_userdata('logged_in')) {
			$comment_id = $this->input->post('comment-id'); 

			// Redirect to comment controller
            $this->session->set_flashdata("delete_comment_id", $comment_id);
			redirect(base_url("comment/delete_comment"));
		}
		echo "You are not authorised";
	}

	// --------------------------------------------------------------------

	/**
	 * Logout admin credential
	 */
	public function logout()
	{
		if ($this->session->has_userdata('logged_in')) {
			$this->session->unset_userdata('logged_in');
			redirect(base_url("admin"));
		}
		echo "You are not authorised";
	}
}
