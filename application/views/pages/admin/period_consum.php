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
        <h3 class="font-red-flamingo page-title"> لوحة التحكم

        </h3>
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="icon-home"></i>
                    <a href="index">الرئيسة</a>
                    <i class="fa fa-angle-left"></i>
                </li>
                <li>
                    <span>كشف قراءة عدادات المستركين</span>
                </li>
            </ul>
        </div>
        <!-- END PAGE HEADER-->
        <!-- BEGIN DASHBOARD STATS 1-->

        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <form class="form-inline margin-bottom-30" role="form" method="post" action="" id="period"
                      enctype="multipart/form-data">

                    <!--                        <div class="form-inline">
                                                <label for="period_date" class="col-md-2 control-labeli">دورة شهر</label>
                                                <div class="col-md-4">
                                                    <input type="month" class="form-control monthpicker" id="period_date" name="period_date" placeholder="اسم المشترك">
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>-->
                    <div class="form-inline">
                        <label for="period_region" class="col-md-2 control-labeli">المنطقة</label>
                        <div class="col-md-4">
                            <select class="form-control" id="period_region">
                                <option id="region_-1">اختر منطقة</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-inline">
                        <label for="period_street" class="col-md-2 control-labeli">الشارع</label>
                        <div class="col-md-4">
                            <select class="form-control" id="period_street">
                                <option id="region_-1">اختر شارع</option>
                            </select>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <hr>

                    <button type="submit" id="period_list_ok" class="btn green display block center-block">جلب
                        البيانات
                    </button>

                    <div class="clearfix"></div>
                    <hr>
                    <!--                        <div class="form-group">
                                                <div class="col-md-offset-2 col-md-10">
                                                    <button type="submit" id="print_report" class="btn blue">طباعة</button>
                                                </div>
                                            </div>-->
                </form>
            </div>
        </div>
        <div class="clearfix"></div>
        <!-- END DASHBOARD STATS 1-->
        <div class="row">
            <div class="col-md-12 col-md-offset-0">
                <img class="loadingimg center-block" src="<?php echo base_url(); ?>assets_admin/global/img/loadingn.gif"
                     alt="جاري التحميل"/>
                <div class="loadingsection portlet box red">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-comments"></i>جدول الدورات
                        </div>
                        <div class="tools">
                            <a id="print_report" class="fa fa-print fa-2x " style="color: #fafcfb;"
                               data-original-title="" title=""> </a>
                            <a id="print_report_details" class="fa fa-print fa-2x " style="color: white;"
                               data-original-title="" title=""> </a>

                            <a id="btn_print" class="fa fa-print fa-2x " style="color: #38C6D8;"
                               data-original-title="" title=""> </a>
                               
                            <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                            <a href="#portlet-config" data-toggle="modal" class="config" data-original-title=""
                               title=""> </a>
                            <a href="javascript:;" class="reload" data-original-title="" title=""> </a>
                            <a href="javascript:;" class="remove" data-original-title="" title=""> </a>
                        </div>
                    </div>
                    <div class="portlet-body" style="display: block;">
                        <table class="table table-striped table-hover table-bordered" id="period_table">
                            <thead>
                            <tr>
                                <th> #</th>
                                <th>اسم المشترك</th>
                                <th>رقم الجوال</th>
                                <th>المنطقة</th>
                                <th>الشارع</th>
                                <th>تاريخ القراءة السابقة</th>
                                <th>قراءة العداد السابقة</th>
                                <th>قراءة العداد الحالية</th>
                                <th>مستحقات الفاتورة السابقة</th>
                                <th>مجموع المستحقات</th>
                                <th>ملاحظة</th>
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
<!--  END CONTAINER -->
<script>
    $(document).ready(function () {
// query and print page 
            print_url = function (period_region, period_street) {
                

                url = '<?php echo base_url(); ?>';
                url+=`main/period_consum_get_all_print?period_region=${period_region}&period_street=${period_street}`;
                window.open(url, '_blank');
               
            };

           

            $('#btn_print').click(function(e) {
                // call get period date
                print_url($('#period_region').children("option:selected").prop('id').split('_').pop()
                , $('#period_street').children("option:selected").prop('id').split('_').pop());
            });


// query anf print page


        var ArrayToPrint =[];
        var period = $('#period_table').dataTable(function () {
        });
        window.onload = function () {
            region_get_all();
        };
        $('#period_list_ok').on('click', function (e) {
            e.preventDefault();
            period_consum_get_all($('#period_region').children("option:selected").prop('id').split('_').pop()
                , $('#period_street').children("option:selected").prop('id').split('_').pop());
        });
        period_consum_get_all = function (period_region, period_street) {
            $('.loadingimg').show();
            $('.loadingsection').hide();
            $.ajax({
                url: '<?php echo base_url(); ?>main/period_consum_get_all',
                type: 'post',
                data: {period_region: period_region, period_street: period_street}, success: function (data) {
                    arrs = JSON.parse(data);
                    ArrayToPrint = arrs;
                    period.fnDestroy();
                    console.log(arrs);
                    if (arrs['status'] !== 'error') {
                        html = '';
                        count = 1;
                        $.each(arrs, function (Index, Entry) {
                            html += '<tr id="' + Entry.period_id + '">';
                            html += '<td width="10px">' + count++ + '</td>';
                            html += '<td width="30%">' + Entry.customer_name + '</td>';
                            html += '<td>' + Entry.customer_jawwal + '</td>';
                            html += '<td>' + Entry.region_name + '</td>';
                            html += '<td>' + Entry.street_name + '</td>';
                            html += '<td>' + Entry.period_reading_date + '</td>';
                            html += '<td>' + Entry.period_reading + '</td>';
                            html += '<td>' + 'ـ ـ ـ ـ ـ ـ ـ ـ ـ ـ ـ' + '</td>';
                            html += '<td>' + Entry.bill_reminder + '</td>';
                            html += '<td>' + Entry.bill_sum + '</td>';
                            html += '<td>' + Entry.period_note + '</td>';
                            html += '</tr>';
                        });
                        $('#period_table tbody').html(html);

                        period = $('#period_table').dataTable(function () {
                        });

                        $('.loadingimg').hide();
                        $('.loadingsection').show();
                    } else {
                        $('#period_table tbody').html('');
                        // swal("Opps", arrs['msg'], "info");
                        $('.loadingimg').hide();
                        $('.loadingsection').show();
                    }
                }


            });
        };

        region_get_all = function () {
            $.ajax({
                url: '<?php echo base_url(); ?>main/region_get_all',
                type: 'post',
                success: function (data) {
                    arrs = JSON.parse(data);
                    if (arrs['status'] !== 'error') {
                        var html = '<option id="region_-1"> اختار منطقة </div>';
                        $.each(arrs, function (Index, Entry) {
                            html += '<option id="' + ('region_').concat(Entry.region_id) + '">';
                            html += Entry.region_name;
                            html += '</option>';
                        });
                        $('#period_region').html(html);
                    } else {

                        swal("Opps", arrs['msg'], "info");
                    }
                }


            });
        };
        $('#period_region').change(function () {

            street_get_all_by_region($(this).children("option:selected").prop('id').split('_').pop());

        });
//        $('#period_street').change(function () {
//            period_consum_get_all($('#period_region').children("option:selected").prop('id').split('_').pop()
//                    , $(this).children("option:selected").prop('id').split('_').pop());
//        });
        street_get_all_by_region = function (street_region) {
            $.ajax({
                url: '<?php echo base_url(); ?>main/street_get_all_by_region',
                type: 'post',
                data: {street_region: street_region},
                success: function (data) {
                    arrs = JSON.parse(data);
                    if (arrs['status'] !== 'error') {
                        var html = '<option id="street_-1">اختر شارع</div>';
                        $.each(arrs, function (Index, Entry) {
                            html += '<option id="' + ('street_').concat(Entry.street_id) + '">';
                            html += Entry.street_name;
                            html += '</option>';
                        });
                        $('#period_street').html(html);
                    } else {

                        //  swal("Opps", arrs['msg'], "info");
                    }
                }


            });
        };


        $('#print_report_details').click(function (e) {
            e.preventDefault();
            bill_print_func();
        });

        $('#print_report').click(function (e) {
            e.preventDefault();
            var period_region = $('#period_region').children("option:selected").val() !== 'اختار منطقة' ?
                $('#period_region').children("option:selected").val() : '';
            var period_street = $('#period_street').children("option:selected").val() !== 'اختر شارع' ?
                ', ' + $('#period_street').children("option:selected").val() : '';

            var report = '<style>'
                + '@media print {table {page-break-after: always;}}'
                //+ 'tr{page-break-inside: avoid !important;page-break-after: auto !important;}}'
                + 'th{text-align:center;font-size:14px;direction:rtl;}'
                + 'td{text-align:center;font-size:12px;direction:rtl;}'
                + 'tr{page-break-inside: avoid !important;page-break-after: auto !important;}'
                + '.loc_label{float:right;padding-left:10px;}'
                + '.loc_title{float:right;width:250px;padding-top:5px;}'
                + 'table{margin-bottom:5px;}ul{list-style:none;}'
                + '.right-header{left:0;background:#ddd;position:absolute;top:0}'
                + '.right-header{right:0;background:#333;position:absolute;top:0}'
                + '</style>';
//

            var head = '<div class="row-fluid" style="padding-top:0px;'
                + 'padding-bottom:0px;border-bottom:2px solid #000000;margin-bottom: 0px;direction:rtl;">'
                + '<div style="text-align:center;font-weight:bold";margin-bottom: 0px;>' //position:relative;width:250px;height:90;margin:0 auto;
                + 'كشف قراءة عدادات المشتركين</div><div class="loc_title"><strong>' + period_region + '  ' + period_street + '</strong></div></div>'
                + '<div class="row-fluid" style="padding-top:5px;padding-bottom:5px;margin-bottom:5px;direction:rtl;">'
                + '<div class="loc_label"></div>'
                + '</div>';
            var secondHead = '<div style="padding-top:5px;padding-bottom:5px;margin-bottom:5px;direction:rtl;" class="loc_title"><strong>' + period_region + '  ' + period_street + '</strong></div>';

            var header = '<table width="100%" border="1" cellspacing="0" cellpadding="5">'
                + '<tr><th width="8%" scope="col">ملاحظة</th>'
                + '<th width="8%" scope="col">مجموع المستحقات</th>'
                + '<th width="8%" scope="col">مستحقات الفاتورة السابقة</th>'
                + '<th width="8%" scope="col">القراءة الحالية</th>'
                + '<th width="8%" scope="col">القراءة السابقة</th>'
                + '<th width="8%" scope="col">تاريخ القراءة السابقة</th>'
                + '<th width="6%" scope="col">الجوال</th>'
                // + '<th width="6%" scope="col">المنطقة</th>'
                + '<th width="12%" scope="col">اسم المشترك</th>'
                + '<th width="2%"  scope="col">م</th></tr>';
            var temp = '';
            var ptype;
            var ptype2;
            var status = "";
            var p_type = "";
            if (ArrayToPrint.length > 20) {

                for (var i = 0; i < ArrayToPrint.length; i++) {
                    var row = ArrayToPrint[i];
                    if (i % 20 == 0) {
                        if (i > ArrayToPrint.length) {
                            temp += '</tbody></table><div style="clear:both;"></div>';
                        }
                        if (i == 0) {
                            temp += '</tbody></table>';
                            temp += header;
                        } else {
                            temp += '</tbody></table><br><div class="p-break"></div>';
                            temp += secondHead;
                            temp += header;
                        }
                    }
                    if (row.bill_sum == 0) {
                        row.bill_sum = '';
                    }
                    if (row.bill_reminder == 0) {
                        row.bill_reminder = '';
                    }
                    temp += '<tr><td><span style=" font-size: 120%;">' + row.period_note + '</span></td>'
                        + '<td><span style=" font-size: 120%;">' + row.bill_sum + '</span></td>'
                        + '<td><span style=" font-size: 120%;">' + row.bill_reminder + '</span></td>'
                        + '<td><span style=" font-size: 120%;">ـ ـ ـ ـ ـ ـ</span></td>'
                        + '<td><span style=" font-size: 120%;">' + row.period_reading + '</span></td>'
                        + '<td><span style=" font-size: 120%;">' + row.period_reading_date + '</span></td>'
                        + '<td><span style=" font-size: 120%;">' + row.customer_jawwal + '</span></td>'
                        // + '<td><span style=" font-size: 120%;">' + row.region_name + '</span></td>'
                        + '<td><span style=" font-size: 120%;">' + row.customer_name + '</span></td>'
                        + '<td><span style=" font-size: 120%;">' + (parseInt(i) + 1) + '</span></td>';

                } // end for			

                report += head;
                report += temp;

            } else if (ArrayToPrint.length <= 20) {
                temp += header;
                for (var i = 0; i < ArrayToPrint.length; i++) {
                    var row = ArrayToPrint[i];

                    if (row.bill_sum == 0) {
                        row.bill_sum = '';
                    }
                    if (row.bill_reminder == 0) {
                        row.bill_reminder = '';
                    }
                    temp += '<tr><td><span style=" font-size: 120%;">' + row.period_note + '</span></td>'
                        + '<td><span style=" font-size: 120%;">' + row.bill_sum + '</span></td>'
                        + '<td><span style=" font-size: 120%;">' + row.bill_reminder + '</span></td>'
                        + '<td><span style=" font-size: 120%;">ـ ـ ـ ـ ـ ـ</span></td>'
                        + '<td><span style=" font-size: 120%;">' + row.period_reading + '</span></td>'
                        + '<td><span style=" font-size: 120%;">' + row.period_reading_date + '</span></td>'
                        + '<td><span style=" font-size: 120%;">' + row.customer_jawwal + '</span></td>'
                        //   + '<td><span style=" font-size: 120%;">' + row.region_name + '</span></td>'
                        + '<td><span style=" font-size: 120%;">' + row.customer_name + '</span></td>'
                        + '<td><span style=" font-size: 120%;">' + (parseInt(i) + 1) + '</span></td>';
                } // end for
                report += head;
                report += temp;
                report = report + '</table>';
                temp = '';
            }
            var newWindow = window.open('', '', 'width=1000, height=600'),
                document = newWindow.document.open();

            document.write(report);
            report = '';

            document.close();
            newWindow.print();

        });


        bill_print_func = function () {

            var allReport = '';

            for (var z = 0; z < ArrayToPrint.length; z++) {

                var row = ArrayToPrint[z];

                var add_cost_datails = '';
                var bill_period =  row.period_date;
                var customer_bill_customer =row.customer_name;

                var report = '<style>'
                    + 'th{text-align:center;font-size:14px;direction:rtl;}'
                    + 'td{text-align:center;font-size:12px;direction:rtl;}'
                    + 'tr{page-break-inside: avoid !important;page-break-after: auto !important;}'
                    + '.loc_label{float:right;padding-left:10px;}'
                    + '.loc_title{float:right;width:550px;padding:15px;}'
                    + 'table{margin-bottom:5px;}ul{list-style:none;}'
                    + '.right-header{left:0;background:#ddd;position:absolute;top:0}'
                    + '.right-header{right:0;background:#333;position:absolute;top:0}'
                    + '.pagebreak { page-break-before: always; } /* page-break-after works, as well */\n'
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


                var add_cost_print = row.add_cost;

                if (add_cost_print.length > 0) {
                    add_cost_datails = '<br><br><div style="float:right;direction:rtl;"> <strong> مبالغ أخرى تم إضافتها على الفاتورة:   </strong> <br>  <br>';

                    for (var i = 0; i < add_cost_print.length; i++) {
                        var add_cost_row = add_cost_print[i];
                        add_cost_datails += '<strong> ' + add_cost_row.add_cost_value + ' --- ' + add_cost_row.add_cost_note + '</strong><br>';
                    }
                    add_cost_datails += '</div> <br> <br>';

                }

                var temp = '';
                var temp_details = '';
                var ptype;
                var ptype2;
                var status = "";
                var p_type = "";

                var payment_print = row.payment;

                for (var i = 0; i < payment_print.length; i++) {
                    var payment_print_row = payment_print[i];
                    temp_details += '<tr><td><span style=" font-size: 120%;">' + payment_print_row.payment_note + '</span></td>'
                        + '<td><span style=" font-size: 120%;">' + payment_print_row.payment_discount + '</span></td>'
                        + '<td><span style=" font-size: 120%;">' + payment_print_row.payment_value + '</span></td>'
                        + '<td><span style=" font-size: 120%;">' + payment_print_row.payment_date + '</span></td></tr>';
                } // end for


                temp += header;



                    temp += '<tr><td><span style=" font-size: 120%;">' + row.bill_sum + '</span></td>'
                        + '<td><span style=" font-size: 120%;">' + (row.bill_sum - row.bill_reminder) + '</span></td>'
                        + '<td><span style=" font-size: 120%;">' + row.bill_reminder + '</span></td>'
                        + '<td><span style=" font-size: 120%;">' + row.bill_discount + '</span></td>'
                        + '<td><span style=" font-size: 120%;">' + row.bill_paid + '</span></td>'
                        + '<td><span style=" font-size: 120%;"><strong>' + parseFloat(row.bill_price) * parseFloat(row.bill_consumption) + '</strong></span></td>'
                        + '<td><span style=" font-size: 120%;">' + row.bill_price + '</span></td>'
                        + '<td><span style=" font-size: 120%;">' + row.bill_consumption + '</span></td>'
                        + '<td><span style=" font-size: 120%;">' + row.period_reading + '</span></td>'
                        + '<td><span style=" font-size: 120%;">' + row.period_previous_reading + '</span></td>'
                        + '<td><span style=" font-size: 120%;">' + row.period_reading_date + '</span></td>';

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
                if(z !=  ArrayToPrint.length - 1){
                    report += '<div class="pagebreak"> </div>';
                }
                allReport += report;

                temp = '';

            }


            var newWindow = window.open('', '', 'width=1000, height=600'),
                document = newWindow.document.open();

            document.write(allReport);
            allReport = '';

            document.close();
            newWindow.print();

        };


    });

</script>