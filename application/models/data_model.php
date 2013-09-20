<?php
    
class Data_model extends Kampret_Model {

    var $db;

    function __construct($param){
        parent::__construct();

        $this->db         = $param;
    }
    
    function get_items($where='',$offset='',$limit=''){

        $query = $this->db->get($where,$offset,$limit);
        return $query; 
    }

    function add_items($data='')
    {
        return $this->db->add($data);
    }

    function update_items($where='',$data='')
    {
        return $this->db->update($where,$data);
    }

    function delete_items($where='')
    {
        return $this->db->delete($where);
    }

}