<?php

class Common_model extends CI_Model {

   
    public function getActiveData($table_name = '', $field_id = '', $sort = '') {
        $this->db->select('*');
        $this->db->from($table_name);
        $this->db->order_by($field_id, $sort);
        $this->db->where('deleted', null);
        $this->db->where('is_active', 1);
        $query = $this->db->get();
        return $query->result();
    }
    
    public function getData($table_name = '',$select,$field_id, $field_name) {
        $this->db->select($select);
        $this->db->from($table_name);
        $this->db->where($field_id, $field_name);
        $this->db->where('deleted', 0);
        $query = $this->db->get();
        return $query->result();
    }
  
    public function getDataOther($table_name = '',$select,$field_id, $field_name,$field_id1, $field_name1,$gropBy) {
        $join = "sync_history.user_id = ".$table_name.'.'.$field_id;

        $this->db->select($select);
        $this->db->from($table_name);
        $this->db->join('sync_history', "$join");
        $this->db->where($field_id, $field_name);
        $this->db->where($field_id1 .'!=', $field_name1);
        $this->db->where('deleted', 0);
        // $this->db->where($table_name.'.created_at < '.$table_name.'.syncDate');
        $this->db->group_by($table_name.'.'.$gropBy);
        $query = $this->db->get();
        return $query->result();
    }
     public function getDataAll($table_name = '',$select,$field_id, $field_name,$field_id1, $field_name1,$gropBy) {
        $join = "sync_history.user_id = ".$table_name.'.'.$field_id;

        $this->db->select($select);
        $this->db->from($table_name);
        $this->db->join('sync_history', "$join");
        $this->db->where($field_id, $field_name);
        $this->db->where($field_id1 .'!=', $field_name1);
        // $this->db->where('deleted', 0);
        // $this->db->where($table_name.'.created_at < '.$table_name.'.syncDate');
        $this->db->group_by($table_name.'.'.$gropBy);
        $query = $this->db->get();
        return $query->result();
    }


    public function getDataByIdMulti($table_name, $field_id, $id, $field_id1, $id1) {
        $this->db->select('*');
        $this->db->from($table_name);
        $this->db->where($field_id, $id);
        $this->db->where($field_id1, $id1);
        $this->db->where('deleted', 0);
        $this->db->where('is_active', 1);
        $query = $this->db->get();
        return $query->row();
    }

    public function getDataById($table_name, $field_id, $id) {
        $this->db->select('*');
        $this->db->from($table_name);
        $this->db->where($field_id, $id);
        $this->db->where('deleted', null);
        $this->db->where('is_active', 1);
        $query = $this->db->get();
        return $query->row();
    }


   
    public function checkFieldUniqueData($table_name, $field_name, $field_value) {
        $this->db->select('*');
        $this->db->from($table_name);
        $this->db->where($field_name, $field_value);
        $this->db->where('deleted', null);
        $this->db->where('is_active', 1);
        $query = $this->db->get();
        return $query->result();
    }

   

    public function insertData($table_name, $data) {
        try {
            $this->db->insert($table_name, $data);
            return $this->db->insert_id();
        } catch (QueryException $ex) {
            return $ex->getMessage();
        }
    }

    public function updateData($table_name, $data, $field_id, $id) {
        try {
            $this->db->where($field_id, $id);
            return $this->db->update($table_name, $data);
        } catch (QueryException $ex) {
            return $ex->getMessage();
        }
    }

    public function deleteData($table_name, $field_id, $id) {
        try {
            $this->db->set('deleted', 1);
            $this->db->where($field_id, $id);
            return $this->db->update($table_name);
        } catch (QueryException $ex) {
            return $ex->getMessage();
        }
    }
    public function delete($table_name, $field_id, $id, $field_id1, $id1){
        $this->db->where($field_id, $id);
        $this->db->where($field_id1, $id1);
        return $this->db->delete($table_name);
    }



}

?>