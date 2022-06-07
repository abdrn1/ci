
<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Home_model extends CI_Model {

    /////////////////////// Global Funcrions ///////////////////
    public function __construct() {

        parent::__construct();
    }

    private $bill_remin_pay = 0.0;

    function login($username, $password) {
        $sql = "SELECT `user_id`, `user_name`,`user_username` FROM `user` WHERE `user_username` LIKE ? AND `user_password` LIKE ?";
        $query = $this->db->query($sql, array($username, md5($password)));
        return $query->result();
    }

    function db_restore_backup() {

        $file_restore = file_get_contents('././backup/mybackup.sql');
        $file_array = explode(';', $file_restore);
        foreach ($file_array as $query) {
            if (!empty(trim($query))) {
                $this->db->query($query);
            }
        }
        return TRUE;
    }

    ///////////////// Pages /////////////////////////
    //////////////////// Region Page ////////////

    function region_insert($region_name) {

        $data = array(
            'region_name' => $region_name
        );
        return $this->db->insert('region', $data);
    }

    function region_update($region_name, $region_id) {

        $this->db->set('region_name', $region_name);
        $this->db->where('region_id', $region_id);
        return $this->db->update('region');
    }

    function region_get_all() {
        $query = $this->db->get('region');
        return $query->result();
    }

    function region_get_selected($region_id) {
        $this->db->where('region_id', $region_id);
        $query = $this->db->get('region');
        //    $query = $this->db->get_where('region', array('image_active' => 'active'));
        return $query->result();
    }

    function region_delete($region_id) {
        $this->db->where('region_id', $region_id);
        return $this->db->delete('region');
    }

    //////////////////// ***************** ////////////
    //////////////////// street Page ////////////

    function street_insert($street_name, $street_region) {

        $data = array(
            'street_name' => $street_name,
            'street_region' => $street_region
        );
        return $this->db->insert('street', $data);
    }

    function street_update($street_name, $street_region, $street_id) {

        $this->db->set('street_name', $street_name);
        $this->db->set('street_region', $street_region);
        $this->db->where('street_id', $street_id);
        return $this->db->update('street');
    }

    function street_get_all() {
        $this->db->select('*'); // <-- There is never any reason to write this line!
        $this->db->from('street');
        $this->db->join('region', 'street_region = region_id');
        $query = $this->db->get();
        return $query->result();
    }

    function street_get_all_by_region($street_region) {
        $this->db->select('*'); // <-- There is never any reason to write this line!
        $this->db->from('street');
        $this->db->where('street_region', $street_region);
        $query = $this->db->get();
        return $query->result();
    }

    function street_get_selected($street_id) {
        $this->db->select('*'); // <-- There is never any reason to write this line!
        $this->db->from('street');
        $this->db->join('region', 'street_region = region_id');
        $this->db->where('street_id', $street_id);
        $query = $this->db->get();
        //    $query = $this->db->get_where('street', array('image_active' => 'active'));
        return $query->result();
    }

    function street_delete($street_id) {
        $this->db->where('street_id', $street_id);
        return $this->db->delete('street');
    }

    //////////////////// ***************** ////////////
    //////////////////// customer Page ////////////

    function customer_insert($customer_name, $customer_jawwal, $customer_serial_number, $customer_street) {
        $customer_max_id = 00;
        $this->db->select_max('customer_id', 'customer_max_id'); // <-- There is never any reason to write this line!
        $this->db->from('customer');
        $query = $this->db->get();

        foreach ($query->result_array() as $id) {
            $customer_max_id = $id['customer_max_id'];
        }

        $data = array(
            'customer_name' => $customer_name,
            'customer_jawwal' => $customer_jawwal,
            'customer_serial_number' => $customer_serial_number,
            'customer_street' => $customer_street,
            'customer_order' => $customer_max_id,
        );
        return $this->db->insert('customer', $data);
    }

    function customer_update($customer_name, $customer_jawwal, $customer_serial_number, $customer_street, $customer_id) {

        $this->db->set('customer_name', $customer_name);
        $this->db->set('customer_jawwal', $customer_jawwal);
        $this->db->set('customer_serial_number', $customer_serial_number);
        $this->db->set('customer_street', $customer_street);
        $this->db->where('customer_id', $customer_id);
        return $this->db->update('customer');
    }

    function customer_order_update($customer_id, $customer_order) {

        $this->db->set('customer_order', $customer_order);
        $this->db->where('customer_id', $customer_id);
        return $this->db->update('customer');
    }

    function customer_price_update($customer_id, $customer_price) {

        $this->db->set('customer_price', $customer_price);
        $this->db->where('customer_id', $customer_id);
        return $this->db->update('customer');
    }

    function customer_get_all() {
        $this->db->select('*'); // <-- There is never any reason to write this line!
        $this->db->from('customer');
        $this->db->join('(select max(period_id) as period_max_id ,period_customer from period group by period_customer) as period_max', 'period_customer = customer_id', 'left');
        $this->db->join('period', 'period_max_id = period_id', 'left');
        $this->db->join('street', 'customer_street = street_id');
        $this->db->join('region', 'street_region = region_id');
        $this->db->order_by('customer_order', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    function customer_get_for_select() {
        $this->db->select('*'); // <-- There is never any reason to write this line!
        $this->db->from('customer');
        $this->db->order_by('customer_order', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    function customer_get_selected($customer_id) {
        $this->db->select('*'); // <-- There is never any reason to write this line!
        $this->db->from('customer');
        $this->db->join('street', 'customer_street = street_id');
        $this->db->where('customer_id', $customer_id);
        $query = $this->db->get();
        //    $query = $this->db->get_where('customer', array('image_active' => 'active'));
        return $query->result();
    }

    function customer_delete($customer_id) {
        $this->db->where('customer_id', $customer_id);
        return $this->db->delete('customer');
    }

    //////////////////// ***************** ////////////
    //////////////////// ***************** ////////////
    //////////////////// Period Page ////////////

    function period_get_all($period_date, $period_region, $period_street) {
        $this->db->select('*'); // <-- There is never any reason to write this line!
        $this->db->from('period');
        $this->db->join('customer', 'period_customer = customer_id');
        $this->db->join('street', 'customer_street = street_id');
        $this->db->join('region', 'street_region = region_ids');
        $this->db->where('period_date', date('Y-m-d', $period_date));
        if ($period_street == -1) {
            if ($period_region != -1) {
                $this->db->where_in('street_region', $period_region);
            }
        } else {
            $this->db->where('street_id', $period_street);
        }
        $query = $this->db->get();
        return $query->result();
    }

    function period_get_all_list($period_date, $period_region, $period_street) {
        $this->db->select('*'); // <-- There is never any reason to write this line!
        $this->db->from('customer');
        $this->db->join('(select max(period_id) as period_max_id ,period_customer from period group by period_customer) as period_max', 'period_customer = customer_id', 'left');
        $this->db->join('(select sum(bill_reminder) as bill_sum ,customer_id as customer_sum_id from bill,period,customer where customer_id = period_customer AND period_id = bill_period group by customer_id) as bill_reminder_sum', 'customer_sum_id = customer_id', 'left');
        $this->db->join('period', 'period_max_id = period_id', 'left');
        $this->db->join('bill', 'period_max_id = bill_period', 'left');
        $this->db->join('street', 'customer_street = street_id');
        $this->db->join('region', 'street_region = region_id');
        //$this->db->where('period_date', date('Y-m-d', $period_date));
        if ($period_street == -1) {
            if ($period_region != -1) {
                $this->db->where_in('street_region', $period_region);
            }
        } else {
            $this->db->where('street_id', $period_street);
        }
        $this->db->order_by('customer_order', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    function period_get_customer($period_date, $period_region, $period_street) {

        $this->db->select('street_id'); // <-- There is never any reason to write this line!
        $this->db->from('street');
        $this->db->where('street_region', $period_region);
        $query = $this->db->get();
        //    $query = $this->db->get_where('customer', array('image_active' => 'active'));
        $region_in_customer = Array();
        //return $region_in_customer;
        foreach ($query->result_array() as $id) {
            $region_in_customer[] = $id['street_id'];
        }

        $this->db->select('period_customer'); // <-- There is never any reason to write this line!
        $this->db->from('period');
        $this->db->where('period_date', date('Y-m-d', $period_date));
        //$this->db->where('period_', $period_date);
        $query = $this->db->get();
        //    $query = $this->db->get_where('customer', array('image_active' => 'active'));
        $customer_in_period = Array();
        foreach ($query->result_array() as $id) {
            $customer_in_period[] = $id['period_customer'];
        }

        $this->db->select('*'); // <-- There is never any reason to write this line!
        $this->db->from('customer');
//        if (!empty($customer_in_period)) {
//            $this->db->where_not_in('customer_id', $customer_in_period);
//        }
        if ($period_street == -1) {
            if (!empty($region_in_customer)) {
                $this->db->where_in('customer_street', $region_in_customer);
            }
        } else {
            $this->db->where('customer_street', $period_street);
        }
        $query = $this->db->get();
        return $query->result();
    }

    function period_get_previous_reading($period_date, $period_customer) {

        $period_d = strtotime($period_date . ' -1 month');
        $period_date = date('Y-m-d', $period_d);
        $this->db->select('*'); // <-- There is never any reason to write this line!
        $this->db->from('customer');
        $this->db->join('(select max(period_id) as period_max_id ,period_customer from period group by period_customer) as period_max', 'period_customer = customer_id', 'left');
        $this->db->join('period', 'period_max_id = period_id', 'left');
        $this->db->where('period.period_customer', $period_customer);
        //$this->db->where('period_date', $period_date);
        $query = $this->db->get();
        return $query->result();
    }

    function period_insert($period_date, $period_price, $period_customer, $period_reading, $period_reading_date, $period_previous_reading, $period_note, $payment_value, $payment_discount) {

        $trans = Array();

        $data = array(
            'period_date' => date('Y-m-d', $period_date),
            'period_customer' => $period_customer,
            'period_reading' => $period_reading,
            'period_reading_date' => date('Y-m-d', $period_reading_date),
            'period_previous_reading' => $period_previous_reading,
            'period_note' => $period_note
        );

        $bill_consumption = $period_reading - $period_previous_reading;
        if (empty($period_price)) {
            $this->db->select('cost_price'); // <-- There is never any reason to write this line!
            $this->db->from('cost');
            $query = $this->db->get();
            foreach ($query->result_array() as $row) {
                $cost_price = $row['cost_price'];
            }
        } else {
            $cost_price = $period_price;
        }

        $bill_reminder = $cost_price * $bill_consumption;


        $this->db->trans_start();
        $this->db->trans_strict();
        $this->db->insert('period', $data);
        $period_id = $this->db->insert_id();

        $data_bill = array(
            'bill_period' => $period_id,
            'bill_price' => $cost_price,
            'bill_consumption' => $bill_consumption,
            'bill_paid' => 00,
            'bill_discount' => 00,
            'bill_reminder' => round($bill_reminder, 3)
        );

        $this->db->insert('bill', $data_bill);
        $bill_id = $this->db->insert_id();
        $trans['bill_id'] = $bill_id;
        $trans['customer_id'] = $period_customer;

        $trans['complete'] = $this->db->trans_complete();


        return $this->payment_insert($bill_id, $payment_value, $payment_discount, 'تم الدفع من صفحة الأدخال المبسط');
    }

    function payment_insert($bill_id, $payment_value, $payment_discount, $payemnt_note) {

        $payment_id = -1;
        $total_paid = 0;
        $reminder['payment'] = 0;
        $reminder['discount'] = 0;
        $in = FALSE;
        $payment_prev_value = $this->payment_insert_from_prev($bill_id);


        $payment_value += $payment_prev_value;


        $reminder = $this->payment_insert_prev($bill_id, $payment_value, $payment_discount, $payemnt_note);

        if ($reminder['temp_bill_reminder'] < 0) {
            global $reminder;
            $payment_prev_value = $this->payment_insert_from_prev($bill_id);
            $reminder['payment'] += abs($payment_prev_value);
            $reminder = $this->payment_insert_prev($bill_id, $reminder['payment'], $reminder['discount'], $payemnt_note);
        }

        $this->db->trans_start();
        $this->db->trans_strict();

        if ($reminder['payment'] > 0 || $reminder['discount'] > 0) {
            $data = array(
                'payment_bill' => $bill_id,
                'payment_value' => $reminder['payment'],
                'payment_discount' => $reminder['discount'],
                'payment_note' => $payemnt_note
            );


            $this->db->insert('payment', $data);


            $total_paid = ($reminder['payment'] + $reminder['discount']);

            $this->db->set('bill_reminder', 'bill_reminder -' . round($total_paid, 2), FALSE);
            $this->db->set('bill_discount', 'bill_discount +' . round($reminder['discount'], 2), FALSE);
            $this->db->set('bill_paid', 'bill_paid +' . round($reminder['payment'], 2), FALSE);
            $this->db->where('bill_id', $bill_id);
            $this->db->update('bill');
        }

        $trans['complete'] = $this->db->trans_complete();
        $trans['bill_id'] = $bill_id;
        $trans['note'] = 'error';
        $trans['rem'] = $reminder['payment'];
        $trans['in'] = $in;
        $trans['disc'] = $payment_discount;
        $trans['reminder'] = $reminder;
        return $trans;
    }

    function payment_insert_one($bill_id, $payment_value, $payment_discount, $payemnt_note) {

        $this->db->trans_start();
        $this->db->trans_strict();

        $payment_prev_value = $this->payment_insert_from_prev($bill_id);
        $payment_value += $payment_prev_value;

        if ($payment_value > 0 || $payment_discount > 0) {
            $data = array(
                'payment_bill' => $bill_id,
                'payment_value' => $payment_value,
                'payment_discount' => $payment_discount,
                'payment_note' => $payemnt_note
            );


            $this->db->insert('payment', $data);


            $total_paid = ($payment_value + $payment_discount);

            $this->db->set('bill_reminder', 'bill_reminder -' . round($total_paid, 2), FALSE);
            $this->db->set('bill_discount', 'bill_discount +' . round($payment_discount, 2), FALSE);
            $this->db->set('bill_paid', 'bill_paid +' . round($payment_value, 2), FALSE);
            $this->db->where('bill_id', $bill_id);
            $this->db->update('bill');
        }

        $trans['complete'] = $this->db->trans_complete();
        $trans['bill_id'] = $bill_id;
        return $trans;
    }

    function payment_insert_prev($bill_id, $payment, $discount, $payemnt_note) {

        $customer_id = -1;
        global $temp_bill_reminder;
        global $temp_bill_id;

        $this->db->select('customer_id'); // <-- There is never any reason to write this line!
        $this->db->from('customer');
        $this->db->join('period', 'period_customer = customer_id', 'left');
        $this->db->join('bill', 'bill_period = period_id', 'left');
        $this->db->where('bill_id', $bill_id);
        $customer_query = $this->db->get();

        foreach ($customer_query->result_array() as $row) {
            $customer_id = $row['customer_id'];
        }


        $bills_reminder = $this->customer_bill_get_reminder_for_payment($customer_id, $bill_id);

        $this->db->trans_start();
        $this->db->trans_strict();

        foreach ($bills_reminder as $row) {

            if ($payment != 0 || $discount != 0) {

                $temp_bill_id = $row->bill_id;
                $temp_bill_reminder = $row->bill_reminder;

                if ($temp_bill_reminder >= $payment) {
                    $temp_payment = $payment;
                    $temp_bill_reminder -= ($payment + $discount);
                    $temp_discount = $discount;
                    $discount = 0;
                    $payment = 0;
                } else if ($temp_bill_reminder < $payment) {
                    $temp_payment = $temp_bill_reminder;
                    $payment = $payment - $temp_bill_reminder;
                    $temp_bill_reminder = 0;
                    $temp_discount = 0;
                }


                $data = array(
                    'payment_bill' => $temp_bill_id,
                    'payment_value' => round($temp_payment, 2),
                    'payment_discount' => round($temp_discount, 2),
                    'payment_note' => $payemnt_note
                );

                $this->db->insert('payment', $data);

                $this->db->set('bill_reminder', round($temp_bill_reminder, 2));
                $this->db->set('bill_paid', 'bill_paid +' . round($temp_payment, 2), FALSE);
                $this->db->set('bill_discount', 'bill_discount +' . round($temp_discount, 2), FALSE);
                $this->db->where('bill_id', $temp_bill_id);
                $this->db->update('bill');
            }
        }
        $trans['complete'] = $this->db->trans_complete();
        $trans['bill_id'] = $bill_id;
        $trans['payment'] = round($payment, 2);
        $trans['discount'] = round($discount, 2);
        $trans['temp_bill_reminder'] = round($temp_bill_reminder, 2);
        return $trans;
    }

    function payment_insert_from_prev($bill_id) {

        $customer_id = -1;


        $this->db->select('customer_id'); // <-- There is never any reason to write this line!
        $this->db->from('customer');
        $this->db->join('period', 'period_customer = customer_id', 'left');
        $this->db->join('bill', 'bill_period = period_id', 'left');
        $this->db->where('bill_id', $bill_id);
        $customer_query = $this->db->get();

        foreach ($customer_query->result_array() as $row) {
            $customer_id = $row['customer_id'];
        }


        $bills_reminder_to_customer = $this->customer_bill_get_reminder_to_customer($customer_id, $bill_id);

        $this->db->trans_start();
        $this->db->trans_strict();

        $totall_prev_amount = 0.0;

        foreach ($bills_reminder_to_customer as $row) {

            $temp_bill_id = $row->bill_id;
            $temp_bill_reminder = $row->bill_reminder;
            $temp_bill_reminder_abs = abs($temp_bill_reminder);

            if ($temp_bill_reminder < 0) {
                $totall_prev_amount += $temp_bill_reminder_abs;
                $temp_payment = $temp_bill_reminder_abs;
                $temp_bill_reminder_abs = 0;
            }


            $this->db->set('bill_reminder', 'bill_reminder +' . round($temp_payment, 2), FALSE);
            $this->db->set('bill_paid', 'bill_paid -' . round($temp_payment, 2), FALSE);
            $this->db->where('bill_id', $temp_bill_id);
            $this->db->update('bill');

            $payments = $this->bill_get_payment_for_transfer($temp_payment, $temp_bill_id);
            foreach ($payments as $payment_row) {
                $payment_id = $payment_row->payment_id;
                $this->db->set('payment_value', 'payment_value -' . round($temp_payment, 2), FALSE);
                $this->db->where('payment_id', $payment_id);
                $this->db->update('payment');
                $temp_payment = 0;
            }
        }
        $this->db->trans_complete();

        return abs($totall_prev_amount);
    }

    function payment_delete($payment_id) {

        $this->db->select('*'); // <-- There is never any reason to write this line!
        $this->db->from('payment');
        $this->db->where('payment_id', $payment_id);
        $query = $this->db->get();
        foreach ($query->result_array() as $row) {
            $payment_value = $row['payment_value'];
            $payment_discount = $row['payment_discount'];
            $payment_bill = $row['payment_bill'];
        }

        $payment_reminder = ($payment_value + $payment_discount);

        $this->db->trans_start();
        $this->db->trans_strict();
        $this->db->set('bill_reminder', 'bill_reminder +' . (int) $payment_reminder, FALSE);
        $this->db->set('bill_discount', 'bill_discount -' . (int) $payment_discount, FALSE);
        $this->db->set('bill_paid', 'bill_paid -' . (int) $payment_value, FALSE);
        $this->db->where('bill_id', $payment_bill);
        $this->db->update('bill');
        $this->db->where('payment_id', $payment_id);
        $this->db->delete('payment');
        return $this->db->trans_complete();
    }

    function period_delete($period_id) {
        $this->db->where('period_id', $period_id);
        return $this->db->delete('period');
    }

    //////////////////// ***************** ////////////
    //////////////////// bill Page ////////////

    function bill_get_all($bill_date_from, $bill_date_to, $bill_region, $bill_street, $bill_is_paid) {
        $this->db->select('*'); // <-- There is never any reason to write this line!
        $this->db->from('bill');
        $this->db->join('period', 'period_id = bill_period');
        $this->db->join('customer', 'period_customer = customer_id');
        $this->db->join('street', 'customer_street = street_id');
        $this->db->join('region', 'street_region = region_id');
        if ($bill_date_from != '') {
            $this->db->where('period_reading_date >=', date('Y-m-d', $bill_date_from));
        }
        if ($bill_date_to != '') {
            $this->db->where('period_reading_date <=', date('Y-m-d', $bill_date_to));
        }
        if ($bill_street == -1) {
            if ($bill_region != -1) {
                $this->db->where_in('street_region', $bill_region);
            }
        } else {
            $this->db->where('street_id', $bill_street);
        }
        if ($bill_is_paid != -1) {
            if ($bill_is_paid == 1) {
                $this->db->where('bill_reminder =', '0');
            } else if ($bill_is_paid == 2) {
                $this->db->where('bill_reminder >', '0');
            }
        }
        $this->db->order_by('customer_order', 'ASC');
        $this->db->order_by('period_reading_date', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    function customer_bill_get_all($customer_id, $bill_id) {
        $this->db->select('*'); // <-- There is never any reason to write this line!
        $this->db->from('bill');
        $this->db->join('period', 'period_id = bill_period');
        $this->db->join('customer', 'period_customer = customer_id');
        $this->db->join('(select sum(bill_reminder) as bill_sum ,customer_id as customer_sum_id from bill,period,customer where customer_id = period_customer AND period_id = bill_period group by customer_id) as bill_reminder_sum', 'customer_sum_id = customer_id', 'left');
        $this->db->where('customer_id', $customer_id);
        if ($bill_id != -1) {
            $this->db->where('bill_id', $bill_id);
        }
        $query = $this->db->get();
        return $query->result();
    }

    function customer_bill_get_reminder($customer_id, $bill_id) {
        $this->db->select('*'); // <-- There is never any reason to write this line!
        $this->db->from('bill');
        $this->db->join('period', 'period_id = bill_period');
        $this->db->join('customer', 'period_customer = customer_id');
        $this->db->where('customer_id', $customer_id);
        $this->db->where('bill_reminder >', 00);
        if ($bill_id != -1) {
            $this->db->where('bill_id', $bill_id);
        }
        $query = $this->db->get();
        return $query->result();
    }

    function customer_bill_get_reminder_for_payment($customer_id, $bill_id) {
        $this->db->select('*'); // <-- There is never any reason to write this line!
        $this->db->from('bill');
        $this->db->join('period', 'period_id = bill_period');
        $this->db->join('customer', 'period_customer = customer_id');
        $this->db->where('customer_id', $customer_id);
        $this->db->where('bill_reminder >', 00);
        //$this->db->where('bill_id !=', $bill_id);
        $query = $this->db->get();
        return $query->result();
    }

    function bill_get_payment_for_transfer($transfer_value, $bill_id) {
        $this->db->select('*'); // <-- There is never any reason to write this line!
        $this->db->from('payment');
        $this->db->where('payment_bill', $bill_id);
        $this->db->where('payment_value >=', $transfer_value);
        $query = $this->db->get();
        return $query->result();
    }

    function customer_bill_get_reminder_to_customer($customer_id, $bill_id) {
        $this->db->select('*'); // <-- There is never any reason to write this line!
        $this->db->from('bill');
        $this->db->join('period', 'period_id = bill_period');
        $this->db->join('customer', 'period_customer = customer_id');
        $this->db->where('customer_id', $customer_id);
        //$this->db->where('bill_id !=', $bill_id);
        $this->db->where('bill_reminder <', 00);
        $query = $this->db->get();
        return $query->result();
    }

    function bill_get_sum($bill_date, $bill_region, $bill_street) {
        $this->db->select_sum('bill_consumption', 'bill_consum'); // <-- There is never any reason to write this line!
        $this->db->select_sum('bill_paid', 'bill_paid'); // <-- There is never any reason to write this line!
        $this->db->select_sum('bill_reminder', 'bill_reminder'); // <-- There is never any reason to write this line!
        $this->db->select_sum('bill_discount', 'bill_discount'); // <-- There is never any reason to write this line!
        $this->db->from('bill');
        $this->db->join('period', 'period_id = bill_period');
        $this->db->join('customer', 'period_customer = customer_id');
        $this->db->join('street', 'customer_street = street_id');
        $this->db->join('region', 'street_region = region_id');
        $this->db->where('period_date', date('Y-m-d', $bill_date));
        if ($bill_street == -1) {
            if ($bill_region != -1) {
                $this->db->where_in('street_region', $bill_region);
            }
        } else {
            $this->db->where('street_id', $bill_street);
        }
        $query = $this->db->get();
        return $query->result();
    }

    function payment_get_selected_bill($bill_id) {
        $this->db->select('*'); // <-- There is never any reason to write this line!
        $this->db->from('bill');
        $this->db->join('payment', 'payment_bill = bill_id');
        $this->db->where('payment_bill', $bill_id);
        $query = $this->db->get();
        return $query->result();
    }

    function bill_get_debt($customer_id) {
//        $this->db->select_max('bill_id', 'bill_max_id'); // <-- There is never any reason to write this line!
//        $this->db->from('bill');
//        $this->db->join('period', 'bill_period = period_id', 'left');
//        $this->db->join('customer', 'period_customer = customer_id', 'left');
//        $this->db->where('customer_id', $customer_id);
//        $query = $this->db->get();
//
//        $bill_max_id = Array();
//        foreach ($query->result_array() as $id) {
//            $bill_max_id[] = $id['bill_max_id'];
//        }



        $this->db->select_sum('bill_reminder', 'bill_debt'); // <-- There is never any reason to write this line!
        $this->db->from('bill');
        $this->db->join('period', 'bill_period = period_id');
        $this->db->join('customer', 'period_customer = customer_id');
        $this->db->where('customer_id', $customer_id);
        //$this->db->where_not_in('bill_id', $bill_max_id);
        $query = $this->db->get();
        return $query->result();
    }

    function bill_get_selected($bill_id) {
        $this->db->select('*'); // <-- There is never any reason to write this line!
        $this->db->from('bill');
        $this->db->where('bill_id', $bill_id);
        $query = $this->db->get();
        return $query->result();
    }

    //////////////////// ***************** ////////////
    function cost_update($cost_price) {

        $this->db->set('cost_price', $cost_price);
        return $this->db->update('cost');
    }

    function cost_get_price() {
        $query = $this->db->get('cost');
        return $query->result();
    }

    ///////////////////////Change Password //////////////////

    function change_password($current_password, $new_password) {

        $this->db->select('*'); // <-- There is never any reason to write this line!
        $this->db->from('user');
        $this->db->where('user_password', md5($current_password));
        $query = $this->db->get();
        if (empty($query->result())) {
            return FALSE;
        }

        $this->db->set('user_password', md5($new_password));
        $this->db->where('user_password', md5($current_password));
        return $this->db->update('user');
    }

/////////////////////////////////////

    function period_consum_get_all($period_region, $period_street) {

        $this->db->select('*'); // <-- There is never any reason to write this line!
        $this->db->from('customer');
        $this->db->join('(select max(period_id) as period_max_id ,period_customer from period group by period_customer) as period_max', 'period_customer = customer_id', 'left');
        $this->db->join('period', 'period_max_id = period_id', 'left');
        $this->db->join('bill', 'period_max_id = bill_period', 'left');
        $this->db->join('(select sum(bill_reminder) as bill_sum ,customer_id as customer_sum_id from bill,period,customer where customer_id = period_customer AND period_id = bill_period group by customer_id) as bill_reminder_sum', 'customer_sum_id = customer_id', 'left');
        $this->db->join('street', 'customer_street = street_id');
        $this->db->join('region', 'street_region = region_id');
        // $this->db->where('period_date', date('Y-m-d', $period_date));
        if ($period_street == -1) {
            if ($period_region != -1) {
                $this->db->where_in('street_region', $period_region);
            }
        } else {
            $this->db->where('street_id', $period_street);
        }
        $this->db->order_by('region_name', 'ASC');
        $this->db->order_by('street_name', 'ASC');
        $this->db->order_by('customer_order', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    function statistic_get_sum($statistic_date_from, $statistic_date_to, $statistic_region, $statistic_street) {
        $this->db->select_sum('bill_consumption', 'bill_consum'); // <-- There is never any reason to write this line!
        $this->db->select_sum('bill_paid', 'bill_paid'); // <-- There is never any reason to write this line!
        $this->db->select_sum('bill_reminder', 'bill_reminder'); // <-- There is never any reason to write this line!
        $this->db->select_sum('bill_discount', 'bill_discount'); // <-- There is never any reason to write this line!
        //$this->db->select('SUM(bill_consumption * bill_price) as total', false);
        $this->db->select('SUM(bill_reminder) + SUM(bill_paid) + SUM(bill_discount) as bill_total', FALSE);
        $this->db->from('bill');
        $this->db->join('period', 'period_id = bill_period');
        $this->db->join('customer', 'period_customer = customer_id');
        $this->db->join('street', 'customer_street = street_id');
        $this->db->join('region', 'street_region = region_id');
        if ($statistic_date_from != '') {
            $this->db->where('period_reading_date >=', date('Y-m-d', $statistic_date_from));
        } if ($statistic_date_to != '') {
            $this->db->where('period_reading_date <=', date('Y-m-d', $statistic_date_to));
        }
        if ($statistic_street == -1) {
            if ($statistic_region != -1) {
                $this->db->where_in('street_region', $statistic_region);
            }
        } else {
            $this->db->where('street_id', $statistic_street);
        }
        $query = $this->db->get();
        return $query->result();
    }

    function statistic_get_sum_for_chart($statistic_date_from, $statistic_date_to, $statistic_region, $statistic_street) {
        $this->db->select_sum('bill_consumption', 'bill_consum'); // <-- There is never any reason to write this line!
       // $this->db->select_sum('bill_paid', 'bill_paid'); // <-- There is never any reason to write this line!
        $this->db->select_sum('bill_reminder', 'bill_reminder'); // <-- There is never any reason to write this line!
        // $this->db->select_sum('bill_discount', 'bill_discount'); // <-- There is never any reason to write this line!
        //$this->db->select('SUM(bill_consumption * bill_price) as total', false);
        //  $this->db->select('SUM(bill_reminder) + SUM(bill_paid) + SUM(bill_discount) as bill_total', FALSE);

        if ($statistic_region != -1) {
            $this->db->select('street_name as name');
        } else {
            $this->db->select('region_name as name');
        }
        $this->db->from('bill');
        $this->db->join('period', 'period_id = bill_period');
        $this->db->join('customer', 'period_customer = customer_id');
        $this->db->join('street', 'customer_street = street_id');
        $this->db->join('region', 'street_region = region_id');
        if ($statistic_date_from != '') {
            $this->db->where('period_reading_date >=', date('Y-m-d', $statistic_date_from));
        } if ($statistic_date_to != '') {
            $this->db->where('period_reading_date <=', date('Y-m-d', $statistic_date_to));
        }
        if ($statistic_street == -1) {
            if ($statistic_region != -1) {
                $this->db->where_in('street_region', $statistic_region);
                $this->db->group_by('street_name');
            } else {
                $this->db->group_by('region_name');
            }
        } else {
            $this->db->where('street_id', $statistic_street);
        }

        $query = $this->db->get();
        return $query->result();
    }

    function statistic_box_get_sum($statistic_date_from, $statistic_date_to) {
        $this->db->select_sum('box_value'); // <-- There is never any reason to write this line!
        $this->db->from('box');
        $this->db->join('box_respective', 'box_box_respective_id = box_respective_id');
        $this->db->join('box_type', 'box_respective_box_type = box_type_id');
        if ($statistic_date_from != '') {
            $this->db->where('box_date >=', date('Y-m-d', $statistic_date_from));
        }if ($statistic_date_to != '') {
            $this->db->where('box_date <=', date('Y-m-d', $statistic_date_to));
        }$query = $this->db->get();
        return $query->result();
    }

    function add_cost_insert($period_id, $add_cost_value, $add_cost_note) {

        $this->db->trans_start();
        $this->db->trans_strict();

        $this->db->set('bill_reminder', 'bill_reminder +' . (double) $add_cost_value, FALSE);
        $this->db->where('bill_period', $period_id);
        $this->db->update('bill');

        $data = array(
            'add_cost_period' => $period_id,
            'add_cost_value' => $add_cost_value,
            'add_cost_note' => $add_cost_note
        );

        $this->db->insert('add_cost', $data);

        return $this->db->trans_complete();
    }

    function get_add_cost($period_id) {
        $this->db->select('*'); // <-- There is never any reason to write this line!
        $this->db->from('add_cost');
        $this->db->where('add_cost_period', $period_id);
        $query = $this->db->get();
        return $query->result();
    }

    function add_cost_delete($add_cost_id) {

        $this->db->trans_start();
        $this->db->trans_strict();
        $add_cost_value = 0.0;
        $add_cost_period = 0;

        $this->db->select('*'); // <-- There is never any reason to write this line!
        $this->db->from('add_cost');
        $this->db->where('add_cost_id', $add_cost_id);
        $query = $this->db->get();
        foreach ($query->result_array() as $row) {
            $add_cost_value = $row['add_cost_value'];
            $add_cost_period = $row['add_cost_period'];
        }


        $this->db->set('bill_reminder', 'bill_reminder -' . (double) $add_cost_value, FALSE);
        $this->db->where('bill_period', $add_cost_period);
        $this->db->update('bill');

        $this->db->where('add_cost_period', $add_cost_period);
        $this->db->delete('add_cost');

        return $this->db->trans_complete();
    }

    function get_payment_list($payment_list_date) {


        $this->db->select('*'); // <-- There is never any reason to write this line!
        $this->db->from('customer');
        $this->db->join('period', ' customer_id = period_customer', 'left');
        $this->db->join('bill', ' period_id = bill_period', 'left');
        $this->db->join('payment', 'payment_bill = bill_id', 'left');
        $this->db->where('STR_TO_DATE(payment_date, "%Y-%m-%d") =', date('Y-m-d', $payment_list_date));
        $this->db->order_by('payment_date', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    ////Box

    function box_type_insert($box_type_name) {

        $data = array(
            'box_type_name' => $box_type_name
        );
        return $this->db->insert('box_type', $data);
    }

    function box_type_update($box_type_name, $box_type_id) {

        $this->db->set('box_type_name', $box_type_name);
        $this->db->where('box_type_id', $box_type_id);
        return $this->db->update('box_type');
    }

    function box_type_get_all() {
        $query = $this->db->get('box_type');
        return $query->result();
    }

    function box_type_get_selected($box_type_id) {
        $this->db->where('box_type_id', $box_type_id);
        $query = $this->db->get('box_type');
        //    $query = $this->db->get_where('box_type', array('image_active' => 'active'));
        return $query->result();
    }

    function box_type_delete($box_type_id) {
        $this->db->where('box_type_id', $box_type_id);
        return $this->db->delete('box_type');
    }

    //////////////////// ***************** ////////////
    //////////////////// box_respective Page ////////////

    function box_respective_insert($box_respective_name, $box_respective_box_type) {

        $data = array(
            'box_respective_name' => $box_respective_name,
            'box_respective_box_type' => $box_respective_box_type
        );
        return $this->db->insert('box_respective', $data);
    }

    function box_respective_update($box_respective_name, $box_respective_box_type, $box_respective_id) {

        $this->db->set('box_respective_name', $box_respective_name);
        $this->db->set('box_respective_box_type', $box_respective_box_type);
        $this->db->where('box_respective_id', $box_respective_id);
        return $this->db->update('box_respective');
    }

    function box_respective_get_all() {
        $this->db->select('*'); // <-- There is never any reason to write this line!
        $this->db->from('box_respective');
        $this->db->join('box_type', 'box_respective_box_type = box_type_id');
        $query = $this->db->get();
        return $query->result();
    }

    function box_respective_get_all_by_box_type($box_respective_box_type) {
        $this->db->select('*'); // <-- There is never any reason to write this line!
        $this->db->from('box_respective');
        $this->db->where('box_respective_box_type', $box_respective_box_type);
        $query = $this->db->get();
        return $query->result();
    }

    function box_respective_get_selected($box_respective_id) {
        $this->db->select('*'); // <-- There is never any reason to write this line!
        $this->db->from('box_respective');
        $this->db->join('box_type', 'box_respective_box_type = box_type_id');
        $this->db->where('box_respective_id', $box_respective_id);
        $query = $this->db->get();
        //    $query = $this->db->get_where('box_respective', array('image_active' => 'active'));
        return $query->result();
    }

    function box_respective_delete($box_respective_id) {
        $this->db->where('box_respective_id', $box_respective_id);
        return $this->db->delete('box_respective');
    }

    //////////////////// ***************** ////////////

    function box_insert($box_respective, $box_value, $box_note, $box_date) {

        $data = array(
            'box_box_respective_id' => $box_respective,
            'box_value' => $box_value,
            'box_note' => $box_note,
            'box_date' => $box_date
        );
        return $this->db->insert('box', $data);
    }

    function box_get_by_respective($box_respective) {
        $this->db->select('*'); // <-- There is never any reason to write this line!
        $this->db->from('box');
        $this->db->join('box_respective', 'box_box_respective_id = box_respective_id');
        $this->db->where('box_respective_id', $box_respective);
        $query = $this->db->get();
        return $query->result();
    }

    function box_delete($box_id) {
        $this->db->where('box_id', $box_id);
        return $this->db->delete('box');
    }

    function box_get_all($box_type, $box_respective, $box_date_from, $box_date_to) {
        $this->db->select('*'); // <-- There is never any reason to write this line!
        $this->db->from('box');
        $this->db->join('box_respective', 'box_box_respective_id = box_respective_id');
        $this->db->join('box_type', 'box_respective_box_type = box_type_id');
        if ($box_respective == -1) {
            if ($box_type != -1) {
                $this->db->where('box_type_id', $box_type);
            }
        } else {
            $this->db->where('box_respective_id', $box_respective);
        }
        if ($box_date_from != '') {
            $this->db->where('box_date >=', date('Y-m-d', $box_date_from));
        }if ($box_date_to != '') {
            $this->db->where('box_date <=', date('Y-m-d', $box_date_to));
        }$query = $this->db->get();
        return $query->result();
    }

}

?>