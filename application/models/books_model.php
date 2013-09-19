<?php
    
class Books_model extends CI_Model {

    var $collection = 'books';

    function __construct(){
        parent::__construct();

        $this->load->library( 'Mongo_db' , array('config_file' => 'mongodb'), 'mongo_db');
    }
    
    function get_all_items($offset = '', $limit = ''){

        if($offset != '' && $limit != ''){
            $this->mongo_db->offset($offset);
            $this->mongo_db->limit($limit);
        }

        $query = $this->mongo_db->get( $this->collection );
        return $query; 
    }

    function get_items($where='',$offset = '', $limit = ''){

        if($offset != '' && $limit != ''){
            $this->mongo_db->offset($offset);
            $this->mongo_db->limit($limit);
        }
        
        if($where != ''){
            $this->mongo_db->where($where);
        }

        $query = $this->mongo_db->get( $this->collection );
        return $query; 
    }

    function count_items($where = ''){
        if($where != ''){
            $this->mongo_db->where($where);
        }
        return $this->mongo_db->count( $this->collection ,$where);
    }
    
    /* --------------------------------------------------------------------------- */


    function add($data){
        
        return $this->mongo_db->insert( $this->collection ,$data);
    }

    function update($data,$id){
        return $this->mongo_db
                    ->where(
                                array(
                                    '_id' => $id
                                )
                            )
                    ->set($data)
                    ->update( $this->collection );
    }    

    function delete($id){
        $query = $this->mongo_db
                        ->where(
                                array(
                                    '_id' => $id
                                )
                            )
                        ->delete( $this->collection );
        return $query; 
    }

    function update_all($where,$fields,$values){

        $query = $this->mongo_db
                        ->where($where)
                        ->set($fields, $values)
                        ->update_all( $this->collection );
        return $query; 
    }

    function update_multiple($where,$data){

        $query = $this->mongo_db
                        ->where($where)
                        ->update_all( $this->collection , $data );
        return $query; 
    }

}