<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct() {

        parent::__construct();
        $this->load->library('session');
        $this->load->model('home_model');
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->helper("security");
       
    }

   

/////////////// Admin Pages ///////////////////////    

    public function view($page = 'index') {

        if (!file_exists(APPPATH . 'views/pages/admin/' . $page . '.php')) {
            show_404();
        }

        if ($page != 'index') {
            //if is not logged in
            if (!isset($this->session->is_logged_in) || $this->session->is_logged_in == FALSE) {
                redirect('admin/view'); // if the user didn't log in yet, redirect to index page 
                //(main/admin) like (main/admin/index)
            }
        } else {
            //if logged in
            if (isset($this->session->is_logged_in) && $this->session->is_logged_in == TRUE) {
                redirect('admin/view/period_new'); // region ->> The First Page so I direct to it if the user 
                //is alredy logged in.
            }
        }

        $data['title'] = ucfirst($page); // Capitalize the first letter
        $data['page'] = $page; // Capitalize the first letter
        if (isset($this->session->name) && !empty($this->session->name)) {
            $data['name'] = $this->session->name;
        }
        $this->load->view('templets/admin/header_admin', $data);
        if ($page != 'index') {
            $this->load->view('templets/admin/sidemenu_admin', $data);
        }
        $this->load->view('pages/admin/' . $page);
        $this->load->view('templets/admin/footer_admin');
    }

//////////////////////////////////////////////////////////////////////////
///////////////////////////// Global Functions ////////////////////////////

    public function login() {

        $data['title'] = ucfirst('Login Page');

        $this->form_validation->set_rules('username', 'Username', 'required|numeric');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templets/admin/header_admin', $data);
            $this->load->view('pages/admin/index');
            $this->load->view('templets/admin/footer_admin');
        } else {
            $data['login'] = $this->home_model->login($this->input->post('username'), $this->input->post('password'));
            $this->login_handeler($data['login']);
        }
    }

    public function login_handeler($login) {

        if (empty($login) == True) {
            $data['title'] = ucfirst('Login Page');
            // login failed
            $data["error"] = 'Wrong username or password.';
            // send error to the view
            $this->load->view('templets/admin/header_admin', $data);
            $this->load->view('pages/admin/index', $data);
            $this->load->view('templets/admin/footer_admin');
        } else {
            foreach ($login AS $row) {

                $this->session->name = $row->user_name;
                $this->session->username = $row->user_username;
                $this->session->userid = $row->user_id;
            }
            $this->session->is_logged_in = true;
            //unlink('././backup/mybackup.sql');
            redirect('admin/view');
        }
    }

////////////////////////////// Eng Global Functions ////////////////////////////
}
