<?php
//if ($_FILES) {
//    $name = $_FILES['image']['name'];
//    move_uploaded_file($_FILES['image']['tmp_name'], $name);
//    echo "Uploaded image '$name'<br><img src='$name'>";
//}
?>




<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content" style="min-height:265px">
        <!-- BEGIN PAGE HEADER-->
        <div class="hide_print">
            <h3 class="font-red-flamingo page-title">  لوحة التحكم 

            </h3>
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="icon-home"></i>
                        <a href="index">الرئيسة</a>
                        <i class="fa fa-angle-left"></i>
                    </li>
                    <li>
                        <span>كشف الفواتير</span>
                    </li>
                </ul>
            </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN DASHBOARD STATS 1-->
        </div>
        <div class="row hide_print">
            <div class="col-md-10 col-md-offset-1">
                <form class="form-inline margin-bottom-30" role="form" method="post" action="" id="period" enctype="multipart/form-data">

                    <div class="form-inline">
                        <label for="period_customer" class="hide_print col-md-2 control-labeli">المشترك</label>
                        <div class="col-md-4">
                            <select class="form-control hide_print" data-live-search="true" id="customer_bill_customer">
                                <option id="customer_-1">اختر مشترك</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-inline">
                        <label for="bill_period" class="hide_print col-md-2 control-labeli">الدورة</label>
                        <div class="col-md-4">
                            <select class="form-control hide_print" id="bill_period">
                                <option id="period_-1">اختر دورة</option>
                            </select>
                        </div>
                    </div>

                </form>
            </div>
        </div>
        <div class="clearfix"></div>
        <br>
        <!-- END DASHBOARD STATS 1-->
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="portlet box red">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-comments"></i>جدول فواتير ودفعات المشترك...</div>
                        <div class="tools">
                            <a id="print_report" class="hide_print fa fa-print fa-2x " style="color: #fafcfb;" data-original-title="" title=""> </a>
                            <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                            <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""> </a>
                            <a href="javascript:;" class="reload" data-original-title="" title=""> </a>
                            <a href="javascript:;" class="remove" data-original-title="" title=""> </a>
                        </div>
                    </div>
                    <div class="portlet-body" style="display: block;">
                        <div id="customer_name_title" style="font-size: 20px;padding: 10px;"></div>
                        <table class="table table-striped table-hover table-bordered" id="customer_bill_table">
                            <thead>
                                <tr>
                                    <th> # </th>
                                    <th>تاريخ القراءة</th>
                                    <th>القراءة السابقة</th>
                                    <th>القراءة الحالية</th>
                                    <th>الاستهلاك الشهري</th>
                                    <th>السعر</th>
                                    <th>قيمة الفاتورة</th>
                                    <th>المدفوع</th>
                                    <th>الخصم</th>
                                    <th>المتبقي لهذه الفاتورة</th>                            
                                    <th>مستحقات سابقة</th>                            
                                    <th> مجموع المستحقات</th>                            
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>








    </div>
    <!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<script>
    $(document).ready(function () {

        var bill_ids = new Array();
        var bill_periods = new Array();
        var bill_print;
        var payment_print;
        var add_cost_print;
        window.onload = function () {
            customer_bill_get_customer();
        };
        $('#customer_bill_customer').change(function () {
            
            bill_get_period($(this).children("option:selected").prop('id').split('_').pop(), -1);
            customer_bill_get_all($(this).children("option:selected").prop('id').split('_').pop(), -1);

        });

        $('#bill_period').change(function () {

            customer_bill_get_all($("#customer_bill_customer").children("option:selected").prop('id').split('_').pop(), $("#bill_period").children("option:selected").prop('id').split('_').pop());

        });


        customer_bill_get_customer = function () {

            $.ajax({
                url: '<?php echo base_url(); ?>main/customer_get_for_select',
                type: 'post',
                success: function (data) {
                    arrs = JSON.parse(data);
                    $('#customer_bill_customer').selectpicker('destroy');
                    if (arrs['status'] !== 'error')
                    {
                        var html = '<option id="customer_-1"> اختار مشترك </div>';
                        $.each(arrs, function (Index, Entry) {
                            html += '<option id="' + ('customer_').concat(Entry.customer_id) + '">';
                            html += Entry.customer_name;
                            html += '</option>';
                        });

                        $('#customer_bill_customer').html(html);

                        $('#customer_bill_customer').selectpicker({
                            style: 'btn-info',
                            size: 4
                        });


                    } else {
                        swal("Opps", arrs['msg'], "info");
                    }
                }


            });
        };


        bill_get_period = function (customer_id, bill_period) {

            $.ajax({
                url: '<?php echo base_url(); ?>main/customer_bill_get_all',
                type: 'post',
                data: {customer_id: customer_id, bill_period: bill_period},
                success: function (data) {
                    arrs = JSON.parse(data);
                    if (arrs['status'] !== 'error')
                    {
                        var html = '<option id="customer_-1"> اختار دورة </div>';
                        $.each(arrs, function (Index, Entry) {
                            html += '<option id="' + ('selectbill_').concat(Entry.bill_id) + '">';
                            html += Entry.period_reading_date;
                            html += '</option>';
                        });

                        $('#bill_period').html(html);

                    } else {
                        swal("Opps", arrs['msg'], "info");
                    }
                }


            });
        };

        customer_bill_get_all = function (customer_id, bill_period) {
            bill_print = new Array();
            bill_ids = new Array();
            bill_periods = new Array();
            $.ajax({
                url: '<?php echo base_url(); ?>main/customer_bill_get_all',
                type: 'post',
                data: {customer_id: customer_id, bill_period: bill_period},
                success: function (data) {
                    arrs = JSON.parse(data);
                    bill_print = arrs;
                    if (arrs['status'] !== 'error')
                    {
                        customer_name = $('#customer_bill_customer').children("option:selected").val() !== 'اختار مشترك' ?
                                $('#customer_bill_customer').children("option:selected").val() : '';

                        html = '<tr>';
                        $("#customer_name_title").html('كشف حساب المشترك: ' + customer_name);
                        count = 1;
                        $.each(arrs, function (Index, Entry) {
                            html += '<tr>';
                            html += '<td>' + count++ + '</td>';
                            html += '<td>' + Entry.period_reading_date + '</td>';
                            html += '<td>' + Entry.period_previous_reading + '</td>';
                            html += '<td>' + Entry.period_reading + '</td>';
                            html += '<td>' + Entry.bill_consumption + '</td>';
                            html += '<td>' + Entry.bill_price + '</td>';
                            html += '<td> <strong>' + parseFloat(Entry.bill_price) * parseFloat(Entry.bill_consumption) + '</strong></td>';
                            html += '<td>' + Entry.bill_paid + '</td>';
                            html += '<td>' + Entry.bill_discount + '</td>';
                            html += '<td>' + Entry.bill_reminder + '</td>';
                            html += '<td>' + (Entry.bill_sum - Entry.bill_reminder) + '</td>';
                            html += '<td>' + Entry.bill_sum + '</td>';
                            html += '</tr>';
                            html += '<tr class="porder_hide_print" style="border:0px !important">';
                            html += '<td class="porder_hide_print" style="border:0px !important" colspan="12"><div id=bill_' + Entry.bill_id + '></div></td>';
                            html += '</tr>';
                            html += '<tr class="porder_hide_print" style="border:0px !important">';
                            html += '<td class="porder_hide_print" style="border:0px !important" colspan="12"><div id=period_' + Entry.bill_period + '></div></td><br>';
                            html += '</tr>';

                            bill_ids.push(Entry.bill_id);
                            bill_periods.push(Entry.bill_period);
                        });
                        $('#customer_bill_table tbody').html(html);
                        $.each(bill_ids, function (index, value) {
                            customer_bill_get_payment(value);
                        });
                        $.each(bill_periods, function (index, value) {
                            get_add_cost(value);
                        });
                    } else {
                        $('#customer_bill_table tbody').html('');
                        swal("Opps", arrs['msg'], "info");
                    }
                }


            });
        };

        customer_bill_get_payment = function (bill_id) {
            $.ajax({
                url: '<?php echo base_url(); ?>main/payment_get_selected_bill',
                type: 'post',
                data: {bill_id: bill_id},
                success: function (data) {
                    arrs = JSON.parse(data);
                    payment_print = arrs;
                    if (arrs['status'] !== 'error')
                    {
                        html = '<table class="porder_hide_print" style="width: 100%;line-height: 25px;"><tbody><thead><tr><td width="10%"></td><td width="30%">التاريخ</td><td width="15%">قيمة الدفعة</td><td  width="15%">الخصم</td><td width="30%">ملاحظة</td></tr></thead>';
                        count = 1;
                        payment_sum = 00;
                        $.each(arrs, function (Index, Entry) {
                            html += '<td> </td>';
                            html += '<td>' + Entry.payment_date + '</td>';
                            html += '<td>' + Entry.payment_value + '</td>';
                            html += '<td>' + Entry.payment_discount + '</td>';
                            html += '<td>' + Entry.payment_note + '</td>';
                            html += '</tr>';
                            payment_sum += parseFloat(Entry.payment_value) + parseFloat(Entry.payment_discount);
                        });
                        $('#bill_' + bill_id).html(html + '<tr class="porder_hide_print"><td class="porder_hide_print"></td><td class="porder_hide_print" style="text-align:center;font-weight:bold;" colspan="4"> مجموع الدفعات:' + payment_sum + '</td></tr></tbody></table>');
                    } else {
                        bill_id = -1;
                        $('#payment_table tbody').html('');
                        // swal("Opps", arrs['msg'], "info");
                    }
                }



            });
        };

        get_add_cost = function (period_id) {
            $.ajax({
                url: '<?php echo base_url(); ?>main/get_add_cost',
                type: 'post',
                data: {period_id: period_id},
                success: function (data) {
                    arrs = JSON.parse(data);
                    add_cost_print = arrs;
                    if (arrs['status'] !== 'error')
                    {
                        html = 'مبالغ أخرى تم إضافتها على الفاتورة';
                        $.each(arrs, function (Index, Entry) {
                            html += '<br>';
                            html += Entry.add_cost_value + ' --- ' + Entry.add_cost_note;
                        });
                        $('#period_' + period_id).html(html + '<br>');

                    } else {
                        //  swal("Opps,", arrs['msg'], "info");
                    }
                }


            });
        };


        $('#print_report').click(function (e) {
            e.preventDefault();
            if ($("#bill_period").children("option:selected").prop('id').split('_').pop() != -1) {
                bill_print_func();
            } else {
                // swal("الدورة غير محددة", 'الرجاء تحديد دورة', "info");
                window.print();
            }

        });

        bill_print_func = function () {

            var add_cost_datails = '';
            var bill_period = $('#bill_period').children("option:selected").val() !== 'اختار دورة' ?
                    $('#bill_period').children("option:selected").val() : '';
            var customer_bill_customer = $('#customer_bill_customer').children("option:selected").val() !== 'اختار مشترك' ?
                    $('#customer_bill_customer').children("option:selected").val() : '';

            var report = '<style>'
                    + 'th{text-align:center;font-size:14px;direction:rtl;}'
                    + 'td{text-align:center;font-size:12px;direction:rtl;}'
                    + 'tr{page-break-inside: avoid !important;page-break-after: auto !important;}'
                    + '.loc_label{float:right;padding-left:10px;}'
                    + '.loc_title{float:right;width:550px;padding:15px;}'
                    + 'table{margin-bottom:5px;}ul{list-style:none;}'
                    + '.right-header{left:0;background:#ddd;position:absolute;top:0}'
                    + '.right-header{right:0;background:#333;position:absolute;top:0}'
                    + '</style>';
//

            var head = '<div class="row-fluid" style="padding-top:0px;'
                    + 'padding-bottom:0px;border-bottom:2px solid #000000;margin-bottom: 0px;direction:rtl;">'
                    + '<div style="text-align:center;font-weight:bold";margin-bottom: 10px;margin-top: 50px;>كشف فاتورة</div>' //position:relative;width:250px;height:90;margin:0 auto;
                    + '<div class="loc_title"><strong>' + customer_bill_customer + ', ' + bill_period + ' </strong></div></div>'
                    + '<div class="row-fluid" style="padding-top:5px;padding-bottom:5px;margin-bottom:5px;direction:rtl;">'
                    + '<div class="loc_label"></div>'
                    + '</div>';
            var header = '<table width="100%" border="1" cellspacing="0" cellpadding="5">'
                    + '<tr><th width="8%" scope="col">مجموع المستحقات</th>'
                    + '<th width="8%" scope="col">مستحقات سابقة</th>'
                    + '<th width="8%" scope="col">المتبقي لهذه الفاتورة</th>'
                    + '<th width="8%" scope="col">المخصوم</th>'
                    + '<th width="8%" scope="col">المدفوع</th>'
                    + '<th width="8%" scope="col">قيمة الفاتورة</th>'
                    + '<th width="8%" scope="col">السعر</th>'
                    + '<th width="8%" scope="col">الإستهلاك الشهري</th>'
                    + '<th width="6%" scope="col">القراءة الحالية</th>'
                    + '<th width="6%" scope="col">القراءة السابقة</th>'
                    + '<th width="12%" scope="col">تاريخ القراءة</th>';

            var header_details = '<table width="100%" border="0" cellspacing="0" cellpadding="5">'
                    + '<tr>'
                    + '<th width="8%" scope="col">ملاحظة</th>'
                    + '<th width="8%" scope="col">الخصم</th>'
                    + '<th width="6%" scope="col">قيمة الدفعة</th>'
                    + '<th width="6%" scope="col">التاريخ</th>';


            if (add_cost_print.length > 0) {
                add_cost_datails = '<br><br><div style="float:right;direction:rtl;"> <strong> مبالغ أخرى تم إضافتها على الفاتورة:   </strong> <br>  <br>';

                for (var i = 0; i < add_cost_print.length; i++)
                {
                    var row = add_cost_print[i];
                    add_cost_datails += '<strong> ' + row.add_cost_value + ' --- ' + row.add_cost_note + '</strong><br>';
                }
                add_cost_datails += '</div> <br> <br>';

            }

            var temp = '';
            var temp_details = '';
            var ptype;
            var ptype2;
            var status = "";
            var p_type = "";

            for (var i = 0; i < payment_print.length; i++)
            {
                var row = payment_print[i];
                temp_details += '<tr><td><span style=" font-size: 120%;">' + row.payment_note + '</span></td>'
                        + '<td><span style=" font-size: 120%;">' + row.payment_discount + '</span></td>'
                        + '<td><span style=" font-size: 120%;">' + row.payment_value + '</span></td>'
                        + '<td><span style=" font-size: 120%;">' + row.payment_date + '</span></td></tr>';
            } // end for



            temp += header;
            for (var i = 0; i < bill_print.length; i++)
            {
                var row = bill_print[i];
                temp += '<tr><td><span style=" font-size: 120%;">' + row.bill_sum + '</span></td>'
                        + '<td><span style=" font-size: 120%;">' + (row.bill_sum  - row.bill_reminder) + '</span></td>'
                        + '<td><span style=" font-size: 120%;">' + row.bill_reminder + '</span></td>'
                        + '<td><span style=" font-size: 120%;">' + row.bill_discount + '</span></td>'
                        + '<td><span style=" font-size: 120%;">' + row.bill_paid + '</span></td>'
                        + '<td><span style=" font-size: 120%;"><strong>' + parseFloat(row.bill_price) * parseFloat(row.bill_consumption) + '</strong></span></td>'
                        + '<td><span style=" font-size: 120%;">' + row.bill_price + '</span></td>'
                        + '<td><span style=" font-size: 120%;">' + row.bill_consumption + '</span></td>'
                        + '<td><span style=" font-size: 120%;">' + row.period_reading + '</span></td>'
                        + '<td><span style=" font-size: 120%;">' + row.period_previous_reading + '</span></td>'
                        + '<td><span style=" font-size: 120%;">' + row.period_reading_date + '</span></td>';
            } // end for
            report += head;
            report += temp;
            report = report + '</table>' + '<br><div style="text-align:center;font-weight:bold";margin-bottom: 0px;>' //position:relative;width:250px;height:90;margin:0 auto;
                    + 'تفاصيل الفاتورة</div><br>';
            var footer = '<div class="row-fluid" style="padding-top:0px;'
                    + 'padding-bottom:0px;margin-top: 30px;direction:rtl;">'
                    + '<div class="loc_title"></div></div><br><br>'
                    + '<div class="loc_title" style="float:left"></div></div>'
                    + '<div class="row-fluid" style="padding-top:5px;padding-bottom:5px;margin-bottom:5px;direction:rtl;">'
                    + '<div class="loc_label"></div>'
                    + '</div>';
            report += header_details + temp_details + '</table>' + add_cost_datails + footer;
            temp = '';

            var newWindow = window.open('', '', 'width=1000, height=600'),
                    document = newWindow.document.open();

            document.write(report);
            report = '';

            document.close();
            newWindow.print();

        };


    });

</script>