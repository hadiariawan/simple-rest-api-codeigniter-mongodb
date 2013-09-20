<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ExcelData {

	var $CI;
    var $excel_file;
	

    public function __construct($CI) 
    {
     	$this->CI = $CI;
    }

    public function load_excel_file($name){
    	$this->excel_file = $name;
    }

    public function get()
    {
    	return 'This is from excel';
    }

    public function add(){
        return 'Added to excel file';	
    }

    public function update(){
        return 'Update to excel file';   	
    }

    public function delete(){
        return 'Delete row on excel file';      	
    }

}