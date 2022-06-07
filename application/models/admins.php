<?php

/**
 * Admins Model Class
 * 
 * Check if the provided credentials exists in the database
 */
class Admins extends CI_MODEL {
    
    // --------------------------------------------------------------------
    
	/**
     * Check if the provided credentials exists in the database
     * 
     * @param   Object  data
	 */
	public function check_credentials($data)
    {
        $query = $this->db->get_where('admins', array('email' => $data["email"]));
        $result = $query->result_array();
        
        if (count($result) > 0)
        {
            // Admin credential exists
            if (hash("sha256", $data["password"]) == $result[0]["password"])
            {
                // Password matches
                return TRUE;
            }
        }
        return FALSE;
    }
}