<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Comment Controller Class
 * 
 * Provides endpoints that handles all
 * CRUD database access to comments
 */
class Comment extends CI_Controller {
	
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
	 * Retrieve all comments
	 * 
	 * @return	json
	 */
	public function get_comments()
	{
		$data["comments"] = $this->comments->get_comments();

		$this->output->set_content_type('application/json');
		$this->output->set_status_header(200);
		$this->output->set_output(json_encode($data));
	}
	
	// --------------------------------------------------------------------

	/**
	 * Retrieve comment with id: id
	 * 
	 * Post params:
	 * @param	string	id
	 * 
	 * @return	json
	 */
	public function get_comment()
	{
		$comment_id = $this->input->get("id");
		$data["comment"] = $this->comments->get_comment($comment_id)[0];

		$this->output->set_content_type('application/json');
		$this->output->set_status_header(200);
		$this->output->set_output(json_encode($data));
	}

	// --------------------------------------------------------------------

	/**
	 * Submit a comment
	 * 
	 * Session params:
	 * @param	Object	submit_comment_data
	 */
	public function submit_comment()
	{
		if (null !== $this->session->flashdata("submit_comment_data"))
		{
			$data = $this->session->flashdata("submit_comment_data");
			$this->comments->add_comment($data);
		}
		redirect(base_url("blog"));
	}
	
	// --------------------------------------------------------------------

	/**
	 * Edit a commment
	 * 
	 * Session params:
	 * @param	string	edit_comment_id
	 * @param	Object	edit_comment_data
	 */
	public function edit_comment()
	{
		if ($this->session->has_userdata('logged_in'))
		{
			if (null !== $this->session->flashdata("edit_comment_data"))
			{
				$comment_id = $this->session->flashdata("edit_comment_id");
				$data = $this->session->flashdata("edit_comment_data");
				$this->comments->edit_comment($comment_id, $data);
			}
			redirect(base_url("admin"));
		}
		echo "You are not authorised";
	}

	// --------------------------------------------------------------------

	/**
	 * Delete a comment
	 * 
	 * Session params:
	 * @param	string	delete_comment_id
	 */
	public function delete_comment()
	{
		if ($this->session->has_userdata('logged_in'))
		{
			if (null !== $comment_id = $this->session->flashdata("delete_comment_id"))
			{
				$comment_id = $this->session->flashdata("delete_comment_id");
				$this->comments->delete_comment($comment_id);
			}
			redirect(base_url("admin"));
		}
		echo "You are not authorised";
	}
}
