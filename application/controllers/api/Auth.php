<?php

require APPPATH.'libraries/REST_Controller.php';

class Auth extends REST_Controller{

  public function __construct(){

    parent::__construct();
    //load database
    $this->load->database();
   // $this->load->model(array("api/users_model"));    
  }

  public function dashboard()
  {
    $this->load->view('template/header');
    $this->load->view('admin/dashboard');
    $this->load->view('template/footer');
  }

}