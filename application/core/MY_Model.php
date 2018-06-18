<?php

class MY_Model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function array_from_post($fields) {
        $data = array();
        foreach ($fields as $field) {
            $data[$field] = $this->input->post($field, TRUE);
        }
        return $data;
    }

    public function get($param) {
        $this->db->distinct();
        if (isset($param['select'])) {
            $this->db->select($param['select']);
        } else {
            $this->db->select();
        }
        if (isset($param['where'])) {
            $this->db->where($param['where']);
        }
        if (isset($param['order_by'])) {
            $this->db->order_by($param['order_by']);
        }
        if(isset($param['group_by'])) {
            $this->db->group_by($param['group_by']);
        }
        if (isset($param['limit'])) {
            $this->db->limit($param['limit']);
        }
        if (isset($param['total']) && isset($param['offset'])) {
            return $this->db->get($param['table'], $param['total'], $param['offset'])->result();
        } else {
            if ($param['get_row']) {
                return $this->db->get($param['table'])->row();
            } else {
                return $this->db->get($param['table'])->result();
            }
        }
    }

    public function count($options) {
        if (count($options) == 0 || !isset($options['where'])) {
            return $this->db->count_all($options['table']);
        } else {
            $this->db->where($options['where']);
            $this->db->from($options['table']);
            return $this->db->count_all_results();
        }
    }

    public function save($options) {
        if ($options['id'] == null) {
            !isset($options['id']) || $options['id'] = NULL;
            $this->db->set($options['data']);
            $this->db->insert($options['table']);
            $id = $this->db->insert_id();
            return $id;
        } else {
            $id = (int) $options['id'];
            $this->db->set($options['data']);
            $this->db->where($options['primary'], $id);
            $this->db->update($options['table']);

            $this->db->trans_complete();

            return $this->db->trans_status();
            //return (($this->db->affected_rows() != 1) ? 0 : 1);
        }
    }

    public function update($options) {
        $this->db->set($options['data']);
        $this->db->where($options['where']);
        $this->db->update($options['table']);
        return (($this->db->affected_rows() != 1) ? 0 : 1);
    }

    public function delete($options) {
        $this->db->where($options['key'], $options['value']);
        //$this->db->limit(1);
        $this->db->delete($options['table']);
    }
    
    public function dp_db($name) {
	    if($this->dbforge->drop_database($name)) {
		    return 1;
	    } else {
		    return 0;
	    }
    }
}
