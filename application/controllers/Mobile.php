<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mobile extends CI_Controller {

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

         public function go(){
             echo 'hello there';
         }

         Public function listAllEmp(){
            $result =  $this->home_model->listAllEmp();
            echo json_encode($result);
         }

         public function empLogin(){

            $username ="";
            $password ="";
            $result =[];
            
            if((isset($_GET['api_key']))){
                
              if($_GET['api_key']!='appv3.2'){
                $result['status'] = 'error';
                $result['msg'] = 'مفتاح دخول خاطئ';
               // echo json_encode($result);
               // return; 
               return $this->output->set_status_header(401)->set_content_type('application/json')->set_output(json_encode($result));
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

        


        public function getAllRegions() {
            $region_name ='';

            if(isset($_GET['region_name'])){
                $region_name =  $_GET['region_name'] ;
            }
           
            $results = $this->home_model->region_get_all($region_name);
            //$results = $this->security->xss_clean(json_decode(json_encode($results), true));
            if (empty($results)) {
                $results['status'] = 'error';
                $results['msg'] = 'لا يوجد بيانات';
                echo json_encode($results);
            } else {
                echo json_encode($results);
            }
        }

        public function getAllStreets(){
            if((isset($_GET['api_key']))){
                
                if($_GET['api_key']!='2242021'){
                    $response['msg'] ="invalid key";
                    return $this->output->set_status_header(401)->set_content_type('application/json')->set_output(json_encode($response));
                }
            }else{
                $response['msg'] ="invalid key";
                return $this->output->set_status_header(401)->set_content_type('application/json')->set_output(json_encode($response));

            }
            $results =$this->home_model->getAllStreets();
            if(empty($results)){
                throw new Exception("There is  No streets");
            }else{
               // echo "hello";
               echo json_encode($results);
            }
        }

        public function getRegionStreets(){
            $region_id=$_GET['region_id'];
            $results =$this->home_model->getRegionStreets($region_id);
            if(empty($results)){
                throw new Exception("There is  No streets");
            }else{
               // echo "hello";
               echo json_encode($results);
            }
           
        }

        public function GetPeriodForAllCustomers(){
            $streetiD =$_GET['street_id'];
            $screenType =$_GET['screen_type'];
            $regionid = -1;
            if(isset($_GET['region_id'])){
                $regionid = $_GET['region_id'];

            }
            $currentDate=-1;
            if(isset($_GET["current_date"])){
                $currentDate =$_GET["current_date"];
            }
          
            $results =$this->home_model->GetPeriodForAllCustomers($currentDate,$regionid,$streetiD,$screenType);
            //$results = $this->security->xss_clean(json_decode(json_encode($results)));
            echo json_encode($results);
        }

        public function testmobile(){
            $this->sendSMSFailByCustomerID ('1477',4,'','');
        }

       
        private function sendSMSFailByCustomerID($customerId, $messageType =4,$sms_text,$smsTextExtra)
        {
    
            
    
            $customer_jawwal = '';
            $customer_id = '';
            $message = '';
            $output = array();
            $messageType =4;
    
    
          
               
                $jawwal = '';
                $sender_name = '';
    
              
    
                    $bill_result = $this->home_model->period_get_all_list_by_customer(-1, -1, $customerId);
                    foreach ($bill_result as $value) {
                        $jawwal ='972'. $value->customer_jawwal;
                         $period_previous_reading = $value->period_previous_reading;
                         $period_reading = $value->period_reading;
                         $period_small_date = date('Y-m-d', strtotime($value->period_reading_date)) ;
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
                       
                       // $message = 'مشتركنا العزيز';
                       // $message .= ' ';
                        $message .= 'فاتورة ';
                        $message .=$period_small_date;
                        $message.=' ';
                        $message .= 'قراءة سابقة '.$period_previous_reading;
                        $message.=' ';
                        $message .= 'ق. حالية '.$period_reading;
                        $message.=' ';
                        $message.='الثمن';
                        $message .= $bill_reminder;
                        $message .= 'ش';
                        $message .= ' رصيدكم';
                        $message .= $bill_sum;
                        $message .= 'ش';
                        //	$message .= ' مع العلم بأن أخر موعد للدفع هو 7 الشهر وعند عدم السداد سوف يتم فصل الاشتراك ';
                        $message .= $smsTextExtra;
                    }
    
    
    
                    // $messageArabic = iconv("utf-8", "windows-1256", $message);
                    $messageArabic = $message; // the chracter in utf-8 formate already 
    
                    $messageencode = urlencode($messageArabic);
                    $sender_name = urlencode($sender_name);
    
                    $url = 'http://www.hotsms.ps/sendbulksms.php?user_name=anwarsoltan&user_pass=9853571&sender=anwarsoltan&mobile=' . $jawwal . '&type=0&text=' . $messageencode;
    
                    // $url = "http://www.leadersms.ps/http/V1/SendSMS?username=279000&password=03e8e18e2b57f4c6&destination=" .
                    //    $jawwal . "&international&sender=" . $sender_name . "&body=" . $messageencode . "&output=json";
    
                    $arContext = array();
                    $arContext['http']['timeout'] = 5;
                    $context = stream_context_create($arContext);
    
                    if (FALSE !== ($jsonStr = @file_get_contents($url, 0, $context))) {
    
                        if ($jsonStr == '1001') {
                            if (empty($customer_jawwal)) {
                                $customer_jawwal = $value->customer_jawwal;
                                $customer_id = $value->customer_id;
                            } else {
                                $customer_jawwal .= ',' . $value->customer_jawwal;
                                $customer_id .= ',' . $value->customer_id;
                            }
                        }
    
                        /*$jsonArray = json_decode($jsonStr, TRUE);
    
                        if ($jsonArray['success'] == 0) {
    
                            if (empty($customer_jawwal)) {
                                $customer_jawwal = $value->customer_jawwal;
                                $customer_id = $value->customer_id;
                            } else {
                                $customer_jawwal .= ',' . $value->customer_jawwal;
                                $customer_id .= ',' . $value->customer_id;
                            }
                        }*/
                    } else {
                        if (empty($customer_jawwal)) {
                            $customer_jawwal = $value->customer_jawwal;
                            $customer_id = $value->customer_id;
                        } else {
                            $customer_jawwal .= ',' . $value->customer_jawwal;
                            $customer_id .= ',' . $value->customer_id;
                        }
                    }
                 
            
            $output['customer_jawwal'] = $customer_jawwal;
            $output['customer_id'] = $customer_id;
    
          //  echo json_encode($output);
        }
       
        public function getPrice(){
            $result = $this->home_model->getPrice();
            if (count($result)>0){
                $result = json_encode($result[0]);
                echo $result ;
            }else{
                echo '{"cost_price":"0"';
            }
            
        }

        


        public function period_insert() {
           

            if(!isset($_POST['api_key'])|| $_POST['api_key']!='2242021'){
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
            $period_note ='إدخال موبايل';
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
                $uploade = $this->home_model->period_insert(strtotime($period_date), $period_price, $period_customer, $period_reading, strtotime($period_reading_date), $period_previous_reading
                        , $period_note, $payment_value, $payment_discount);
                if ($uploade['complete'] == TRUE) {
                    $uploade['status'] = 'Success';
                    $uploade['msg'] = 'تم الإضافة بنجاح';

                    $mobileResult=$this->home_model->getPrice();
                    if($mobileResult[0]->send_sms==1){
                        $this->sendSMSFailByCustomerID ($period_customer,4,'','');
                    }
                   
                    // end of text message
                    if(isset($period_add_money) && !empty($period_add_money)){
                        return $this->_add_cost_insert($uploade['period_id'],$period_add_money,$period_note);
                    }else{
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

        public function _add_cost_insert($period_id,$add_cost_value,$add_cost_note) {

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
    
        public function add_cost_insert() {
    
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


        public function payment_insert() {

            if(!isset($_POST['api_key'])|| $_POST['api_key']!='2242021'){
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


        public function customer_insert()
        {
    
            log_message('DEBUG', "Abd: Call customer insert");
            log_message('DEBUG', "Name:".$_POST['customer_name']);
             log_message('DEBUG', "Order:".$_POST['customer_order']);
    
            //  die($_FILES['image']['name']);
            $uploade['status'] = 'Success';
            if (empty($_POST['customer_name'])) {
                $uploade['status'] = 'error';
                $uploade['msg'] = 'اسم المشترك فارغ';
                die(json_encode($uploade));
            }
    
         
            if (empty($_POST['customer_street']) || $_POST['customer_street'] == -1) {
                $uploade['status'] = 'error';
                $uploade['msg'] = 'اختار العنوان';
                die(json_encode($uploade));
            }
            $customer_name = $_POST['customer_name'];
            $customer_jawwal = $_POST['customer_jawwal'];
            $customer_order = $_POST['customer_order'];
            $customer_street = $_POST['customer_street'];
    
            if ($uploade['status'] != 'error') {
                if ($this->home_model->customer_insert_mobile($customer_name, $customer_jawwal, $customer_order, $customer_street) == TRUE) {
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
            $cusotmer_order = $_POST['customer_order'];
            $customer_street = $_POST['customer_street'];
            $customer_id = $_POST['customer_id'];
    
    
            if ($uploade['status'] != 'error') {
                if ($this->home_model->customer_update_mobile($customer_name, $customer_jawwal, $cusotmer_order, $customer_street, $customer_id) == TRUE) {
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
    
    }
