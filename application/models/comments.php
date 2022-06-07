<?php

/**
 * Comments Model Class
 * 
 * Handles CRUD access to comments in the database
 */
class Comments extends CI_MODEL {

	/**
     * Retrieve all comments
	 */
	public function get_comments()
    {
        return $this->db->get("comments")->result_array();
    }

    // --------------------------------------------------------------------
    
	/**
     * Retrieve comment with the given id
     * 
     * @param   int     id
	 */
	public function get_comment($id)
    {
        $this->db->where(array("id" => $id));
        return $this->db->get("comments")->result();
    }

    // --------------------------------------------------------------------
    
	/**
     * Insert comment to databse
     * 
     * @param   Object  data
	 */
	public function add_comment($data)
    {
        $result = $this->db->insert("comments", $data);
    }

    // --------------------------------------------------------------------
    
	/**
     * Edit an existing comment
     * 
     * @param   Object  data
	 */
	public function edit_comment($id, $data)
    {
        $this->db->where(array("id" => $id));
        $this->db->update("comments", $data);
    }

    // --------------------------------------------------------------------
    
	/**
     * Delete an existing comment
     * 
     * @param   Object  data
	 */
	public function delete_comment($id)
    {
        $this->db->where(array("id" => $id));
        $this->db->delete("comments");
    }
}