<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Books extends CI_Controller {

	var $is_test = false;

	public function __construct() 
    {
        parent::__construct();

        $this->load->model('books_model');

    }

	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function lists($offset='',$limit='')
	{
		$books['books'] = $this->books_model->get_all_items($offset,$limit);

		if(!$this->is_test){
			header('Content-Type: application/json');
			echo json_encode($books);
			exit;
		}else{
			return json_encode($books); 
		}

	}

	public function show($book_id='')
	{
		$where['_id'] = new MongoId($book_id);
		$books['book'] = $this->books_model->get_items($where);
		
		if(!$this->is_test){
			header('Content-Type: application/json');
			echo json_encode($books);
			exit;
		}else{
			return json_encode($books); 
		}
	}

	public function update($book_id='')
	{
		$is_valid = true;

		// $books = array('title' => 'Book Title Test #' . rand(0,100) , 'author' => 'Hadi Ariawan');
		$book = $this->input->post(null,true);

		if(empty($book)){
			$is_valid = false;
		}else{
			if(empty($book_id)){
				$is_valid = $this->books_model->add($book);
			}else{
				$is_valid = $this->books_model->update($book,new MongoId($book_id));
			}
		}

		if($is_valid){
			$message['code']    = 1;
			$message['message'] = 'Success';
		}else{
			$message['code']    = 0;
			$message['message'] = 'Error';
		}

		if(!$this->is_test){
			header('Content-Type: application/json');
			echo json_encode($message);
			exit;
		}else{
			return json_encode($message); 
		}
	}

	public function delete($book_id='')
	{
		if(empty($book_id)){
			$is_valid = false;
		}else{
			$is_valid = $this->books_model->delete(new MongoId($book_id));
		}

		if($is_valid){
			$message['code']    = 1;
			$message['message'] = 'Success';
		}else{
			$message['code']    = 0;
			$message['message'] = 'Error';
		}

		if(!$this->is_test){
			header('Content-Type: application/json');
			echo json_encode($message);
			exit;
		}else{
			return json_encode($message); 
		}
	}

}