<?php

class Mma {

 public function bill_get_all() {
        $list = $this->bill->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $bill) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $bill->customer_name;
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
}

?>