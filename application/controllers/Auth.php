<?php

class Auth extends CI_Controller{

  public function __construct(){

    parent::__construct();
    //load database
    $this->load->database();
    $this->load->model(array("users_model"));         
  }

  public function dashboard()
  {    
    if(!($this->session->userdata('logged_in') === true)){
      redirect('auth/login');
    } else {

      $this->load->view('template/header');
      $this->load->view('admin/dashboard');
      $this->load->view('template/footer');
    }     
    
  }

  public function login()
  {    
    $this->load->view('access/l_header');
    $this->load->view('access/login');
    $this->load->view('access/l_footer');
  }

  public function logout()
  {
    $this->session->sess_destroy();    
    $this->load->view('access/l_header');
    $this->load->view('access/login');
    $this->load->view('access/l_footer');
  }

  public function makelogin()
  {
      $email = $this->security->xss_clean($this->input->post('email'));
      $password = $this->security->xss_clean($this->input->post('password'));

      $this->form_validation->set_rules("email", "Email", "required|valid_email");
      $this->form_validation->set_rules("password", "Password", "required");

      // check form validation
      if($this->form_validation->run() === FALSE)
      {
        $this->load->view('access/i_header');
        $this->load->view('access/login');
        $this->load->view('access/i_footer');
      } else 
      {
        if(!empty($email) && !empty($password))
        {
            $user = array(
                "email" => $email,
                "password" => md5($password)
            );

            $output = $this->users_model->get_user($user);
            if($output != false)
            {
              $userdata = array(
                'userid' => $output->id,
                'email' => $output->email,
                'username' => $output->username,
                'logged_in' => true                
              );

              $this->session->set_userdata($userdata);

              redirect('auth/dashboard');
              //echo "Login Success";
            } else 
            {
                echo "Login Failed";
            }
        }
      }
  }

}