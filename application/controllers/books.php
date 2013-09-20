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

	public function lists($offset='',$limit='',$source='mongodb')
	{
		if($source == 'mongodb'){
			$DataProvider = new MongoData($this,'books');
		}else{
			$DataProvider = new ExcelData($this);
		}		

		$this->load->model('data_model','',FALSE,$DataProvider);

		$where = '';
		$books['books'] = $this->data_model->get_items($where,$offset,$limit);

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
		// $DataProvider = new ExcelData($this);
		$DataProvider = new MongoData($this,'books');
		$this->load->model('data_model','',FALSE,$DataProvider);

		$where['_id'] = new MongoId($book_id);
		$books['books'] = $this->data_model->get_items($where);
		
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

		// $book = array('title' => 'Book Title Test #' . rand(0,100) , 'author' => 'Hadi Ariawan');
		$book = $this->input->post(null,true);

		// $DataProvider = new ExcelData($this);
		$DataProvider = new MongoData($this,'books');
		$this->load->model('data_model','',FALSE,$DataProvider);

		if(empty($book)){
			$is_valid = false;
		}else{
			if(empty($book_id)){
				$is_valid = $this->data_model->add_items($book);
			}else{
				$is_valid = $this->data_model->add_items($book,new MongoId($book_id));
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
		// $DataProvider = new ExcelData($this);
		$DataProvider = new MongoData($this,'books');
		$this->load->model('data_model','',FALSE,$DataProvider);

		if(empty($book_id)){
			$is_valid = false;
		}else{
			$where['_id'] = new MongoId($book_id);
			$is_valid = $this->data_model->delete_items($where);
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

	public function just_echo($echo='')
	{
		return $echo;
	}

}