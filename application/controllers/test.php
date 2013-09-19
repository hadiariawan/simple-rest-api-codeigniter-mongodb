<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller {

	var $obooks;

	public function __construct() 
    {
        parent::__construct();

        $this->load->library('unit_test');
        
        $this->obooks = $this->load->dependency('controllers/books','Books');
    }

	public function index()
	{
		$success_result = null;
		$success_result['code'] = 1;
		$success_result['message'] = 'Success';
		$success_result = json_encode($success_result);

		$error_result = null;
		$error_result['code'] = 0;
		$error_result['message'] = 'Error';
		$error_result = json_encode($error_result);

		$this->obooks->is_test = true;

		// Book Listing
		$this->unit->run( $this->obooks->lists() , $this->obooks->lists(), 'book listing', 'if test enable, then lists return json instead of print');
		// Delete with no book id
		$this->unit->run( $this->obooks->delete() , $error_result, 'delete book without book_id', 'with no book_id parameter');
		// Delete with wrong book id
		$this->unit->run( $this->obooks->delete('5239a2250d8e3a0906000009') , $error_result, 'delete book with book_id', 'entered wrong book_id');
		// Adding new book
		$this->unit->run( $this->obooks->update() , $success_result, 'adding new book', 'with no post parameter');
		
		
		// print_r($this->unit->result());

		print_r($this->unit->report());
	}

}
