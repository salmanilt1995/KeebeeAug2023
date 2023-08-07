<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getClientData($user_id, $limit, $search = '') {

        $this->db->select('*');
        $this->db->from('tbl_client');
        $this->db->where('user_id', $user_id);
        $this->db->where('is_active', 1);
        $this->db->where('deleted', null);
        $this->db->limit(ITEM_PER_PAGE, $limit);
        if($search != ''){
            $this->db->like('billing_name', $search);
            $this->db->or_like('contact_name', $search);
            $this->db->or_like('mailing_address', $search);
            $this->db->or_like('direction', $search);
            $this->db->or_like('phone', $search);
            $this->db->or_like('area', $search);
        }
       
        return $this->db->get()->result();

    }
	
	
	
}
