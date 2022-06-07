<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customers extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('customers_model','customers');
	}

	public function index()
	{
		//$this->load->helper('url');
		//$this->load->view('customers_view');
	}

	public function ajax_list()
	{
		$list = $this->customers->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $customers) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $customers->period_date;
			$row[] = $customers->period_reading;
			$row[] = $customers->customer_name;
			$row[] = $customers->street_name;
			$row[] = '$customers->city';
			$row[] = '<td> <button class="btn btn-danger btn-block" period-id="' . $customers->period_id . '" id="delete">حذف</button> </td>';
			$row[] = '$customers->country';

			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->customers->count_all(),
						"recordsFiltered" => $this->customers->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function empLogin(){

        $username ="";
        $password ="";
        $result =[];
        
        if((isset($_GET['api_key']))){
            
           if($_GET['api_key']!='2242021'){
            $result['status'] = 'error';
            $result['msg'] = 'مفتاح دخول خاطئ';
            echo json_encode($result);
            return; 
           }
      
        }else{
            $result['status'] = 'error';
            $result['msg'] = 'لا مفتاح دخول';
            echo json_encode($result);
            return;
        }

        if(isset($_GET['username']) && $_GET['password']){
            $username = $_GET['username'] ;
            $password = $_GET['password'];
            $result = $this->home_model->empLogin($username,$password);
        }
       
       
        echo json_encode($result);
     
    }


}
