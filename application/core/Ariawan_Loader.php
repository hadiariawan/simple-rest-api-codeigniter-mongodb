<?php  if (! defined('BASEPATH')) exit('No direct script access allowed');

class Ariawan_Loader extends CI_Loader
{
    function __construct()
    {
        parent::__construct();

    }

    public function dependency($library = '', $class_name = '')
    {
        $path = APPPATH . $library . '.php';

        if(!file_exists($path))
        {
            return false;
        }else{

            include_once($path);
            return new $class_name;
        }
    }
}