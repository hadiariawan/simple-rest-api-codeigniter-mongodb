<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MongoData {

	var $CI;
	var $collection;

    public function __construct($CI,$collection_name) 
    {
     	$this->CI = $CI;
        $this->CI->load->library( 'Mongo_db' , array('config_file' => 'mongodb'), 'mongo_db');
        $this->collection = $collection_name;
    }

    public function get($where,$offset,$limit)
    {
    	if($offset != '' && $limit != ''){
            $this->CI->mongo_db->offset($offset);
            $this->CI->mongo_db->limit($limit);
        }

        if($where != ''){
            $this->CI->mongo_db->where($where);
        }

    	$query = $this->CI->mongo_db->get( $this->collection );
        return $query;
    }

    public function add($data){
    	return $this->CI->mongo_db->insert( $this->collection , $data );
    }

    public function update($where,$data){
    	return $this->mongo_db->where($where)->set($data)->update( $this->collection );
    }

    public function delete($where){
        return $this->CI->mongo_db->delete_all($this->collection, $where);
    }

}