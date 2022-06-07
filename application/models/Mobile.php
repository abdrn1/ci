<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mobile extends CI_Controller
{

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
    public function __construct()
    {

        parent::__construct();
        $this->load->library('session');
        $this->load->model('home_model');
        $this->load->model('customer_model', 'customer');
        $this->load->model('period_model', 'period');
        $this->load->model('bill_model', 'bill');
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->helper("security");
        $this->load->helper('file');

        // if (!isset($this->session->is_logged_in) || $this->session->is_logged_in == FALSE) {
        //     redirect('admin/view'); // if the user didn't log in yet, redirect to index page 
        //     //(main/admin) like (main/admin/index)
    }

    public function go()
    {
        echo 'hello there';
    }

    public function listAllEmp()
    {
        $result =  $this->home_model->listAllEmp();
        echo json_encode($result);
    }

    public function empLogin()
    {

        $username = "";
        $password = "";
        $result = [];

        if ((isset($_GET['api_key']))) {

            if ($_GET['api_key'] != '2242021') {
                $result['status'] = 'error';
                $result['msg'] = 'مفتاح دخول خاطئ';
                echo json_encode($result);
                return;
            }
        } else {
            $result['status'] = 'error';
            $result['msg'] = 'لا مفتاح دخول';
            echo json_encode($result);
            return;
        }

        if (isset($_GET['username']) && $_GET['password']) {
            $username = $_GET['username'];
            $password = $_GET['password'];
            $result = $this->home_model->empLogin($username, $password);
        }


        echo json_encode($result);
    }


    public function getAllRegions()
    {
        $results = $this->home_model->region_get_all();
        //$results = $this->security->xss_clean(json_decode(json_encode($results), true));
        if (empty($results)) {
            $results['status'] = 'error';
            $results['msg'] = 'لا يوجد بيانات';
            echo json_encode($results);
        } else {
            echo json_encode($results);
        }
    }

    public function getAllStreets()
    {
        if ((isset($_GET['api_key']))) {

            if ($_GET['api_key'] != '2242021') {
                $response['msg'] = "invalid key";
                return $this->output->set_status_header(401)->set_content_type('application/json')->set_output(json_encode($response));
            }
        } else {
            $response['msg'] = "invalid key";
            return $this->output->set_status_header(401)->set_content_type('application/json')->set_output(json_encode($response));
        }
        $results = $this->home_model->getAllStreets();
        if (empty($results)) {
            throw new Exception("There is  No streets");
        } else {
            // echo "hello";
            echo json_encode($results);
        }
    }

    public function GetPeriodForAllCustomers()
    {
        $streetiD = $_GET['street_id'];
        $screenType = $_GET['screen_type'];
        $currentDate = -1;
        if (isset($_GET["current_date"])) {
            $currentDate = $_GET["current_date"];
        }

        $results = $this->home_model->GetPeriodForAllCustomers($currentDate, -1, $streetiD, $screenType);
        //$results = $this->security->xss_clean(json_decode(json_encode($results)));
        echo json_encode($results);
    }


    public function period_insert()
    {


        if (!isset($_POST['api_key']) || $_POST['api_key'] != '2242021') {
            $result['status'] = 'error';
            $result['msg'] = 'مفتاح دخول خاطئ';
            echo json_encode($result);
            return;
        }


        $uploade['status'] = 'Success';
        if (empty($_POST['period_date'])) {
            $uploade['status'] = 'error';
            $uploade['msg'] = 'دورة الشهر فارغة';
            die(json_encode($uploade));
        }
        if (empty($_POST['period_customer']) || $_POST['period_customer'] == -1) {
            $uploade['status'] = 'error';
            $uploade['msg'] = 'اسم المستخدم فارغ';
            die(json_encode($uploade));
        }
        if (empty($_POST['period_reading'])) {
            $uploade['status'] = 'error';
            $uploade['msg'] = 'قراءة العداد فارغة';
            die(json_encode($uploade));
        }
        if (empty($_POST['period_reading_date'])) {
            $uploade['status'] = 'error';
            $uploade['msg'] = 'تاريخ قراءة العداد فارغة';
            die(json_encode($uploade));
        }
        if (empty($_POST['period_previous_reading'])) {
            $uploade['status'] = 'error';
            $uploade['msg'] = 'قراءةالشهر السابق فارغة';
            die(json_encode($uploade));
        }

        $period_date = $_POST['period_date'];
        $period_price = $_POST['period_price'];
        $period_customer = $_POST['period_customer'];
        $period_reading = $_POST['period_reading'];
        $period_reading_date = $_POST['period_reading_date'];
        $period_previous_reading = $_POST['period_previous_reading'];
        //            $period_note = $_POST['period_note'];
        $period_note = 'إدخال موبايل';
        $period_add_money = $_POST['period_add_money'];
        if (isset($_POST['payment_value']) && !empty($_POST['payment_value'])) {
            $payment_value = $_POST['payment_value'];
        } else {
            $payment_value = 0;
        }
        if (isset($_POST['payment_discount']) && !empty($_POST['payment_discount'])) {
            $payment_discount = $_POST['payment_discount'];
        } else {
            $payment_discount = 0;
        }

        if ($uploade['status'] != 'error') {
            $uploade = $this->home_model->period_insert(
                strtotime($period_date),
                $period_price,
                $period_customer,
                $period_reading,
                strtotime($period_reading_date),
                $period_previous_reading,
                $period_note,
                $payment_value,
                $payment_discount
            );
            if ($uploade['complete'] == TRUE) {
                $uploade['status'] = 'Success';
                $uploade['msg'] = 'تم الإضافة بنجاح';


                if (isset($period_add_money) && !empty($period_add_money)) {
                    return $this->_add_cost_insert($uploade['period_id'], $period_add_money, $period_note);
                } else {
                    echo json_encode($uploade);
                }
            } else {
                $uploade['status'] = 'error';
                $uploade['msg'] = 'لم يتم إضافة البيانات';
                echo json_encode($uploade);
            }
        } else {
            echo json_encode($uploade);
        }
    }

    public function _add_cost_insert($period_id, $add_cost_value, $add_cost_note)
    {

        $uploade['status'] = 'Success';

        if ($uploade['status'] != 'error') {
            if ($this->home_model->add_cost_insert($period_id, $add_cost_value, $add_cost_note) == TRUE) {
                $uploade['status'] = 'Success';
                $uploade['msg'] = 'تم الإضافة بنجاح';
                echo json_encode($uploade);
            } else {
                $uploade['status'] = 'error';
                $uploade['msg'] = 'لم يتم إضافة البيانات';
                echo json_encode($uploade);
            }
        } else {
            echo json_encode($uploade);
        }
    }

    public function add_cost_insert()
    {

        //  die($_FILES['image']['name']);
        $uploade['status'] = 'Success';
        if (empty($_POST['period_id'])) {
            $uploade['status'] = 'error';
            $uploade['msg'] = 'لم يتم تحديد دورة';
            die(json_encode($uploade));
        }

        $period_id = $_POST['period_id'];
        $add_cost_value = $_POST['add_cost_value'];
        $add_cost_note = $_POST['add_cost_note'];

        if ($uploade['status'] != 'error') {
            if ($this->home_model->add_cost_insert($period_id, $add_cost_value, $add_cost_note) == TRUE) {
                $uploade['status'] = 'Success';
                $uploade['msg'] = 'تم الإضافة بنجاح';
                echo json_encode($uploade);
            } else {
                $uploade['status'] = 'error';
                $uploade['msg'] = 'لم يتم إضافة البيانات';
                echo json_encode($uploade);
            }
        } else {
            echo json_encode($uploade);
        }
    }


    public function payment_insert()
    {

        if (!isset($_POST['api_key']) || $_POST['api_key'] != '2242021') {
            $result['status'] = 'error';
            $result['msg'] = 'مفتاح دخول خاطئ';
            echo json_encode($result);
            return;
        }

        //  die($_FILES['image']['name']);
        $uploade['status'] = 'Success';
        if (empty($_POST['bill_id'])) {
            $uploade['status'] = 'error';
            $uploade['msg'] = 'رقم الفاتورة فارغ';
            die(json_encode($uploade));
        }
        if (empty($_POST['payment_value'])) {
            $uploade['status'] = 'error';
            $uploade['msg'] = 'قيمة الدفع فارغة';
            die(json_encode($uploade));
        }

        $bill_id = $_POST['bill_id'];
        $payment_value = $_POST['payment_value'];
        $payment_discount = $_POST['payment_discount'];
        $payment_note = $_POST['payment_note'];

        if ($uploade['status'] != 'error') {
            $upload = $this->home_model->payment_insert($bill_id, $payment_value, $payment_discount, $payment_note);
            if ($upload['complete'] == TRUE) {
                $uploade['status'] = 'Success';
                $uploade['msg'] = 'تم الإضافة بنجاح';
                echo json_encode($uploade);
            } else {
                $uploade['status'] = 'error';
                $uploade['msg'] = 'لم يتم إضافة البيانات';
                echo json_encode($uploade);
            }
        } else {
            echo json_encode($uploade);
        }
    }
}
