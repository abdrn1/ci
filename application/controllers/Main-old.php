<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
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
     * 
     
     */

    public $sms_username = 'Remal Motor';
    public $sms_pass = '4049778';
    public $sms_sender = 'Remal Motor';

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

        if (!isset($this->session->is_logged_in) || $this->session->is_logged_in == FALSE) {
            redirect('admin/view'); // if the user didn't log in yet, redirect to index page 
            //(main/admin) like (main/admin/index)
        }
    }

    public function logout()
    {
        $this->backupdb();
        session_destroy();
        session_unset('is_logged_in');
        echo TRUE;
    }

    ////////////////////

    public function backupdb()
    {

        $prefs = array(
            'tables' => array('region', 'street', 'customer', 'period', 'bill', 'payment', 'cost', 'user', 'add_cost', 'box', 'box_type', 'box_respective'), // Array of tables to backup.
            //  'ignore'        => array(),                     // List of tables to omit from the backup
            'format' => 'txt', // gzip, zip, txt
            // 'filename'      => 'mybackup.sql',              // File name - NEEDED ONLY WITH ZIP FILES
            'add_drop' => TRUE, // Whether to add DROP TABLE statements to backup file
            'add_insert' => TRUE, // Whether to add INSERT data to backup file
            'newline' => "\n", // Newline character used in backup file
            'foreign_key_checks' => FALSE
        );


        // Load the DB utility class
        $this->load->dbutil();

        // Backup your entire database and assign it to a variable
        $backup = $this->dbutil->backup($prefs);

        // Load the file helper and write the file to your server

        write_file('././backup/mybackup.sql', $backup);

        // Load the download helper and send the file to your desktop
        //    $this->load->helper('download');
        //    force_download('mybackup.gz', $backup);
    }

    public function db_restore_backup()
    {
        if ($this->home_model->db_restore_backup()) {
            $uploade['status'] = 'Success';
            $uploade['msg'] = 'تم  الإنتهاء';
            echo json_encode($uploade);
        } else {
            $uploade['status'] = 'error';
            $uploade['msg'] = 'لم يتم الإسترجاع';
            echo json_encode($uploade);
        }
    }

    ////////////////////////////// Eng Global Functions ////////////////////////////
    ///////////////////////// Ajax Functions /////////////////////////////////////
    ////***** Start region Page ///

    public function region_insert()
    {

        //  die($_FILES['image']['name']);
        $uploade['status'] = 'Success';
        if (empty($_POST['region_name'])) {
            $uploade['status'] = 'error';
            $uploade['msg'] = 'اسم المنطقة فارغ';
            die(json_encode($uploade));
        }
        $region_name = $_POST['region_name'];
        $sender_name = $_POST['sender_name'];

        if ($uploade['status'] != 'error') {
            if ($this->home_model->region_insert($region_name, $sender_name) == TRUE) {
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

    public function region_update()
    {

        //  die($_FILES['image']['name']);
        $uploade['status'] = 'Success';
        if (empty($_POST['region_name'])) {
            $uploade['status'] = 'error';
            $uploade['msg'] = 'اسم المنطقة فارغ';
            die(json_encode($uploade));
        }

        if (empty($_POST['region_id'])) {
            $uploade['status'] = 'error';
            $uploade['msg'] = 'معرف المنطقة فارغ';
            die(json_encode($uploade));
        }

        $region_id = $_POST['region_id'];
        $region_name = $_POST['region_name'];
        $sender_name = $_POST['sender_name'];

        if ($uploade['status'] != 'error') {
            if ($this->home_model->region_update($region_name, $sender_name, $region_id) == TRUE) {
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

    public function region_get_all()
    {
        $results = $this->home_model->region_get_all();
        $results = $this->security->xss_clean(json_decode(json_encode($results), true));
        if (empty($results)) {
            $results['status'] = 'error';
            $results['msg'] = 'لا يوجد بيانات';
            echo json_encode($results);
        } else {
            echo json_encode($results);
        }
    }

    public function region_get_selected()
    {
        $results['status'] = '';
        $results['msg'] = '';
        if (empty($_POST['region_id'])) {
            $results['status'] = 'error';
            $results['msg'] = 'معرف المنطقة فارغ';
            echo json_encode($results);
        }
        if ($results['status'] != 'error') {
            $results = $this->home_model->region_get_selected($_POST['region_id']);
            $results = $this->security->xss_clean(json_decode(json_encode($results), true));
            if (empty($results)) {
                $results['status'] = 'error';
                $results['msg'] = 'لا يوجد بيانات';
                echo json_encode($results);
            } else {
                echo json_encode($results);
            }
        }
    }

    public function region_delete()
    {
        $results['status'] = '';
        $results['msg'] = '';
        if (empty($_POST['region_id'])) {
            $results['status'] = 'error';
            $results['msg'] = 'معرف المنطقة فارغ';
            echo json_encode($results);
        }

        if ($results['status'] !== 'error') {
            $results['rslt'] = $this->home_model->region_delete($_POST['region_id']);
            if ($results['rslt'] != TRUE) {
                $results['status'] = 'error';
                $results['msg'] = ' لا يوجد بيانات للحذف';
                echo json_encode($results);
            } else {
                $results['status'] = 'success';
                $results['msg'] = 'تم حذف البيانات بنجاح';
                echo json_encode($results);
            }
        }
    }

    ////***** End region Page ///
    ////***** Start street Page ///

    public function street_insert()
    {

        //  die($_FILES['image']['name']);
        $uploade['status'] = 'Success';
        if (empty($_POST['street_name'])) {
            $uploade['status'] = 'error';
            $uploade['msg'] = 'اسم الشارع فارغ';
            die(json_encode($uploade));
        }
        if (empty($_POST['street_region']) || $_POST['street_region'] == -1) {
            $uploade['status'] = 'error';
            $uploade['msg'] = 'اسم المنطقة فارغ';
            die(json_encode($uploade));
        }
        $street_name = $_POST['street_name'];
        $street_region = $_POST['street_region'];

        if ($uploade['status'] != 'error') {
            if ($this->home_model->street_insert($street_name, $street_region) == TRUE) {
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

    public function street_update()
    {

        //  die($_FILES['image']['name']);
        $uploade['status'] = 'Success';
        if (empty($_POST['street_name'])) {
            $uploade['status'] = 'error';
            $uploade['msg'] = 'اسم المنطقة فارغ';
            die(json_encode($uploade));
        }

        if (empty($_POST['street_id'])) {
            $uploade['status'] = 'error';
            $uploade['msg'] = 'معرف المنطقة فارغ';
            die(json_encode($uploade));
        }

        if (empty($_POST['street_region']) || $_POST['street_region'] == -1) {
            $uploade['status'] = 'error';
            $uploade['msg'] = 'اسم المنطقة فارغ';
            die(json_encode($uploade));
        }

        $street_id = $_POST['street_id'];
        $street_name = $_POST['street_name'];
        $street_region = $_POST['street_region'];

        if ($uploade['status'] != 'error') {
            if ($this->home_model->street_update($street_name, $street_region, $street_id) == TRUE) {
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

    public function street_get_all()
    {
        $results = $this->home_model->street_get_all();
        $results = $this->security->xss_clean(json_decode(json_encode($results), true));
        if (empty($results)) {
            $results['status'] = 'error';
            $results['msg'] = 'لا يوجد بيانات';
            echo json_encode($results);
        } else {
            echo json_encode($results);
        }
    }

    public function street_get_all_by_region()
    {

        $uploade['status'] = 'Success';

        if (empty($_POST['street_region']) || $_POST['street_region'] == -1) {
            $uploade['status'] = 'error';
            $uploade['msg'] = 'معرف المنطقة فارغ';
            die(json_encode($uploade));
        }

        $street_region = $_POST['street_region'];

        $results = $this->home_model->street_get_all_by_region($street_region);
        $results = $this->security->xss_clean(json_decode(json_encode($results), true));
        if (empty($results)) {
            $results['status'] = 'error';
            $results['msg'] = 'لا يوجد بيانات';
            echo json_encode($results);
        } else {
            echo json_encode($results);
        }
    }

    public function street_get_selected()
    {
        $results['status'] = '';
        $results['msg'] = '';
        if (empty($_POST['street_id'])) {
            $results['status'] = 'error';
            $results['msg'] = 'معرف المنطقة فارغ';
            echo json_encode($results);
        }
        if ($results['status'] != 'error') {
            $results = $this->home_model->street_get_selected($_POST['street_id']);
            $results = $this->security->xss_clean(json_decode(json_encode($results), true));
            if (empty($results)) {
                $results['status'] = 'error';
                $results['msg'] = 'لا يوجد بيانات';
                echo json_encode($results);
            } else {
                echo json_encode($results);
            }
        }
    }

    public function street_delete()
    {
        $results['status'] = '';
        $results['msg'] = '';
        if (empty($_POST['street_id'])) {
            $results['status'] = 'error';
            $results['msg'] = 'معرف المنطقة فارغ';
            echo json_encode($results);
        }

        if ($results['status'] !== 'error') {
            $results['rslt'] = $this->home_model->street_delete($_POST['street_id']);
            if ($results['rslt'] != TRUE) {
                $results['status'] = 'error';
                $results['msg'] = ' لا يوجد بيانات للحذف';
                echo json_encode($results);
            } else {
                $results['status'] = 'success';
                $results['msg'] = 'تم حذف البيانات بنجاح';
                echo json_encode($results);
            }
        }
    }

    ////***** End street Page ///
    ////***** Start customer Page ///

    public function customer_insert()
    {

        //  die($_FILES['image']['name']);
        $uploade['status'] = 'Success';
        if (empty($_POST['customer_name'])) {
            $uploade['status'] = 'error';
            $uploade['msg'] = 'اسم المشترك فارغ';
            die(json_encode($uploade));
        }

        //        if (empty($_POST['customer_jawwal'])) {
        //            $uploade['status'] = 'error';
        //            $uploade['msg'] = 'رقم الجوال فارغ';
        //            die(json_encode($uploade));
        //        }
        //      
        //        if (empty($_POST['customer_serial_number'])) {
        //            $uploade['status'] = 'error';
        //            $uploade['msg'] = 'الرقم المتسلسل فارغ';
        //            die(json_encode($uploade));
        //        }
        if (empty($_POST['customer_street']) || $_POST['customer_street'] == -1) {
            $uploade['status'] = 'error';
            $uploade['msg'] = 'اختار العنوان';
            die(json_encode($uploade));
        }
        $customer_name = $_POST['customer_name'];
        $customer_jawwal = $_POST['customer_jawwal'];
        $customer_serial_number = $_POST['customer_serial_number'];
        $customer_street = $_POST['customer_street'];

        if ($uploade['status'] != 'error') {
            if ($this->home_model->customer_insert($customer_name, $customer_jawwal, $customer_serial_number, $customer_street) == TRUE) {
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

    public function customer_update()
    {

        //  die($_FILES['image']['name']);
        $uploade['status'] = 'Success';

        if (empty($_POST['customer_id'])) {
            $uploade['status'] = 'error';
            $uploade['msg'] = 'معرف  المشترك فارغ';
            die(json_encode($uploade));
        }
        if (empty($_POST['customer_name'])) {
            $uploade['status'] = 'error';
            $uploade['msg'] = 'اسم المشترك فارغ';
            die(json_encode($uploade));
        }
        //       if (empty($_POST['customer_jawwal'])) {
        //            $uploade['status'] = 'error';
        //            $uploade['msg'] = 'رقم الجوال فارغ';
        //            die(json_encode($uploade));
        //        }
        //        if (empty($_POST['customer_serial_number'])) {
        //            $uploade['status'] = 'error';
        //            $uploade['msg'] = 'الرقم المتسلسل فارغ';
        //            die(json_encode($uploade));
        //        }
        if (empty($_POST['customer_street']) || $_POST['customer_street'] == -1) {
            $uploade['status'] = 'error';
            $uploade['msg'] = 'اختار العنوان';
            die(json_encode($uploade));
        }
        $customer_name = $_POST['customer_name'];
        $customer_jawwal = $_POST['customer_jawwal'];
        $customer_serial_number = $_POST['customer_serial_number'];
        $customer_street = $_POST['customer_street'];
        $customer_id = $_POST['customer_id'];


        if ($uploade['status'] != 'error') {
            if ($this->home_model->customer_update($customer_name, $customer_jawwal, $customer_serial_number, $customer_street, $customer_id) == TRUE) {
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

    public function customer_order_update()
    {

        //  die($_FILES['image']['name']);
        $uploade['status'] = 'Success';
        $uploade['msg'] = '';
        if (empty($_POST['customer_id'])) {
            $uploade['status'] = 'error';
            $uploade['msg'] = 'اسم المشترك فارغ';
            die(json_encode($uploade));
        }

        if (empty($_POST['customer_order'])) {
            $uploade['status'] = 'error';
            $uploade['msg'] = 'خانة الترتيب فارغة';
            die(json_encode($uploade));
        }

        $customer_id = $_POST['customer_id'];
        $customer_order = $_POST['customer_order'];

        if ($uploade['status'] != 'error') {
            if ($this->home_model->customer_order_update($customer_id, $customer_order) == TRUE) {
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

    public function customer_price_update()
    {

        //  die($_FILES['image']['name']);
        $uploade['status'] = 'Success';
        $uploade['msg'] = '';
        if (empty($_POST['customer_id'])) {
            $uploade['status'] = 'error';
            $uploade['msg'] = 'اسم المشترك فارغ';
            die(json_encode($uploade));
        }

        if (empty($_POST['customer_price'])) {
            $customer_price = null;
        } else {
            $customer_price = $_POST['customer_price'];
        }

        $customer_id = $_POST['customer_id'];


        if ($uploade['status'] != 'error') {
            if ($this->home_model->customer_price_update($customer_id, $customer_price) == TRUE) {
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

    public function customer_get_print()
    {
        $results = $this->home_model->customer_get_all();
        $results = $this->security->xss_clean(json_decode(json_encode($results), true));
        if (empty($results)) {
            $results['status'] = 'error';
            $results['msg'] = 'لا يوجد بيانات';
            echo json_encode($results);
        } else {
            echo json_encode($results);
        }
    }

    public function customer_get_for_select()
    {
        $results = $this->home_model->customer_get_for_select();
        $results = $this->security->xss_clean(json_decode(json_encode($results), true));
        if (empty($results)) {
            $results['status'] = 'error';
            $results['msg'] = 'لا يوجد بيانات';
            echo json_encode($results);
        } else {
            echo json_encode($results);
        }
    }

    public function customer_get_all()
    {
        $list = $this->customer->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $customer) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $customer->customer_name;
            $row[] = $customer->customer_jawwal;
            $row[] = $customer->customer_serial_number;
            $row[] = $customer->period_reading;
            $row[] = $customer->period_date;
            $row[] = $customer->region_name;
            $row[] = $customer->street_name;
            $row[] = '<td> <button class="btn btn-primary btn-block" customer-id="' . $customer->customer_id . '" id="edit">تعديل</button> </td>';
            $row[] = '<td> <button class="btn btn-danger btn-block" customer-id="' . $customer->customer_id . '" id="delete">حذف</button> </td>';


            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->customer->count_all(),
            "recordsFiltered" => $this->customer->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function customer_get_selected()
    {
        $results['status'] = '';
        $results['msg'] = '';
        if (empty($_POST['customer_id'])) {
            $results['status'] = 'error';
            $results['msg'] = 'معرف المشترك فارغ';
            echo json_encode($results);
        }
        if ($results['status'] != 'error') {
            $results = $this->home_model->customer_get_selected($_POST['customer_id']);
            $results = $this->security->xss_clean(json_decode(json_encode($results), true));
            if (empty($results)) {
                $results['status'] = 'error';
                $results['msg'] = 'لا يوجد بيانات';
                echo json_encode($results);
            } else {
                echo json_encode($results);
            }
        }
    }

    public function customer_delete()
    {
        $results['status'] = '';
        $results['msg'] = '';
        if (empty($_POST['customer_id'])) {
            $results['status'] = 'error';
            $results['msg'] = 'معرف المشترك فارغ';
            echo json_encode($results);
        }

        if ($results['status'] !== 'error') {
            $results['rslt'] = $this->home_model->customer_delete($_POST['customer_id']);
            if ($results['rslt'] != TRUE) {
                $results['status'] = 'error';
                $results['msg'] = ' لا يوجد بيانات للحذف';
                echo json_encode($results);
            } else {
                $results['status'] = 'success';
                $results['msg'] = 'تم حذف البيانات بنجاح';
                echo json_encode($results);
            }
        }
    }

    ////***** End customer Page ///
    ////***** Start Period Page ///

    public function period_get_print()
    {
        $results['status'] = '';
        $results['msg'] = '';
        if (empty($_POST['period_date'])) {
            $results['status'] = 'error';
            $results['msg'] = 'لم يتم تحديد دورة';
            die($results);
        }
        $period_date = $_POST['period_date'];
        $period_region = $_POST['period_region'];
        $period_street = $_POST['period_street'];
        $results = $this->home_model->period_get_all(strtotime($period_date), $period_region, $period_street);
        $results = $this->security->xss_clean(json_decode(json_encode($results), true));
        if (empty($results)) {
            $results['status'] = 'error';
            $results['msg'] = 'لا يوجد بيانات';
            echo json_encode($results);
        } else {
            echo json_encode($results);
        }
    }

    public function period_get_all()
    {
        $list = $this->period->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $period) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $period->customer_name;
            $row[] = $period->region_name;
            $row[] = $period->street_name;
            $row[] = $period->period_reading;
            $row[] = $period->period_reading_date;
            $row[] = $period->period_previous_reading;
            $row[] = $period->period_note;
            $row[] = '<td> <button class="btn btn-danger btn-block" period-id="' . $period->period_id . '" id="delete">حذف</button> </td>';


            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->period->count_all(),
            "recordsFiltered" => $this->period->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function period_get_all_list()
    {
        $results['status'] = '';
        $results['msg'] = '';
        if (empty($_POST['period_date'])) {
            $results['status'] = 'error';
            $results['msg'] = 'لم يتم تحديد دورة';
            die($results);
        }
        $period_date = $_POST['period_date'];
        $period_region = $_POST['period_region'];
        $period_street = $_POST['period_street'];
        $results = $this->home_model->period_get_all_list(strtotime($period_date), $period_region, $period_street);
        $results = $this->security->xss_clean(json_decode(json_encode($results), true));
        if (empty($results)) {
            $results['status'] = 'error';
            $results['msg'] = 'لا يوجد بيانات';
            echo json_encode($results);
        } else {
            echo json_encode($results);
        }
    }

    public function period_insert()
    {

        //  die($_FILES['image']['name']);
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
        $period_note = $_POST['period_note'];
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

    public function sendBillSMS($bill_consumption_sms, $bill_reminder_sms, $smsTextExtra, $customer_id)
    {

        $customer_result = $this->home_model->customer_get_selected($customer_id);
        $customer_jawwal = 0;

        $jsonStr = array();
        foreach ($customer_result as $value) {
            $customer_jawwal = $value->customer_jawwal;
        }

        $bill_result = $this->home_model->period_get_all_list_by_customer(-1, -1, $customer_id);
        foreach ($bill_result as $value) {
            $period_previous_reading = $value->period_previous_reading;
            $period_reading = $value->period_reading;
            $period_reading_date = $value->period_reading_date;
            $bill_paid = $value->bill_paid;
            $bill_discount = $value->bill_discount;
            $bill_consumption = $value->bill_consumption;
            $bill_reminder = $value->bill_reminder;
            $bill_sum = $value->bill_sum;
            $bill_price = $value->bill_price;
        }

        //            $message = 'مشتركنا العزيز';
        //            $message .= ' ';
        //            $message .= 'نحيطكم علماً  ';
        //            $message .= 'بأن المبلغ المطلوب لدورة هذا الشهر هو ';
        //            $message .= $bill_reminder;
        //            $message .= ' شيكل ';
        //            $message .= 'عن ';
        //            $message .= $bill_consumption;
        //            $message .= ' كيلو';
        //            $message .= ' ديون سابقة:';
        //            $message .=  abs($bill_reminder - $bill_sum);



        if ($customer_jawwal != 0 && !empty($customer_jawwal)) {

            $jawwal = '972' . $customer_jawwal;
            $message = '';
            $message = 'مشتركنا العزيز';
            $message .= '،';
            $message .= ' المبلغ المطلوب هو ';
            $message .= $bill_reminder;
            $message .= ' شيكل ';
            $message .= 'عن ';
            $message .= $bill_consumption;
            $message .= ' كيلو';
            // $message .= '، ';
            // $message .= 'مع العلم بأن أخر موعد للدفع هو 7 الشهر وعند عدم السداد سوف يتم فصل الاشتراك';
            if (isset($smsTextExtra)) {
                $smsTextExtra = trim($smsTextExtra);
                if (!empty($smsTextExtra)) {
                    $message .= ' ';
                    $message .= trim($smsTextExtra);
                }
            }



            // $messageencode = iconv( "utf-8", "windows-1256", $message); 

            $messageArabic = iconv("utf-8", "windows-1256", $message);

            $messageencode = urlencode($messageArabic);

            $url = "http://www.leadersms.ps/http/V1/SendSMS?username=279000&password=03e8e18e2b57f4c6&destination=" .
                $jawwal . "&international&sender=" . $sender_name . "&body=" . $messageencode . "&output=json";

            $arContext = array();
            $arContext['http']['timeout'] = 5;
            $context = stream_context_create($arContext);

            if (FALSE !== ($jsonStr = @file_get_contents($url, 0, $context))) {
                return $jsonStr;
            } else {
                $jsonStr['smsMessage'] = 'هناك مشكلة غير معروفة، ربما مشكلة اتصال بالشبكة';
                $jsonStr['success'] = '0';
                return $jsonStr;
            }
        } else {
            $jsonStr['smsMessage'] = 'الرجاء التأكد من رقم الجوال';
            $jsonStr['success'] = '0';
            return $jsonStr;
        }
    }

    public function sendSMS()
    {

        $period_region = $_POST['period_region'];
        $period_street = $_POST['period_street'];
        $sms_text = $_POST['smsText'];

        $customer_result = $this->home_model->period_consum_get_all($period_region, $period_street);


        $customer_jawwal = '';
        $sender_name = '';
        $jsonStr = array();
        foreach ($customer_result as $value) {
            $value = json_decode(json_encode($value));
            $customer_jawwal = substr($value->customer_jawwal, 2, 7);

            $sender_name = $value->sender_name;

            if ($customer_jawwal != 0 && !empty($customer_jawwal)) {

                $jawwal = $customer_jawwal;

                $message = $sms_text;

                $messageencode = iconv("utf-8", "windows-1256", $message);
                $sender_name = urlencode($sender_name);

               /* $url = "http://www.leadersms.ps/http/V1/SendSMS?username=279000&password=03e8e18e2b57f4c6&destination=" .
                    $jawwal . "&provider=1&sender=" . $sender_name . "&body=" . $messageencode . "&output=json";*/
                
                    $sms_user = urlencode($this->sms_username);
                    $sender_name = urlencode($this->sms_sender);
    
                    $url = 'http://www.hotsms.ps/sendbulksms.php?user_name=' . $sms_user . '&user_pass=' . $this->sms_pass . '&sender=' . $sender_name . '&mobile=' . $jawwal . '&type=0&text=' . $messageencode;
    
    
                $jsonStr = file_get_contents($url);

                echo $jsonStr;
            } else {
                $jsonStr['smsMessage'] = 'الرجاء التأكد من رقم الجوال';
                $jsonStr['success'] = '0';
                echo json_encode($jsonStr);
            }
        }
    }

    public function sendSMSLoop()
    {

        $period_region = $_POST['period_region'];
        $period_street = $_POST['period_street'];
        $sms_text = $_POST['smsText'];
        $smsTextExtra = trim($_POST['smsTextExtra']);
        $messageType = $_POST['messageType'];

        $customer_result = $this->home_model->period_consum_get_all($period_region, $period_street);
        $customer_jawwal = '';
        $customer_id = '';
        $message = '';
        $output = array();

        if (isset($smsTextExtra) && !empty($smsTextExtra)) {
            $smsTextExtra = ' ' . $smsTextExtra;
        }


        foreach ($customer_result as $value) {
            $jawwal = '';
            $sender_name = '';
            $value = json_decode(json_encode($value));

            if (!empty($value->customer_jawwal) && strlen($value->customer_jawwal) > 3) {

                $jawwal = '97' . $value->customer_jawwal;
                $sender_name = $value->sender_name;

                $bill_result = $this->home_model->period_get_all_list_by_customer(-1, -1, $value->customer_id);
                foreach ($bill_result as $value) {
                    //  $period_previous_reading = $value->period_previous_reading;
                    //  $period_reading = $value->period_reading;
                    //   $period_reading_date = $value->period_reading_date;
                    //   $bill_paid = $value->bill_paid;
                    //   $bill_discount = $value->bill_discount;
                    $bill_consumption = $value->bill_consumption;
                    $bill_reminder = $value->bill_reminder;
                    $bill_sum = $value->bill_sum;
                    //   $bill_price = $value->bill_price;
                }
                $message = '';

                if ($messageType == 1) {
                    $message = $sms_text;
                } else if ($messageType == 2) {
                    $message = 'مشتركنا العزيز';
                    $message .= '،';
                    $message .= ' المبلغ المطلوب هو ';
                    $message .= $bill_reminder;
                    $message .= ' شيكل ';
                    $message .= 'عن ';
                    $message .= $bill_consumption;
                    $message .= ' كيلو';
                    //  $message .= '، ';
                    //  $message .= 'مع العلم بأن أخر موعد للدفع هو 7 الشهر وعند عدم السداد سوف يتم فصل الاشتراك';
                    $message .= $smsTextExtra;
                } else if ($messageType == 3) {
                    $message = 'مشتركنا العزيز';
                    $message .= ' ';
                    $message .= 'نحيطكم علماً  ';
                    $message .= 'بأن المبلغ المطلوب لدورة هذا الشهر هو ';
                    $message .= $bill_reminder;
                    $message .= ' شيكل ';
                    $message .= 'عن ';
                    $message .= $bill_consumption;
                    $message .= ' كيلو';
                    $message .= ' ديون سابقة:';
                    $message .= abs($bill_reminder - $bill_sum);
                    //	$message .= ' مع العلم بأن أخر موعد للدفع هو 7 الشهر وعند عدم السداد سوف يتم فصل الاشتراك ';
                    $message .= $smsTextExtra;
                } else if ($messageType == 4) {
                    $message = 'مشتركنا العزيز';
                    $message .= ' ';
                    $message .= 'نحيطك علماً  ';
                    $message .= 'بأن المبلغ المطلوب لأخر فاتورة ';
                    $message .= $bill_reminder;
                    $message .= ' شيكل ';
                    $message .= 'و مجموع المستحقات ';
                    $message .= $bill_sum;
                    $message .= ' شيكل';
                    //	$message .= ' مع العلم بأن أخر موعد للدفع هو 7 الشهر وعند عدم السداد سوف يتم فصل الاشتراك ';
                    $message .= $smsTextExtra;
                }

                $messageArabic = iconv("utf-8", "windows-1256", $message);

                $messageencode = urlencode($messageArabic);
                $sender_name = urlencode($sender_name);

                $jsonStr = '';
                /* $url = "http://www.leadersms.ps/http/V1/SendSMS?username=279000&password=03e8e18e2b57f4c6&destination=" .
                        $jawwal . "&international&sender=". $sender_name ."&body=" . $messageencode . "&output=json";*/

                $sms_user = urlencode($this->sms_username);
                $sender_name = urlencode($this->sms_sender);

                $url = 'http://www.hotsms.ps/sendbulksms.php?user_name=' . $sms_user . '&user_pass=' . $this->sms_pass . '&sender=' . $sender_name . '&mobile=' . $jawwal . '&type=0&text=' . $messageencode;


                $arContext = array();
                $arContext['http']['timeout'] = 5;
                $context = stream_context_create($arContext);

                if (FALSE !== ($jsonStr = @file_get_contents($url, 0, $context))) {

                  //  $jsonArray = json_decode($jsonStr, TRUE);

                    if ($jsonStr == '1001') {

                        if (empty($customer_jawwal)) {
                            $customer_jawwal = $value->customer_jawwal;
                            $customer_id = $value->customer_id;
                        } else {
                            $customer_jawwal .= ',' . $value->customer_jawwal;
                            $customer_id .= ',' . $value->customer_id;
                        }
                    }
                } else {

                    if (empty($customer_jawwal)) {
                        $customer_jawwal = $value->customer_jawwal;
                        $customer_id = $value->customer_id;
                    } else {
                        $customer_jawwal .= ',' . $value->customer_jawwal;
                        $customer_id .= ',' . $value->customer_id;
                    }
                }
            } else {
                if (empty($customer_jawwal)) {
                    $customer_jawwal = $value->customer_jawwal;
                    $customer_id = $value->customer_id;
                } else {
                    $customer_jawwal .= ',' . $value->customer_jawwal;
                    $customer_id .= ',' . $value->customer_id;
                }
            }
        }
        $output['customer_jawwal'] = $customer_jawwal;
        $output['customer_id'] = $customer_id;

        echo json_encode($output);
    }

    public function sendSMSFail()
    {

        $sms_text = $_POST['smsText'];
        $sms_fails = $_POST['sms_fails'];
        $sms_ids = $_POST['sms_ids'];
        $smsTextExtra = trim($_POST['smsTextExtra']);
        $messageType = $_POST['messageType'];

        $customer_result = explode(',', $sms_fails);
        $customer_ids = explode(',', $sms_ids);

        if (isset($smsTextExtra) && !empty($smsTextExtra)) {
            $smsTextExtra = ' ' . $smsTextExtra;
        }

        $customer_jawwal = '';
        $customer_id = '';
        $message = '';
        $output = array();



        foreach ($customer_result as $key => $value) {
            $value = json_decode(json_encode($value));
            $jawwal = '';
            $sender_name = '';

            if (!empty($value) && strlen($value) >3) {
                $jawwal = '97' . $value;

                $bill_result = $this->home_model->period_get_all_list_by_customer(-1, -1, $customer_ids[$key]);
                foreach ($bill_result as $value) {
                    //  $period_previous_reading = $value->period_previous_reading;
                    //  $period_reading = $value->period_reading;
                    //   $period_reading_date = $value->period_reading_date;
                    //   $bill_paid = $value->bill_paid;
                    //   $bill_discount = $value->bill_discount;
                    $bill_consumption = $value->bill_consumption;
                    $bill_reminder = $value->bill_reminder;
                    $bill_sum = $value->bill_sum;
                    //   $bill_price = $value->bill_price;
                    $sender_name = $value->sender_name;
                }
                $message = '';

                if ($messageType == 1) {
                    $message = $sms_text;
                } else if ($messageType == 2) {
                    $message = 'مشتركنا العزيز';
                    $message .= '،';
                    $message .= ' المبلغ المطلوب هو ';
                    $message .= $bill_reminder;
                    $message .= ' شيكل ';
                    $message .= 'عن ';
                    $message .= $bill_consumption;
                    $message .= ' كيلو';
                    $message .= '، ';
                    //    $message .= 'مع العلم بأن أخر موعد للدفع هو 7 الشهر وعند عدم السداد سوف يتم فصل الاشتراك';
                    $message .= $smsTextExtra;
                } else if ($messageType == 3) {
                    $message = 'مشتركنا العزيز';
                    $message .= ' ';
                    $message .= 'نحيطكم علماً  ';
                    $message .= 'بأن المبلغ المطلوب لدورة هذا الشهر هو ';
                    $message .= $bill_reminder;
                    $message .= ' شيكل ';
                    $message .= 'عن ';
                    $message .= $bill_consumption;
                    $message .= ' كيلو';
                    $message .= ' ديون سابقة:';
                    $message .= abs($bill_reminder - $bill_sum);
                    //	$message .= ' مع العلم بأن أخر موعد للدفع هو 7 الشهر وعند عدم السداد سوف يتم فصل الاشتراك ';
                    $message .= $smsTextExtra;
                } else if ($messageType == 4) {
                    $message = 'مشتركنا العزيز';
                    $message .= ' ';
                    $message .= 'نحيطك علماً  ';
                    $message .= 'بأن المبلغ المطلوب لأخر فاتورة ';
                    $message .= $bill_reminder;
                    $message .= ' شيكل ';
                    $message .= 'و مجموع المستحقات ';
                    $message .= $bill_sum;
                    $message .= ' شيكل';
                    //	$message .= ' مع العلم بأن أخر موعد للدفع هو 7 الشهر وعند عدم السداد سوف يتم فصل الاشتراك ';
                    $message .= $smsTextExtra;
                }



                $messageArabic = iconv("utf-8", "windows-1256", $message);

                $messageencode = urlencode($messageArabic);
                $sender_name = urlencode($sender_name);

               /* $url = "http://www.leadersms.ps/http/V1/SendSMS?username=279000&password=03e8e18e2b57f4c6&destination=" .
                    $jawwal . "&international&sender=" . $sender_name . "&body=" . $messageencode . "&output=json";*/
                
                    $sms_user = urlencode($this->sms_username);
                    $sender_name = urlencode($this->sms_sender);
    
                    $url = 'http://www.hotsms.ps/sendbulksms.php?user_name=' . $sms_user . '&user_pass=' . $this->sms_pass . '&sender=' . $sender_name . '&mobile=' . $jawwal . '&type=0&text=' . $messageencode;
    

                $arContext = array();
                $arContext['http']['timeout'] = 5;
                $context = stream_context_create($arContext);

                if (FALSE !== ($jsonStr = @file_get_contents($url, 0, $context))) {

                  //  $jsonArray = json_decode($jsonStr, TRUE);

                    if ($jsonStr == '1001') {

                        if (empty($customer_jawwal)) {
                            $customer_jawwal = $value->customer_jawwal;
                            $customer_id = $value->customer_id;
                        } else {
                            $customer_jawwal .= ',' . $value->customer_jawwal;
                            $customer_id .= ',' . $value->customer_id;
                        }
                    }
                } else {
                    if (empty($customer_jawwal)) {
                        $customer_jawwal = $value->customer_jawwal;
                        $customer_id = $value->customer_id;
                    } else {
                        $customer_jawwal .= ',' . $value->customer_jawwal;
                        $customer_id .= ',' . $value->customer_id;
                    }
                }
            } else {
                if (empty($customer_jawwal)) {
                    $customer_jawwal = $value->customer_jawwal;
                    $customer_id = $value->customer_id;
                } else {
                    $customer_jawwal .= ',' . $value->customer_jawwal;
                    $customer_id .= ',' . $value->customer_id;
                }
            }
        }
        $output['customer_jawwal'] = $customer_jawwal;
        $output['customer_id'] = $customer_id;

        echo json_encode($output);
    }

    public function smsGetCredits()
    {

       // $url = "http://www.leadersms.ps/http/V1/CheckBalance?username=279000&password=03e8e18e2b57f4c6&output=plain";
       $sms_user = urlencode($this->sms_username);

        $url = 'http://www.hotsms.ps/getbalance.php?user_name=' . $sms_user. '&user_pass=' . $this->sms_pass;
       

        $arContext = array();
        $arContext['http']['timeout'] = 50;
        $context = stream_context_create($arContext);

        if (FALSE !== ($jsonStr = @file_get_contents($url, 0, $context))) {
            echo $jsonStr;
        } else {
            echo 'الرجاء التأكد من اتصال الإنترنت';
        }
    }

    public function period_get_customer()
    {
        $results['status'] = '';
        $results['msg'] = '';
        if (empty($_POST['period_date'])) {
            $results['status'] = 'error';
            $results['msg'] = 'لم يتم تحديد دورة';
            die($results);
        }
        $period_date = $_POST['period_date'];
        $period_region = $_POST['period_region'];
        $period_street = $_POST['period_street'];

        $results = $this->home_model->period_get_customer(strtotime($period_date), $period_region, $period_street);
        $results = $this->security->xss_clean(json_decode(json_encode($results), true));
        if (empty($results)) {
            $results['status'] = 'error';
            $results['msg'] = 'لا يوجد بيانات';
            echo json_encode($results);
        } else {
            echo json_encode($results);
        }
    }

    public function period_get_previous_reading()
    {
        $results['status'] = '';
        $results['msg'] = '';
        if (empty($_POST['period_date'])) {
            $results['status'] = 'error';
            $results['msg'] = 'لم يتم تحديد دورة';
            die($results);
        }
        if (empty($_POST['period_customer'])) {
            $results['status'] = 'error';
            $results['msg'] = 'لم يتم  مشترك';
            die($results);
        }
        $period_date = $_POST['period_date'];
        $period_customer = $_POST['period_customer'];


        $results = $this->home_model->period_get_previous_reading($period_date, $period_customer);
        $results = $this->security->xss_clean(json_decode(json_encode($results), true));
        if (empty($results)) {
            $results['status'] = 'error';
            $results['msg'] = 'لا يوجد بيانات';
            echo json_encode($results);
        } else {
            echo json_encode($results);
        }
    }

    public function period_delete()
    {
        $results['status'] = '';
        $results['msg'] = '';
        if (empty($_POST['period_id'])) {
            $results['status'] = 'error';
            $results['msg'] = 'معرف الدورة فارغ';
            echo json_encode($results);
        }

        if ($results['status'] !== 'error') {
            $results['rslt'] = $this->home_model->period_delete($_POST['period_id']);
            if ($results['rslt'] != TRUE) {
                $results['status'] = 'error';
                $results['msg'] = ' لا يوجد بيانات للحذف';
                echo json_encode($results);
            } else {
                $results['status'] = 'success';
                $results['msg'] = 'تم حذف البيانات بنجاح';
                echo json_encode($results);
            }
        }
    }

    ////***** End Period Page ///
    ////***** Start Pill Page ///

    public function bill_get_print()
    {
        $results['status'] = '';
        $results['msg'] = '';
        //        if (empty($_POST['bill_date'])) {
        //            $results['status'] = 'error';
        //            $results['msg'] = 'لم يتم تحديد دورة';
        //            die($results);
        //        }

        $bill_date_from = $_POST['bill_date_from'];
        $bill_date_to = $_POST['bill_date_to'];
        $bill_region = $_POST['bill_region'];
        $bill_street = $_POST['bill_street'];
        $bill_is_paid = $_POST['bill_is_paid'];
        $results = $this->home_model->bill_get_all(strtotime($bill_date_from), strtotime($bill_date_to), $bill_region, $bill_street, $bill_is_paid);
        $results = $this->security->xss_clean(json_decode(json_encode($results), true));
        if (empty($results)) {
            $results['status'] = 'error';
            $results['msg'] = 'لا يوجد بيانات';
            echo json_encode($results);
        } else {
            echo json_encode($results);
        }
    }

    public function bill_get_all()
    {
        $list = $this->bill->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $bill) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $bill->customer_name;
            $row[] = $bill->region_name;
            $row[] = $bill->street_name;
            $row[] = $bill->period_date;
            $row[] = $bill->period_reading_date;
            $row[] = $bill->period_reading;
            $row[] = $bill->period_previous_reading;
            $row[] = $bill->bill_consumption;
            $row[] = $bill->bill_price;
            $row[] = $bill->bill_paid;
            $row[] = $bill->bill_discount;
            $row[] = $bill->bill_reminder;
            $row[] = '<td> <button class="btn btn-success btn-block" customer-id="' . $bill->customer_id . '" bill-id="' . $bill->bill_id . '" id="view">عرض</button> </td>';


            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->bill->count_all(),
            "recordsFiltered" => $this->bill->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function customer_bill_get_all()
    {
        $results['status'] = '';
        $results['msg'] = '';
        // $bill_id = -1;
        if (empty($_POST['customer_id'])) {
            $results['status'] = 'error';
            $results['msg'] = 'لم يتم تحديد مشترك';
            die($results);
        }
        $customer_id = $_POST['customer_id'];
        $bill_period = $_POST['bill_period'];

        $results = $this->home_model->customer_bill_get_all($customer_id, $bill_period);
        $results = $this->security->xss_clean(json_decode(json_encode($results), true));
        if (empty($results)) {
            $results['status'] = 'error';
            $results['msg'] = 'لا يوجد بيانات';
            echo json_encode($results);
        } else {
            echo json_encode($results);
        }
    }

    public function customer_bill_get_reminder()
    {
        $results['status'] = '';
        $results['msg'] = '';
        // $bill_id = -1;
        if (empty($_POST['customer_id'])) {
            $results['status'] = 'error';
            $results['msg'] = 'لم يتم تحديد مشترك';
            die($results);
        }
        $customer_id = $_POST['customer_id'];
        $bill_period = $_POST['bill_period'];

        $results = $this->home_model->customer_bill_get_reminder($customer_id, $bill_period);
        $results = $this->security->xss_clean(json_decode(json_encode($results), true));
        if (empty($results)) {
            $results['status'] = 'error';
            $results['msg'] = 'لا يوجد دفعات سابقة غير مسددة لهذا المشترك';
            echo json_encode($results);
        } else {
            echo json_encode($results);
        }
    }

    public function bill_get_sum()
    {
        $results['status'] = '';
        $results['msg'] = '';
        if (empty($_POST['bill_date'])) {
            $results['status'] = 'error';
            $results['msg'] = 'لم يتم تحديد دورة';
            die($results);
        }
        $bill_date = $_POST['bill_date'];
        $bill_region = $_POST['bill_region'];
        $bill_street = $_POST['bill_street'];
        $results = $this->home_model->bill_get_sum(strtotime($bill_date), $bill_region, $bill_street);
        $results = $this->security->xss_clean(json_decode(json_encode($results), true));
        if (empty($results)) {
            $results['status'] = 'error';
            $results['msg'] = 'لا يوجد بيانات';
            echo json_encode($results);
        } else {
            echo json_encode($results);
        }
    }

    public function payment_get_selected_bill()
    {
        $results['status'] = '';
        $results['msg'] = '';
        if (empty($_POST['bill_id'])) {
            $results['status'] = 'error';
            $results['msg'] = 'لم يتم تحديد فتورة';
            die($results);
        }
        $bill_id = $_POST['bill_id'];
        $results = $this->home_model->payment_get_selected_bill($bill_id);
        $results = $this->security->xss_clean(json_decode(json_encode($results), true));
        if (empty($results)) {
            $results['status'] = 'error';
            $results['msg'] = 'لا يوجد بيانات';
            echo json_encode($results);
        } else {
            echo json_encode($results);
        }
    }

    public function bill_get_selected()
    {
        $results['status'] = '';
        $results['msg'] = '';
        if (empty($_POST['bill_id'])) {
            $results['status'] = 'error';
            $results['msg'] = 'لم يتم تحديد فتورة';
            die($results);
        }
        $bill_id = $_POST['bill_id'];
        $results = $this->home_model->bill_get_selected($bill_id);
        $results = $this->security->xss_clean(json_decode(json_encode($results), true));
        if (empty($results)) {
            $results['status'] = 'error';
            $results['msg'] = 'لا يوجد بيانات';
            echo json_encode($results);
        } else {
            echo json_encode($results);
        }
    }

    public function bill_get_debt()
    {
        $results['status'] = '';
        $results['msg'] = '';
        if (empty($_POST['customer_id'])) {
            $results['status'] = 'error';
            $results['msg'] = 'لم يتم تحديد مشترك';
            die(json_encode($results));
        }
        $customer_id = $_POST['customer_id'];
        $results = $this->home_model->bill_get_debt($customer_id);
        $results = $this->security->xss_clean(json_decode(json_encode($results), true));
        if (empty($results)) {
            $results['status'] = 'error';
            $results['msg'] = 'لا يوجد بيانات';
            echo json_encode($results);
        } else {
            echo json_encode($results);
        }
    }

    public function payment_insert()
    {

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

    public function payment_insert_one()
    {

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
            $upload = $this->home_model->payment_insert_one($bill_id, $payment_value, $payment_discount, $payment_note);
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

    public function payment_delete()
    {
        $results['status'] = '';
        $results['msg'] = '';
        if (empty($_POST['payment_id']) || $_POST['payment_id'] == -1) {
            $results['status'] = 'error';
            $results['msg'] = 'معرف الدورة فارغ';
            echo json_encode($results);
        }

        if ($results['status'] !== 'error') {
            $results['rslt'] = $this->home_model->payment_delete($_POST['payment_id']);
            if ($results['rslt'] != TRUE) {
                $results['status'] = 'error';
                $results['msg'] = ' لا يوجد بيانات للحذف';
                echo json_encode($results);
            } else {
                $results['status'] = 'success';
                $results['msg'] = 'تم حذف البيانات بنجاح';
                echo json_encode($results);
            }
        }
    }

    ////***** End Pill Page ///


    public function cost_update()
    {

        //  die($_FILES['image']['name']);
        $uploade['status'] = 'Success';

        if (empty($_POST['cost_price'])) {
            $uploade['status'] = 'error';
            $uploade['msg'] = 'خانة السعر فارغة';
            die(json_encode($uploade));
        }

        $cost_price = $_POST['cost_price'];

        if ($uploade['status'] != 'error') {
            if ($this->home_model->cost_update($cost_price) == TRUE) {
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

    public function cost_get_price()
    {
        $results = $this->home_model->cost_get_price();
        $results = $this->security->xss_clean(json_decode(json_encode($results), true));
        if (empty($results)) {
            $results['status'] = 'error';
            $results['msg'] = 'لا يوجد بيانات';
            echo json_encode($results);
        } else {
            echo json_encode($results);
        }
    }

    ///////////////////////Change Password////////////////


    public function change_password()
    {

        //  die($_FILES['image']['name']);
        $uploade['status'] = 'Success';

        if (empty($_POST['current_password'])) {
            $uploade['status'] = 'error';
            $uploade['msg'] = 'كلمة السر القديمة فارغة';
            die(json_encode($uploade));
        }
        if (empty($_POST['new_password'])) {
            $uploade['status'] = 'error';
            $uploade['msg'] = 'كلمة السر الجديدة فارغة';
            die(json_encode($uploade));
        }
        if ($_POST['renew_password'] != $_POST['new_password']) {
            $uploade['status'] = 'error';
            $uploade['msg'] = 'إعادة كلمة المرور غير متطابقة';
            die(json_encode($uploade));
        }

        $current_password = $_POST['current_password'];
        $new_password = $_POST['new_password'];

        if ($uploade['status'] != 'error') {
            if ($this->home_model->change_password($current_password, $new_password) == TRUE) {
                $uploade['status'] = 'Success';
                $uploade['msg'] = 'تم الإضافة بنجاح';
                echo json_encode($uploade);
            } else {
                $uploade['status'] = 'error';
                $uploade['msg'] = 'تأكد من كلمة المرور الحالية';
                echo json_encode($uploade);
            }
        } else {
            echo json_encode($uploade);
        }
    }

    //////////////////////
    public function period_consum_get_all()
    {
        $results['status'] = '';
        $results['msg'] = '';

        $period_region = $_POST['period_region'];
        $period_street = $_POST['period_street'];
        $results = $this->home_model->period_consum_get_all($period_region, $period_street);
        $results = $this->security->xss_clean(json_decode(json_encode($results), true));
        if (empty($results)) {
            $results['status'] = 'error';
            $results['msg'] = 'لا يوجد بيانات';
            echo json_encode($results);
        } else {
            echo json_encode($results);
        }
    }

    public function statistic_get_sum()
    {
        $results['status'] = '';
        $results['msg'] = '';


        if (empty($_POST['statistic_date_from'])) {
            $statistic_date_from = '';
        } else {
            $statistic_date_from = $_POST['statistic_date_from'];
        }
        if (empty($_POST['statistic_date_to'])) {
            $statistic_date_to = '';
        } else {
            $statistic_date_to = $_POST['statistic_date_to'];
        }

        $statistic_region = $_POST['statistic_region'];
        $statistic_street = $_POST['statistic_street'];
        $results = $this->home_model->statistic_get_sum(strtotime($statistic_date_from), strtotime($statistic_date_to), $statistic_region, $statistic_street);
        $results = $this->security->xss_clean(json_decode(json_encode($results), true));
        if (empty($results)) {
            $results['status'] = 'error';
            $results['msg'] = 'لا يوجد بيانات';
            echo json_encode($results);
        } else {
            echo json_encode($results);
        }
    }
    public function statistic_get_sum_for_chart()
    {
        $results['status'] = '';
        $results['msg'] = '';


        if (empty($_POST['statistic_date_from'])) {
            $statistic_date_from = '';
        } else {
            $statistic_date_from = $_POST['statistic_date_from'];
        }
        if (empty($_POST['statistic_date_to'])) {
            $statistic_date_to = '';
        } else {
            $statistic_date_to = $_POST['statistic_date_to'];
        }

        $statistic_region = $_POST['statistic_region'];
        $statistic_street = $_POST['statistic_street'];
        $results = $this->home_model->statistic_get_sum_for_chart(strtotime($statistic_date_from), strtotime($statistic_date_to), $statistic_region, -1);
        $results = $this->security->xss_clean(json_decode(json_encode($results), true));
        if (empty($results)) {
            $results['status'] = 'error';
            $results['msg'] = 'لا يوجد بيانات';
            echo json_encode($results);
        } else {
            echo json_encode($results);
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

    public function get_add_cost()
    {
        $results['status'] = '';
        $results['msg'] = '';
        if (empty($_POST['period_id'])) {
            $results['status'] = 'error';
            $results['msg'] = 'لم يتم تحديد فتورة';
            die(json_encode($results));
        }
        $period_id = $_POST['period_id'];
        $results = $this->home_model->get_add_cost($period_id);
        $results = $this->security->xss_clean(json_decode(json_encode($results), true));
        if (empty($results)) {
            $results['status'] = 'error';
            $results['msg'] = 'لا يوجد بيانات';
            echo json_encode($results);
        } else {
            echo json_encode($results);
        }
    }

    public function add_cost_delete()
    {
        $results['status'] = '';
        $results['msg'] = '';
        if (empty($_POST['add_cost_id'])) {
            $results['status'] = 'error';
            $results['msg'] = 'معرف الدورة فارغ';
            echo json_encode($results);
        }

        if ($results['status'] !== 'error') {
            $results['rslt'] = $this->home_model->add_cost_delete($_POST['add_cost_id']);
            if ($results['rslt'] != TRUE) {
                $results['status'] = 'error';
                $results['msg'] = ' لا يوجد بيانات للحذف';
                echo json_encode($results);
            } else {
                $results['status'] = 'success';
                $results['msg'] = 'تم حذف البيانات بنجاح';
                echo json_encode($results);
            }
        }
    }

    public function get_payment_list()
    {
        $results['status'] = '';
        $results['msg'] = '';
        if (empty($_POST['payment_list_date'])) {
            $results['status'] = 'error';
            $results['msg'] = 'لم يتم تحديد تاريخ';
            die($results);
        }
        $payment_list_date = $_POST['payment_list_date'];
        $payment_list_end_date = $_POST['payment_list_end_date'];
        $bill_street = $_POST['bill_street'];
        $bill_region = $_POST['bill_region'];

        $results = $this->home_model->get_payment_list(strtotime($payment_list_date), strtotime($payment_list_end_date), $bill_street, $bill_region);
        $results = $this->security->xss_clean(json_decode(json_encode($results), true));
        if (empty($results)) {
            $results['status'] = 'error';
            $results['msg'] = 'لا يوجد بيانات';
            echo json_encode($results);
        } else {
            echo json_encode($results);
        }
    }

    /// box

    public function box_type_insert()
    {

        //  die($_FILES['image']['name']);
        $uploade['status'] = 'Success';
        if (empty($_POST['box_type_name'])) {
            $uploade['status'] = 'error';
            $uploade['msg'] = 'اسم المنطقة فارغ';
            die(json_encode($uploade));
        }
        $box_type_name = $_POST['box_type_name'];

        if ($uploade['status'] != 'error') {
            if ($this->home_model->box_type_insert($box_type_name) == TRUE) {
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

    public function box_type_update()
    {

        //  die($_FILES['image']['name']);
        $uploade['status'] = 'Success';
        if (empty($_POST['box_type_name'])) {
            $uploade['status'] = 'error';
            $uploade['msg'] = 'اسم المنطقة فارغ';
            die(json_encode($uploade));
        }

        if (empty($_POST['box_type_id'])) {
            $uploade['status'] = 'error';
            $uploade['msg'] = 'معرف المنطقة فارغ';
            die(json_encode($uploade));
        }

        $box_type_id = $_POST['box_type_id'];
        $box_type_name = $_POST['box_type_name'];

        if ($uploade['status'] != 'error') {
            if ($this->home_model->box_type_update($box_type_name, $box_type_id) == TRUE) {
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

    public function box_type_get_all()
    {
        $results = $this->home_model->box_type_get_all();
        $results = $this->security->xss_clean(json_decode(json_encode($results), true));
        if (empty($results)) {
            $results['status'] = 'error';
            $results['msg'] = 'لا يوجد بيانات';
            echo json_encode($results);
        } else {
            echo json_encode($results);
        }
    }

    public function box_type_get_selected()
    {
        $results['status'] = '';
        $results['msg'] = '';
        if (empty($_POST['box_type_id'])) {
            $results['status'] = 'error';
            $results['msg'] = 'معرف المنطقة فارغ';
            echo json_encode($results);
        }
        if ($results['status'] != 'error') {
            $results = $this->home_model->box_type_get_selected($_POST['box_type_id']);
            $results = $this->security->xss_clean(json_decode(json_encode($results), true));
            if (empty($results)) {
                $results['status'] = 'error';
                $results['msg'] = 'لا يوجد بيانات';
                echo json_encode($results);
            } else {
                echo json_encode($results);
            }
        }
    }

    public function box_type_delete()
    {
        $results['status'] = '';
        $results['msg'] = '';
        if (empty($_POST['box_type_id'])) {
            $results['status'] = 'error';
            $results['msg'] = 'معرف المنطقة فارغ';
            echo json_encode($results);
        }

        if ($results['status'] !== 'error') {
            $results['rslt'] = $this->home_model->box_type_delete($_POST['box_type_id']);
            if ($results['rslt'] != TRUE) {
                $results['status'] = 'error';
                $results['msg'] = ' لا يوجد بيانات للحذف';
                echo json_encode($results);
            } else {
                $results['status'] = 'success';
                $results['msg'] = 'تم حذف البيانات بنجاح';
                echo json_encode($results);
            }
        }
    }

    public function box_respective_insert()
    {

        //  die($_FILES['image']['name']);
        $uploade['status'] = 'Success';
        if (empty($_POST['box_respective_name'])) {
            $uploade['status'] = 'error';
            $uploade['msg'] = 'اسم صاحب الصندوق فارغ';
            die(json_encode($uploade));
        }
        if (empty($_POST['box_respective_box_type']) || $_POST['box_respective_box_type'] == -1) {
            $uploade['status'] = 'error';
            $uploade['msg'] = 'اسم نوع الصندوق فارغ';
            die(json_encode($uploade));
        }
        $box_respective_name = $_POST['box_respective_name'];
        $box_respective_box_type = $_POST['box_respective_box_type'];

        if ($uploade['status'] != 'error') {
            if ($this->home_model->box_respective_insert($box_respective_name, $box_respective_box_type) == TRUE) {
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

    public function box_respective_update()
    {

        //  die($_FILES['image']['name']);
        $uploade['status'] = 'Success';
        if (empty($_POST['box_respective_name'])) {
            $uploade['status'] = 'error';
            $uploade['msg'] = 'اسم نوع الصندوق فارغ';
            die(json_encode($uploade));
        }

        if (empty($_POST['box_respective_id'])) {
            $uploade['status'] = 'error';
            $uploade['msg'] = 'معرف نوع الصندوق فارغ';
            die(json_encode($uploade));
        }

        if (empty($_POST['box_respective_box_type']) || $_POST['box_respective_box_type'] == -1) {
            $uploade['status'] = 'error';
            $uploade['msg'] = 'اسم نوع الصندوق فارغ';
            die(json_encode($uploade));
        }

        $box_respective_id = $_POST['box_respective_id'];
        $box_respective_name = $_POST['box_respective_name'];
        $box_respective_box_type = $_POST['box_respective_box_type'];

        if ($uploade['status'] != 'error') {
            if ($this->home_model->box_respective_update($box_respective_name, $box_respective_box_type, $box_respective_id) == TRUE) {
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

    public function box_respective_get_all()
    {
        $results = $this->home_model->box_respective_get_all();
        $results = $this->security->xss_clean(json_decode(json_encode($results), true));
        if (empty($results)) {
            $results['status'] = 'error';
            $results['msg'] = 'لا يوجد بيانات';
            echo json_encode($results);
        } else {
            echo json_encode($results);
        }
    }

    public function box_respective_get_all_by_box_type()
    {

        $uploade['status'] = 'Success';

        if (empty($_POST['box_respective_box_type']) || $_POST['box_respective_box_type'] == -1) {
            $uploade['status'] = 'error';
            $uploade['msg'] = 'معرف نوع الصندوق فارغ';
            die(json_encode($uploade));
        }

        $box_respective_box_type = $_POST['box_respective_box_type'];

        $results = $this->home_model->box_respective_get_all_by_box_type($box_respective_box_type);
        $results = $this->security->xss_clean(json_decode(json_encode($results), true));
        if (empty($results)) {
            $results['status'] = 'error';
            $results['msg'] = 'لا يوجد بيانات';
            echo json_encode($results);
        } else {
            echo json_encode($results);
        }
    }

    public function box_respective_get_selected()
    {
        $results['status'] = '';
        $results['msg'] = '';
        if (empty($_POST['box_respective_id'])) {
            $results['status'] = 'error';
            $results['msg'] = 'معرف نوع الصندوق فارغ';
            echo json_encode($results);
        }
        if ($results['status'] != 'error') {
            $results = $this->home_model->box_respective_get_selected($_POST['box_respective_id']);
            $results = $this->security->xss_clean(json_decode(json_encode($results), true));
            if (empty($results)) {
                $results['status'] = 'error';
                $results['msg'] = 'لا يوجد بيانات';
                echo json_encode($results);
            } else {
                echo json_encode($results);
            }
        }
    }

    public function box_respective_delete()
    {
        $results['status'] = '';
        $results['msg'] = '';
        if (empty($_POST['box_respective_id'])) {
            $results['status'] = 'error';
            $results['msg'] = 'معرف نوع الصندوق فارغ';
            echo json_encode($results);
        }

        if ($results['status'] !== 'error') {
            $results['rslt'] = $this->home_model->box_respective_delete($_POST['box_respective_id']);
            if ($results['rslt'] != TRUE) {
                $results['status'] = 'error';
                $results['msg'] = ' لا يوجد بيانات للحذف';
                echo json_encode($results);
            } else {
                $results['status'] = 'success';
                $results['msg'] = 'تم حذف البيانات بنجاح';
                echo json_encode($results);
            }
        }
    }

    ////***** End box_respective Page ///

    public function box_insert()
    {

        //  die($_FILES['image']['name']);
        $uploade['status'] = 'Success';
        if (empty($_POST['box_respective']) or $_POST['box_respective'] == -1) {
            $uploade['status'] = 'error';
            $uploade['msg'] = 'اختر صاحب الصندوق';
            die(json_encode($uploade));
        }
        if (empty($_POST['box_value'])) {
            $uploade['status'] = 'error';
            $uploade['msg'] = 'قيمة الصندوق فارغة';
            die(json_encode($uploade));
        }
        //        if (empty($_POST['box_note'])) {
        //            $uploade['status'] = 'error';
        //            $uploade['msg'] = 'الملاحظة فارغة';
        //            die(json_encode($uploade));
        //        }
        if (empty($_POST['box_date'])) {
            $uploade['status'] = 'error';
            $uploade['msg'] = 'التاريخ فارغ';
            die(json_encode($uploade));
        }
        if (empty($_POST['box_in_out']) or $_POST['box_in_out'] == -1) {
            $uploade['status'] = 'error';
            $uploade['msg'] = 'حدد داخل أو خارج الصندوق';
            die(json_encode($uploade));
        }

        $box_respective = $_POST['box_respective'];
        $box_value = $_POST['box_value'];
        $box_note = $_POST['box_note'];
        $box_date = $_POST['box_date'];
        $box_in_out = $_POST['box_in_out'];

        if ($box_in_out == 'out') {
            $box_value = abs($box_value) * -1;
        } else {
            $box_value = abs($box_value);
        }

        if ($uploade['status'] != 'error') {
            $upload = $this->home_model->box_insert($box_respective, $box_value, $box_note, $box_date);
            if ($upload == TRUE) {
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

    public function box_get_by_respective()
    {
        $results['status'] = '';
        $results['msg'] = '';
        if (empty($_POST['box_respective'])) {
            $results['status'] = 'error';
            $results['msg'] = 'اختر صاحب الصندوق';
            echo json_encode($results);
        }
        if ($results['status'] != 'error') {
            $results = $this->home_model->box_get_by_respective($_POST['box_respective']);
            $results = $this->security->xss_clean(json_decode(json_encode($results), true));
            if (empty($results)) {
                $results['status'] = 'error';
                $results['msg'] = 'لا يوجد بيانات';
                echo json_encode($results);
            } else {
                echo json_encode($results);
            }
        }
    }

    public function box_delete()
    {
        $results['status'] = '';
        $results['msg'] = '';
        if (empty($_POST['box_id'])) {
            $results['status'] = 'error';
            $results['msg'] = 'معرف نوع الصندوق فارغ';
            echo json_encode($results);
        }

        if ($results['status'] !== 'error') {
            $results['rslt'] = $this->home_model->box_delete($_POST['box_id']);
            if ($results['rslt'] != TRUE) {
                $results['status'] = 'error';
                $results['msg'] = ' لا يوجد بيانات للحذف';
                echo json_encode($results);
            } else {
                $results['status'] = 'success';
                $results['msg'] = 'تم حذف البيانات بنجاح';
                echo json_encode($results);
            }
        }
    }

    public function box_get_all()
    {
        $results['status'] = '';
        $results['msg'] = '';

        $box_type = $_POST['box_box_type'];
        $box_respective = $_POST['box_respective'];
        $box_date_from = $_POST['box_date_from'];
        $box_date_to = $_POST['box_date_to'];

        if ($results['status'] != 'error') {
            $results = $this->home_model->box_get_all($box_type, $box_respective, strtotime($box_date_from), strtotime($box_date_to));
            $results = $this->security->xss_clean(json_decode(json_encode($results), true));
            if (empty($results)) {
                $results['status'] = 'error';
                $results['msg'] = 'لا يوجد بيانات';
                echo json_encode($results);
            } else {
                echo json_encode($results);
            }
        }
    }

    public function statistic_box_get_sum()
    {
        $results['status'] = '';
        $results['msg'] = '';


        if (empty($_POST['statistic_date_from'])) {
            $statistic_date_from = '';
        } else {
            $statistic_date_from = $_POST['statistic_date_from'];
        }
        if (empty($_POST['statistic_date_to'])) {
            $statistic_date_to = '';
        } else {
            $statistic_date_to = $_POST['statistic_date_to'];
        }

        $results = $this->home_model->statistic_box_get_sum(strtotime($statistic_date_from), strtotime($statistic_date_to));
        $results = $this->security->xss_clean(json_decode(json_encode($results), true));
        if (empty($results)) {
            $results['status'] = 'error';
            $results['msg'] = 'لا يوجد بيانات';
            echo json_encode($results);
        } else {
            echo json_encode($results);
        }
    }


    public function test_input($input)
    {
        $input_name = $input;
        $input_val = $this->input->post($input_name, false);
        if (empty($input_val)) {
            $data['status'] = 'error';
            $data['msg'] = 'Empty ' . $input_name;
            die(json_encode($data));
        } else {
            return trim($input_val);
        }
    }
}
